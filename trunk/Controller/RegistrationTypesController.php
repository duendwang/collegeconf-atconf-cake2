<?php
App::uses('AppController', 'Controller');
/**
 * RateTypes Controller
 *
 * @property RateType $RateType
 */
class RateTypesController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->RateType->recursive = 0;
		$this->set('rateTypes', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->RateType->exists($id)) {
			throw new NotFoundException(__('Invalid rate type'));
		}
		$options = array('conditions' => array('RateType.' . $this->RateType->primaryKey => $id));
		$this->set('rateType', $this->RateType->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->RateType->create();
			if ($this->RateType->save($this->request->data)) {
				$this->Session->setFlash(__('The rate type has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The rate type could not be saved. Please, try again.'));
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
		if (!$this->RateType->exists($id)) {
			throw new NotFoundException(__('Invalid rate type'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->RateType->save($this->request->data)) {
				$this->Session->setFlash(__('The rate type has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The rate type could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('RateType.' . $this->RateType->primaryKey => $id));
			$this->request->data = $this->RateType->find('first', $options);
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
		$this->RateType->id = $id;
		if (!$this->RateType->exists()) {
			throw new NotFoundException(__('Invalid rate type'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->RateType->delete()) {
			$this->Session->setFlash(__('Rate type deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Rate type was not deleted'));
		$this->redirect(array('action' => 'index'));
	}

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->RateType->recursive = 0;
		$this->set('rateTypes', $this->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->RateType->exists($id)) {
			throw new NotFoundException(__('Invalid rate type'));
		}
		$options = array('conditions' => array('RateType.' . $this->RateType->primaryKey => $id));
		$this->set('rateType', $this->RateType->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->RateType->create();
			if ($this->RateType->save($this->request->data)) {
				$this->Session->setFlash(__('The rate type has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The rate type could not be saved. Please, try again.'));
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
		if (!$this->RateType->exists($id)) {
			throw new NotFoundException(__('Invalid rate type'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->RateType->save($this->request->data)) {
				$this->Session->setFlash(__('The rate type has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The rate type could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('RateType.' . $this->RateType->primaryKey => $id));
			$this->request->data = $this->RateType->find('first', $options);
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
		$this->RateType->id = $id;
		if (!$this->RateType->exists()) {
			throw new NotFoundException(__('Invalid rate type'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->RateType->delete()) {
			$this->Session->setFlash(__('Rate type deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Rate type was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
