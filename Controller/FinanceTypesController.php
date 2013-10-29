<?php
App::uses('AppController', 'Controller');
/**
 * FinanceTypes Controller
 *
 * @property FinanceType $FinanceType
 */
class FinanceTypesController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->FinanceType->recursive = 0;
		$this->set('financeTypes', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->FinanceType->exists($id)) {
			throw new NotFoundException(__('Invalid finance type'));
		}
		$options = array('conditions' => array('FinanceType.' . $this->FinanceType->primaryKey => $id));
		$this->set('financeType', $this->FinanceType->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->FinanceType->create();
			if ($this->FinanceType->save($this->request->data)) {
				$this->Session->setFlash(__('The finance type has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The finance type could not be saved. Please, try again.'));
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
		if (!$this->FinanceType->exists($id)) {
			throw new NotFoundException(__('Invalid finance type'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->FinanceType->save($this->request->data)) {
				$this->Session->setFlash(__('The finance type has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The finance type could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('FinanceType.' . $this->FinanceType->primaryKey => $id));
			$this->request->data = $this->FinanceType->find('first', $options);
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
		$this->FinanceType->id = $id;
		if (!$this->FinanceType->exists()) {
			throw new NotFoundException(__('Invalid finance type'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->FinanceType->delete()) {
			$this->Session->setFlash(__('Finance type deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Finance type was not deleted'));
		$this->redirect(array('action' => 'index'));
	}


/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->FinanceType->recursive = 0;
		$this->set('financeTypes', $this->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->FinanceType->exists($id)) {
			throw new NotFoundException(__('Invalid finance type'));
		}
		$options = array('conditions' => array('FinanceType.' . $this->FinanceType->primaryKey => $id));
		$this->set('financeType', $this->FinanceType->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->FinanceType->create();
			if ($this->FinanceType->save($this->request->data)) {
				$this->Session->setFlash(__('The finance type has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The finance type could not be saved. Please, try again.'));
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
		if (!$this->FinanceType->exists($id)) {
			throw new NotFoundException(__('Invalid finance type'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->FinanceType->save($this->request->data)) {
				$this->Session->setFlash(__('The finance type has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The finance type could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('FinanceType.' . $this->FinanceType->primaryKey => $id));
			$this->request->data = $this->FinanceType->find('first', $options);
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
		$this->FinanceType->id = $id;
		if (!$this->FinanceType->exists()) {
			throw new NotFoundException(__('Invalid finance type'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->FinanceType->delete()) {
			$this->Session->setFlash(__('Finance type deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Finance type was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
