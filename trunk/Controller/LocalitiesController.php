<?php
App::uses('AppController', 'Controller');
/**
 * Localities Controller
 *
 * @property Locality $Locality
 */
class LocalitiesController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Locality->recursive = 0;
		$this->set('localities', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Locality->exists($id)) {
			throw new NotFoundException(__('Invalid locality'));
		}
		$options = array('conditions' => array('Locality.' . $this->Locality->primaryKey => $id));
		$this->set('locality', $this->Locality->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Locality->create();
			if ($this->Locality->save($this->request->data)) {
				$this->Session->setFlash(__('The locality has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The locality could not be saved. Please, try again.'));
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
		if (!$this->Locality->exists($id)) {
			throw new NotFoundException(__('Invalid locality'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Locality->save($this->request->data)) {
				$this->Session->setFlash(__('The locality has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The locality could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Locality.' . $this->Locality->primaryKey => $id));
			$this->request->data = $this->Locality->find('first', $options);
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
		$this->Locality->id = $id;
		if (!$this->Locality->exists()) {
			throw new NotFoundException(__('Invalid locality'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Locality->delete()) {
			$this->Session->setFlash(__('Locality deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Locality was not deleted'));
		$this->redirect(array('action' => 'index'));
	}


/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Locality->recursive = 0;
		$this->set('localities', $this->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Locality->exists($id)) {
			throw new NotFoundException(__('Invalid locality'));
		}
		$options = array('conditions' => array('Locality.' . $this->Locality->primaryKey => $id));
		$this->set('locality', $this->Locality->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Locality->create();
			if ($this->Locality->save($this->request->data)) {
				$this->Session->setFlash(__('The locality has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The locality could not be saved. Please, try again.'));
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
		if (!$this->Locality->exists($id)) {
			throw new NotFoundException(__('Invalid locality'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Locality->save($this->request->data)) {
				$this->Session->setFlash(__('The locality has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The locality could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Locality.' . $this->Locality->primaryKey => $id));
			$this->request->data = $this->Locality->find('first', $options);
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
		$this->Locality->id = $id;
		if (!$this->Locality->exists()) {
			throw new NotFoundException(__('Invalid locality'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Locality->delete()) {
			$this->Session->setFlash(__('Locality deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Locality was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
        
/**
 * autocomplete method
 */
        public function autocomplete($all = false) {
            $this->Locality->recursive = -1;
            $this->autoRender = false;
            if ($this->request->is('ajax')) {
                $this->layout = 'ajax';
                $query = $this->request->query('term');
                
                $conditions = array(
                    //remove the leading '%' if you want to restrict the matches more
                    'Locality.name LIKE' => '%' . $query . '%',
                );
                if ($all != true) {
                    $conditions = array_merge($conditions, array(
                        array('Locality.name NOT LIKE' => 'Other%'),
                        array('Locality.name NOT LIKE' => '*%'),
                    ));
                }
                
                $localities = $this->Locality->find('all', array(
                    'fields' => array('Locality.id','Locality.name'),
                    'conditions' => $conditions,
                    'order' => 'Locality.name',
                ));
                $i = 0;
                foreach($localities as $locality):
                    $response[$i]['value'] = $locality['Locality']['id'];
                    $response[$i]['label'] = $locality['Locality']['name'];
                    $i++;
                endforeach;
                echo json_encode($response);
            } else {
                //if the form wasn't submitted with JavaScript
                //set a session variable with the search term in and redirect to index page
                //$this->Session->write('companyName',$this->request->data['Company']['name']);
                $this->Session->setflash('You have reached this page in error. Please use the links from the home page or from the registration team to navigate to where you need to go. If the problem persists, please contact the registration team for support.','failure');
                $this->redirect(array('controller' => 'pages','action' => 'display','home'));
            }
        }
}
