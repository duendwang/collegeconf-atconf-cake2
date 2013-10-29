<?php
App::uses('AppController', 'Controller');
/**
 * Localities Controller
 *
 * @property Locality $Locality
 */
class LocalitiesController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Locality->recursive = 0;
		$this->set('localities', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Locality->exists($id)) {
			throw new NotFoundException(__('Invalid locality'));
		}
		$options = array('conditions' => array('Locality.' . $this->Locality->primaryKey => $id));
		$this->set('locality', $this->Locality->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Locality->create();
			if ($this->Locality->save($this->request->data)) {
				$this->Session->setFlash(__('The locality has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The locality could not be saved. Please, try again.'));
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
		if (!$this->Locality->exists($id)) {
			throw new NotFoundException(__('Invalid locality'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Locality->save($this->request->data)) {
				$this->Session->setFlash(__('The locality has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The locality could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Locality.' . $this->Locality->primaryKey => $id));
			$this->request->data = $this->Locality->find('first', $options);
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
		$this->Locality->id = $id;
		if (!$this->Locality->exists()) {
			throw new NotFoundException(__('Invalid locality'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Locality->delete()) {
			$this->Session->setFlash(__('Locality deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Locality was not deleted'));
		$this->redirect(array('action' => 'index'));
	}


/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Locality->recursive = 0;
		$this->set('localities', $this->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Locality->exists($id)) {
			throw new NotFoundException(__('Invalid locality'));
		}
		$options = array('conditions' => array('Locality.' . $this->Locality->primaryKey => $id));
		$this->set('locality', $this->Locality->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Locality->create();
			if ($this->Locality->save($this->request->data)) {
				$this->Session->setFlash(__('The locality has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The locality could not be saved. Please, try again.'));
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
		if (!$this->Locality->exists($id)) {
			throw new NotFoundException(__('Invalid locality'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Locality->save($this->request->data)) {
				$this->Session->setFlash(__('The locality has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The locality could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Locality.' . $this->Locality->primaryKey => $id));
			$this->request->data = $this->Locality->find('first', $options);
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
		$this->Locality->id = $id;
		if (!$this->Locality->exists()) {
			throw new NotFoundException(__('Invalid locality'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Locality->delete()) {
			$this->Session->setFlash(__('Locality deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Locality was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
