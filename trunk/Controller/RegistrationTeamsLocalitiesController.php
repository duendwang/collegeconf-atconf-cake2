<?php
App::uses('AppController', 'Controller');
/**
 * RegistrationTeamsLocalities Controller
 *
 * @property RegistrationTeamsLocality $RegistrationTeamsLocality
 */
class RegistrationTeamsLocalitiesController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->RegistrationTeamsLocality->recursive = 0;
		$this->set('registrationTeamsLocalities', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->RegistrationTeamsLocality->exists($id)) {
			throw new NotFoundException(__('Invalid registration teams locality'));
		}
		$options = array('conditions' => array('RegistrationTeamsLocality.' . $this->RegistrationTeamsLocality->primaryKey => $id));
		$this->set('registrationTeamsLocality', $this->RegistrationTeamsLocality->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->RegistrationTeamsLocality->create();
			if ($this->RegistrationTeamsLocality->save($this->request->data)) {
				$this->Session->setFlash(__('The registration teams locality has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The registration teams locality could not be saved. Please, try again.'));
			}
		}
		$conferences = $this->RegistrationTeamsLocality->Conference->find('list');
		$localities = $this->RegistrationTeamsLocality->Locality->find('list');
		$registrationTeams = $this->RegistrationTeamsLocality->RegistrationTeam->find('list');
		$this->set(compact('conferences', 'localities', 'registrationTeams'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->RegistrationTeamsLocality->exists($id)) {
			throw new NotFoundException(__('Invalid registration teams locality'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->RegistrationTeamsLocality->save($this->request->data)) {
				$this->Session->setFlash(__('The registration teams locality has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The registration teams locality could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('RegistrationTeamsLocality.' . $this->RegistrationTeamsLocality->primaryKey => $id));
			$this->request->data = $this->RegistrationTeamsLocality->find('first', $options);
		}
		$conferences = $this->RegistrationTeamsLocality->Conference->find('list');
		$localities = $this->RegistrationTeamsLocality->Locality->find('list');
		$registrationTeams = $this->RegistrationTeamsLocality->RegistrationTeam->find('list');
		$this->set(compact('conferences', 'localities', 'registrationTeams'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->RegistrationTeamsLocality->id = $id;
		if (!$this->RegistrationTeamsLocality->exists()) {
			throw new NotFoundException(__('Invalid registration teams locality'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->RegistrationTeamsLocality->delete()) {
			$this->Session->setFlash(__('Registration teams locality deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Registration teams locality was not deleted'));
		$this->redirect(array('action' => 'index'));
	}

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->RegistrationTeamsLocality->recursive = 0;
		$this->set('registrationTeamsLocalities', $this->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->RegistrationTeamsLocality->exists($id)) {
			throw new NotFoundException(__('Invalid registration teams locality'));
		}
		$options = array('conditions' => array('RegistrationTeamsLocality.' . $this->RegistrationTeamsLocality->primaryKey => $id));
		$this->set('registrationTeamsLocality', $this->RegistrationTeamsLocality->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->RegistrationTeamsLocality->create();
			if ($this->RegistrationTeamsLocality->save($this->request->data)) {
				$this->Session->setFlash(__('The registration teams locality has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The registration teams locality could not be saved. Please, try again.'));
			}
		}
		$conferences = $this->RegistrationTeamsLocality->Conference->find('list');
		$localities = $this->RegistrationTeamsLocality->Locality->find('list');
		$registrationTeams = $this->RegistrationTeamsLocality->RegistrationTeam->find('list');
		$this->set(compact('conferences', 'localities', 'registrationTeams'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->RegistrationTeamsLocality->exists($id)) {
			throw new NotFoundException(__('Invalid registration teams locality'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->RegistrationTeamsLocality->save($this->request->data)) {
				$this->Session->setFlash(__('The registration teams locality has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The registration teams locality could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('RegistrationTeamsLocality.' . $this->RegistrationTeamsLocality->primaryKey => $id));
			$this->request->data = $this->RegistrationTeamsLocality->find('first', $options);
		}
		$conferences = $this->RegistrationTeamsLocality->Conference->find('list');
		$localities = $this->RegistrationTeamsLocality->Locality->find('list');
		$registrationTeams = $this->RegistrationTeamsLocality->RegistrationTeam->find('list');
		$this->set(compact('conferences', 'localities', 'registrationTeams'));
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->RegistrationTeamsLocality->id = $id;
		if (!$this->RegistrationTeamsLocality->exists()) {
			throw new NotFoundException(__('Invalid registration teams locality'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->RegistrationTeamsLocality->delete()) {
			$this->Session->setFlash(__('Registration teams locality deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Registration teams locality was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
