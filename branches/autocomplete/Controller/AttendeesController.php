<?php
App::uses('AppController', 'Controller');
/**
 * Attendees Controller
 *
 * @property Attendee $Attendee
 */
class AttendeesController extends AppController {

        public $components = array('Search.Prg');

        public $presetVars = array(
                array('field' => 'name', 'type' => 'value'),
                array('field' => 'locality', 'type' => 'value')
        );
        
        public function beforeFilter() {
            parent::beforeFilter();
            $this->Auth->allow('selfadd','verify','_requirementCheck','selfedit');
        }
        
/**
 * index method
 *
 * @return void
 */
	public function index() {
                Configure::write('debug', 0);
		$this->Attendee->recursive = -1;
                $this->Prg->commonProcess();
                if ($this->Attendee->parseCriteria($this->passedArgs)) {
                    $conditions = $this->Attendee->parseCriteria($this->passedArgs);
                } elseif ($conference = $this->Attendee->Conference->find('first',array('conditions' => array('Conference.id' => $this->Attendee->Conference->current_conference()),'recursive' => -1))) {
                    $conditions = array(
                        'OR' => array(
                            'Attendee.cancel_count' => 0,
                            'Cancel.created >' => $conference['Conference']['start_date'],
                        )
                    );
                } else {
                    $conditions = array(
                        'Attendee.cancel_count' => 0
                    );
                }
		$this->paginate = array(
                    'conditions' => $conditions,
                    'contain' => $this->Attendee->contain,
                    'limit' => 100
                );
                //$attendees = $this->paginate();
		$this->set('attendees',$this->paginate());
	}

/*
 * report method
 * 
 * @return void
 */
        public function report($locality = null) {
                $this->Attendee->recursive = 0;
                $contain = array_merge($this->Attendee->contain,array(
                    'AttendeeFinanceAdd' => array(
                        'fields' => array(
                            'AttendeeFinanceAdd.cancel_attendee_id'
                        ),
                        'CancelAttendee' => array(
                            'fields' => 'CancelAttendee.name'
                        )
                    )
                ));
                
                $conference = $this->Attendee->Conference->find('first',array('conditions' => array('Conference.id' => 6/**$this->Attendee->Conference->current_conference()**/),'recursive' => 0));
                
                if(isset($locality)) {
                    $this->paginate = array(
                        'conditions' => array('Attendee.locality_id =' => $locality, 'OR' => array('Cancel.created >' => date('Y-m-d h:i:s',strtotime($conference['Conference']['start_date'])),'Attendee.cancel_count' => 0)),
                        'contain' => $contain,
                        'limit' => 200,
                    );
                    $locality = $this->Attendee->Locality->find('first',array('conditions' => array('Locality.id' => $locality),'recursive' => 0));
                } else {
                    $this->redirect(array('action' => index));
                }
                
                $attendees = $this->paginate();
                foreach($attendees as &$attendee):
                    $attendee['Attendee']['created'] = date('m/d/Y',strtotime($attendee['Attendee']['created']));
                    if (!empty($attendee['Cancel']['created'])) {
                        $attendee['Cancel']['created'] = date('m/d/Y',strtotime($attendee['Cancel']['created']));
                    }
                    if (!empty($attendee['Cancel']['replaced'])) {
                        $attendee['Cancel']['reason'] = $attendee['Cancel']['reason'].'; Replaced by '.$attendee['Cancel']['replaced'];
                    }
                    if (!empty($attendee['AttendeeFinanceAdd'])) {
                        foreach ($attendee['AttendeeFinanceAdd'] as &$attendee_finance):
                            if (!empty($attendee_finance['cancel_attendee_id'])) {
                                if (!empty($attendee['Attendee']['comment'])) {
                                    $attendee['Attendee']['comment'] = $attendee['Attendee']['comment'].'; '.'Replacing '.$attendee_finance['CancelAttendee']['name'];
                                } else $attendee['Attendee']['comment'] = 'Replacing '.$attendee_finance['CancelAttendee']['name'];
                            }
                        endforeach;
                    }
                endforeach;
                $this->set(compact('attendees','locality'));
        }

/**
 * summary method
 *
 * @return void
 */
	public function summary() {
                $this->Attendee->recursive = 0;
                $contain = array(
                    'Locality' => array(
                        'fields' => array(
                            'Locality.name'
                        )
                    ),
                );
                
                $totals = $this->Attendee->find('all',array(
                    'contain' => $contain,
                    'fields' => array(
                        //'Attendee.locality_id',
                        'COUNT(Attendee.id) as total',
                        'SUM(check_in_count) as checked_in',
                        'SUM(cancel_count) as canceled',
                    ),
                    'group' => 'Attendee.locality_id',
                    'order' => 'Locality.name',
                ));
                
                $excused_ids = $this->Attendee->AttendeeFinanceCancel->find('list',array(
                    'conditions' => array(
                        'AttendeeFinanceCancel.cancel_attendee_id NOT' => null,
                    ),
                    'fields' => array(
                        'AttendeeFinanceCancel.cancel_attendee_id',
                    ),
                ));
                
                $excused_counts = $this->Attendee->find('all',array(
                    'conditions' => array(
                        'Attendee.id' => $excused_ids,
                    ),
                    'contain' => $contain,
                    'fields' => array(
                        'COUNT(Attendee.id) as count',
                    ),
                    'group' => 'Attendee.locality_id',
                    'order' => 'Locality.name',
                ));
                
                $final_counts = $this->Attendee->find('all',array(
                    'conditions' => array(
                        'Attendee.id NOT' => $excused_ids,
                    ),
                    'contain' => $contain,
                    'fields' => array(
                        'COUNT(Attendee.id) as count',
                        'SUM(Attendee.rate) as charge'
                    ),
                    'group' => 'Attendee.locality_id',
                    'order' => 'Locality.name',
                ));
                
                foreach($totals as $total):
                    $summaries[$total['Locality']['id']] = array_merge(array('name' => $total['Locality']['name']),$total[0]);
                    $summaries[$total['Locality']['id']]['excused'] = '0';
                endforeach;
                
                foreach($excused_counts as $excused):
                    $summaries[$excused['Locality']['id']]['excused'] = $excused[0]['count'];
                endforeach;
                
                foreach($final_counts as $final):
                    $summaries[$final['Locality']['id']]['final_count'] = $final[0]['count'];
                    $summaries[$final['Locality']['id']]['total_charge'] = $final[0]['charge'];
                endforeach;
                
                $this->set(compact('summaries'));
	}

/**
 * ccReport method
 *
 * @param string $id
 * @return void
 */
	
