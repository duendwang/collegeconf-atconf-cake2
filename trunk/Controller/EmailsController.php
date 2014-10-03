<?php
App::uses('AppController', 'Controller');
/**
 * Emails Controller
 *
 * @property Email $Email
 */
class EmailsController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Email->recursive = 0;
		$this->set('emails', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Email->exists($id)) {
			throw new NotFoundException(__('Invalid email'));
		}
		$options = array('conditions' => array('Email.' . $this->Email->primaryKey => $id));
		$this->set('email', $this->Email->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Email->create();
			if ($this->Email->save($this->request->data)) {
				$this->Session->setFlash(__('The email has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The email could not be saved. Please, try again.'));
			}
		}
		$creators = $this->Email->Creator->find('list');
		$modifiers = $this->Email->Modifier->find('list');
		$this->set(compact('creators', 'modifiers'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Email->exists($id)) {
			throw new NotFoundException(__('Invalid email'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Email->save($this->request->data)) {
				$this->Session->setFlash(__('The email has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The email could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Email.' . $this->Email->primaryKey => $id));
			$this->request->data = $this->Email->find('first', $options);
		}
		$creators = $this->Email->Creator->find('list');
		$modifiers = $this->Email->Modifier->find('list');
		$this->set(compact('creators', 'modifiers'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Email->id = $id;
		if (!$this->Email->exists()) {
			throw new NotFoundException(__('Invalid email'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Email->delete()) {
			$this->Session->setFlash(__('Email deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Email was not deleted'));
		$this->redirect(array('action' => 'index'));
	}


/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Email->recursive = 0;
		$this->set('emails', $this->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Email->exists($id)) {
			throw new NotFoundException(__('Invalid email'));
		}
		$options = array('conditions' => array('Email.' . $this->Email->primaryKey => $id));
		$this->set('email', $this->Email->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Email->create();
			if ($this->Email->save($this->request->data)) {
				$this->Session->setFlash(__('The email has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The email could not be saved. Please, try again.'));
			}
		}
		$creators = $this->Email->Creator->find('list');
		$modifiers = $this->Email->Modifier->find('list');
		$this->set(compact('creators', 'modifiers'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->Email->exists($id)) {
			throw new NotFoundException(__('Invalid email'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Email->save($this->request->data)) {
				$this->Session->setFlash(__('The email has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The email could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Email.' . $this->Email->primaryKey => $id));
			$this->request->data = $this->Email->find('first', $options);
		}
		$creators = $this->Email->Creator->find('list');
		$modifiers = $this->Email->Modifier->find('list');
		$this->set(compact('creators', 'modifiers'));
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->Email->id = $id;
		if (!$this->Email->exists()) {
			throw new NotFoundException(__('Invalid email'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Email->delete()) {
			$this->Session->setFlash(__('Email deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Email was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
