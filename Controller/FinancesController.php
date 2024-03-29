<?php
App::uses('AppController', 'Controller');
/**
 * Finances Controller
 *
 * @property Finance $Finance
 */
class FinancesController extends AppController {

        public $helpers = array('Js' => array('Jquery'));

        public $components = array('Search.Prg');

        public $presetVars = array(
                array('field' => 'locality', 'type' => 'value')
        );

/**
 * index method
 *
 * @return void
 */
	public function index() {
                $this->Prg->commonProcess();
                $this->Finance->recursive = 0;
                $this->paginate = array(
                    'conditions' => $this->Finance->parseCriteria($this->passedArgs),
                    'contain' => $this->Finance->contain,
                    'order' => array('Finance.locality')
                );
                
                $finances = $this->paginate();
                foreach ($finances as &$finance):
                    if(true) {
                    //if($finance['Finance']['finance_type_id'] !== '1' || strpos($finance['Finance']['comment'],'No lodging') !== false || strpos($finance['Finance']['comment'],'Nurse') !== false) {
                        $finance_comment = ' ';
                        foreach ($finance['FinanceAttendee'] as $finance_attendee):
                            if (!empty($finance_attendee['AddAttendee']) && !empty($finance_attendee['CancelAttendee'])) {
                                $finance_comment = $finance_comment.
                                        $finance_attendee['AddAttendee']['name'].
                                        ' for '.
                                        $finance_attendee['CancelAttendee']['name'];
                            } elseif (!empty($finance_attendee['AddAttendee'])) {
                                $finance_comment = $finance_comment.
                                        $finance_attendee['AddAttendee']['name'].
                                        ',';
                            } elseif (!empty($finance_attendee['CancelAttendee'])) {
                                $finance_comment = $finance_comment.
                                        $finance_attendee['CancelAttendee']['name'].
                                        ',';
                            }
                        endforeach;
                        $finance_comment = substr($finance_comment,0,-1);
                        $finance['Finance']['comment'] = $finance['Finance']['comment'].$finance_comment;
                    }
                endforeach;
                $this->set(compact('finances'));
	}

/**
 * report method
 *
 * @return void
 */
	public function report($locality = null) {
                $this->Finance->recursive = 0;
                if(isset($locality)) {
                    $this->paginate = array(
                        'conditions' => array('Finance.locality_id =' => $locality),
                        'contain' => $this->Finance->contain,
                        'order' => array('Finance.receive_date' => 'asc'),
                        'limit' => 100,
                    );
                    $locality = $this->Finance->Locality->find('first',array('conditions' => array('Locality.id' => $locality),'recursive' => 0));
                    $this->set('totals',$this->Finance->find('all',array('conditions' => array('Finance.locality_id' => $locality['Locality']['id']),'fields' => array('Finance.conference_id','Locality.name','sum(count) as total_count','sum(charge) as total_charge','sum(payment) as total_payment','sum(balance) as total_balance'),'recursive' => 2)));
                } else {
                    $this->redirect(array('action' => 'index'));
                }

                $finances = $this->paginate();
                foreach ($finances as &$finance):
                    if($finance['Finance']['finance_type_id'] !== '1' || strpos($finance['Finance']['comment'],'No lodging') !== false || strpos($finance['Finance']['comment'],'Nurse') !== false) {
                        $finance_comment = ' ';
                        foreach ($finance['FinanceAttendee'] as $finance_attendee):
                            if (!empty($finance_attendee['AddAttendee']) && !empty($finance_attendee['CancelAttendee'])) {
                                $finance_comment = $finance_comment.
                                        $finance_attendee['AddAttendee']['name'].
                                        ' for '.
                                        $finance_attendee['CancelAttendee']['name'].
                                        ', ';
                            } elseif (!empty($finance_attendee['AddAttendee'])) {
                                $finance_comment = $finance_comment.
                                        $finance_attendee['AddAttendee']['name'].
                                        ', ';
                            } elseif (!empty($finance_attendee['CancelAttendee'])) {
                                $finance_comment = $finance_comment.
                                        $finance_attendee['CancelAttendee']['name'].
                                        ', ';
                            }
                        endforeach;
                        $finance_comment = substr($finance_comment,0,-2);
                        $finance['Finance']['comment'] = $finance['Finance']['comment'].$finance_comment;
                    }
                endforeach;
                $this->set(compact('finances','locality'));
	}

/**
 * summary method
 *
 * @return void
 */
        
