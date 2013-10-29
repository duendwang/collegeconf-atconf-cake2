<?php
App::uses('AppController', 'Controller');
/**
 * Lodgings Controller
 *
 * @property Lodging $Lodging
 */
class LodgingsController extends AppController {

        public $helpers = array('Js' => array('Jquery'));
        
        public $components = array('Search.Prg');

        public $presetVars = array(
                array('field' => 'name', 'type' => 'value'),
                array('field' => 'locality', 'type' => 'value'),
                array('field' => 'city', 'type' => 'value')
        );

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Lodging->recursive = 0;
                $this->Prg->commonProcess();
                $this->paginate = array('conditions' => $this->Lodging->parseCriteria($this->passedArgs));
		$this->set('lodgings', $this->paginate());
	}

/**
 * capacity method
 *
 * @return void
 */
        public function capacity($id = null) {
                $three_days_ago = date('Y-m-d', strtotime('-3 days'));
                $current_conference = $this->Lodging->Conference->find('list',array('conditions' => array('Conference.start_date < NOW()',"Conference.start_date >= '$three_days_ago'")));
                $lodgings = $this->Lodging->find('all',array('conditions' => array('Lodging.conference_id' => $current_conference),'recursive' => 0));
                foreach ($lodgings as $lodging):
                    $attendee = $this->Lodging->Attendee->find('first',array('conditions' => array('Attendee.lodging_id' => $lodging['Lodging']['id'])));
                    //debug($attendee);
                    //exit;
                    $capacities[] = array(
                        'house' => $lodging['Lodging']['name'],
                        'room' => $lodging['Lodging']['room'],
                        'openings' => $lodging['Lodging']['capacity'] - $this->Lodging->Attendee->find('count',array('conditions' => array('Attendee.lodging_id' => $lodging['Lodging']['id']))),
                        'assigned_locality' => $attendee['Locality']['city'],
                        'assigned_gender' => $attendee['Attendee']['gender'],
                        );
                endforeach;
                /**$capacities = $this->Lodging->query("
                    SELECT lodgings1.id, lodgings1.name AS 'Host Name', lodgings1.lodging_locality AS 'Lodging Locality', lodgings1.capacity AS 'Host Capacity',  
                    COUNT(attendees.lodging_id) AS 'Capacity Occupied', attendees.gender AS 'Attendee Gender', localities.city 'Attendee Locality'
                    FROM attendees 
                    INNER JOIN (SELECT lodgings.id, lodgings.name, lodgings.capacity, localities.city AS lodging_locality 
                            FROM lodgings 
                            INNER JOIN localities 
                            ON (lodgings.locality_id = localities.id)) AS lodgings1
                    ON (lodgings1.id = attendees.lodging_id)
                    INNER JOIN localities ON (localities.id = attendees.locality_id) 
                    GROUP BY attendees.lodging_id
                ");
                //print_r($capacities;**/
                $this->set(compact('capacities'));
                
        }

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Lodging->exists($id)) {
			throw new NotFoundException(__('Invalid lodging'));
		}
		$options = array('conditions' => array('Lodging.' . $this->Lodging->primaryKey => $id));
		$this->set('lodging', $this->Lodging->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Lodging->create();
			if ($this->Lodging->save($this->request->data)) {
				$this->Session->setFlash(__('The lodging has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The lodging could not be saved. Please, try again.'));
			}
		}
		$conferences = $this->Lodging->Conference->find('list');
		$localities = $this->Lodging->Locality->find('list');
		$this->set(compact('conferences', 'localities'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Lodging->exists($id)) {
			throw new NotFoundException(__('Invalid lodging'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Lodging->save($this->request->data)) {
				$this->Session->setFlash(__('The lodging has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The lodging could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Lodging.' . $this->Lodging->primaryKey => $id));
			$this->request->data = $this->Lodging->find('first', $options);
		}
		$conferences = $this->Lodging->Conference->find('list');
		$localities = $this->Lodging->Locality->find('list');
		$this->set(compact('conferences', 'localities'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Lodging->id = $id;
		if (!$this->Lodging->exists()) {
			throw new NotFoundException(__('Invalid lodging'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Lodging->delete()) {
			$this->Session->setFlash(__('Lodging deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Lodging was not deleted'));
		$this->redirect(array('action' => 'index'));
	}


/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Lodging->recursive = 0;
		$this->set('lodgings', $this->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Lodging->exists($id)) {
			throw new NotFoundException(__('Invalid lodging'));
		}
		$options = array('conditions' => array('Lodging.' . $this->Lodging->primaryKey => $id));
		$this->set('lodging', $this->Lodging->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Lodging->create();
			if ($this->Lodging->save($this->request->data)) {
				$this->Session->setFlash(__('The lodging has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The lodging could not be saved. Please, try again.'));
			}
		}
		$conferences = $this->Lodging->Conference->find('list');
		$localities = $this->Lodging->Locality->find('list');
		$this->set(compact('conferences', 'localities'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->Lodging->exists($id)) {
			throw new NotFoundException(__('Invalid lodging'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Lodging->save($this->request->data)) {
				$this->Session->setFlash(__('The lodging has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The lodging could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Lodging.' . $this->Lodging->primaryKey => $id));
			$this->request->data = $this->Lodging->find('first', $options);
		}
		$conferences = $this->Lodging->Conference->find('list');
		$localities = $this->Lodging->Locality->find('list');
		$this->set(compact('conferences', 'localities'));
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->Lodging->id = $id;
		if (!$this->Lodging->exists()) {
			throw new NotFoundException(__('Invalid lodging'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Lodging->delete()) {
			$this->Session->setFlash(__('Lodging deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Lodging was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
