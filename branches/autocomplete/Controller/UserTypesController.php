<?php
App::uses('AppController', 'Controller');
/**
 * UserTypes Controller
 *
 * @property UserType $UserType
 */
class UserTypesController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->UserType->recursive = 0;
		$this->set('userTypes', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->UserType->exists($id)) {
			throw new NotFoundException(__('Invalid user type'));
		}
		$options = array('conditions' => array('UserType.' . $this->UserType->primaryKey => $id));
		$this->set('userType', $this->UserType->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->UserType->create();
			if ($this->UserType->save($this->request->data)) {
				$this->Session->setFlash(__('The user type has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user type could not be saved. Please, try again.'));
			}
		}
                $users = $this->UserType->User->find('list',array('conditions' => array('User.first_name !=' => ""),'fields' => array('User.name'),'order' => 'User.last_name')) +
                        $this->UserType->User->find('list',array('conditions' => array('User.first_name' => ""),'fields' => array('Locality.city'),'order' => 'Locality.city','recursive' => 0));
		//debug($this->UserType->User->find('list',array('conditions' => array('User.first_name !=' => ""),'fields' => array('User.name'),'order' => 'User.last_name')));
                //debug($this->UserType->User->find('list',array('conditions' => array('User.first_name' => ""),'fields' => array('Locality.city'),'order' => 'Locality.city','recursive' => 1)));
                //debug($users);
                //exit;
		$accountTypes = $this->UserType->AccountType->find('list');
		$this->set(compact('users', 'accountTypes'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->UserType->exists($id)) {
			throw new NotFoundException(__('Invalid user type'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->UserType->save($this->request->data)) {
				$this->Session->setFlash(__('The user type has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user type could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('UserType.' . $this->UserType->primaryKey => $id));
			$this->request->data = $this->UserType->find('first', $options);
		}
		$users = $this->UserType->User->find('list');
		$accountTypes = $this->UserType->AccountType->find('list');
		$this->set(compact('users', 'accountTypes'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->UserType->id = $id;
		if (!$this->UserType->exists()) {
			throw new NotFoundException(__('Invalid user type'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->UserType->delete()) {
			$this->Session->setFlash(__('User type deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('User type was not deleted'));
		$this->redirect(array('action' => 'index'));
	}


/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->UserType->recursive = 0;
		$this->set('userTypes', $this->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->UserType->exists($id)) {
			throw new NotFoundException(__('Invalid user type'));
		}
		$options = array('conditions' => array('UserType.' . $this->UserType->primaryKey => $id));
		$this->set('userType', $this->UserType->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->UserType->create();
			if ($this->UserType->save($this->request->data)) {
				$this->Session->setFlash(__('The user type has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user type could not be saved. Please, try again.'));
			}
		}
		$users = $this->UserType->User->find('list');
		$accountTypes = $this->UserType->AccountType->find('list');
		$this->set(compact('users', 'accountTypes'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->UserType->exists($id)) {
			throw new NotFoundException(__('Invalid user type'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->UserType->save($this->request->data)) {
				$this->Session->setFlash(__('The user type has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user type could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('UserType.' . $this->UserType->primaryKey => $id));
			$this->request->data = $this->UserType->find('first', $options);
		}
		$users = $this->UserType->User->find('list');
		$accountTypes = $this->UserType->AccountType->find('list');
		$this->set(compact('users', 'accountTypes'));
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->UserType->id = $id;
		if (!$this->UserType->exists()) {
			throw new NotFoundException(__('Invalid user type'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->UserType->delete()) {
			$this->Session->setFlash(__('User type deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('User type was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