        public function summary() {
            $this->Finance->recursive = 2;
            $this->paginate = array(
                'fields' => array(
                    'Finance.locality_id',
                    'SUM(Finance.count) as "count"',
                    'SUM(Finance.charge) as "total charge"',
                    'SUM(Finance.payment) as "total payment"',
                    'SUM(Finance.balance) as "balance"'),
                'order' => array('Locality.name' => 'asc'),
                'group' => array('Finance.locality_id'),
                'limit' => 100,
                );
            /**$report_entries = $this->Finance->query("SELECT city,
                SUM(count) AS count,
                SUM(charge) AS 'total charge',
                SUM(payment) AS 'total payment',
                SUM(balance) AS balance
                FROM finances As Finance
                INNER JOIN localities As Locality
                ON Finance.locality_id=Locality.id
                GROUP BY Finance.locality_id");**/
           
            //print_r($report_entries);
            
            $this->set('report_entries', $this->paginate());
                     
        }

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Finance->exists($id)) {
			throw new NotFoundException(__('Invalid finance'));
		}
		$options = array('conditions' => array('Finance.' . $this->Finance->primaryKey => $id));
		$this->set('finance', $this->Finance->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Finance->create();
			if ($this->Finance->save($this->request->data)) {
				$this->Session->setFlash(__('The finance has been saved'),'success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The finance could not be saved. Please, try again.'),'failure');
			}
		}
                $conferences = $this->Finance->Conference->find('list',array('conditions' => array('Conference.id' => $this->Finance->Conference->current_conference())));
                $localities = $this->Finance->Locality->find('list');
		$financeTypes = $this->Finance->FinanceType->find('list',array('conditions' => array('FinanceType.id NOT' => 3),'order' => 'FinanceType.id'));
		//$creators = $this->Finance->Creator->find('list');
		//$modifiers = $this->Finance->Modifier->find('list');
		$this->set(compact('conferences', 'localities', 'financeTypes'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Finance->exists($id)) {
			throw new NotFoundException(__('Invalid finance'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Finance->save($this->request->data)) {
				$this->Session->setFlash(__('The finance has been saved'),'success');
				$this->redirect($this->request->data['Finance']['referer']);
			} else {
				$this->Session->setFlash(__('The finance could not be saved. Please, try again.'),'failure');
			}
		} else {
			$options = array('conditions' => array('Finance.' . $this->Finance->primaryKey => $id));
			$this->request->data = $this->Finance->find('first', $options);
                        if ($this->request->data['Finance']['charge'] == $this->request->data['Finance']['count'] * $this->request->data['Finance']['rate'] * -1) {
                            unset($this->request->data['Finance']['charge']);
                        }
                        unset($this->request->data['Finance']['balance']);
		}
                $referer = $this->referer();
                $conferences = $this->Finance->Conference->find('list',array('conditions' => array('Conference.id' => $this->Finance->Conference->current_conference())));
                $localities = $this->Finance->Locality->find('list');
		$financeTypes = $this->Finance->FinanceType->find('list');
		//$creators = $this->Finance->Creator->find('list');
		//$modifiers = $this->Finance->Modifier->find('list');
		$this->set(compact('conferences', 'localities', 'financeTypes','referer'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
                $this->Session->setFlash(__('Deleting of finances not allowed'));
		$this->redirect(array('action' => 'index'));
		/**$this->Finance->id = $id;
		if (!$this->Finance->exists()) {
			throw new NotFoundException(__('Invalid finance'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Finance->delete()) {
			$this->Session->setFlash(__('Finance deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Finance was not deleted'));
		$this->redirect(array('action' => 'index'));**/
	}


/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Finance->recursive = 0;
		$this->set('finances', $this->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Finance->exists($id)) {
			throw new NotFoundException(__('Invalid finance'));
		}
		$options = array('conditions' => array('Finance.' . $this->Finance->primaryKey => $id));
		$this->set('finance', $this->Finance->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Finance->create();
			if ($this->Finance->save($this->request->data)) {
				$this->Session->setFlash(__('The finance has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The finance could not be saved. Please, try again.'));
			}
		}
		$conferences = $this->Finance->Conference->find('list');
		$localities = $this->Finance->Locality->find('list');
		$financeTypes = $this->Finance->FinanceType->find('list');
		$creators = $this->Finance->Creator->find('list');
		$modifiers = $this->Finance->Modifier->find('list');
		$this->set(compact('conferences', 'localities', 'financeTypes', 'creators', 'modifiers'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->Finance->exists($id)) {
			throw new NotFoundException(__('Invalid finance'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Finance->save($this->request->data)) {
				$this->Session->setFlash(__('The finance has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The finance could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Finance.' . $this->Finance->primaryKey => $id));
			$this->request->data = $this->Finance->find('first', $options);
		}
		$conferences = $this->Finance->Conference->find('list');
		$localities = $this->Finance->Locality->find('list');
		$financeTypes = $this->Finance->FinanceType->find('list');
		$creators = $this->Finance->Creator->find('list');
		$modifiers = $this->Finance->Modifier->find('list');
		$this->set(compact('conferences', 'localities', 'financeTypes', 'creators', 'modifiers'));
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->Finance->id = $id;
		if (!$this->Finance->exists()) {
			throw new NotFoundException(__('Invalid finance'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Finance->delete()) {
			$this->Session->setFlash(__('Finance deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Finance was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
