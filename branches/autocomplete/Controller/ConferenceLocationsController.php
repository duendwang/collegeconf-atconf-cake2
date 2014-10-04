<?php
App::uses('AppController', 'Controller');
/**
 * ConferenceLocations Controller
 *
 * @property ConferenceLocation $ConferenceLocation
 */
class ConferenceLocationsController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->ConferenceLocation->recursive = 0;
		$this->set('conferenceLocations', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->ConferenceLocation->exists($id)) {
			throw new NotFoundException(__('Invalid conference location'));
		}
		$options = array('conditions' => array('ConferenceLocation.' . $this->ConferenceLocation->primaryKey => $id));
		$this->set('conferenceLocation', $this->ConferenceLocation->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->ConferenceLocation->create();
			if ($this->ConferenceLocation->save($this->request->data)) {
				$this->Session->setFlash(__('The conference location has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The conference location could not be saved. Please, try again.'));
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
		if (!$this->ConferenceLocation->exists($id)) {
			throw new NotFoundException(__('Invalid conference location'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->ConferenceLocation->save($this->request->data)) {
				$this->Session->setFlash(__('The conference location has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The conference location could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('ConferenceLocation.' . $this->ConferenceLocation->primaryKey => $id));
			$this->request->data = $this->ConferenceLocation->find('first', $options);
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->ConferenceLocation->id = $id;
		if (!$this->ConferenceLocation->exists()) {
			throw new NotFoundException(__('Invalid conference location'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->ConferenceLocation->delete()) {
			$this->Session->setFlash(__('Conference location deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Conference location was not deleted'));
		$this->redirect(array('action' => 'index'));
	}

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->ConferenceLocation->recursive = 0;
		$this->set('conferenceLocations', $this->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->ConferenceLocation->exists($id)) {
			throw new NotFoundException(__('Invalid conference location'));
		}
		$options = array('conditions' => array('ConferenceLocation.' . $this->ConferenceLocation->primaryKey => $id));
		$this->set('conferenceLocation', $this->ConferenceLocation->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->ConferenceLocation->create();
			if ($this->ConferenceLocation->save($this->request->data)) {
				$this->Session->setFlash(__('The conference location has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The conference location could not be saved. Please, try again.'));
			}
		}
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->ConferenceLocation->exists($id)) {
			throw new NotFoundException(__('Invalid conference location'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->ConferenceLocation->save($this->request->data)) {
				$this->Session->setFlash(__('The conference location has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The conference location could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('ConferenceLocation.' . $this->ConferenceLocation->primaryKey => $id));
			$this->request->data = $this->ConferenceLocation->find('first', $options);
		}
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->ConferenceLocation->id = $id;
		if (!$this->ConferenceLocation->exists()) {
			throw new NotFoundException(__('Invalid conference location'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->ConferenceLocation->delete()) {
			$this->Session->setFlash(__('Conference location deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Conference location was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
