<?php
App::uses('AppController', 'Controller');
/**
 * Campuses Controller
 *
 * @property Campus $Campus
 */
class CampusesController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Campus->recursive = 0;
		$this->set('campuses', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Campus->exists($id)) {
			throw new NotFoundException(__('Invalid campus'));
		}
		$options = array('conditions' => array('Campus.' . $this->Campus->primaryKey => $id));
		$this->set('campus', $this->Campus->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Campus->create();
			if ($this->Campus->save($this->request->data)) {
				$this->Session->setFlash(__('The campus has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The campus could not be saved. Please, try again.'));
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
		if (!$this->Campus->exists($id)) {
			throw new NotFoundException(__('Invalid campus'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Campus->save($this->request->data)) {
				$this->Session->setFlash(__('The campus has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The campus could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Campus.' . $this->Campus->primaryKey => $id));
			$this->request->data = $this->Campus->find('first', $options);
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
		$this->Campus->id = $id;
		if (!$this->Campus->exists()) {
			throw new NotFoundException(__('Invalid campus'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Campus->delete()) {
			$this->Session->setFlash(__('Campus deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Campus was not deleted'));
		$this->redirect(array('action' => 'index'));
	}


/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Campus->recursive = 0;
		$this->set('campuses', $this->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Campus->exists($id)) {
			throw new NotFoundException(__('Invalid campus'));
		}
		$options = array('conditions' => array('Campus.' . $this->Campus->primaryKey => $id));
		$this->set('campus', $this->Campus->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Campus->create();
			if ($this->Campus->save($this->request->data)) {
				$this->Session->setFlash(__('The campus has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The campus could not be saved. Please, try again.'));
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
		if (!$this->Campus->exists($id)) {
			throw new NotFoundException(__('Invalid campus'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Campus->save($this->request->data)) {
				$this->Session->setFlash(__('The campus has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The campus could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Campus.' . $this->Campus->primaryKey => $id));
			$this->request->data = $this->Campus->find('first', $options);
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
		$this->Campus->id = $id;
		if (!$this->Campus->exists()) {
			throw new NotFoundException(__('Invalid campus'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Campus->delete()) {
			$this->Session->setFlash(__('Campus deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Campus was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
