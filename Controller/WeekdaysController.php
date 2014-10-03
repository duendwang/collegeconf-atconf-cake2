<?php
App::uses('AppController', 'Controller');
/**
 * Weekdays Controller
 *
 * @property Weekday $Weekday
 */
class WeekdaysController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Weekday->recursive = 0;
		$this->set('weekdays', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Weekday->exists($id)) {
			throw new NotFoundException(__('Invalid weekday'));
		}
		$options = array('conditions' => array('Weekday.' . $this->Weekday->primaryKey => $id));
		$this->set('weekday', $this->Weekday->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Weekday->create();
			if ($this->Weekday->save($this->request->data)) {
				$this->Session->setFlash(__('The weekday has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The weekday could not be saved. Please, try again.'));
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
		if (!$this->Weekday->exists($id)) {
			throw new NotFoundException(__('Invalid weekday'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Weekday->save($this->request->data)) {
				$this->Session->setFlash(__('The weekday has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The weekday could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Weekday.' . $this->Weekday->primaryKey => $id));
			$this->request->data = $this->Weekday->find('first', $options);
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
		$this->Weekday->id = $id;
		if (!$this->Weekday->exists()) {
			throw new NotFoundException(__('Invalid weekday'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Weekday->delete()) {
			$this->Session->setFlash(__('Weekday deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Weekday was not deleted'));
		$this->redirect(array('action' => 'index'));
	}


/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Weekday->recursive = 0;
		$this->set('weekdays', $this->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Weekday->exists($id)) {
			throw new NotFoundException(__('Invalid weekday'));
		}
		$options = array('conditions' => array('Weekday.' . $this->Weekday->primaryKey => $id));
		$this->set('weekday', $this->Weekday->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Weekday->create();
			if ($this->Weekday->save($this->request->data)) {
				$this->Session->setFlash(__('The weekday has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The weekday could not be saved. Please, try again.'));
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
		if (!$this->Weekday->exists($id)) {
			throw new NotFoundException(__('Invalid weekday'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Weekday->save($this->request->data)) {
				$this->Session->setFlash(__('The weekday has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The weekday could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Weekday.' . $this->Weekday->primaryKey => $id));
			$this->request->data = $this->Weekday->find('first', $options);
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
		$this->Weekday->id = $id;
		if (!$this->Weekday->exists()) {
			throw new NotFoundException(__('Invalid weekday'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Weekday->delete()) {
			$this->Session->setFlash(__('Weekday deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Weekday was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
