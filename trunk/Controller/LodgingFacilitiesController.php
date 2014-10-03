<?php
App::uses('AppController', 'Controller');
/**
 * LodgingFacilities Controller
 *
 * @property LodgingFacility $LodgingFacility
 */
class LodgingFacilitiesController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->LodgingFacility->recursive = 0;
		$this->set('lodgingFacilities', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->LodgingFacility->exists($id)) {
			throw new NotFoundException(__('Invalid lodging facility'));
		}
		$options = array('conditions' => array('LodgingFacility.' . $this->LodgingFacility->primaryKey => $id));
		$this->set('lodgingFacility', $this->LodgingFacility->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->LodgingFacility->create();
			if ($this->LodgingFacility->save($this->request->data)) {
				$this->Session->setFlash(__('The lodging facility has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The lodging facility could not be saved. Please, try again.'));
			}
		}
		$conferenceLocations = $this->LodgingFacility->ConferenceLocation->find('list');
		$this->set(compact('conferenceLocations'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->LodgingFacility->exists($id)) {
			throw new NotFoundException(__('Invalid lodging facility'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->LodgingFacility->save($this->request->data)) {
				$this->Session->setFlash(__('The lodging facility has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The lodging facility could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('LodgingFacility.' . $this->LodgingFacility->primaryKey => $id));
			$this->request->data = $this->LodgingFacility->find('first', $options);
		}
		$conferenceLocations = $this->LodgingFacility->ConferenceLocation->find('list');
		$this->set(compact('conferenceLocations'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->LodgingFacility->id = $id;
		if (!$this->LodgingFacility->exists()) {
			throw new NotFoundException(__('Invalid lodging facility'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->LodgingFacility->delete()) {
			$this->Session->setFlash(__('Lodging facility deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Lodging facility was not deleted'));
		$this->redirect(array('action' => 'index'));
	}


/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->LodgingFacility->recursive = 0;
		$this->set('lodgingFacilities', $this->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->LodgingFacility->exists($id)) {
			throw new NotFoundException(__('Invalid lodging facility'));
		}
		$options = array('conditions' => array('LodgingFacility.' . $this->LodgingFacility->primaryKey => $id));
		$this->set('lodgingFacility', $this->LodgingFacility->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->LodgingFacility->create();
			if ($this->LodgingFacility->save($this->request->data)) {
				$this->Session->setFlash(__('The lodging facility has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The lodging facility could not be saved. Please, try again.'));
			}
		}
		$conferenceLocations = $this->LodgingFacility->ConferenceLocation->find('list');
		$this->set(compact('conferenceLocations'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->LodgingFacility->exists($id)) {
			throw new NotFoundException(__('Invalid lodging facility'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->LodgingFacility->save($this->request->data)) {
				$this->Session->setFlash(__('The lodging facility has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The lodging facility could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('LodgingFacility.' . $this->LodgingFacility->primaryKey => $id));
			$this->request->data = $this->LodgingFacility->find('first', $options);
		}
		$conferenceLocations = $this->LodgingFacility->ConferenceLocation->find('list');
		$this->set(compact('conferenceLocations'));
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->LodgingFacility->id = $id;
		if (!$this->LodgingFacility->exists()) {
			throw new NotFoundException(__('Invalid lodging facility'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->LodgingFacility->delete()) {
			$this->Session->setFlash(__('Lodging facility deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Lodging facility was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
