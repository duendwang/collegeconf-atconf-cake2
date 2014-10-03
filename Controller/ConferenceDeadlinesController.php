<?php
App::uses('AppController', 'Controller');
/**
 * ConferenceDeadlines Controller
 *
 * @property ConferenceDeadline $ConferenceDeadline
 */
class ConferenceDeadlinesController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->ConferenceDeadline->recursive = 0;
		$this->set('conferenceDeadlines', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->ConferenceDeadline->exists($id)) {
			throw new NotFoundException(__('Invalid conference deadline'));
		}
		$options = array('conditions' => array('ConferenceDeadline.' . $this->ConferenceDeadline->primaryKey => $id));
		$this->set('conferenceDeadline', $this->ConferenceDeadline->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->ConferenceDeadline->create();
			if ($this->ConferenceDeadline->save($this->request->data)) {
				$this->Session->setFlash(__('The conference deadline has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The conference deadline could not be saved. Please, try again.'));
			}
		}
		$weekdays = $this->ConferenceDeadline->Weekday->find('list');
		$this->set(compact('weekdays'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->ConferenceDeadline->exists($id)) {
			throw new NotFoundException(__('Invalid conference deadline'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->ConferenceDeadline->save($this->request->data)) {
				$this->Session->setFlash(__('The conference deadline has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The conference deadline could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('ConferenceDeadline.' . $this->ConferenceDeadline->primaryKey => $id));
			$this->request->data = $this->ConferenceDeadline->find('first', $options);
		}
		$weekdays = $this->ConferenceDeadline->Weekday->find('list');
		$this->set(compact('weekdays'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->ConferenceDeadline->id = $id;
		if (!$this->ConferenceDeadline->exists()) {
			throw new NotFoundException(__('Invalid conference deadline'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->ConferenceDeadline->delete()) {
			$this->Session->setFlash(__('Conference deadline deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Conference deadline was not deleted'));
		$this->redirect(array('action' => 'index'));
	}


/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->ConferenceDeadline->recursive = 0;
		$this->set('conferenceDeadlines', $this->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->ConferenceDeadline->exists($id)) {
			throw new NotFoundException(__('Invalid conference deadline'));
		}
		$options = array('conditions' => array('ConferenceDeadline.' . $this->ConferenceDeadline->primaryKey => $id));
		$this->set('conferenceDeadline', $this->ConferenceDeadline->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->ConferenceDeadline->create();
			if ($this->ConferenceDeadline->save($this->request->data)) {
				$this->Session->setFlash(__('The conference deadline has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The conference deadline could not be saved. Please, try again.'));
			}
		}
		$weekdays = $this->ConferenceDeadline->Weekday->find('list');
		$this->set(compact('weekdays'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->ConferenceDeadline->exists($id)) {
			throw new NotFoundException(__('Invalid conference deadline'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->ConferenceDeadline->save($this->request->data)) {
				$this->Session->setFlash(__('The conference deadline has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The conference deadline could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('ConferenceDeadline.' . $this->ConferenceDeadline->primaryKey => $id));
			$this->request->data = $this->ConferenceDeadline->find('first', $options);
		}
		$weekdays = $this->ConferenceDeadline->Weekday->find('list');
		$this->set(compact('weekdays'));
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->ConferenceDeadline->id = $id;
		if (!$this->ConferenceDeadline->exists()) {
			throw new NotFoundException(__('Invalid conference deadline'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->ConferenceDeadline->delete()) {
			$this->Session->setFlash(__('Conference deadline deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Conference deadline was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
