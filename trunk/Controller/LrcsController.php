<?php
App::uses('AppController', 'Controller');
/**
 * Lrcs Controller
 *
 * @property Lrc $Lrc
 */
class LrcsController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Lrc->recursive = 0;
		$this->set('lrcs', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Lrc->exists($id)) {
			throw new NotFoundException(__('Invalid lrc'));
		}
		$options = array('conditions' => array('Lrc.' . $this->Lrc->primaryKey => $id));
		$this->set('lrc', $this->Lrc->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Lrc->create();
			if ($this->Lrc->save($this->request->data)) {
				$this->Session->setFlash(__('The LRC has been saved'),'success');
				if ($this->Auth->user('UserType.account_type_id') == 4) {
                                    $this->redirect(array('controller' => 'users','action' => 'edit',$this->Auth->user('id')));
                                } else {
                                    $this->redirect(array('action' => 'index'));
                                }
			} else {
				$this->Session->setFlash(__('The LRC could not be saved. Please, try again.'));
			}
		}
		$locality = $this->Auth->user('locality_id');
                $localities = $this->Lrc->Locality->find('list');
		$this->set(compact('locality','localities'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Lrc->exists($id)) {
			throw new NotFoundException(__('Invalid lrc'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Lrc->save($this->request->data)) {
				$this->Session->setFlash(__('The LRC has been saved'),'success');
				if ($this->Auth->user('UserType.account_type_id') == 4) {
                                    $this->redirect(array('controller' => 'users','action' => 'edit',$this->Auth->user('id')));
                                } else {
                                    $this->redirect(array('action' => 'index'));
                                }
			} else {
				$this->Session->setFlash(__('The LRC could not be saved. Please, try again.'),'failure');
			}
		} else {
			$options = array('conditions' => array('Lrc.' . $this->Lrc->primaryKey => $id));
			$this->request->data = $this->Lrc->find('first', $options);
		}
		$locality = $this->Auth->user('locality_id');
                $localities = $this->Lrc->Locality->find('list');
		$this->set(compact('locality','localities'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Lrc->id = $id;
		if (!$this->Lrc->exists()) {
			throw new NotFoundException(__('Invalid lrc'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Lrc->delete()) {
			$this->Session->setFlash(__('LRC deleted'),'success');
                        if ($this->Auth->user('UserType.account_type_id') == 4) {
                            $this->redirect(array('controller' => 'users','action' => 'edit',$this->Auth->user('id')));
                        } else {
                            $this->redirect(array('action' => 'index'));
                        }
		}
		$this->Session->setFlash(__('LRC was not deleted'),'failure');
		$this->redirect(array('action' => 'index'));
	}


/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Lrc->recursive = 0;
		$this->set('lrcs', $this->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Lrc->exists($id)) {
			throw new NotFoundException(__('Invalid lrc'));
		}
		$options = array('conditions' => array('Lrc.' . $this->Lrc->primaryKey => $id));
		$this->set('lrc', $this->Lrc->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Lrc->create();
			if ($this->Lrc->save($this->request->data)) {
				$this->Session->setFlash(__('The lrc has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The lrc could not be saved. Please, try again.'));
			}
		}
		$localities = $this->Lrc->Locality->find('list');
		$this->set(compact('localities'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->Lrc->exists($id)) {
			throw new NotFoundException(__('Invalid lrc'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Lrc->save($this->request->data)) {
				$this->Session->setFlash(__('The lrc has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The lrc could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Lrc.' . $this->Lrc->primaryKey => $id));
			$this->request->data = $this->Lrc->find('first', $options);
		}
		$localities = $this->Lrc->Locality->find('list');
		$this->set(compact('localities'));
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->Lrc->id = $id;
		if (!$this->Lrc->exists()) {
			throw new NotFoundException(__('Invalid lrc'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Lrc->delete()) {
			$this->Session->setFlash(__('Lrc deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Lrc was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
