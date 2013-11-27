<?php
App::uses('AppController', 'Controller');
/**
 * AttendeesFinances Controller
 *
 * @property AttendeesFinance $AttendeesFinance
 */
class AttendeesFinancesController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->AttendeesFinance->recursive = 0;
		$this->set('attendeesFinances', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->AttendeesFinance->exists($id)) {
			throw new NotFoundException(__('Invalid attendees finance'));
		}
		$options = array('conditions' => array('AttendeesFinance.' . $this->AttendeesFinance->primaryKey => $id));
		$this->set('attendeesFinance', $this->AttendeesFinance->find('first', $options));
	}

/**
 * replacement method
 * 
 * @return void
 */

        public function replacement() {
            if ($this->request->is('post')) {
                if (!empty($this->request->data['AttendeesFinance']['add_attendee_id']) && !empty($this->request->data['AttendeesFinance']['cancel_attendee_id'])) {
                    $add_attendee = $this->AttendeesFinance->AddAttendee->find('first',array('conditions' => array('AddAttendee.id' => $this->request->data['AttendeesFinance']['add_attendee_id']),'recursive' => -1));
                    $cancel_attendee = $this->AttendeesFinance->CancelAttendee->find('first',array('conditions' => array('CancelAttendee.id' => $this->request->data['AttendeesFinance']['cancel_attendee_id']),'recursive' => -1));
                    
                    $add_attendee_finance = $this->AttendeesFinance->find('first',array(
                        'conditions' => array(
                            'AttendeesFinance.add_attendee_id' => $this->request->data['AttendeesFinance']['add_attendee_id'],
                        ),
                        'contain' => array(
                            'Finance'
                        ),
                        'recursive' => -1,
                    ));
                    
                    if (empty($add_attendee_finance['AttendeesFinance']['cancel_attendee_id'])) {
                        $this->request->data['AttendeesFinance']['id'] = $add_attendee_finance['AttendeesFinance']['id'];
                        $this->request->data['Finance'] = array(
                            'id' => $add_attendee_finance['Finance']['id'],
                            'finance_type_id' => 5,
                            'count' => null,
                            'rate' => null,
                            'charge' => null,
                            'payment' => $add_attendee_finance['Finance']['payment'],
                            'balance' => '0.00',
                            'comment' => $add_attendee_finance['Finance']['comment']
                        );
                        $this->request->data['AddAttendee'] = array(
                            'id' => $add_attendee['AddAttendee']['id'],
                            'rate' => $cancel_attendee['CancelAttendee']['rate']
                        );
                        
                        if ($this->AttendeesFinance->saveAssociated($this->request->data,array('validate' => false,'deep' => true))) {
                            $this->Session->setFlash(__('Replacement has been saved'),'success');
                            $this->redirect(array('action' => 'replacement'));
                        } else {
                            $this->Session->setFlash(__('Replacement could not be saved'),'failure');
                        }
                    } else {
                        $this->Session->setFlash(__($add_attendee['Attendee']['name'].' is already replacing another attendee'),'failure');
                    }
                } else {
                    $this->Session->setFlash(__('Both fields are required'),'failure');
                }
            }
            $conference = $this->AttendeesFinance->AddAttendee->Conference->find('first',array('conditions' => array('Conference.id' => $this->AttendeesFinance->AddAttendee->Conference->current_conference()),'recursive' => -1));
            $add_attendeesfinances = $this->AttendeesFinance->find('list',array('conditions' => array('AttendeesFinance.add_attendee_id NOT' => null,'AttendeesFinance.cancel_attendee_id' => null,'Finance.receive_date >=' => $conference['Conference']['start_date'],'Finance.finance_type_id' => 3),'fields' => 'AttendeesFinance.add_attendee_id','recursive' => 2));
            $excused_cancel_attendees_finances = $this->AttendeesFinance->find('list',array('conditions' => array('AttendeesFinance.cancel_attendee_id NOT' => null,'Finance.receive_date >=' => $conference['Conference']['start_date'],'Finance.finance_type_id' => 4),'fields' => 'AttendeesFinance.cancel_attendee_id','recursive' => 2));
            $addAttendees = $this->AttendeesFinance->AddAttendee->find('list',array('conditions' => array('AddAttendee.id' => $add_attendeesfinances),'order' => 'AddAttendee.name'));
            $cancelAttendees = $this->AttendeesFinance->CancelAttendee->find('list',array('conditions' => array('Cancel.created >' => $conference['Conference']['start_date'],'CancelAttendee.id NOT' => $excused_cancel_attendees_finances),'contain' => array('Cancel'),'order' => 'CancelAttendee.name'));
            $this->set(compact('addAttendees','cancelAttendees'));
        }

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->AttendeesFinance->create();
			if ($this->AttendeesFinance->save($this->request->data)) {
				$this->Session->setFlash(__('The attendees finance has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The attendees finance could not be saved. Please, try again.'));
			}
		}
		$finances = $this->AttendeesFinance->Finance->find('list');
		$adds = $this->AttendeesFinance->Add->find('list');
		$cancels = $this->AttendeesFinance->Cancel->find('list');
		$this->set(compact('finances', 'adds', 'cancels'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->AttendeesFinance->exists($id)) {
			throw new NotFoundException(__('Invalid attendees finance'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->AttendeesFinance->save($this->request->data)) {
				$this->Session->setFlash(__('The attendees finance has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The attendees finance could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('AttendeesFinance.' . $this->AttendeesFinance->primaryKey => $id));
			$this->request->data = $this->AttendeesFinance->find('first', $options);
		}
		$finances = $this->AttendeesFinance->Finance->find('list');
		$adds = $this->AttendeesFinance->Add->find('list');
		$cancels = $this->AttendeesFinance->Cancel->find('list');
		$this->set(compact('finances', 'adds', 'cancels'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->AttendeesFinance->id = $id;
		if (!$this->AttendeesFinance->exists()) {
			throw new NotFoundException(__('Invalid attendees finance'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->AttendeesFinance->delete()) {
			$this->Session->setFlash(__('Attendees finance deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Attendees finance was not deleted'));
		$this->redirect(array('action' => 'index'));
	}


/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->AttendeesFinance->recursive = 0;
		$this->set('attendeesFinances', $this->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->AttendeesFinance->exists($id)) {
			throw new NotFoundException(__('Invalid attendees finance'));
		}
		$options = array('conditions' => array('AttendeesFinance.' . $this->AttendeesFinance->primaryKey => $id));
		$this->set('attendeesFinance', $this->AttendeesFinance->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->AttendeesFinance->create();
			if ($this->AttendeesFinance->save($this->request->data)) {
				$this->Session->setFlash(__('The attendees finance has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The attendees finance could not be saved. Please, try again.'));
			}
		}
		$finances = $this->AttendeesFinance->Finance->find('list');
		$adds = $this->AttendeesFinance->Add->find('list');
		$cancels = $this->AttendeesFinance->Cancel->find('list');
		$this->set(compact('finances', 'adds', 'cancels'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->AttendeesFinance->exists($id)) {
			throw new NotFoundException(__('Invalid attendees finance'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->AttendeesFinance->save($this->request->data)) {
				$this->Session->setFlash(__('The attendees finance has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The attendees finance could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('AttendeesFinance.' . $this->AttendeesFinance->primaryKey => $id));
			$this->request->data = $this->AttendeesFinance->find('first', $options);
		}
		$finances = $this->AttendeesFinance->Finance->find('list');
		$adds = $this->AttendeesFinance->Add->find('list');
		$cancels = $this->AttendeesFinance->Cancel->find('list');
		$this->set(compact('finances', 'adds', 'cancels'));
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->AttendeesFinance->id = $id;
		if (!$this->AttendeesFinance->exists()) {
			throw new NotFoundException(__('Invalid attendees finance'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->AttendeesFinance->delete()) {
			$this->Session->setFlash(__('Attendees finance deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Attendees finance was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
