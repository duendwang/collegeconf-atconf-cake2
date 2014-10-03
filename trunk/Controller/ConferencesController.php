<?php
App::uses('AppController', 'Controller');
/**
 * Conferences Controller
 *
 * @property Conference $Conference
 */
class ConferencesController extends AppController {

/**
 * conferenceChange method
 * 
 * @return void
 */

    public function conference_change() {
        if ($this->request->is('post')) {
            $this->Session->write('Conference.selected',$this->request->data['Conference']['selected']);
            $this->redirect($this->referer());
        }
    }

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Conference->recursive = 0;
		$this->set('conferences', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Conference->exists($id)) {
			throw new NotFoundException(__('Invalid conference'));
		}
		$options = array('conditions' => array('Conference.' . $this->Conference->primaryKey => $id));
		$this->set('conference', $this->Conference->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Conference->create();
                        //TODO also create registrationSteps rates
			if ($this->Conference->save($this->request->data)) {
				$this->Session->setFlash(__('The conference has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The conference could not be saved. Please, try again.'));
			}
		}
		$conferenceLocations = $this->Conference->ConferenceLocation->find('list');
		$this->set(compact('conferenceLocations'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Conference->exists($id)) {
			throw new NotFoundException(__('Invalid conference'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Conference->save($this->request->data)) {
				$this->Session->setFlash(__('The conference has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The conference could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Conference.' . $this->Conference->primaryKey => $id));
			$this->request->data = $this->Conference->find('first', $options);
		}
		$conferenceLocations = $this->Conference->ConferenceLocation->find('list');
		$this->set(compact('conferenceLocations'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Conference->id = $id;
		if (!$this->Conference->exists()) {
			throw new NotFoundException(__('Invalid conference'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Conference->delete()) {
			$this->Session->setFlash(__('Conference deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Conference was not deleted'));
		$this->redirect(array('action' => 'index'));
	}


/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Conference->recursive = 0;
		$this->set('conferences', $this->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Conference->exists($id)) {
			throw new NotFoundException(__('Invalid conference'));
		}
		$options = array('conditions' => array('Conference.' . $this->Conference->primaryKey => $id));
		$this->set('conference', $this->Conference->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Conference->create();
			if ($this->Conference->save($this->request->data)) {
				$this->Session->setFlash(__('The conference has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The conference could not be saved. Please, try again.'));
			}
		}
		$conferenceLocations = $this->Conference->ConferenceLocation->find('list');
		$this->set(compact('conferenceLocations'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->Conference->exists($id)) {
			throw new NotFoundException(__('Invalid conference'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Conference->save($this->request->data)) {
				$this->Session->setFlash(__('The conference has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The conference could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Conference.' . $this->Conference->primaryKey => $id));
			$this->request->data = $this->Conference->find('first', $options);
		}
		$conferenceLocations = $this->Conference->ConferenceLocation->find('list');
		$this->set(compact('conferenceLocations'));
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->Conference->id = $id;
		if (!$this->Conference->exists()) {
			throw new NotFoundException(__('Invalid conference'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Conference->delete()) {
			$this->Session->setFlash(__('Conference deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Conference was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
