<?php
App::uses('AppController', 'Controller');
/**
 * RegistrationTeamMembers Controller
 *
 * @property RegistrationTeamMember $RegistrationTeamMember
 */
class RegistrationTeamsMembersController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->RegistrationTeamsMember->recursive = 0;
                $this->paginate = array(
                        'conditions' => array('RegistrationTeamsMember.registration_team_id' => $this->Auth->user('RegistrationTeamsMember.registration_team_id'),'RegistrationTeamsMember.user_id NOT' => $this->Auth->user('id')),
                        'contain' => array(
                            'User' => array(
                                'fields' => array('User.name'),
                                'RegistrationStep' => array(
                                    'conditions' => array('RegistrationStep.conference_id' => $this->Session->read('Conference.selected')),
                                    'fields' => array(),
                                    'Locality' => array(
                                        'fields' => array('Locality.id','Locality.name')
                                    )
                                )
                            )
                        ),
                );
		$this->set('registrationTeamsMembers', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->RegistrationTeamMember->exists($id)) {
			throw new NotFoundException(__('Invalid registration team assignment'));
		}
		$options = array('conditions' => array('RegistrationTeamMember.' . $this->RegistrationTeamMember->primaryKey => $id));
		$this->set('registrationTeamMember', $this->RegistrationTeamMember->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->RegistrationTeamMember->create();
			if ($this->RegistrationTeamMember->save($this->request->data)) {
				$this->Session->setFlash(__('The registration team assignment has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The registration team assignment could not be saved. Please, try again.'));
			}
		}
		$users = $this->RegistrationTeamMember->User->find('list');
		$registrationTeams = $this->RegistrationTeamMember->RegistrationTeam->find('list');
		$this->set(compact('users', 'registrationTeams'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->RegistrationTeamMember->exists($id)) {
			throw new NotFoundException(__('Invalid registration team assignment'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->RegistrationTeamMember->save($this->request->data)) {
				$this->Session->setFlash(__('The registration team assignment has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The registration team assignment could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('RegistrationTeamMember.' . $this->RegistrationTeamMember->primaryKey => $id));
			$this->request->data = $this->RegistrationTeamMember->find('first', $options);
		}
		$users = $this->RegistrationTeamMember->User->find('list');
		$registrationTeams = $this->RegistrationTeamMember->RegistrationTeam->find('list');
		$this->set(compact('users', 'registrationTeams'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->RegistrationTeamMember->id = $id;
		if (!$this->RegistrationTeamMember->exists()) {
			throw new NotFoundException(__('Invalid registration team assignment'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->RegistrationTeamMember->delete()) {
			$this->Session->setFlash(__('Registration team assignment deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Registration team assignment was not deleted'));
		$this->redirect(array('action' => 'index'));
	}


/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->RegistrationTeamMember->recursive = 0;
		$this->set('registrationTeamAssignments', $this->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->RegistrationTeamMember->exists($id)) {
			throw new NotFoundException(__('Invalid registration team assignment'));
		}
		$options = array('conditions' => array('RegistrationTeamMember.' . $this->RegistrationTeamMember->primaryKey => $id));
		$this->set('registrationTeamAssignment', $this->RegistrationTeamMember->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->RegistrationTeamMember->create();
			if ($this->RegistrationTeamMember->save($this->request->data)) {
				$this->Session->setFlash(__('The registration team assignment has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The registration team assignment could not be saved. Please, try again.'));
			}
		}
		$users = $this->RegistrationTeamMember->User->find('list');
		$registrationTeams = $this->RegistrationTeamMember->RegistrationTeam->find('list');
		$this->set(compact('users', 'registrationTeams'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->RegistrationTeamMember->exists($id)) {
			throw new NotFoundException(__('Invalid registration team assignment'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->RegistrationTeamMember->save($this->request->data)) {
				$this->Session->setFlash(__('The registration team assignment has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The registration team assignment could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('RegistrationTeamMember.' . $this->RegistrationTeamMember->primaryKey => $id));
			$this->request->data = $this->RegistrationTeamMember->find('first', $options);
		}
		$users = $this->RegistrationTeamMember->User->find('list');
		$registrationTeams = $this->RegistrationTeamMember->RegistrationTeam->find('list');
		$this->set(compact('users', 'registrationTeams'));
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->RegistrationTeamMember->id = $id;
		if (!$this->RegistrationTeamMember->exists()) {
			throw new NotFoundException(__('Invalid registration team assignment'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->RegistrationTeamMember->delete()) {
			$this->Session->setFlash(__('Registration team assignment deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Registration team assignment was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
