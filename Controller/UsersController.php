<?php
App::uses('AppController', 'Controller');
/**
 * Users Controller
 *
 * @property User $User
 */
class UsersController extends AppController {

/**
 * beforeFilter method
 *
 * @return void
 */

        public function beforeFilter() {
            parent::beforeFilter();
            $this->Auth->allow('login','logout');
        }
 
 /**
 * login method
 *
 * @return void
 */
 
	public function login() {
            //$this->layout = 'login';
            if ($this->request->is('post')) {
		if ($this->Auth->login()) {
                    //get the current conference
                    $this->loadModel('Conference');
                    $current_month = date('n');
                    $current_year = date('Y');
                    
                    //determine the current term
                    if ($current_month <= 6) $current_term = 'Spring';
                    else if ($current_month >= 7) $current_term = 'Fall';
                    
                    //find all conferences in current term
                    $near_conferences = array_merge($this->Conference->find('all',array('conditions' => array('Conference.year' => $current_year,'Conference.term' => $current_term),'order' => 'Conference.start_date','recursive' => -1)));
                    
                    //If only 1 conference, then set that as default conference.
                    //Otherwise which one should be set according to account type.
                    if (count($near_conferences) > 1) {
                        foreach ($near_conferences as $near_conference):
                            $active_userType = $this->Auth->user('UserType.account_type_id');
                            switch ($active_userType) {
                                case 1:
                                case 2:
                                case 3:
                                    //Default conference to switch to next conference beginning Monday after previous conference.
                                    if (strtotime('now') < strtotime($near_conference['Conference']['start_date'].'+3 days')) {
                                        $current_conference = $near_conference['Conference']['id'];
                                        break 2;
                                    } else break;
                                case 4:
                                    //Default conference to match locality preferred conference for locality accounts
                                    if ($near_conference['Conference']['part'] == $this->Auth->user('Locality.preferred_conference')) {
                                        $current_conference = $near_conference['Conference']['id'];
                                        break 2;
                                    } else break;
                            }
                        endforeach;
                        if (!isset($current_conference)) $current_conference = $near_conferences[count($near_conferences)-1]['Conference']['id'];
                    } else $current_conference = $near_conferences[0]['Conference']['id'];
                    $this->Session->write('Conference.default',$current_conference);
                    $this->Session->write('Conference.selected',$current_conference); //Automatically selects default conference.
                    
                    //Set last_login field for user account
                    $this->User->id = $this->Auth->user('id');
                    $this->User->saveField('last_login',date('Y-m-d h:i:s',strtotime('now')));
                    
                    $this->redirect($this->Auth->redirect());
                } else {
                    $this->Session->setFlash(__('Invalid username or password. Please make sure caps lock isn\'t on and try again'),'failure');
                }
            }
	}
 
 /**
 * logout method
 *
 * @return void
 */
 
	public function logout() {
                $this->Session->delete('User');
                $this->Session->delete('Attendee');
                $this->Session->delete('Conference');
                //$this->Session->destroy();
                $this->Session->setFlash(__('You have been successfully logged out. For security reasons, please close your browser.'),'success');
		$this->redirect($this->Auth->logout());
	}

/**
 * index method
 *
 * @return void
 */
	public function index() {
                //$this->loadModel('UserType');
		$this->User->recursive = 0;
                if (in_array($this->Auth->user('UserType.account_type_id'),array(1, 2, 3))) {
                //if($this->UserType->find('list',array('conditions' => array('UserType.user_id =' => $this->Auth->user('id'),'UserType.account_type_id' => array('1','2','3'))))) {
                    $this->paginate = array(
                        'conditions' => array('UserType.account_type_id' => '1',"UserType.user_id NOT IN ('1','19')",'User.active' => 1),
                        'order' => 'User.last_name',
                        'limit' => 50,
                        'recursive' => 2,
                        /**'joins' => array(
                            array(
                                'table' => 'user_types',
                                'alias' => 'UserType',
                                'type' => 'inner',
                                'conditions' => array('UserType.user_id=User.id')
                        ))**/
                    );
                    //$this->set('overseer_users',$this->UserType->find('all',array('conditions' => array('UserType.account_type_id' => '1',"UserType.user_id NOT IN ('1','19')"),'recursive' => 2,'order' => 'User.last_name')));
                    $this->set('overseer_users',$this->paginate());
                    $this->paginate = array(
                        'conditions' => array('UserType.account_type_id' => array('2','3'), 'UserType.user_id !=' => 1,'User.active' => 1),
                        'order' => 'User.last_name',
                        'limit' => 50,
                        'recursive' => 2,
                        /**'joins' => array(
                            array(
                                'table' => 'user_types',
                                'alias' => 'UserType',
                                'type' => 'inner',
                                'conditions' => array('UserType.user_id=User.id')
                        ))**/
                    );
                    $this->set('registration_users',$this->paginate());
                    //$this->set('registration_users',$this->UserType->find('all',array('conditions' => array('UserType.account_type_id' => array('2','3'), 'UserType.user_id !=' => 1),'recursive' => 2,'order' => 'User.last_name')));
                }
		$this->set('users', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
		$this->set('user', $this->User->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->User->create();
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		}
		$localities = $this->User->Locality->find('list');
		$statuses = $this->User->Status->find('list');
		$campuses = $this->User->Campus->find('list');
		$this->set(compact('localities', 'statuses', 'campuses'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved'),'success');
				if ($this->Auth->user('UserType.account_type_id') == 4) {
                                    $this->redirect(array('controller' => 'pages','action' => 'display','home'));
                                } else {
                                    $this->redirect(array('action' => 'index'));
                                }
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'),'failure');
			}
		} elseif (($this->Auth->user('UserType.account_type_id') == 4 && $id == $this->Auth->user('id')) | $this->Auth->user('UserType.account_type_id') < 4) {
                    //LRC account types can only edit their own account, all other account types without restriction
                    $this->request->data = $this->User->read(null, $id);
		} else {
                    $this->Session->setFlash(__('You are not authorized to view this page'),'failure');
                    $this->redirect(array('controller' => 'pages', 'action' => 'home'));
                    //$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
                    //$this->request->data = $this->User->find('first', $options);
		}
                $this->set('Lrcs', $this->User->Locality->Lrc->find('all', array('conditions' => array('Lrc.locality_id =' => $this->Auth->user('locality_id')))));
		$localities = $this->User->Locality->find('list');
		$statuses = $this->User->Status->find('list',array('order' => 'Status.id'));
		$campuses = $this->User->Campus->find('list');
		$this->set(compact('localities', 'statuses', 'campuses'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->User->delete()) {
			$this->Session->setFlash(__('User deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('User was not deleted'));
		$this->redirect(array('action' => 'index'));
	}


/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->User->recursive = 0;
		$this->set('users', $this->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
		$this->set('user', $this->User->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->User->create();
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		}
		$localities = $this->User->Locality->find('list');
		$statuses = $this->User->Status->find('list');
		$campuses = $this->User->Campus->find('list');
		$this->set(compact('localities', 'statuses', 'campuses'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
			$this->request->data = $this->User->find('first', $options);
		}
		$localities = $this->User->Locality->find('list');
		$statuses = $this->User->Status->find('list');
		$campuses = $this->User->Campus->find('list');
		$this->set(compact('localities', 'statuses', 'campuses'));
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->User->delete()) {
			$this->Session->setFlash(__('User deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('User was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
