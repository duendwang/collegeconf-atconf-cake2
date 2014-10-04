<?php
App::uses('AppController', 'Controller');
/**
 * CheckIns Controller
 *
 * @property CheckIn $CheckIn
 */
class CheckInsController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->CheckIn->recursive = 0;
		$this->set('checkIns', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->CheckIn->exists($id)) {
			throw new NotFoundException(__('Invalid check in'));
		}
		$options = array('conditions' => array('CheckIn.' . $this->CheckIn->primaryKey => $id));
		$this->set('checkIn', $this->CheckIn->find('first', $options));
	}

/**
 * add method
 *
 * @param string $id
 * @return void
 */
	public function add($attendee_id = null) {
            $messages = array(
                'Registered' => true,
                'Checked in and canceled' => array(
                    'type' => 'failure',
                    'message' => 'The attendee %s has already been checked in and canceled.'
                ),
                'Checked in' => array(
                    'type' => 'warning',
                    'message' => 'The attendee %s has already been checked in.'
                ),
                'Canceled' => array(
                    'type' => 'failure',
                    'message' => 'The attendee %s is already canceled.',
                ),
                'Not registered' => array(
                    'type' => 'failure',
                    'message' => 'Attendee not found'
                ),
            );
            if (!empty($attendee_id)) {
                $status = $this->CheckIn->Attendee->get_status($attendee_id);
                $attendee = $this->CheckIn->Attendee->find('first',array('conditions' => array('Attendee.id' => $attendee_id)));
            }
            if ($this->request->is('post')) {
                $barcode = array(
                    'conference' => substr($this->request->data['CheckIn']['barcode'],0,3),
                    'attendee_id' => substr($this->request->data['CheckIn']['barcode'],3,4),
                );
                $conference = $this->CheckIn->Attendee->Conference->find('first',array('conditions' => array('Conference.id' => $this->CheckIn->Attendee->Conference->current_conference()),'recursive' => -1));
                $status = 'Not registered';
                if ($conference['Conference']['code'] == $barcode['conference']) {
                    $status = $this->CheckIn->Attendee->get_status($barcode['attendee_id']);
                    $attendee = $this->CheckIn->Attendee->find('first',array('conditions' => array('Attendee.id' => $barcode['attendee_id']),'recursive' => -1));
                }
            }
            if (!empty($status)) {
                if ($messages[$status] === true) {
                    $this->CheckIn->create();
                    $this->request->data['CheckIn'] = array(
                        'attendee_id' => $attendee['Attendee']['id'],
                        'timestamp' => '',
                    );
                    if ($this->CheckIn->save($this->request->data)) {
                        $this->Session->setFlash(__('The attendee '.$attendee['Attendee']['first_name'].' '.$attendee['Attendee']['last_name'].' has been checked in'),'success');
                        $this->redirect($this->referer());
                    } else {
                        $this->Session->setFlash(__('The attendee '.$attendee['Attendee']['first_name'].' '.$attendee['Attendee']['last_name'].' could not be checked in. Please, try again.'),'failure');
                        $this->redirect($this->referer());
                    }
                } else {
                    $this->Session->setFlash(__(sprintf($messages[$status]['message'],$attendee['Attendee']['name'],$attendee['Cancel']['id'])),$messages[$status]['type']);
                    $this->redirect($this->referer());
                }
            }
	}
        
/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->CheckIn->exists($id)) {
			throw new NotFoundException(__('Invalid check in'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->CheckIn->save($this->request->data)) {
				$this->Session->setFlash(__('The check in has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The check in could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('CheckIn.' . $this->CheckIn->primaryKey => $id));
			$this->request->data = $this->CheckIn->find('first', $options);
		}
		$attendees = $this->CheckIn->Attendee->find('list');
		$this->set(compact('attendees'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->CheckIn->id = $id;
		if (!$this->CheckIn->exists()) {
			throw new NotFoundException(__('Invalid check in'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->CheckIn->delete()) {
			$this->Session->setFlash(__('Check in deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Check in was not deleted'));
		$this->redirect(array('action' => 'index'));
	}


/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->CheckIn->recursive = 0;
		$this->set('checkIns', $this->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->CheckIn->exists($id)) {
			throw new NotFoundException(__('Invalid check in'));
		}
		$options = array('conditions' => array('CheckIn.' . $this->CheckIn->primaryKey => $id));
		$this->set('checkIn', $this->CheckIn->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->CheckIn->create();
			if ($this->CheckIn->save($this->request->data)) {
				$this->Session->setFlash(__('The check in has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The check in could not be saved. Please, try again.'));
			}
		}
		$attendees = $this->CheckIn->Attendee->find('list');
		$this->set(compact('attendees'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->CheckIn->exists($id)) {
			throw new NotFoundException(__('Invalid check in'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->CheckIn->save($this->request->data)) {
				$this->Session->setFlash(__('The check in has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The check in could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('CheckIn.' . $this->CheckIn->primaryKey => $id));
			$this->request->data = $this->CheckIn->find('first', $options);
		}
		$attendees = $this->CheckIn->Attendee->find('list');
		$this->set(compact('attendees'));
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->CheckIn->id = $id;
		if (!$this->CheckIn->exists()) {
			throw new NotFoundException(__('Invalid check in'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->CheckIn->delete()) {
			$this->Session->setFlash(__('Check in deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Check in was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
