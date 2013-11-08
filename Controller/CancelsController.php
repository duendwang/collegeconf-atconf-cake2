<?php
App::uses('AppController', 'Controller');
/**
 * Cancels Controller
 *
 * @property Cancel $Cancel
 */
class CancelsController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Cancel->recursive = 0;
		$this->set('cancels', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Cancel->exists($id)) {
			throw new NotFoundException(__('Invalid cancel'));
		}
		$options = array('conditions' => array('Cancel.' . $this->Cancel->primaryKey => $id));
		$this->set('cancel', $this->Cancel->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */

	public function add($attendee_id = null) {
            $messages = array(
                'Registered' => true,
                'Checked in and canceled' => array(
                    'type' => 'failure',
                    'message' => 'The attendee '.$attendee['Attendee']['name'].' has already been checked in.'
                ),
                'Checked in' => array(
                    'type' => 'failure',
                    'message' => 'The attendee '.$attendee['Attendee']['name'].' has already been checked in.'
                ),
                'Canceled' => array(
                    'type' => 'warning',
                    'message' => 'The attendee '.$attendee['Attendee']['name'].' is already canceled. Edit the existing cancellation entry <a href="'.Router::url(array('controller' => 'cancel','action' => 'edit',$attendee['Cancel']['id']),false).'">here</a>.',
                ),
                'Not registered' => array(
                    'type' => 'failure',
                    'message' => 'Attendee not found'
                ),
            );
            if (!empty($attendee_id)) {
                $status = $this->Cancel->Attendee->get_status($attendee_id);
                if ($messages[$status] === true) {
                    $attendee = $this->Cancel->Attendee->find('first',array('conditions' => array('Attendee.id' => $attendee_id)));
                    $referer = $this->referer();
                } else {
                    $this->Session->setFlash(__($messages[$status]['message']),$messages[$status]['type']);
                    $this->redirect($this->referer());
                }
            }
            if ($this->request->is('post')) {
                $this->request->data['Cancel']['replaced'] = ucwords($this->request->data['Cancel']['replaced']);
                
                $barcode = array(
                    'conference' => substr($this->request->data['Cancel']['barcode'],0,3),
                    'attendee_id' => substr($this->request->data['Cancel']['barcode'],3,4),
                );
                $conference = $this->Cancel->Conference->find('first',array('conditions' => array('Conference.id' => $this->Cancel->Conference->current_conference()),'recursive' => -1));
                $status = 'Not registered';
                if ($conference['Conference']['code'] == $barcode['conference']) {
                    $status = $this->Cancel->Attendee->get_status($barcode['attendee_id']);
                    $attendee = $this->Cancel->Attendee->find('first',array('conditions' => array('Attendee.id' => $barcode['attendee_id']),'contain' => array('Lodging'),'recursive' => -1));
                }
                if ($messages[$status] === true) {
                    $this->Cancel->create();
                    $this->request->data['Cancel']['attendee_id'] = $attendee['Attendee']['id'];
                    if ($this->Cancel->save($this->request->data)) {
                        $this->Cancel->Attendee->Lodging->save(array('id' => $attendee['Lodging']['id'],'attendee_count' => $attendee['Lodging']['attendee_count'] - 1),false);
                        $this->Session->setFlash(__('The attendee '.$attendee['Attendee']['name'].' has been canceled'),'success');
                        $this->redirect($this->request->data['Referer']['url']);
                    } else {
                        $this->Session->setFlash(__('The attendee '.$attendee['Attendee']['name'].' could not be canceled. Please, try again.'),'failure');
                        debug($this->request->data);
                        debug($this->Cancel->validationErrors);
                        exit;
                    }
                } else {
                    $this->Session->setFlash(__($messages[$status]['message']),$messages[$status]['type']);
                    $this->redirect($this->request->data['Referer']['url']);
                }
            }
            $conferences = $this->Cancel->Attendee->Conference->find('list',array('conditions' => array('Conference.id' => $this->Cancel->Attendee->Conference->current_conference())));
            $this->set(compact('attendee','conferences','referer'));
        }

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Cancel->exists($id)) {
			throw new NotFoundException(__('Invalid cancel'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Cancel->save($this->request->data)) {
				$this->Session->setFlash(__('The cancel has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The cancel could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Cancel.' . $this->Cancel->primaryKey => $id));
			$this->request->data = $this->Cancel->find('first', $options);
		}
		$attendees = $this->Cancel->Attendee->find('list');
		$conferences = $this->Cancel->Conference->find('list');
		$creators = $this->Cancel->Creator->find('list');
		$modifiers = $this->Cancel->Modifier->find('list');
		$this->set(compact('attendees', 'conferences', 'creators', 'modifiers'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Cancel->id = $id;
		if (!$this->Cancel->exists()) {
			throw new NotFoundException(__('Invalid cancel'));
		}
                $attendee = $this->Cancel->Attendee->find('first',array('conditions' => array('Attendee.id' => $this->Cancel->field('attendee_id',array('id' => $id))),'contain' => array('Lodging'),'recursive' => -1));
                $lodging = $this->Cancel->Attendee->Lodging->find('first',array('conditions' => array('Lodging.id' => $attendee['Attendee']['lodging_id']),'recursive' => -1));
		$this->request->onlyAllow('post', 'delete');
		if ($this->Cancel->delete()) {
                        $this->Cancel->Attendee->Lodging->save(array('id' => $lodging['Lodging']['id'],'attendee_count' => $lodging['Lodging']['attendee_count'] + 1),false);
			$this->Session->setFlash(__('Cancel deleted'),'success');
			$this->redirect($this->referer());
		}
		$this->Session->setFlash(__('Cancel was not deleted'));
		$this->redirect(array('action' => 'index'));
	}


/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Cancel->recursive = 0;
		$this->set('cancels', $this->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Cancel->exists($id)) {
			throw new NotFoundException(__('Invalid cancel'));
		}
		$options = array('conditions' => array('Cancel.' . $this->Cancel->primaryKey => $id));
		$this->set('cancel', $this->Cancel->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Cancel->create();
			if ($this->Cancel->save($this->request->data)) {
				$this->Session->setFlash(__('The cancel has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The cancel could not be saved. Please, try again.'));
			}
		}
		$attendees = $this->Cancel->Attendee->find('list');
		$conferences = $this->Cancel->Conference->find('list');
		$creators = $this->Cancel->Creator->find('list');
		$modifiers = $this->Cancel->Modifier->find('list');
		$this->set(compact('attendees', 'conferences', 'creators', 'modifiers'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->Cancel->exists($id)) {
			throw new NotFoundException(__('Invalid cancel'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Cancel->save($this->request->data)) {
				$this->Session->setFlash(__('The cancel has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The cancel could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Cancel.' . $this->Cancel->primaryKey => $id));
			$this->request->data = $this->Cancel->find('first', $options);
		}
		$attendees = $this->Cancel->Attendee->find('list');
		$conferences = $this->Cancel->Conference->find('list');
		$creators = $this->Cancel->Creator->find('list');
		$modifiers = $this->Cancel->Modifier->find('list');
		$this->set(compact('attendees', 'conferences', 'creators', 'modifiers'));
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->Cancel->id = $id;
		if (!$this->Cancel->exists()) {
			throw new NotFoundException(__('Invalid cancel'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Cancel->delete()) {
			$this->Session->setFlash(__('Cancel deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Cancel was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
