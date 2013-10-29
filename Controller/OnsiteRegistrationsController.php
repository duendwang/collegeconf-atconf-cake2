<?php
App::uses('AppController', 'Controller');
/**
 * OnsiteRegistrations Controller
 *
 * @property OnsiteRegistration $OnsiteRegistration
 */
class OnsiteRegistrationsController extends AppController {

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
