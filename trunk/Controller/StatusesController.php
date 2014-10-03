<?php
App::uses('AppController', 'Controller');
/**
 * Statuses Controller
 *
 * @property Status $Status
 */
class StatusesController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Status->recursive = 0;
		$this->set('statuses', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Status->exists($id)) {
			throw new NotFoundException(__('Invalid status'));
		}
		$options = array('conditions' => array('Status.' . $this->Status->primaryKey => $id));
		$this->set('status', $this->Status->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Status->create();
			if ($this->Status->save($this->request->data)) {
				$this->Session->setFlash(__('The status has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The status could not be saved. Please, try again.'));
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
		if (!$this->Status->exists($id)) {
			throw new NotFoundException(__('Invalid status'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Status->save($this->request->data)) {
				$this->Session->setFlash(__('The status has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The status could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Status.' . $this->Status->primaryKey => $id));
			$this->request->data = $this->Status->find('first', $options);
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
		$this->Status->id = $id;
		if (!$this->Status->exists()) {
			throw new NotFoundException(__('Invalid status'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Status->delete()) {
			$this->Session->setFlash(__('Status deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Status was not deleted'));
		$this->redirect(array('action' => 'index'));
	}


/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Status->recursive = 0;
		$this->set('statuses', $this->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Status->exists($id)) {
			throw new NotFoundException(__('Invalid status'));
		}
		$options = array('conditions' => array('Status.' . $this->Status->primaryKey => $id));
		$this->set('status', $this->Status->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Status->create();
			if ($this->Status->save($this->request->data)) {
				$this->Session->setFlash(__('The status has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The status could not be saved. Please, try again.'));
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
		if (!$this->Status->exists($id)) {
			throw new NotFoundException(__('Invalid status'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Status->save($this->request->data)) {
				$this->Session->setFlash(__('The status has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The status could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Status.' . $this->Status->primaryKey => $id));
			$this->request->data = $this->Status->find('first', $options);
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
		$this->Status->id = $id;
		if (!$this->Status->exists()) {
			throw new NotFoundException(__('Invalid status'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Status->delete()) {
			$this->Session->setFlash(__('Status deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Status was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