	public function cc_report() {
                $this->Attendee->recursive = 0;
		$this->paginate = array(
                    'conditions' => array('Attendee.conf_contact' => 1),
                    'contain' => $this->Attendee->contain,
                    'order' => array('Locality.city' => 'asc','Locality.city' => 'asc'),
                    'limit' => 100,
                );
                $confcontacts = $this->paginate();
		$this->set(compact('confcontacts'));
	}

/**
 * cancelReport method
 * 
 * @return void
 */
        public function cancel_report($no_show = false) {
            $this->Attendee->recursive = 0;
            $contain = array_merge(
                    $this->Attendee->contain,
                    array(
                        'AttendeeFinanceCancel'
                    )
            );
            $conference = $this->Attendee->Conference->find('first',array('conditions' => array('Conference.id' => $this->Attendee->Conference->current_conference()),'recursive' => -1));
            if ($no_show) {
                $conditions = array(
                    'OR' => array(
                        array('AND' => array(
                            'Attendee.cancel_count' => 1,
                            'Cancel.created >' => $conference['Conference']['start_date'],
                            'Cancel.replaced' => ''
                        )),
                        array('AND' => array(
                            'Attendee.check_in_count' => 0,
                            'Attendee.cancel_count' => 0
                        ))
                    )
                );
            } else {
                $conditions = array(
                    'Attendee.cancel_count' => 1,
                    'Cancel.created >' => $conference['Conference']['start_date'],
                    'Cancel.replaced' => ''
                );
            }
            $this->paginate = array(
                'conditions' => $conditions,
                'contain' => $contain, 
                'order' => array('Locality.name' => 'asc'),
                'limit' => 50,
            );
            $this->set('cancellations',$this->paginate());
        }
        
/*
 * excuseCancellation method
 * 
 * @return void
 */
        public function excuse_cancellation($id) {
                $this->Attendee->id = $id;
		if (!$this->Attendee->exists()) {
			throw new NotFoundException(__('Invalid attendee'));
		}
		$this->request->onlyAllow('post', 'excuse_cancellation');
                $attendee = $this->Attendee->find('first',array('conditions' => array('Attendee.id' => $id),'recursive' => -1));
		$this->request->data['Finance'] = array(
                    'conference_id' => $attendee['Attendee']['conference_id'],
                    'receive_date' => date('Y-m-d'),
                    'locality_id' => $attendee['Attendee']['locality_id'],
                    'finance_type_id' => 4,
                    'count' => -1,
                    'rate' => $attendee['Attendee']['rate'],
                    'charge' => '',
                    'payment' => '',
                    'balance' => '0.00',
                    'comment' => 'Excused',
                );
                $this->request->data['FinanceAttendee'][0] = array(
                    'cancel_attendee_id' => $id,
                );
                if ($this->Attendee->AttendeeFinanceCancel->Finance->saveAssociated($this->request->data,array('validate' => true,'deep' => true))) {
                    $this->Session->setFlash(__('Cancellation excused'),'success');
			$this->redirect(array('action' => 'cancel_report'));
		}
		$this->Session->setFlash(__('Not able to be excused'),'failure');
		$this->redirect(array('action' => 'cancel_report'));
        }

/*
 * unexcuseCancellation method
 * 
 * @return void
 */
        public function unexcuse_cancellation($id) {
                $this->Attendee->id = $id;
		if (!$this->Attendee->exists()) {
			throw new NotFoundException(__('Invalid attendee'));
		}
		$this->request->onlyAllow('post', 'unexcuse_cancellation');
                $contain = array(
                    'AttendeeFinanceCancel' => array(
                        'Finance'
                    )
                );
                $attendee = $this->Attendee->find('first',array('conditions' => array('Attendee.id' => $id),'contain' => $contain,'recursive' => -1));
                
                //Check if attendee cancellation is already excused or replaced
                if (!empty($attendee['AttendeeFinanceCancel'])) {
                    $replacement = 0;
                    $excused = 0;
                    $others = 0;
                    foreach ($attendee['AttendeeFinanceCancel'] as $attendeefinance):
                        if ($attendeefinance['Finance']['finance_type_id'] == 5) {
                            $replacement = $replacement + 1;
                        } elseif ($attendeefinance['Finance']['finance_type_id'] == 4) {
                            $excused = $excused + 1;
                            $attendeefinance_id = $attendeefinance['id'];
                            $finance_id = $attendeefinance['Finance']['id'];
                        } else {
                            $others = $others + 1;
                        }
                    endforeach;
                    
                    if ($replacement == 0 && $excused == 1) {
                        if ($this->Attendee->AttendeeFinanceCancel->delete($attendeefinance_id,false)) {
                            $attendeefinance_delete = 1;
                        }
                        if ($this->Attendee->AttendeeFinanceCancel->Finance->delete($finance_id,false)) {
                            $finance_delete = 1;
                        }
                        if ($attendeefinance_delete == 1 && $finance_delete == 1) {
                            $this->Session->setFlash(__('Reversed excused cancellation'),'success');
                            $this->redirect(array('action' => 'cancel_report'));
                        } else {
                            $this->Session->setFlash(__('Unable to reverse excused cancellation'),'failure');
                            $this->redirect(array('action' => 'cancel_report'));
                        }
                    } elseif ($replacement == 1) {
                        $this->Session->setFlash(__('Attendee is already replaced'),'failure');
                        $this->redirect(array('action' => 'cancel_report'));
                    } elseif ($excused == 0) {
                        $this->Session->setFlash(__('Attendee cancellation is not excused'),'failure');
                        $this->redirect(array('action' => 'cancel_report'));
                    }
                } else {
                    $this->Session->setFlash(__('Attendee is not canceled'),'failure');
                    $this->redirect($this->referer());
                }
        }

/**
 * checkin_report method
 *
 * @return void
 */
	public function checkin_stats() {
                //Get conference start date
                $conference = $this->Attendee->Conference->find('first',array('conditions' => array('Conference.id' => $this->Attendee->Conference->current_conference()),'recursive' => -1));
                $start_date = strtotime($conference['Conference']['start_date']);

                $checked_in_count = $this->Attendee->find('count',array('conditions' => array('Attendee.check_in_count >' => 0)));
                $high_school_count = $this->Attendee->find('count',array('conditions' => array('Attendee.check_in_count >' => 0,'Attendee.status_id' => 1)));
                $college_count = $this->Attendee->find('count',array('conditions' => array('Attendee.check_in_count >' => 0,'Attendee.status_id' => array(2,3,4,5))));
                $canceled_count = $this->Attendee->find('count',array('conditions' => array('Attendee.cancel_count >' => 0,'Cancel.created >' => $conference['Conference']['start_date'])));
                $not_checked_in_count = $this->Attendee->find('count',array('conditions' => array('Attendee.check_in_count =' => 0,'Attendee.cancel_count' => 0)));
                
                //Construct time breakdowns
                $time_slots = array(
                    //Anaheim time slots
                    'FriD' => array(
                        'name' => 'Friday Dinner',
                        'start' => date('Y-m-d H:i:s',strtotime('12:00:00',$start_date)),
                        'end' => date('Y-m-d H:i:s',strtotime('19:00:00',$start_date)),
                    ),
                    'FriPM' => array(
                        'name' => 'Friday Meeting',
                        'start' => date('Y-m-d H:i:s',strtotime('19:00:00',$start_date)),
                        'end' => date('Y-m-d H:i:s',strtotime('21:30:00',$start_date)),
                    ),
                    'FriNight' => array(
                        'name' => 'Friday Night',
                        'start' => date('Y-m-d H:i:s',strtotime('21:30:00',$start_date)),
                        'end' => date('Y-m-d H:i:s',strtotime('+1 day 06:00:00',$start_date)),
                    ),
                    'SatAM' => array(
                        'name' => 'Saturday Morning Meeting',
                        'start' => date('Y-m-d H:i:s',strtotime('+1 day 06:00:00',$start_date)),
                        'end' => date('Y-m-d H:i:s',strtotime('+1 day 11:00:00',$start_date)),
                    ),
                    'SatL' => array(
                        'name' => 'Saturday Lunch',
                        'start' => date('Y-m-d H:i:s',strtotime('+1 day 11:00:00',$start_date)),
                        'end' => date('Y-m-d H:i:s',strtotime('+1 day 13:00:00',$start_date)),
                    ),
                    'SatA' => array(
                        'name' => 'Saturday Afternoon',
                        'start' => date('Y-m-d H:i:s',strtotime('+1 day 13:00:00',$start_date)),
                        'end' => date('Y-m-d H:i:s',strtotime('+1 day 17:00:00',$start_date)),
                    ),
                    'SatD' => array(
                        'name' => 'Saturday Dinner',
                        'start' => date('Y-m-d H:i:s',strtotime('+1 day 17:00:00',$start_date)),
                        'end' => date('Y-m-d H:i:s',strtotime('+1 day 19:00:00',$start_date)),
                    ),
                    'SatPM' => array(
                        'name' => 'Saturday Evening Meeting',
                        'start' => date('Y-m-d H:i:s',strtotime('+1 day 19:00:00',$start_date)),
                        'end' => date('Y-m-d H:i:s',strtotime('+1 day 21:00:00',$start_date)),
                    ),
                    'SatNight' => array(
                        'name' => 'Saturday Night',
                        'start' => date('Y-m-d H:i:s',strtotime('+1 day 21:00:00',$start_date)),
                        'end' => date('Y-m-d H:i:s',strtotime('+2 day 06:00:00',$start_date)),
                    ),
                    'LDAM' => array(
                        'name' => 'Lord\'s Day Morning Meeting',
                        'start' => date('Y-m-d H:i:s',strtotime('+2 day 06:00:00',$start_date)),
                        'end' => date('Y-m-d H:i:s',strtotime('+2 day 11:00:00',$start_date)),
                    ),
                    'LDL' => array(
                        'name' => 'Lord\'s Day Lunch',
                        'start' => date('Y-m-d H:i:s',strtotime('+2 day 11:00:00',$start_date)),
                        'end' => date('Y-m-d H:i:s',strtotime('+2 day 13:00:00',$start_date)),
                    ),
                );
                
                /**$time_slots = array(
                    //Big Bear time slots
                    'FriPM' => array(
                        'name' => 'Friday Meeting',
                        'start' => date('Y-m-d H:i:s',strtotime('12:00:00',$start_date)),
                        'end' => date('Y-m-d H:i:s',strtotime('21:30:00',$start_date)),
                    ),
                    'FriNight' => array(
                        'name' => 'Friday Night',
                        'start' => date('Y-m-d H:i:s',strtotime('21:30:00',$start_date)),
                        'end' => date('Y-m-d H:i:s',strtotime('+1 day 06:00:00',$start_date)),
                    ),
                    'SatB' => array(
                        'name' => 'Saturday Breakfast',
                        'start' => date('Y-m-d H:i:s',strtotime('+1 day 06:00:00',$start_date)),
                        'end' => date('Y-m-d H:i:s',strtotime('+1 day 09:00:00',$start_date)),
                    ),
                    'SatL' => array(
                        'name' => 'Saturday Lunch',
                        'start' => date('Y-m-d H:i:s',strtotime('+1 day 09:00:00',$start_date)),
                        'end' => date('Y-m-d H:i:s',strtotime('+1 day 13:00:00',$start_date)),
                    ),
                    'SatD' => array(
                        'name' => 'Saturday Dinner',
                        'start' => date('Y-m-d H:i:s',strtotime('+1 day 13:00:00',$start_date)),
                        'end' => date('Y-m-d H:i:s',strtotime('+1 day 19:00:00',$start_date)),
                    ),
                    'SatPM' => array(
                        'name' => 'Saturday Evening Meeting',
                        'start' => date('Y-m-d H:i:s',strtotime('+1 day 19:00:00',$start_date)),
                        'end' => date('Y-m-d H:i:s',strtotime('+1 day 21:00:00',$start_date)),
                    ),
                    'SatNight' => array(
                        'name' => 'Saturday Night',
                        'start' => date('Y-m-d H:i:s',strtotime('+1 day 21:00:00',$start_date)),
                        'end' => date('Y-m-d H:i:s',strtotime('+2 day 06:00:00',$start_date)),
                    ),
                    'LDB' => array(
                        'name' => 'Lord\'s Day Breakfast',
                        'start' => date('Y-m-d H:i:s',strtotime('+2 day 06:00:00',$start_date)),
                        'end' => date('Y-m-d H:i:s',strtotime('+2 day 09:00:00',$start_date)),
                    ),
                    'LDL' => array(
                        'name' => 'Lord\'s Day Lunch',
                        'start' => date('Y-m-d H:i:s',strtotime('+2 day 09:00:00',$start_date)),
                        'end' => date('Y-m-d H:i:s',strtotime('+2 day 13:00:00',$start_date)),
                    ),
                );**/
                
                foreach($time_slots as &$time_slot):
                    $time_slot['count'] = $this->Attendee->CheckIn->find('count',array('conditions' => array('CheckIn.timestamp >' => $time_slot['start'],'CheckIn.timestamp <' => $time_slot['end'])));
                endforeach;
                
                $this->set(compact('time_slots','checked_in_count','high_school_count','college_count','canceled_count','not_checked_in_count'));
	}

/*
 * noshow_report method
 * 
 * @return void
 */
        public function noshow_report() {
            $this->Attendee->recursive = 0;
            $no_shows = $this->Attendee->find('all',array('joins' => array(array('alias' => 'CheckIn','table' => 'check_ins','foreignKey' => false,'conditions' => array('CheckIn.attendee_id = Attendee.id'))),'conditions' => array('CheckIn.id' => null)));
            //debug($no_shows);
            $this->set(compact('no_shows'));
        }

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Attendee->exists($id)) {
			throw new NotFoundException(__('Invalid attendee'));
		}
                $contain = array_merge($this->Attendee->contain, array(
                    'Lodging',
                    'Creator' => array(
                        'fields' => 'Creator.username'
                    ),
                    'Modifier' => array(
                        'fields' => 'Modifier.username'
                    ),
                    'OnsiteRegistration',
                    'PartTimeRegistration',
                    'Payment',
                ));
		$options = array('conditions' => array('Attendee.' . $this->Attendee->primaryKey => $id),'contain' => $contain);
		$attendee = $this->Attendee->find('first', $options);
                
                //Get related finances
                $attendees_finances = $this->Attendee->AttendeeFinanceAdd->find('all',array('conditions' => array('OR' => array('AttendeeFinanceAdd.add_attendee_id' => $id, 'AttendeeFinanceAdd.cancel_attendee_id' => $id)),'recursive' => -1));
                foreach ($attendees_finances as $attendee_finance):
                    $finances[] = $attendee_finance['AttendeeFinanceAdd']['finance_id'];
                endforeach;
                $related_finances = $this->Attendee->AttendeeFinanceAdd->Finance->find('all',array('conditions' => array('Finance.id' => $finances),'contain' => $this->Attendee->AttendeeFinanceAdd->Finance->contain,'recursive' => -1));
                
                $this->set(compact('attendee','related_finances'));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
                    if (empty($this->request->data['Attendee']['reg_type'])) {
                        $this->Session->setFlash(__('Indicate a registration type'),'failure');
                    } elseif (empty($this->request->data['Attendee']['locality_id'])) {
                        $this->Session->setFlash(__('Indicate a locality. If unknown and attendee paid, indicate "other."'),'failure');
                    } else {
			$this->Attendee->create();
                        //Adds other allergy information to comments
                        if (!empty($this->request->data['Attendee']['other_allergies']) && strpos($this->request->data['Attendee']['comment'],'Other Allergies:') === false) {
                            $this->request->data['Attendee']['comment'] = 'Other Allergies: '.str_replace(';',',',$this->request->data['Attendee']['other_allergies']).'; '.$this->request->data['Attendee']['comment'];
                        }
                        //Changes first and last names to correct case
                        $this->request->data['Attendee']['first_name'] = ucwords($this->request->data['Attendee']['first_name']);
                        $this->request->data['Attendee']['last_name'] = ucwords($this->request->data['Attendee']['last_name']);
                        
                        //Changes group field to all caps
                        $this->request->data['Attendee']['group'] = strtoupper($this->request->data['Attendee']['group']);
                        
                        //Sets rate based on registration type
                        //Get rate structure
                        $conference = $this->Attendee->Conference->find('first',array('conditions' => array('Conference.id' => $this->request->data['Attendee']['conference_id']),'recursive' => -1));
                        $conference_location = $conference['Conference']['conference_location_id'];
                        $rates = $this->Attendee->Conference->ConferenceLocation->Rate->conference_rates($conference_location);
                        
                        $finance_comment = '';
                        
                        if ($this->request->data['Attendee']['locality_id'] <= 3) {
                            $this->request->data['Attendee']['calculated_rate'] = $rates['serving']['cost'] + $rates['serving']['latefee_applies'] * $rates['late_fee']['cost'];
                        } elseif ($this->request->data['Attendee']['nurse'] == 1) {
                            $this->request->data['Attendee']['calculated_rate'] = $rates['nurse']['cost'] + $rates['nurse']['latefee_applies'] * $rates['late_fee']['cost'];
                            //Need to add check for FTTA or non-FTTA nurse.
                            $finance_comment = 'Nurse(s)';
                            if ($this->request->data['Attendee']['comment'] == null) $this->request->data['Attendee']['comment'] = 'Nurse';
                            else $this->request->data['Attendee']['comment'] = 'Nurse; '.$this->request->data['Attendee']['comment'];
                        } elseif ($this->request->data['Attendee']['reg_type'] == 'sat_only') {
                            $this->request->data['Attendee']['calculated_rate'] = $rates['sat_only']['cost'] + $rates['sat_only']['latefee_applies'] * $rates['late_fee']['cost'];
                        } elseif ($this->request->data['Attendee']['reg_type'] == 'pt') {
                            if (!empty($this->request->data['Attendee']['pt_misc'])) {
                                foreach ($this->request->data['Attendee']['pt_misc'] as $pt_misc):
                                    //Add water bottle and booklet cost
                                    $this->request->data['Attendee']['calculated_rate'] = $this->request->data['Attendee']['calculated_rate'] + $rates[$pt_misc]['cost'];
                                endforeach;
                            }
                            //Add meal cost to rate
                            $this->request->data['Attendee']['calculated_rate'] = $this->request->data['Attendee']['calculated_rate'] + $rates['meal']['cost'] * count(array_filter($this->request->data['Attendee']['pt_meals']));
                        } elseif ($this->request->data['Attendee']['reg_type'] == 'ft_nolodging') {
                            $this->request->data['Attendee']['calculated_rate'] = $rates['ft_nolodging']['cost'] + $rates['ft_nolodging']['latefee_applies'] * $rates['late_fee']['cost'];
                            $finance_comment = 'No lodging:';
                        } else {
                            $this->request->data['Attendee']['calculated_rate'] = $rates['ft']['cost'] + $rates['ft']['latefee_applies'] * $rates['late_fee']['cost'];
                        }
                        
                        //Use calculated rate if no rate exception
                        if (empty($this->request->data['Attendee']['rate'])) {
                            $this->request->data['Attendee']['rate'] = $this->request->data['Attendee']['calculated_rate'];
                        }
                        
                        //Add finance entry
                        $this->request->data['AttendeeFinanceAdd'][0] = array(
                            'Finance' => array(
                                'conference_id' => $this->request->data['Attendee']['conference_id'],
                                'receive_date' => $this->request->data['CheckIn']['timestamp']['year'].'-'.$this->request->data['CheckIn']['timestamp']['month'].'-'.$this->request->data['CheckIn']['timestamp']['day'],
                                'locality_id' => $this->request->data['Attendee']['locality_id'],
                                'finance_type_id' => 3,
                                'count' => 1,
                                'rate' => $this->request->data['Attendee']['rate'],
                                'charge' => '',
                                'payment' => $this->request->data['Attendee']['paid_at_conf'],
                                'balance' => '0.00',
                                'comment' => $finance_comment,
                        ));
                        
                        //Add Onsite Registration entry
                        $this->request->data['OnsiteRegistration'] = array(
                            'conference_id' => $this->request->data['Attendee']['conference_id'],
                            'registration' => $this->request->data['CheckIn']['timestamp']
                        );
                        
                        //Add PartTimeRegistration entry as needed
                        if ($this->request->data['Attendee']['reg_type'] == 'pt') {
                            $this->request->data['PartTimeRegistration']['conference_id'] = $this->request->data['Attendee']['conference_id'];
                            $pt_entries = array_merge($this->request->data['Attendee']['pt_meetings'],$this->request->data['Attendee']['pt_meals']);
                            foreach ($pt_entries as $pt_entry):
                                $this->request->data['PartTimeRegistration'][$pt_entry] = 1;
                            endforeach;
                        }
                            
                        if ($this->Attendee->saveAssociated($this->request->data,array('validate' => false,'deep' => true))) {
                                $this->Session->setFlash(__('The attendee has been saved'),'success');
                                $this->redirect(array('action' => 'add'));
                        } else {
				$this->Session->setFlash(__('The attendee could not be saved. Please, try again.'),'failure');
			}
                    }
		}
                $this->Attendee->validate = '';
                $conferences = $this->Attendee->Conference->find('list',array('conditions' => array('Conference.id' => $this->Attendee->Conference->current_conference())));
                $localities = $this->Attendee->Locality->find('list');
		//$campuses = $this->Attendee->Campus->find('list');
		$statuses = $this->Attendee->Status->find('list', array(/**'conditions' => array('Status.id >' => 1),**/ 'order' => 'Status.id'));
		$lodgings = $this->Attendee->Lodging->find('list');
		//$creators = $this->Attendee->Creator->find('list');
		//$modifiers = $this->Attendee->Modifier->find('list');
                
		$this->set(compact('conferences', 'localities', 'statuses', 'lodgings'));
	}

