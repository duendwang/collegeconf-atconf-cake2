<?php
App::uses('AppController', 'Controller');
/**
 * EmailVariables Controller
 *
 * @property EmailVariable $EmailVariable
 */
class EmailVariablesController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->EmailVariable->recursive = 0;
		$this->set('emailVariables', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->EmailVariable->exists($id)) {
			throw new NotFoundException(__('Invalid email variable'));
		}
		$options = array('conditions' => array('EmailVariable.' . $this->EmailVariable->primaryKey => $id));
		$this->set('emailVariable', $this->EmailVariable->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->EmailVariable->create();
			if ($this->EmailVariable->save($this->request->data)) {
				$this->Session->setFlash(__('The email variable has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The email variable could not be saved. Please, try again.'));
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
		if (!$this->EmailVariable->exists($id)) {
			throw new NotFoundException(__('Invalid email variable'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->EmailVariable->save($this->request->data)) {
				$this->Session->setFlash(__('The email variable has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The email variable could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('EmailVariable.' . $this->EmailVariable->primaryKey => $id));
			$this->request->data = $this->EmailVariable->find('first', $options);
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
		$this->EmailVariable->id = $id;
		if (!$this->EmailVariable->exists()) {
			throw new NotFoundException(__('Invalid email variable'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->EmailVariable->delete()) {
			$this->Session->setFlash(__('Email variable deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Email variable was not deleted'));
		$this->redirect(array('action' => 'index'));
	}


/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->EmailVariable->recursive = 0;
		$this->set('emailVariables', $this->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->EmailVariable->exists($id)) {
			throw new NotFoundException(__('Invalid email variable'));
		}
		$options = array('conditions' => array('EmailVariable.' . $this->EmailVariable->primaryKey => $id));
		$this->set('emailVariable', $this->EmailVariable->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->EmailVariable->create();
			if ($this->EmailVariable->save($this->request->data)) {
				$this->Session->setFlash(__('The email variable has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The email variable could not be saved. Please, try again.'));
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
		if (!$this->EmailVariable->exists($id)) {
			throw new NotFoundException(__('Invalid email variable'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->EmailVariable->save($this->request->data)) {
				$this->Session->setFlash(__('The email variable has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The email variable could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('EmailVariable.' . $this->EmailVariable->primaryKey => $id));
			$this->request->data = $this->EmailVariable->find('first', $options);
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
		$this->EmailVariable->id = $id;
		if (!$this->EmailVariable->exists()) {
			throw new NotFoundException(__('Invalid email variable'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->EmailVariable->delete()) {
			$this->Session->setFlash(__('Email variable deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Email variable was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
