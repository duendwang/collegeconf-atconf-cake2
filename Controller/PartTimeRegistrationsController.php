<?php
App::uses('AppController', 'Controller');
/**
 * PartTimeRegistrations Controller
 *
 * @property PartTimeRegistration $PartTimeRegistration
 */
class PartTimeRegistrationsController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->PartTimeRegistration->recursive = 0;
		$this->set('partTimeRegistrations', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->PartTimeRegistration->exists($id)) {
			throw new NotFoundException(__('Invalid part time registration'));
		}
		$options = array('conditions' => array('PartTimeRegistration.' . $this->PartTimeRegistration->primaryKey => $id));
		$this->set('partTimeRegistration', $this->PartTimeRegistration->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->PartTimeRegistration->create();
			if ($this->PartTimeRegistration->save($this->request->data)) {
				$this->Session->setFlash(__('The part time registration has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The part time registration could not be saved. Please, try again.'));
			}
		}
		$conferences = $this->PartTimeRegistration->Conference->find('list');
		$attendees = $this->PartTimeRegistration->Attendee->find('list');
		$this->set(compact('conferences', 'attendees'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->PartTimeRegistration->exists($id)) {
			throw new NotFoundException(__('Invalid part time registration'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->PartTimeRegistration->save($this->request->data)) {
				$this->Session->setFlash(__('The part time registration has been saved'),'success');
				$this->redirect($this->request->data['PartTimeRegistration']['referer']);
			} else {
				$this->Session->setFlash(__('The part time registration could not be saved. Please, try again.'),'failure');
			}
		} else {
			$options = array('conditions' => array('PartTimeRegistration.' . $this->PartTimeRegistration->primaryKey => $id));
			$this->request->data = $this->PartTimeRegistration->find('first', $options);
		}
		$referer = $this->referer();
                $conferences = $this->PartTimeRegistration->Conference->find('list');
		$attendees = $this->PartTimeRegistration->Attendee->find('list');
		$this->set(compact('conferences', 'attendees','referer'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->PartTimeRegistration->id = $id;
		if (!$this->PartTimeRegistration->exists()) {
			throw new NotFoundException(__('Invalid part time registration'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->PartTimeRegistration->delete()) {
			$this->Session->setFlash(__('Part time registration deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Part time registration was not deleted'));
		$this->redirect(array('action' => 'index'));
	}


/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->PartTimeRegistration->recursive = 0;
		$this->set('partTimeRegistrations', $this->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->PartTimeRegistration->exists($id)) {
			throw new NotFoundException(__('Invalid part time registration'));
		}
		$options = array('conditions' => array('PartTimeRegistration.' . $this->PartTimeRegistration->primaryKey => $id));
		$this->set('partTimeRegistration', $this->PartTimeRegistration->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->PartTimeRegistration->create();
			if ($this->PartTimeRegistration->save($this->request->data)) {
				$this->Session->setFlash(__('The part time registration has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The part time registration could not be saved. Please, try again.'));
			}
		}
		$conferences = $this->PartTimeRegistration->Conference->find('list');
		$attendees = $this->PartTimeRegistration->Attendee->find('list');
		$this->set(compact('conferences', 'attendees'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->PartTimeRegistration->exists($id)) {
			throw new NotFoundException(__('Invalid part time registration'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->PartTimeRegistration->save($this->request->data)) {
				$this->Session->setFlash(__('The part time registration has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The part time registration could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('PartTimeRegistration.' . $this->PartTimeRegistration->primaryKey => $id));
			$this->request->data = $this->PartTimeRegistration->find('first', $options);
		}
		$conferences = $this->PartTimeRegistration->Conference->find('list');
		$attendees = $this->PartTimeRegistration->Attendee->find('list');
		$this->set(compact('conferences', 'attendees'));
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->PartTimeRegistration->id = $id;
		if (!$this->PartTimeRegistration->exists()) {
			throw new NotFoundException(__('Invalid part time registration'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->PartTimeRegistration->delete()) {
			$this->Session->setFlash(__('Part time registration deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Part time registration was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