/**
 * requirementCheck method
 *
 * @return true
 */

        function _requirementCheck($attendee) {
            if(strlen($attendee['Attendee']['gender']) === 0) {$requirement_messages[] = array('Please indicate your gender.','error');}
            if(strlen($attendee['Attendee']['email']) === 0) {$requirement_messages[] = array('Please enter your email address.','error');}
            if(strlen($attendee['Attendee']['status_id']) === 0) {$requirement_messages[] = array('Please indicate your current status.','error');}
            if(strlen($attendee['Attendee']['campus_id']) === 0 && in_array($attendee['Attendee']['status_id'],array(2,3,4,5))) {$requirement_messages[] = array('Please indicate which college campus you are on.','error');}
            if(strlen($attendee['Attendee']['locality_id']) === 0) {$requirement_messages[] = array('Please enter your locality. For help on this, please ask a serving one. If your locality is not listed, select "Other."','error');}
            if(strlen($attendee['Attendee']['reg_type']) === 0) {$requirement_messages[] = array('Please select a registration type','error');}
            if($attendee['Attendee']['reg_type'] === 'pt' && count(array_filter($attendee['Attendee']['pt_meetings'])) === 0) {$requirement_messages[] = array('Please indicate which meetings you plan on attending.','error');}
            
            //check for error messages and display them while sending them back to the form
            if(empty($requirement_messages)) return true;
            else {
                foreach ($requirement_messages as $requirement_message):
                    $this->_flash(__($requirement_message[0],true),$requirement_message[1]);
                endforeach;
                $this->Session->write('Attendee.selfadd',$attendee);
                $this->redirect(array('action' => 'selfadd'));
            }
        }

