<?php
App::uses('AppController', 'Controller');
/**
 * Cancels Controller
 *
 * @property Cancel $Cancel
 */
class CancelsController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Cancel->recursive = 0;
		$this->set('cancels', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Cancel->exists($id)) {
			throw new NotFoundException(__('Invalid cancel'));
		}
		$options = array('conditions' => array('Cancel.' . $this->Cancel->primaryKey => $id));
		$this->set('cancel', $this->Cancel->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Cancel->create();
			if ($this->Cancel->save($this->request->data)) {
				$this->Session->setFlash(__('The cancel has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The cancel could not be saved. Please, try again.'));
			}
		}
		$attendees = $this->Cancel->Attendee->find('list');
		$conferences = $this->Cancel->Conference->find('list');
		$creators = $this->Cancel->Creator->find('list');
		$modifiers = $this->Cancel->Modifier->find('list');
		$this->set(compact('attendees', 'conferences', 'creators', 'modifiers'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Cancel->exists($id)) {
			throw new NotFoundException(__('Invalid cancel'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Cancel->save($this->request->data)) {
				$this->Session->setFlash(__('The cancel has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The cancel could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Cancel.' . $this->Cancel->primaryKey => $id));
			$this->request->data = $this->Cancel->find('first', $options);
		}
		$attendees = $this->Cancel->Attendee->find('list');
		$conferences = $this->Cancel->Conference->find('list');
		$creators = $this->Cancel->Creator->find('list');
		$modifiers = $this->Cancel->Modifier->find('list');
		$this->set(compact('attendees', 'conferences', 'creators', 'modifiers'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Cancel->id = $id;
		if (!$this->Cancel->exists()) {
			throw new NotFoundException(__('Invalid cancel'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Cancel->delete()) {
			$this->Session->setFlash(__('Cancel deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Cancel was not deleted'));
		$this->redirect(array('action' => 'index'));
	}


/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Cancel->recursive = 0;
		$this->set('cancels', $this->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Cancel->exists($id)) {
			throw new NotFoundException(__('Invalid cancel'));
		}
		$options = array('conditions' => array('Cancel.' . $this->Cancel->primaryKey => $id));
		$this->set('cancel', $this->Cancel->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Cancel->create();
			if ($this->Cancel->save($this->request->data)) {
				$this->Session->setFlash(__('The cancel has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The cancel could not be saved. Please, try again.'));
			}
		}
		$attendees = $this->Cancel->Attendee->find('list');
		$conferences = $this->Cancel->Conference->find('list');
		$creators = $this->Cancel->Creator->find('list');
		$modifiers = $this->Cancel->Modifier->find('list');
		$this->set(compact('attendees', 'conferences', 'creators', 'modifiers'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->Cancel->exists($id)) {
			throw new NotFoundException(__('Invalid cancel'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Cancel->save($this->request->data)) {
				$this->Session->setFlash(__('The cancel has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The cancel could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Cancel.' . $this->Cancel->primaryKey => $id));
			$this->request->data = $this->Cancel->find('first', $options);
		}
		$attendees = $this->Cancel->Attendee->find('list');
		$conferences = $this->Cancel->Conference->find('list');
		$creators = $this->Cancel->Creator->find('list');
		$modifiers = $this->Cancel->Modifier->find('list');
		$this->set(compact('attendees', 'conferences', 'creators', 'modifiers'));
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->Cancel->id = $id;
		if (!$this->Cancel->exists()) {
			throw new NotFoundException(__('Invalid cancel'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Cancel->delete()) {
			$this->Session->setFlash(__('Cancel deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Cancel was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
