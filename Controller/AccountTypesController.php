<?php
App::uses('AppController', 'Controller');
/**
 * AccountTypes Controller
 *
 * @property AccountType $AccountType
 */
class AccountTypesController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->AccountType->recursive = 0;
		$this->set('accountTypes', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->AccountType->exists($id)) {
			throw new NotFoundException(__('Invalid account type'));
		}
		$options = array('conditions' => array('AccountType.' . $this->AccountType->primaryKey => $id));
		$this->set('accountType', $this->AccountType->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->AccountType->create();
			if ($this->AccountType->save($this->request->data)) {
				$this->Session->setFlash(__('The account type has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The account type could not be saved. Please, try again.'));
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
		if (!$this->AccountType->exists($id)) {
			throw new NotFoundException(__('Invalid account type'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->AccountType->save($this->request->data)) {
				$this->Session->setFlash(__('The account type has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The account type could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('AccountType.' . $this->AccountType->primaryKey => $id));
			$this->request->data = $this->AccountType->find('first', $options);
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
		$this->AccountType->id = $id;
		if (!$this->AccountType->exists()) {
			throw new NotFoundException(__('Invalid account type'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->AccountType->delete()) {
			$this->Session->setFlash(__('Account type deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Account type was not deleted'));
		$this->redirect(array('action' => 'index'));
	}


/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->AccountType->recursive = 0;
		$this->set('accountTypes', $this->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->AccountType->exists($id)) {
			throw new NotFoundException(__('Invalid account type'));
		}
		$options = array('conditions' => array('AccountType.' . $this->AccountType->primaryKey => $id));
		$this->set('accountType', $this->AccountType->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->AccountType->create();
			if ($this->AccountType->save($this->request->data)) {
				$this->Session->setFlash(__('The account type has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The account type could not be saved. Please, try again.'));
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
		if (!$this->AccountType->exists($id)) {
			throw new NotFoundException(__('Invalid account type'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->AccountType->save($this->request->data)) {
				$this->Session->setFlash(__('The account type has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The account type could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('AccountType.' . $this->AccountType->primaryKey => $id));
			$this->request->data = $this->AccountType->find('first', $options);
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
		$this->AccountType->id = $id;
		if (!$this->AccountType->exists()) {
			throw new NotFoundException(__('Invalid account type'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->AccountType->delete()) {
			$this->Session->setFlash(__('Account type deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Account type was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