/**
 * selfadd method
 *

 * @return void
 */
	public function selfadd() {
		if ($this->request->is('post')) {
                        //Process Cancel button
                        if(isset($this->request->data['cancel'])) $this->redirect(array('controller' => 'pages','action' => 'display','registration'));
                        
                        $this->Attendee->create();
                        
                        //data validation
                        if(strlen($this->request->data['Attendee']['first_name']) === 0 || strlen($this->request->data['Attendee']['last_name']) === 0) {$requirement_messages[] = array('Please enter your complete first and last name.','error');}
                        if(strlen($this->request->data['Attendee']['cell_phone']) === 0) {$requirement_messages[] = array('We need your cell phone number in case of an emergency.','error');}
                        //if(strlen($this->request->data['Attendee']['last_name']) === 0) {$requirement_messages[] = array('Please enter your last name.','error');}
                        if(!empty($requirement_messages)) {
                            foreach ($requirement_messages as $requirement_message):
                                $this->_flash(__($requirement_message[0],true),$requirement_message[1]);
                            endforeach;
                            $this->Session->write('Attendee.selfadd',$this->request->data);
                            $this->redirect(array('action' => 'selfadd'));
                        }
                        
                        $this->request->data['Attendee']['first_name'] = ucwords($this->request->data['Attendee']['first_name']);
                        $this->request->data['Attendee']['last_name'] = ucwords($this->request->data['Attendee']['last_name']);
                       
                        //Check if user is already registered
                        $match_name = $this->Attendee->find('all',array('conditions' => array('Attendee.first_name' => $this->request->data['Attendee']['first_name'],'Attendee.last_name' => $this->request->data['Attendee']['last_name']),'recursive' => -1));
                        $match_cell = $this->Attendee->find('all',array('conditions' => array('Attendee.cell_phone' => $this->request->data['Attendee']['cell_phone']),'recursive' => -1));
                        $match_attendees = array_unique(array_merge($match_name, $match_cell),SORT_REGULAR);
                        if(!empty($match_attendees) && $this->Session->read('Attendee.matches') !== false) {
                            foreach ($match_attendees as &$match_attendee):
                                $match_attendee['Attendee']['cell_phone'] = 'xxx-xxx-'.substr($match_attendee['Attendee']['cell_phone'],8,4);
                                $match_attendee['Attendee']['email'] = substr($match_attendee['Attendee']['email'],0,4).'...'.strstr($match_attendee['Attendee']['email'],'@');
                            endforeach;
                            $this->Session->write('Attendee.matches',$match_attendees);
                            $this->Session->write('Attendee.selfadd',$this->request->data);
                            $this->redirect(array('action' => 'verify'));
                        }
                        
                        //continue validation checking
                        $this->_requirementCheck($this->request->data);
                       
                        $this->Session->write('Attendee.selfadd',$this->request->data);
                        
                        //Change names to upper case
                        //$this->request->data['Attendee']['replaced_first'] = ucwords($this->request->data['Attendee']['replaced_first']);
                        //$this->request->data['Attendee']['replaced_last'] = ucwords($this->request->data['Attendee']['replaced_last']);
                        
                        //save attendee
                        if ($this->Attendee->save($this->request->data)) {
                            //Save Onsite Registration entry
                            $onsite = array(
                                'attendee_id' => $this->Attendee->id,
                                'conference_id' => $this->request->data['Attendee']['conference_id'],
                                'registration' => null,);
                            $this->Attendee->OnsiteRegistration->create($onsite);
                            $this->Attendee->OnsiteRegistration->save($onsite);
                            //$this->Session->setFlash(__('Thank you for registering. Your total cost is.'),'success');
                            $this->redirect(array('action' => 'verify', $this->Attendee->id));
			} else {
                            $this->Session->setFlash(__('Your information could not be saved. Please contact a serving one.'),'failure');
			}
		}
                $conferences = $this->Attendee->Conference->find('list',array('conditions' => array('Conference.id' => $this->Attendee->Conference->current_conference())));
                $localities = $this->Attendee->Locality->find('list', array('conditions' => array('Locality.id >' => '3'/**,'Locality.id NOT' => '44'**/),'fields' => 'Locality.name'));
                //$campuses = $this->Attendee->Campus->find('list');
		$statuses = $this->Attendee->Status->find('list', array(/**'conditions' => array('Status.id >' => 1), **/'order' => 'Status.id'));
		$this->set(compact('conferences', 'localities', 'statuses'));
                
                if($this->Session->read('Attendee.selfadd') && $this->referer() == Router::url(array('controller' => 'attendees', 'action' => 'verify'))) {
                    $this->request->data = $this->Session->read('Attendee.selfadd');
                    $this->Session->delete('Attendee.selfadd');
                } elseif($this->Session->read('Attendee.selfadd')) {
                    $this->Session->delete('Attendee.selfadd');
                }
	}

