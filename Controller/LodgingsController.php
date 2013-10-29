<?php
App::uses('AppController', 'Controller');
/**
 * Lodgings Controller
 *
 * @property Lodging $Lodging
 */
class LodgingsController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Lodging->recursive = 0;
		$this->set('lodgings', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Lodging->exists($id)) {
			throw new NotFoundException(__('Invalid lodging'));
		}
		$options = array('conditions' => array('Lodging.' . $this->Lodging->primaryKey => $id));
		$this->set('lodging', $this->Lodging->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Lodging->create();
			if ($this->Lodging->save($this->request->data)) {
				$this->Session->setFlash(__('The lodging has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The lodging could not be saved. Please, try again.'));
			}
		}
		$conferences = $this->Lodging->Conference->find('list');
		$localities = $this->Lodging->Locality->find('list');
		$this->set(compact('conferences', 'localities'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Lodging->exists($id)) {
			throw new NotFoundException(__('Invalid lodging'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Lodging->save($this->request->data)) {
				$this->Session->setFlash(__('The lodging has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The lodging could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Lodging.' . $this->Lodging->primaryKey => $id));
			$this->request->data = $this->Lodging->find('first', $options);
		}
		$conferences = $this->Lodging->Conference->find('list');
		$localities = $this->Lodging->Locality->find('list');
		$this->set(compact('conferences', 'localities'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Lodging->id = $id;
		if (!$this->Lodging->exists()) {
			throw new NotFoundException(__('Invalid lodging'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Lodging->delete()) {
			$this->Session->setFlash(__('Lodging deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Lodging was not deleted'));
		$this->redirect(array('action' => 'index'));
	}


/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Lodging->recursive = 0;
		$this->set('lodgings', $this->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Lodging->exists($id)) {
			throw new NotFoundException(__('Invalid lodging'));
		}
		$options = array('conditions' => array('Lodging.' . $this->Lodging->primaryKey => $id));
		$this->set('lodging', $this->Lodging->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Lodging->create();
			if ($this->Lodging->save($this->request->data)) {
				$this->Session->setFlash(__('The lodging has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The lodging could not be saved. Please, try again.'));
			}
		}
		$conferences = $this->Lodging->Conference->find('list');
		$localities = $this->Lodging->Locality->find('list');
		$this->set(compact('conferences', 'localities'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->Lodging->exists($id)) {
			throw new NotFoundException(__('Invalid lodging'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Lodging->save($this->request->data)) {
				$this->Session->setFlash(__('The lodging has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The lodging could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Lodging.' . $this->Lodging->primaryKey => $id));
			$this->request->data = $this->Lodging->find('first', $options);
		}
		$conferences = $this->Lodging->Conference->find('list');
		$localities = $this->Lodging->Locality->find('list');
		$this->set(compact('conferences', 'localities'));
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->Lodging->id = $id;
		if (!$this->Lodging->exists()) {
			throw new NotFoundException(__('Invalid lodging'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Lodging->delete()) {
			$this->Session->setFlash(__('Lodging deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Lodging was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
