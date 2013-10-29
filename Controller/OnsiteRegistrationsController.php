<?php
App::uses('AppController', 'Controller');
/**
 * OnsiteRegistrations Controller
 *
 * @property OnsiteRegistration $OnsiteRegistration
 */
class OnsiteRegistrationsController extends AppController {

/**
 * cashier method
 *
 * @return void
 */
	public function cashier($id = null) {
                $this->OnsiteRegistration->recursive = 2;
                if($this->request->is('post')) {
                    if(!empty($this->request->data['Payment'])) {
                        $this->OnsiteRegistration->Attendee->Payment->create();
                        if($this->OnsiteRegistration->Attendee->Payment->save($this->request->data['Payment'])) {
                            if($this->request->data['Payment']['cash'] + $this->request->data['Payment']['check'] == 0) {
                                $comment = $this->request->data['Payment']['first_name'].' '.$this->request->data['Payment']['last_name'];
                                if(!empty($this->request->data['Payment']['check_number'])) $comment = $comment.'; '.$this->request->data['Payment']['check_number'];
                                if(!empty($this->request->data['Payment']['comment'])) $comment = $comment.'; '.$this->request->data['Payment']['comment'];
                                $this->OnsiteRegistration->Attendee->Locality->Finance->create($finance = array(
                                    'conference_id' => '3',
                                    'receive_date' => date('Y-m-d',strtotime('now')),
                                    'locality_id' => $this->request->data['Payment']['locality_id'],
                                    'description' => 'Payment',
                                    'count' => '0',
                                    'rate' => '0',
                                    'charge' => '0',
                                    'payment' => $this->request->data['Payment']['cash'] + $this->request->data['Payment']['check'],
                                    'balance' => $this->request->data['Payment']['cash'] + $this->request->data['Payment']['check'],
                                    'comment' => $comment,
                                    ));
                                $this->OnsiteRegistration->Attendee->Locality->Finance->save($finance);
                            }
                            $attendee = $this->OnsiteRegistration->Attendee->read(null,$this->request->data['Payment']['attendee_id']);
                            $this->OnsiteRegistration->Attendee->set(array('paid_at_conf' => $attendee['Attendee']['paid_at_conf'] + $this->request->data['Payment']['cash'] + $this->request->data['Payment']['check']));
                            $this->OnsiteRegistration->Attendee->save();
                            $total = $this->request->data['Payment']['cash'] + $this->request->data['Payment']['check'] + $this->request->data['Payment']['locality'];
                            if($total >= $this->request->data['Payment']['amount_due']) {
                                $this->OnsiteRegistration->read(null,$attendee['OnsiteRegistration'][0]['id']);
                                $this->OnsiteRegistration->set(array('cashier' => '1'));
                                $this->OnsiteRegistration->save();
                            }
                            $this->Session->setFlash(__('Payment has been saved'),'success');
                            $this->redirect(array('action' => 'cashier'));
                        } else {
                            $this->Session->setFlash(__('Payment could not be saved'),'failure');
                        }
                    } elseif (!empty($this->request->data['OnsiteRegistration'])) {
                        $locality_id = $this->request->data['OnsiteRegistration']['locality_id'];
                        $locality = $this->OnsiteRegistration->Attendee->Locality->find('all',array('conditions' => array('Locality.id' => $locality_id),'recursive' => 0));
                        $this->set(compact('locality'));
                    }
                } elseif($id) {
                    $this->OnsiteRegistration->Attendee->id = $id;
                    if (!$this->OnsiteRegistration->Attendee->exists()) {
			throw new NotFoundException(__('Invalid attendee'));
                    } else{
                        $current_attendee = $this->OnsiteRegistration->Attendee->read(null,$id);
                        $amount_due = $current_attendee['Attendee']['rate']-$current_attendee['Attendee']['paid_at_conf'];
                        $this->set(compact('current_attendee','amount_due'));
                    }
                }
		$attendees = $this->OnsiteRegistration->find('all',array('conditions' => array('OnsiteRegistration.need_cashier' => 1,'OnsiteRegistration.cashier' => null),'order' => array('Attendee.first_name' => 'asc','Attendee.last_name' => 'asc')));
                $localities = $this->OnsiteRegistration->Attendee->Locality->find('list',array('conditions' => array('Locality.id NOT' => array('1','2','3','44')),'fields' => array('Locality.city')));
                $this->set(compact('attendees','localities'));
	}

/**
 * badges method
 *
 * @return void
 */
	public function badges($id = null) {
		$this->OnsiteRegistration->recursive = 2;
                if($this->request->is('post')) {  
                    $this->OnsiteRegistration->read(null,$this->request->data['OnsiteRegistration']['id']);
                    $this->OnsiteRegistration->set(array('badge' => 1));
                    if ($this->OnsiteRegistration->save()) {
                        $this->Session->setFlash(__('Badge printing has been recorded'),'success');
                        $this->redirect(array('action' => 'badges'));
                    } else {
                        $this->Session->setFlash(__('Error occured'),'failure');
                    }
                } elseif($id) {
                    $this->OnsiteRegistration->Attendee->id = $id;
                    if (!$this->OnsiteRegistration->Attendee->exists()) {
			throw new NotFoundException(__('Invalid attendee'));
                    } else{
                        $current_attendee = $this->OnsiteRegistration->Attendee->read(null,$id);
                        $this->set(compact('current_attendee'));
                    }
                }
		$attendees = $this->OnsiteRegistration->find('all',array('conditions' => array('OnsiteRegistration.need_badge' => 1,'OnsiteRegistration.badge' => null),'order' => array('Attendee.first_name' => 'asc','Attendee.last_name' => 'asc')));
                $this->set(compact('attendees'));
	}

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->OnsiteRegistration->recursive = 0;
		$this->set('onsiteRegistrations', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->OnsiteRegistration->exists($id)) {
			throw new NotFoundException(__('Invalid onsite registration'));
		}
		$options = array('conditions' => array('OnsiteRegistration.' . $this->OnsiteRegistration->primaryKey => $id));
		$this->set('onsiteRegistration', $this->OnsiteRegistration->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->OnsiteRegistration->create();
			if ($this->OnsiteRegistration->save($this->request->data)) {
				$this->Session->setFlash(__('The onsite registration has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The onsite registration could not be saved. Please, try again.'));
			}
		}
		$conferences = $this->OnsiteRegistration->Conference->find('list');
		$attendees = $this->OnsiteRegistration->Attendee->find('list');
		$oldLocalities = $this->OnsiteRegistration->OldLocality->find('list');
		$this->set(compact('conferences', 'attendees', 'oldLocalities'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->OnsiteRegistration->exists($id)) {
			throw new NotFoundException(__('Invalid onsite registration'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->OnsiteRegistration->save($this->request->data)) {
				$this->Session->setFlash(__('The onsite registration has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The onsite registration could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('OnsiteRegistration.' . $this->OnsiteRegistration->primaryKey => $id));
			$this->request->data = $this->OnsiteRegistration->find('first', $options);
		}
		$conferences = $this->OnsiteRegistration->Conference->find('list');
		$attendees = $this->OnsiteRegistration->Attendee->find('list');
		$oldLocalities = $this->OnsiteRegistration->OldLocality->find('list');
		$this->set(compact('conferences', 'attendees', 'oldLocalities'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->OnsiteRegistration->id = $id;
		if (!$this->OnsiteRegistration->exists()) {
			throw new NotFoundException(__('Invalid onsite registration'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->OnsiteRegistration->delete()) {
			$this->Session->setFlash(__('Onsite registration deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Onsite registration was not deleted'));
		$this->redirect(array('action' => 'index'));
	}


/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->OnsiteRegistration->recursive = 0;
		$this->set('onsiteRegistrations', $this->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->OnsiteRegistration->exists($id)) {
			throw new NotFoundException(__('Invalid onsite registration'));
		}
		$options = array('conditions' => array('OnsiteRegistration.' . $this->OnsiteRegistration->primaryKey => $id));
		$this->set('onsiteRegistration', $this->OnsiteRegistration->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->OnsiteRegistration->create();
			if ($this->OnsiteRegistration->save($this->request->data)) {
				$this->Session->setFlash(__('The onsite registration has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The onsite registration could not be saved. Please, try again.'));
			}
		}
		$conferences = $this->OnsiteRegistration->Conference->find('list');
		$attendees = $this->OnsiteRegistration->Attendee->find('list');
		$oldLocalities = $this->OnsiteRegistration->OldLocality->find('list');
		$this->set(compact('conferences', 'attendees', 'oldLocalities'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->OnsiteRegistration->exists($id)) {
			throw new NotFoundException(__('Invalid onsite registration'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->OnsiteRegistration->save($this->request->data)) {
				$this->Session->setFlash(__('The onsite registration has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The onsite registration could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('OnsiteRegistration.' . $this->OnsiteRegistration->primaryKey => $id));
			$this->request->data = $this->OnsiteRegistration->find('first', $options);
		}
		$conferences = $this->OnsiteRegistration->Conference->find('list');
		$attendees = $this->OnsiteRegistration->Attendee->find('list');
		$oldLocalities = $this->OnsiteRegistration->OldLocality->find('list');
		$this->set(compact('conferences', 'attendees', 'oldLocalities'));
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->OnsiteRegistration->id = $id;
		if (!$this->OnsiteRegistration->exists()) {
			throw new NotFoundException(__('Invalid onsite registration'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->OnsiteRegistration->delete()) {
			$this->Session->setFlash(__('Onsite registration deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Onsite registration was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