/**
 * verify method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function verify($id = null) {
                //debug($id);
                if($id) {
                    $this->Attendee->id = $id;
                    if (!$this->Attendee->exists()) {
                        throw new NotFoundException(__('Invalid attendee. Please contact a serving one.'));
                    }
                    $attendee = $this->Attendee->read(null, $id);
                }
                $confirm = null;
                if ($this->request->is('post') || $this->request->is('put')) {
                    switch($this->request->data['Submit']) {
                        case ('Yes. Edit my information.'):
                            //Case when attendee confirms match to existing attendee.
                            $this->Session->delete('Attendee.selfadd');
                            $this->Session->delete('Attendee.matches');
                            $attendee = $this->Attendee->read(null,$this->request->data['Attendee']['Match']);
                            if(in_array($attendee['Attendee']['part_time_registration_count'],array(null,0))) {
                                $this->Session->setFlash(__('You are registered full time and cannot change any information on this site. Please contact a serving one to change any information or to check in.'),'warning');
                                $this->redirect(array('controller' => 'pages','action' => 'display','registration'));
                            } else {
                                $this->redirect(array('action' => 'selfedit',$this->request->data['Attendee']['Match']));
                                $this->Session->setFlash(__('We are not set up yet to modify existing registrations. Please see a serving one to change your registration. Sorry for the inconvenience.'),'warning');
                                $this->redirect(array('controller' => 'pages','action' => 'display','registration'));
                            }
                            break;
                        case ('No. Register as new attendee.'):
                            //Case when attendee confirms no match to existing attendee.
                            $this->Session->delete('Attendee.matches');
                            if($this->_requirementCheck($this->Session->read('Attendee.selfadd'))) {
                                $this->Attendee->create($this->Session->read('Attendee.selfadd'));
                                if ($this->Attendee->save($this->Session->read('Attendee.selfadd'))) {
                                    //Save Onsite Registration entry
                                    $onsite = array(
                                        'attendee_id' => $this->Attendee->id,
                                        'conference_id' => $this->Session->read('Attendee.selfadd.conference_id'),
                                        'registration' => null,);
                                    $this->Attendee->OnsiteRegistration->create($onsite);
                                    $this->Attendee->OnsiteRegistration->save($onsite);
                                    //$this->Session->delete('Attendee.selfadd');
                                    $this->redirect(array('action' => 'verify',$this->Attendee->id));
                                } else {
                                    $this->Session->setFlash(__('Your information could not be saved. Please contact a serving one'),'failure');
                                    $this->redirect(array('action' => 'selfadd'));
                                }
                            }
                            break;
                        case ('Confirm'):
                            //Case when new attendee confirms entered information and price.
                            $attendee['Attendee']['reg_type'] = $this->Session->read('Attendee.selfadd.Attendee.reg_type');
                            $attendee['Attendee']['pt_meetings'] = $this->Session->read('Attendee.selfadd.Attendee.pt_meetings');
                            $attendee['Attendee']['pt_meals'] = $this->Session->read('Attendee.selfadd.Attendee.pt_meals');
                            $attendee['Attendee']['pt_misc'] = $this->Session->read('Attendee.selfadd.Attendee.pt_misc');
                            
                            $conference_info = $this->Attendee->Conference->conference_info();
                            $rate_structure = $this->Attendee->Conference->ConferenceLocation->Rate->find('all',array('conditions' => array('Rate.conference_location_id' => $conference_info['location']),'recursive' => -1));
                            foreach($rate_structure as $structure):
                                $rates[$structure['Rate']['rate_type_id']] = array(
                                    'cost' => $structure['Rate']['cost'],
                                    'late_fee' => $structure['Rate']['latefee_applies'],
                                );
                            endforeach;
                            
                            $onsite = array('registration' => date('Y-m-d h:i:s'));
                            $table = 'Cashier';
                            $part_time_mtgs = array(
                                'fri' => 'fri_mtg',
                                'satm' => 'sat_mtg1',
                                'sata' => 'sat_mtg2',
                                'satn' => 'sat_mtg3',
                                'ld' => 'ld_mtg');
                            $part_time_meals = array(
                                'fri' => 'fri_din',
                                'satl' => 'sat_lun',
                                'satd' => 'sat_din',
                                'ld' => 'ld_lun');
                            
                            //set registering attendee's rate
                            switch($attendee['Attendee']['reg_type']) {
                                case ('ft_lodging'):
                                    $onsite = array_merge($onsite,array('need_hospitality' => '1'));
                                case ('ft_nolodging'):
                                    $cost = $rates[1]['cost'] + $rates[8]['cost']*$rates[1]['late_fee'];
                                    $onsite = array_merge($onsite,array('need_badge' => '1'));
                                    $table = 'Badge';
                                    break;
                                /**case ('sat_only'):
                                    $cost = $rates[7];
                                    $this->Attendee->set(array('pt' => '1'));
                                    break;**/
                                case ('pt'):
                                    $charged_meetings = array_diff($attendee['Attendee']['pt_meetings'],array('sata'));
                                    switch(count($charged_meetings)) {
                                        case ('4'):
                                            $cost = '75';
                                            $onsite = array_merge($onsite,array('need_badge' => '1'));
                                            $table = 'Badge';
                                            break;
                                        case ('3'):
                                            $cost = '65';
                                            $part_time = 1;
                                            break;
                                        case ('2'):
                                        case ('1'):
                                            //$this->Attendee->set(array('PT' => '1'));
                                            $cost = $rates[9]['cost']*count(array_filter($attendee['Attendee']['pt_meals'])) + $rates[10]['cost']*count(array_filter($attendee['Attendee']['pt_misc']));
                                            $part_time = 1;
                                            break;
                                        }
                                    break;
                            }
                            if($cost > 0) {
                                $onsite = array_merge($onsite,array('need_cashier' => 1));
                                $this->Attendee->Locality->Finance->create($finance = array(
                                    'conference_id' => $attendee['Attendee']['conference_id'],
                                    'receive_date' => date('Y-m-d',strtotime('now')),
                                    'locality_id' => $attendee['Attendee']['locality_id'],
                                    'finance_type_id' => 3,
                                    'count' => '1',
                                    'rate' => $cost,
                                    'charge' => null,
                                    'payment' => null,
                                    'balance' => null,
                                    'comment' => null,
                                ));
                                $this->Attendee->Locality->Finance->save($finance);
                                $this->Attendee->AttendeeFinanceAdd->create($attendeefinance = array(
                                    'add_attendee_id' => $attendee['Attendee']['id'],
                                    'finance_id' => $this->Attendee->Locality->Finance->id,
                                ));
                                $this->Attendee->AttendeeFinanceAdd->save($attendeefinance);
                            } else $table = '0';
                            if($part_time === 1) {
                                $part_time = array(
                                    'conference_id' => $attendee['Attendee']['conference_id'],
                                    'attendee_id' => $attendee['Attendee']['id'],
                                );
                                foreach($attendee['Attendee']['pt_meetings'] as $pt_meeting):
                                    $part_time = array_merge($part_time,array($part_time_mtgs[$pt_meeting] => 1));
                                endforeach;
                                foreach($attendee['Attendee']['pt_meals'] as $pt_meal):
                                    $part_time = array_merge($part_time,array($part_time_meals[$pt_meal] => 1));
                                endforeach;
                                if($attendee['PartTimeRegistration']['id'] == null) {
                                    $this->Attendee->PartTimeRegistration->create($part_time);
                                    $this->Attendee->PartTimeRegistration->save($part_time);
                                } else {
                                    foreach($attendee['PartTimeRegistrations'] as $ptreg):
                                    endforeach;
                                }
                            }
                            $this->Attendee->set(array('rate' => $cost));
                            $onsite_id = $this->Attendee->OnsiteRegistration->find('list',array('conditions' => array('OnsiteRegistration.attendee_id' => $attendee['Attendee']['id'])));
                            $this->Attendee->OnsiteRegistration->id = $onsite_id;
                            $this->Attendee->OnsiteRegistration->save($onsite,array('validate' => false));
                            $this->Attendee->CheckIn->create($CheckIn = array(
                                'attendee_id' => $attendee['Attendee']['id'],
                                'timestamp' => ''
                            ));
                            $this->Attendee->CheckIn->save($CheckIn);
                            $confirm = array('cost' => $cost-$attendee['Attendee']['paid_at_conf'],'table' => $table);
                            $this->Attendee->save();
                            $this->Session->delete('Attendee.selfadd');
                            continue;
                            break;
                        case ('Edit my information.'):
                            //Case when new attendee needs to edit entered information.
                            $this->redirect(array('action' => 'selfedit',$id));
                            $this->Session->setFlash(__('We are not set up yet to modify existing registrations. Please see a serving one to change your registration. Sorry for the inconvenience.'),'warning');
                            $this->redirect(array('controller' => 'pages','action' => 'display','registration'));
                            break;
                        case ('OK'):
                            $this->Session->delete('Attendee');
                            $this->redirect(array('controller' => 'pages','action' => 'display','registration'));
                            break;
                    }
                } elseif ($id){
                    $types = array(
                        'ft_lodging' => 'Full time with lodging',
                        'ft_nolodging' => 'Full time without lodging',
                        'ft' => 'Full time',
                        'sat_only' => 'Saturday only',
                        'pt' => 'Part time');
                    $meetings = array(
                        'fri' => 'Friday night',
                        'satm' => 'Saturday morning',
                        'sata' => 'Saturday afternoon',
                        'satn' => 'Saturday night',
                        'ld' => 'Sunday morning');
                    $meals = array(
                        'fri' => 'Friday dinner',
                        'satl' => 'Saturday lunch',
                        'satd' => 'Saturday dinner',
                        'ld' => 'Sunday lunch',);
                    $reg_type = $this->Session->read('Attendee.selfadd.Attendee.reg_type');
                    $pt_meetings = $this->Session->read('Attendee.selfadd.Attendee.pt_meetings');
                    $pt_meals = $this->Session->read('Attendee.selfadd.Attendee.pt_meals');
                    $pt_misc = $this->Session->read('Attendee.selfadd.Attendee.pt_misc');
                    $attendee['Attendee']['type'] = $types[$reg_type];
                    foreach ($pt_meetings as $pt_meeting):
                        $attendee['Attendee']['meetings'][] = $meetings[$pt_meeting];
                    endforeach;
                    foreach ($pt_meals as $pt_meal):
                        $attendee['Attendee']['meals'][] = $meals[$pt_meal];
                    endforeach;
                    if(!empty($pt_misc)) $attendee['Attendee']['booklet'] = 'Yes';
                    else $attendee['Attendee']['booklet'] = 'No';
                    $attendee['Attendee']['meetings'] = implode(', ',$attendee['Attendee']['meetings']);
                    $attendee['Attendee']['meals'] = implode(', ',$attendee['Attendee']['meals']);
                    if($attendee['Attendee']['gender'] === 'B') $attendee['Attendee']['gender'] = 'Male';
                    elseif($attendee['Attendee']['gender'] === 'S') $attendee['Attendee']['gender'] = 'Female';
                    $this->set(compact('attendee'));
                } else {
                    $matches = $this->Session->read('Attendee.matches');
                    $options = array();
                    foreach ($matches as $match):
                        $options = array_merge($options,array($match['Attendee']['id'] => $match['Attendee']['first_name'].' '.$match['Attendee']['last_name'].'&nbsp;&nbsp;&nbsp;&nbsp;'.$match['Attendee']['cell_phone'].'&nbsp;&nbsp;&nbsp;&nbsp;'.$match['Attendee']['email'].'<br>'));
                        //debug(array($match['Attendee']['id'] => $match['Attendee']['first_name'].' '.$match['Attendee']['last_name'].'&nbsp;&nbsp;&nbsp;&nbsp;'.$match['Attendee']['cell_phone'].'&nbsp;&nbsp;&nbsp;&nbsp;'.$match['Attendee']['email']));
                    endforeach;
                    //debug($options);
                    //exit;
                    $this->set(compact('options'));
                }
                if ($confirm) {
                    $this->set(compact('confirm'));
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
		if (!$this->Attendee->exists($id)) {
			throw new NotFoundException(__('Invalid attendee'));
		}

                if ($this->request->is('post') || $this->request->is('put')) {
                        //changes first and last names to correct case
                        $this->request->data['Attendee']['first_name'] = ucwords($this->request->data['Attendee']['first_name']);
                        $this->request->data['Attendee']['last_name'] = ucwords($this->request->data['Attendee']['last_name']);
                        
                        //Get related attendee information
                        $created = $this->Attendee->field('created',array('Attendee.id' => $this->request->data['Attendee']['id']));
                        $this->request->data['Attendee']['locality_id'] = $this->Attendee->field('locality_id',array('Attendee.id' => $this->request->data['Attendee']['id']));
			
                        if ($this->Attendee->save($this->request->data,array('validate' => false))) {
                                $this->Session->setFlash(__('The attendee has been saved. Finances, etc, were not automatically updated. Please update those manually below as necessary.'),'success');
                                $this->redirect(array('action' => 'view',$this->request->data['Attendee']['id']));
			} else {
				$this->Session->setFlash(__('The attendee could not be saved. Please, try again.'),'failure');
			}
		} else {
			$options = array('conditions' => array('Attendee.' . $this->Attendee->primaryKey => $id));
			$this->request->data = $this->Attendee->find('first', $options);
                        
                        //Determine if nurse box needs to be checked
                        if (strpos($this->request->data['Attendee']['comment'],'Nurse') !== false) {
                            $this->request->data['Attendee']['nurse'] = 1;
                       }
		}
                $this->Attendee->validate = '';
                $conferences = $this->Attendee->Conference->find('list',array('conditions' => array('Conference.id' => $this->Attendee->Conference->current_conference())));
		$localities = $this->Attendee->Locality->find('list');
		//$campuses = $this->Attendee->Campus->find('list');
		$statuses = $this->Attendee->Status->find('list', array('conditions' => array('Status.id >' => 1), 'order' => 'Status.id'));
		$lodgings = $this->Attendee->Lodging->find('list');
		$this->set(compact('conferences', 'localities', 'statuses', 'lodgings'));
	}

