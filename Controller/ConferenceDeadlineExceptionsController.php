<?php
App::uses('AppController', 'Controller');
/**
 * ConferenceDeadlineExceptions Controller
 *
 * @property ConferenceDeadlineException $ConferenceDeadlineException
 */
class ConferenceDeadlineExceptionsController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->ConferenceDeadlineException->recursive = 0;
		$this->set('conferenceDeadlineExceptions', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->ConferenceDeadlineException->exists($id)) {
			throw new NotFoundException(__('Invalid conference deadline exception'));
		}
		$options = array('conditions' => array('ConferenceDeadlineException.' . $this->ConferenceDeadlineException->primaryKey => $id));
		$this->set('conferenceDeadlineException', $this->ConferenceDeadlineException->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->ConferenceDeadlineException->create();
			if ($this->ConferenceDeadlineException->save($this->request->data)) {
				$this->Session->setFlash(__('The conference deadline exception has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The conference deadline exception could not be saved. Please, try again.'));
			}
		}
		$conferences = $this->ConferenceDeadlineException->Conference->find('list');
		$conferenceDeadlines = $this->ConferenceDeadlineException->ConferenceDeadline->find('list');
		$this->set(compact('conferences', 'conferenceDeadlines'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->ConferenceDeadlineException->exists($id)) {
			throw new NotFoundException(__('Invalid conference deadline exception'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->ConferenceDeadlineException->save($this->request->data)) {
				$this->Session->setFlash(__('The conference deadline exception has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The conference deadline exception could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('ConferenceDeadlineException.' . $this->ConferenceDeadlineException->primaryKey => $id));
			$this->request->data = $this->ConferenceDeadlineException->find('first', $options);
		}
		$conferences = $this->ConferenceDeadlineException->Conference->find('list');
		$conferenceDeadlines = $this->ConferenceDeadlineException->ConferenceDeadline->find('list');
		$this->set(compact('conferences', 'conferenceDeadlines'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->ConferenceDeadlineException->id = $id;
		if (!$this->ConferenceDeadlineException->exists()) {
			throw new NotFoundException(__('Invalid conference deadline exception'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->ConferenceDeadlineException->delete()) {
			$this->Session->setFlash(__('Conference deadline exception deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Conference deadline exception was not deleted'));
		$this->redirect(array('action' => 'index'));
	}


/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->ConferenceDeadlineException->recursive = 0;
		$this->set('conferenceDeadlineExceptions', $this->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->ConferenceDeadlineException->exists($id)) {
			throw new NotFoundException(__('Invalid conference deadline exception'));
		}
		$options = array('conditions' => array('ConferenceDeadlineException.' . $this->ConferenceDeadlineException->primaryKey => $id));
		$this->set('conferenceDeadlineException', $this->ConferenceDeadlineException->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->ConferenceDeadlineException->create();
			if ($this->ConferenceDeadlineException->save($this->request->data)) {
				$this->Session->setFlash(__('The conference deadline exception has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The conference deadline exception could not be saved. Please, try again.'));
			}
		}
		$conferences = $this->ConferenceDeadlineException->Conference->find('list');
		$conferenceDeadlines = $this->ConferenceDeadlineException->ConferenceDeadline->find('list');
		$this->set(compact('conferences', 'conferenceDeadlines'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->ConferenceDeadlineException->exists($id)) {
			throw new NotFoundException(__('Invalid conference deadline exception'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->ConferenceDeadlineException->save($this->request->data)) {
				$this->Session->setFlash(__('The conference deadline exception has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The conference deadline exception could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('ConferenceDeadlineException.' . $this->ConferenceDeadlineException->primaryKey => $id));
			$this->request->data = $this->ConferenceDeadlineException->find('first', $options);
		}
		$conferences = $this->ConferenceDeadlineException->Conference->find('list');
		$conferenceDeadlines = $this->ConferenceDeadlineException->ConferenceDeadline->find('list');
		$this->set(compact('conferences', 'conferenceDeadlines'));
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->ConferenceDeadlineException->id = $id;
		if (!$this->ConferenceDeadlineException->exists()) {
			throw new NotFoundException(__('Invalid conference deadline exception'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->ConferenceDeadlineException->delete()) {
			$this->Session->setFlash(__('Conference deadline exception deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Conference deadline exception was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
