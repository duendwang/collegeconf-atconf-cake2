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