/**
 * selfedit method
 *

 * @return void
 */
	public function selfedit($id = null) {
                $this->Attendee->id = $id;
                if (!$this->Attendee->exists()) {
			throw new NotFoundException(__('Invalid attendee'));
		}
		if ($this->request->is('post')) {
                        //Process Cancel button
                        if(isset($this->request->data['cancel'])) $this->redirect(array('action' => 'selfadd'));
                        
                        //data validation
                        if(strlen($this->request->data['Attendee']['first_name']) === 0 || strlen($this->request->data['Attendee']['last_name']) === 0) {$requirement_messages[] = array('Please enter your complete first and last name.','error');}
                        if(strlen($this->request->data['Attendee']['cell_phone']) === 0) {$requirement_messages[] = array('We need your cell phone number in case of an emergency.','error');}
                        //if(strlen($this->request->data['Attendee']['last_name']) === 0) {$requirement_messages[] = array('Please enter your last name.','error');}
                        if(empty($requirement_messages) && $attendee['OnsiteRegistration']['registration'] === 0) {
                            $this->request->data['Attendee']['first_name'] = ucwords($this->request->data['Attendee']['first_name']);
                            $this->request->data['Attendee']['last_name'] = ucwords($this->request->data['Attendee']['last_name']);
                            //Check if user is already registered
                            $match_name = $this->Attendee->find('all',array('conditions' => array('Attendee.first_name' => $this->request->data['Attendee']['first_name'],'Attendee.last_name' => $this->request->data['Attendee']['last_name']),'recursive' => -1));
                            $match_cell = $this->Attendee->find('all',array('conditions' => array('Attendee.cell_phone' => $this->request->data['Attendee']['cell_phone']),'recursive' => -1));
                            $match_attendees = array_unique(array_merge($match_name, $match_cell));
                            if(!empty($match_attendees) && $this->Session->read('Attendee.matches') !== false) {
                                foreach ($match_attendees as &$match_attendee):
                                    $match_attendee['Attendee']['cell_phone'] = 'xxx-xxx-'.substr($match_attendee['Attendee']['cell_phone'],8,4);
                                    $match_attendee['Attendee']['email'] = substr($match_attendee['Attendee']['email'],0,4).'...'.strstr($match_attendee['Attendee']['email'],'@');
                                endforeach;
                                $this->Session->write('Attendee.matches',$match_attendees);
                                $this->Session->write('Attendee.selfadd',$this->request->data);
                                //debug($this->Session->read('Attendee.matches'));
                                //exit;
                                //$this->set(compact($match_attendees));
                                $this->redirect(array('action' => 'verify'));
                            }
                            
                            //continue validation checking
                            $this->_requirementCheck($this->request->data);
                        }
                        
                        $this->Session->write('Attendee.selfadd',$this->request->data);
                        
                        //save attendee
                        if ($this->Attendee->save($this->request->data)) {
                            //Save Onsite Registration entry
                            $onsite = array('registration' => 0,);
                            $this->Attendee->OnsiteRegistration->read(null,$attendee['OnsiteRegistration']['id']);
                            $this->Attendee->OnsiteRegistration->set($onsite);
                            $this->Attendee->OnsiteRegistration->save();
                            $this->redirect(array('action' => 'verify', $this->Attendee->id));
			} else {
                            $this->Session->setFlash(__('Your information could not be saved. Please contact a serving one.'),'failure');
			}
		} else {
                    $this->request->data = $this->Attendee->read(null,$id);
                }
                $three_days_ago = date('Y-m-d', strtotime('-4 days'));
                $current_conference = $this->Attendee->Conference->find('list',array('conditions' => array('Conference.start_date < NOW()',"Conference.start_date >= '$three_days_ago'")));
                $localities = $this->Attendee->Locality->find('list', array('conditions' => array('Locality.id >' => '3','Locality.id NOT' => '44'),'fields' => 'Locality.city'));
                //$campuses = $this->Attendee->Campus->find('list');
		$statuses = $this->Attendee->Status->find('list', array(/**'conditions' => array('Status.id >' => 1), **/'order' => 'Status.id'));
		$this->set(compact('current_conference', 'localities', 'statuses'));
                if($this->Session->read('Attendee.selfadd') == !null) $this->request->data = $this->Session->read('Attendee.selfadd');
                $this->Session->delete('Attendee.selfadd');
                
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Attendee->id = $id;
		if (!$this->Attendee->exists()) {
			throw new NotFoundException(__('Invalid attendee'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Attendee->delete()) {
			$this->Session->setFlash(__('Attendee deleted'),'success');
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Attendee was not deleted'),'failure');
		$this->redirect(array('action' => 'index'));
	}

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Attendee->recursive = 0;
		$this->set('attendees', $this->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Attendee->exists($id)) {
			throw new NotFoundException(__('Invalid attendee'));
		}
		$options = array('conditions' => array('Attendee.' . $this->Attendee->primaryKey => $id));
		$this->set('attendee', $this->Attendee->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Attendee->create();
			if ($this->Attendee->save($this->request->data)) {
				$this->Session->setFlash(__('The attendee has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The attendee could not be saved. Please, try again.'));
			}
		}
		$conferences = $this->Attendee->Conference->find('list');
		$localities = $this->Attendee->Locality->find('list');
		$campuses = $this->Attendee->Campus->find('list');
		$statuses = $this->Attendee->Status->find('list');
		$lodgings = $this->Attendee->Lodging->find('list');
		$creators = $this->Attendee->Creator->find('list');
		$modifiers = $this->Attendee->Modifier->find('list');
		$this->set(compact('conferences', 'localities', 'campuses', 'statuses', 'lodgings', 'creators', 'modifiers'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->Attendee->exists($id)) {
			throw new NotFoundException(__('Invalid attendee'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Attendee->save($this->request->data)) {
				$this->Session->setFlash(__('The attendee has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The attendee could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Attendee.' . $this->Attendee->primaryKey => $id));
			$this->request->data = $this->Attendee->find('first', $options);
		}
		$conferences = $this->Attendee->Conference->find('list');
		$localities = $this->Attendee->Locality->find('list');
		$campuses = $this->Attendee->Campus->find('list');
		$statuses = $this->Attendee->Status->find('list');
		$lodgings = $this->Attendee->Lodging->find('list');
		$creators = $this->Attendee->Creator->find('list');
		$modifiers = $this->Attendee->Modifier->find('list');
		$this->set(compact('conferences', 'localities', 'campuses', 'statuses', 'lodgings', 'creators', 'modifiers'));
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->Attendee->id = $id;
		if (!$this->Attendee->exists()) {
			throw new NotFoundException(__('Invalid attendee'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Attendee->delete()) {
			$this->Session->setFlash(__('Attendee deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Attendee was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
        
/**
 * autocomplete method
 */
        public function autocomplete() {
            $this->Attendee->Campus->recursive = -1;
            if ($this->request->is('ajax')) {
                $this->redirect(array('controller' => 'attendees', 'action' => 'index'));
                $this->autoRender = false;
                $this->layout = 'ajax';
                debug($_GET['term']);
                debug($this->request);
                //$query = $_GET['term'];
                $query = $this->request->query('term');
                $campuses = $this->Attendee->Campus->find('all', array(
                    'fields' => array('Campus.name','Campus.code'),
                    //remove the leading '%' if you want to restrict the matches more
                    'conditions' => array(
                        'OR',array(
                            'Campus.name LIKE ' => '%' . $query . '%',
                            'Campus.code LIKE ' => '%' . $query . '%',
                        ),
                        'Campus.name NOT LIKE' => 'Other%',
                )));
                $i = 0;
                foreach($campuses as $campus):
                    $response[$i]['id'] = $campus['Campus']['id'];
                    if (notempty($campus['Campus']['code'])) {
                        $response['display'] = $campus['Campus']['name'].' ('.$campus['Campus']['code'].')';
                    } else {
                        $response['display'] = $campus['Campus']['name'];
                    }
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