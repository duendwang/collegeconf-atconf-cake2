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
 * @return void
 */
	public function add() {
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
