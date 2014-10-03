<?php
App::uses('AppController', 'Controller');
/**
 * Rates Controller
 *
 * @property Rate $Rate
 */
class RatesController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Rate->recursive = 0;
		$this->set('rates', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Rate->exists($id)) {
			throw new NotFoundException(__('Invalid rate'));
		}
		$options = array('conditions' => array('Rate.' . $this->Rate->primaryKey => $id));
		$this->set('rate', $this->Rate->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Rate->create();
			if ($this->Rate->save($this->request->data)) {
				$this->Session->setFlash(__('The rate has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The rate could not be saved. Please, try again.'));
			}
		}
		$conferenceLocations = $this->Rate->ConferenceLocation->find('list');
		$rateTypes = $this->Rate->RateType->find('list');
		$this->set(compact('conferenceLocations', 'rateTypes'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Rate->exists($id)) {
			throw new NotFoundException(__('Invalid rate'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Rate->save($this->request->data)) {
				$this->Session->setFlash(__('The rate has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The rate could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Rate.' . $this->Rate->primaryKey => $id));
			$this->request->data = $this->Rate->find('first', $options);
		}
		$conferenceLocations = $this->Rate->ConferenceLocation->find('list');
		$rateTypes = $this->Rate->RateType->find('list');
		$this->set(compact('conferenceLocations', 'rateTypes'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Rate->id = $id;
		if (!$this->Rate->exists()) {
			throw new NotFoundException(__('Invalid rate'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Rate->delete()) {
			$this->Session->setFlash(__('Rate deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Rate was not deleted'));
		$this->redirect(array('action' => 'index'));
	}

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Rate->recursive = 0;
		$this->set('rates', $this->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Rate->exists($id)) {
			throw new NotFoundException(__('Invalid rate'));
		}
		$options = array('conditions' => array('Rate.' . $this->Rate->primaryKey => $id));
		$this->set('rate', $this->Rate->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Rate->create();
			if ($this->Rate->save($this->request->data)) {
				$this->Session->setFlash(__('The rate has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The rate could not be saved. Please, try again.'));
			}
		}
		$conferenceLocations = $this->Rate->ConferenceLocation->find('list');
		$rateTypes = $this->Rate->RateType->find('list');
		$this->set(compact('conferenceLocations', 'rateTypes'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->Rate->exists($id)) {
			throw new NotFoundException(__('Invalid rate'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Rate->save($this->request->data)) {
				$this->Session->setFlash(__('The rate has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The rate could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Rate.' . $this->Rate->primaryKey => $id));
			$this->request->data = $this->Rate->find('first', $options);
		}
		$conferenceLocations = $this->Rate->ConferenceLocation->find('list');
		$rateTypes = $this->Rate->RateType->find('list');
		$this->set(compact('conferenceLocations', 'rateTypes'));
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->Rate->id = $id;
		if (!$this->Rate->exists()) {
			throw new NotFoundException(__('Invalid rate'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Rate->delete()) {
			$this->Session->setFlash(__('Rate deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Rate was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
