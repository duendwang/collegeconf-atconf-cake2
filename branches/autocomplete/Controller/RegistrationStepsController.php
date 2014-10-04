<?php
App::uses('AppController', 'Controller');
/**
 * RegistrationSteps Controller
 *
 * @property RegistrationStep $RegistrationStep
 */
class RegistrationStepsController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
                //$this->loadModel('UserType');
		$this->RegistrationStep->recursive = 0;
                if(in_array($this->Auth->user('UserType.account_type_id'),array('2','3'))) {
                    $this->paginate = array(
                        'conditions' => array('RegistrationStep.user_id' => $this->Auth->user('id'),'RegistrationStep.conference_id' => $this->RegistrationStep->Conference->current_term_conferences()),
                        'order' => array('RegistrationStep.conference_id' => 'asc', 'RegistrationStep.locality_id' => 'asc')
                    );
                }
		$this->set('registrationSteps', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->RegistrationStep->exists($id)) {
			throw new NotFoundException(__('Invalid registration step'));
		}
		$options = array('conditions' => array('RegistrationStep.' . $this->RegistrationStep->primaryKey => $id));
		$this->set('registrationStep', $this->RegistrationStep->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->RegistrationStep->create();
			if ($this->RegistrationStep->save($this->request->data)) {
				$this->Session->setFlash(__('The registration step has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The registration step could not be saved. Please, try again.'));
			}
		}
		$conferences = $this->RegistrationStep->Conference->find('list');
		$localities = $this->RegistrationStep->Locality->find('list');
		$users = $this->RegistrationStep->User->find('list');
		$creators = $this->RegistrationStep->Creator->find('list');
		$modifiers = $this->RegistrationStep->Modifier->find('list');
		$this->set(compact('conferences', 'localities', 'users', 'creators', 'modifiers'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->RegistrationStep->exists($id)) {
			throw new NotFoundException(__('Invalid registration step'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->RegistrationStep->save($this->request->data)) {
				$this->Session->setFlash(__('The registration step has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The registration step could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('RegistrationStep.' . $this->RegistrationStep->primaryKey => $id));
			$this->request->data = $this->RegistrationStep->find('first', $options);
		}
		$conferences = $this->RegistrationStep->Conference->find('list');
		$localities = $this->RegistrationStep->Locality->find('list');
		$users = $this->RegistrationStep->User->find('list');
		$creators = $this->RegistrationStep->Creator->find('list');
		$modifiers = $this->RegistrationStep->Modifier->find('list');
		$this->set(compact('conferences', 'localities', 'users', 'creators', 'modifiers'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->RegistrationStep->id = $id;
		if (!$this->RegistrationStep->exists()) {
			throw new NotFoundException(__('Invalid registration step'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->RegistrationStep->delete()) {
			$this->Session->setFlash(__('Registration step deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Registration step was not deleted'));
		$this->redirect(array('action' => 'index'));
	}


/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->RegistrationStep->recursive = 0;
		$this->set('registrationSteps', $this->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->RegistrationStep->exists($id)) {
			throw new NotFoundException(__('Invalid registration step'));
		}
		$options = array('conditions' => array('RegistrationStep.' . $this->RegistrationStep->primaryKey => $id));
		$this->set('registrationStep', $this->RegistrationStep->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->RegistrationStep->create();
			if ($this->RegistrationStep->save($this->request->data)) {
				$this->Session->setFlash(__('The registration step has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The registration step could not be saved. Please, try again.'));
			}
		}
		$conferences = $this->RegistrationStep->Conference->find('list');
		$localities = $this->RegistrationStep->Locality->find('list');
		$users = $this->RegistrationStep->User->find('list');
		$creators = $this->RegistrationStep->Creator->find('list');
		$modifiers = $this->RegistrationStep->Modifier->find('list');
		$this->set(compact('conferences', 'localities', 'users', 'creators', 'modifiers'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->RegistrationStep->exists($id)) {
			throw new NotFoundException(__('Invalid registration step'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->RegistrationStep->save($this->request->data)) {
				$this->Session->setFlash(__('The registration step has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The registration step could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('RegistrationStep.' . $this->RegistrationStep->primaryKey => $id));
			$this->request->data = $this->RegistrationStep->find('first', $options);
		}
		$conferences = $this->RegistrationStep->Conference->find('list');
		$localities = $this->RegistrationStep->Locality->find('list');
		$users = $this->RegistrationStep->User->find('list');
		$creators = $this->RegistrationStep->Creator->find('list');
		$modifiers = $this->RegistrationStep->Modifier->find('list');
		$this->set(compact('conferences', 'localities', 'users', 'creators', 'modifiers'));
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->RegistrationStep->id = $id;
		if (!$this->RegistrationStep->exists()) {
			throw new NotFoundException(__('Invalid registration step'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->RegistrationStep->delete()) {
			$this->Session->setFlash(__('Registration step deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Registration step was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
