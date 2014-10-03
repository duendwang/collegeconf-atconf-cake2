<?php
App::uses('AppController', 'Controller');
/**
 * RegistrationTeams Controller
 *
 * @property RegistrationTeam $RegistrationTeam
 */
class RegistrationTeamsController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->RegistrationTeam->recursive = 0;
		$this->set('registrationTeams', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->RegistrationTeam->exists($id)) {
			throw new NotFoundException(__('Invalid registration team'));
		}
		$options = array('conditions' => array('RegistrationTeam.' . $this->RegistrationTeam->primaryKey => $id));
		$this->set('registrationTeam', $this->RegistrationTeam->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->RegistrationTeam->create();
			if ($this->RegistrationTeam->save($this->request->data)) {
				$this->Session->setFlash(__('The registration team has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The registration team could not be saved. Please, try again.'));
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
		if (!$this->RegistrationTeam->exists($id)) {
			throw new NotFoundException(__('Invalid registration team'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->RegistrationTeam->save($this->request->data)) {
				$this->Session->setFlash(__('The registration team has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The registration team could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('RegistrationTeam.' . $this->RegistrationTeam->primaryKey => $id));
			$this->request->data = $this->RegistrationTeam->find('first', $options);
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
		$this->RegistrationTeam->id = $id;
		if (!$this->RegistrationTeam->exists()) {
			throw new NotFoundException(__('Invalid registration team'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->RegistrationTeam->delete()) {
			$this->Session->setFlash(__('Registration team deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Registration team was not deleted'));
		$this->redirect(array('action' => 'index'));
	}


/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->RegistrationTeam->recursive = 0;
		$this->set('registrationTeams', $this->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->RegistrationTeam->exists($id)) {
			throw new NotFoundException(__('Invalid registration team'));
		}
		$options = array('conditions' => array('RegistrationTeam.' . $this->RegistrationTeam->primaryKey => $id));
		$this->set('registrationTeam', $this->RegistrationTeam->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->RegistrationTeam->create();
			if ($this->RegistrationTeam->save($this->request->data)) {
				$this->Session->setFlash(__('The registration team has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The registration team could not be saved. Please, try again.'));
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
		if (!$this->RegistrationTeam->exists($id)) {
			throw new NotFoundException(__('Invalid registration team'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->RegistrationTeam->save($this->request->data)) {
				$this->Session->setFlash(__('The registration team has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The registration team could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('RegistrationTeam.' . $this->RegistrationTeam->primaryKey => $id));
			$this->request->data = $this->RegistrationTeam->find('first', $options);
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
		$this->RegistrationTeam->id = $id;
		if (!$this->RegistrationTeam->exists()) {
			throw new NotFoundException(__('Invalid registration team'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->RegistrationTeam->delete()) {
			$this->Session->setFlash(__('Registration team deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Registration team was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
