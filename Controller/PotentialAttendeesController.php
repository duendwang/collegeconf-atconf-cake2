<?php
App::uses('AppController', 'Controller');
/**
 * PotentialAttendees Controller
 *
 * @property PotentialAttendee $PotentialAttendee
 */
class PotentialAttendeesController extends AppController {

/**
 * beforeFilter method
 *
 * @return void
 */

        public function beforeFilter() {
            parent::beforeFilter();
            $this->Auth->allow('add','confirm');
        }

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->PotentialAttendee->recursive = 0;
		$this->set('potentialAttendees', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->PotentialAttendee->exists($id)) {
			throw new NotFoundException(__('Invalid potential attendee'));
		}
		$options = array('conditions' => array('PotentialAttendee.' . $this->PotentialAttendee->primaryKey => $id));
		$this->set('potentialAttendee', $this->PotentialAttendee->find('first', $options));
	}

/**
 * add method
 *
 * @param string $conference
 * @param string $locality
 * @return void
 */
	public function add($conference = null, $locality = null) {
		if ($this->request->is('post')) {
			$this->PotentialAttendee->create();
			if ($this->PotentialAttendee->save($this->request->data)) {
				//$this->Session->setFlash(__('Your information has been saved. Please keep in mind that you are not officially registered until you submit your payment to your local registration coordinator'),'success');
                                $this->redirect(array('action' => 'confirm',1,$this->PotentialAttendee->id));
			} else {
				$this->Session->setFlash(__('Your information could not be saved. Please try again or contact your local registration coordinator.'),'failure');
			}
		}
                if ($conference == null || $locality == null) {
                    $this->redirect(array('action' => 'confirm',2,null));
                }
		$conferences = $this->PotentialAttendee->Conference->find('list',array('conditions' => array('Conference.id' => $this->PotentialAttendee->Conference->current_term_conferences())));
		$localities = $this->PotentialAttendee->Locality->find('list',array('conditions' => array('Locality.id' => $locality)));
		$campuses = $this->PotentialAttendee->Campus->find('list');
		$statuses = $this->PotentialAttendee->Status->find('list');
		$this->set(compact('conferences','conference','localities','locality', 'campuses', 'statuses'));
	}

/**
 * confirm method
 * 
 * @param string $type
 * @param string $id
 * @return void
 */

        public function confirm($type = null, $id = null) {
            switch ($type) {
                case 1:
                    $messages = array(
                        'Thank you for your submission',
                        'Your registration is not complete until your local registration coordinator (or the one who invited you to the conference) receives your payment and confirms your registration. Payment must be received by the registration deadline to guarantee your registration.',
                        'For more information, please visit <a href="http://www.college-conference.com">www.college-conference.com</a>.'
                    );
                    break;
                case 2:
                    $messages = array(
                        'You have reached this page in error.',
                        'You must be provided a special link in order to submit your information for registration. This makes sure your information ends up in the right place. Please contact your local registration coordinator (or the one who invited you to the conference) to obtain this link.',
                        'For more information, please visit <a href="http://www.college-conference.com">www.college-conference.com</a>.'
                        
                    );
                    break;
            }
            $this->set(compact('messages'));
        }

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->PotentialAttendee->exists($id)) {
			throw new NotFoundException(__('Invalid potential attendee'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->PotentialAttendee->save($this->request->data)) {
				$this->Session->setFlash(__('The potential attendee has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The potential attendee could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('PotentialAttendee.' . $this->PotentialAttendee->primaryKey => $id));
			$this->request->data = $this->PotentialAttendee->find('first', $options);
		}
		$conferences = $this->PotentialAttendee->Conference->find('list');
		$localities = $this->PotentialAttendee->Locality->find('list');
		$campuses = $this->PotentialAttendee->Campus->find('list');
		$statuses = $this->PotentialAttendee->Status->find('list');
		$this->set(compact('conferences', 'localities', 'campuses', 'statuses'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->PotentialAttendee->id = $id;
		if (!$this->PotentialAttendee->exists()) {
			throw new NotFoundException(__('Invalid potential attendee'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->PotentialAttendee->delete()) {
			$this->Session->setFlash(__('Potential attendee deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Potential attendee was not deleted'));
		$this->redirect(array('action' => 'index'));
	}

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->PotentialAttendee->recursive = 0;
		$this->set('potentialAttendees', $this->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->PotentialAttendee->exists($id)) {
			throw new NotFoundException(__('Invalid potential attendee'));
		}
		$options = array('conditions' => array('PotentialAttendee.' . $this->PotentialAttendee->primaryKey => $id));
		$this->set('potentialAttendee', $this->PotentialAttendee->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->PotentialAttendee->create();
			if ($this->PotentialAttendee->save($this->request->data)) {
				$this->Session->setFlash(__('The potential attendee has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The potential attendee could not be saved. Please, try again.'));
			}
		}
		$conferences = $this->PotentialAttendee->Conference->find('list');
		$localities = $this->PotentialAttendee->Locality->find('list');
		$campuses = $this->PotentialAttendee->Campus->find('list');
		$statuses = $this->PotentialAttendee->Status->find('list');
		$this->set(compact('conferences', 'localities', 'campuses', 'statuses'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->PotentialAttendee->exists($id)) {
			throw new NotFoundException(__('Invalid potential attendee'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->PotentialAttendee->save($this->request->data)) {
				$this->Session->setFlash(__('The potential attendee has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The potential attendee could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('PotentialAttendee.' . $this->PotentialAttendee->primaryKey => $id));
			$this->request->data = $this->PotentialAttendee->find('first', $options);
		}
		$conferences = $this->PotentialAttendee->Conference->find('list');
		$localities = $this->PotentialAttendee->Locality->find('list');
		$campuses = $this->PotentialAttendee->Campus->find('list');
		$statuses = $this->PotentialAttendee->Status->find('list');
		$this->set(compact('conferences', 'localities', 'campuses', 'statuses'));
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->PotentialAttendee->id = $id;
		if (!$this->PotentialAttendee->exists()) {
			throw new NotFoundException(__('Invalid potential attendee'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->PotentialAttendee->delete()) {
			$this->Session->setFlash(__('Potential attendee deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Potential attendee was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
