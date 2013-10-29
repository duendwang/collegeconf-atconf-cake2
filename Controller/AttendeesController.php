<?php
App::uses('AppController', 'Controller');
/**
 * Attendees Controller
 *
 * @property Attendee $Attendee
 */
class AttendeesController extends AppController {

        public $helpers = array('Js' => array('Jquery'));
        
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
		$this->Attendee->recursive = 0;
		$this->paginate = array(
                    'conditions' => $this->Attendee->parseCriteria($this->passedArgs),
                    //'conditions' => array('Attendee.conference_id' => $this->Session->read('Conference.selected'),'Attendee.cancel_count' => 0),
                    'contain' => $this->Attendee->contain,
                    'recursive' => 0,
                    'limit' => 1500
                );
		$this->set('attendees', $this->paginate());
	}

/**
 * summary method
 *
 * @return void
 */
	public function summary($locality = null) {
                $this->Attendee->recursive = 2;
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
                
                $summaries = $this->Attendee->find('all',array('fields' => array('Attendee.locality_id','COUNT(last_name) as count','SUM(rate) as total_charge'),'order' => array('Attendee.locality_id' => 'asc'),'group' => 'Attendee.locality_id'));
                
                $conference_dates = $this->Attendee->Conference->conference_dates($this->Session->read('Conference.selected'));
                
                if($this->Auth->user('UserType.account_type_id') == 4) {
                    $this->paginate = array( 
                        'conditions' => array('Attendee.conference_id' => $this->Session->read('Conference.selected'),'Attendee.locality_id ' => $this->Auth->user('locality_id'), 'OR' => array('Attendee.cancel_count' => 0, 'Cancel.created >' => date('Y-m-d',strtotime($conference_dates['first_deadline'])))),
                        'contain' => $contain,
                        'limit' => 200,
                        );
		} else {
                    $locality_ids = $this->Attendee->Locality->RegistrationStep->find('list',array('conditions' => array('RegistrationStep.conference_id' => $this->Session->read('Conference.selected'),'RegistrationStep.user_id =' => $this->Auth->user('id')),'fields' => 'RegistrationStep.locality_id'));
                    $this->set('localities',$this->Attendee->Locality->find('all',array('conditions' => array('Locality.id' => $locality_ids),'recursive' => 0,'order' => 'Locality.name')));
                    if(isset($locality)) {
                        $this->paginate = array(
                            'conditions' => array('Attendee.conference_id' => $this->Session->read('Conference.selected'),'Attendee.locality_id =' => $locality, 'OR' => array('Attendee.cancel_count' => 0, 'Cancel.created >' => date('Y-m-d',strtotime($conference_dates['first_deadline'])))),
                            'contain' => $contain,
                            'limit' => 100,
                            );
                    } else {
                        $this->paginate = array(
                            'conditions' => array('Attendee.conference_id' => $this->Session->read('Conference.selected'),'Attendee.locality_id ' => $locality_ids, 'OR' => array('Attendee.cancel_count' => 0, 'Cancel.created >' => date('Y-m-d',strtotime($conference_dates['first_deadline'])))),
                            'contain' => $contain,
                            'limit' => 200,
                            );
                    }
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
                $this->set(compact('attendees'));
	}

/**
 * cc_report method
 *
 * @param string $id
 * @return void
 */
	
	public function cc_report() {
                $this->Attendee->recursive = 0;
		$this->paginate = array('conditions' => array('Attendee.conf_contact' => 1),'order' => array('Locality.city' => 'asc','Attendee.gender' => 'asc'),'limit' => 100,'recursive' => 1);
		//debug($this->Attendee->find('all',array('conditions' => array('Attendee.conf_contact' => 1),'recursive' => 1)));
                /**$cc_entries = $this->Attendee->query("SELECT city,
			first_name AS 'first name',
			last_name AS 'last name',
			gender AS gender,
			cell_phone AS 'cell phone',
			check_in_id AS 'check in id'
			FROM attendees as Attendee
			INNER JOIN localities as Locality
			ON Attendee.locality_id=Locality.id
			WHERE conf_contact = 1
			ORDER BY city ASC, gender ASC");**/
		
		//print_r($cc_entries);
		
		//$this->set('cc_entries', $cc_entries);
		$this->set('confcontacts',$this->paginate());
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
		$options = array('conditions' => array('Attendee.' . $this->Attendee->primaryKey => $id));
		$this->set('attendee', $this->Attendee->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Attendee->create();
			if ($this->Attendee->save($this->request->data)) {
                                $this->Attendee->CheckIn->create($CheckIn = array(
                                    'attendee_id' => $this->Attendee->id,
                                    'timestamp' => ''
                                ));
                                $this->Attendee->CheckIn->save($CheckIn);
				$this->Session->setFlash(__('The attendee has been saved'),'success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The attendee could not be saved. Please, try again.'),'failure');
			}
		}
                $three_days_ago = date('Y-m-d', strtotime('-3 days'));
                $one_day_later = date('Y-m-d', strtotime('+1 day'));
                $current_conference = $this->Attendee->Conference->find('list',array('conditions' => array("Conference.start_date <= '$one_day_later'","Conference.start_date >= '$three_days_ago'")));
                $localities = $this->Attendee->Locality->find('list', array('fields' => 'Locality.city'));
                $campuses = $this->Attendee->Campus->find('list');
		$statuses = $this->Attendee->Status->find('list', array('conditions' => array('Status.id >' => 1), 'order' => 'Status.id'));
		$lodgings = $this->Attendee->Lodging->find('list', array('conditions' => array('Lodging.conference_id' => $current_conference),'fields' => array('Lodging.fullname'),'recursive' => 0));
                //debug($lodgings);
                //exit;
		$this->set(compact('current_conference', 'localities', 'campuses', 'statuses', 'lodgings'));
	}

/**
 * add method
 *
 * @return void
 */
	public function add1() {
		if ($this->request->is('post')) {
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
                        
                        //Sets rate based on save time related to the two registration deadlines
                        //TODO Consider linking rates to Conference deadlines.
                        $conference_dates = $this->Attendee->Conference->conference_dates($this->request->data['Attendee']['conference_id']);
                        
                        //Get rate structure
                        $conference = $this->Attendee->Conference->find('all',array('conditions' => array('Conference.id' => $this->request->data['Attendee']['conference_id']),'recursive' => -1));
                        $conference_location = $conference[0]['Conference']['conference_location_id'];
                        $rates = $this->Attendee->Conference->ConferenceLocation->Rate->conference_rates($conference_location);
                        
                        //Determine if registration is submitted after first deadline.
                        if (strtotime('now') > $conference_dates['first_deadline']) {
                            $late_reg = 1;
                            $finance_type = 2;
                        } else {
                            $late_reg = 0;
                            $finance_type = 1;
                        }
                        
                        $finance_comment = '';
                        
                        if($this->Auth->user('UserType.account_type_id') == 4 && strtotime('now') > $conference_dates['second_deadline']) {
                            $this->Session->setFlash(__('Registration has been closed. All registrants at this point must register at the conference.'),'failure');
                            //TODO Add an independent method (maybe in beforeSave) to check for this instead of in each method.
                            //TODO Do the check not when saving, but when opening the form.
                            $this->redirect(array('action' => 'index'));
                        } elseif ($this->request->data['Attendee']['locality_id'] <= 3) {
                            $this->request->data['Attendee']['rate'] = $rates['serving']['cost'] + $late_reg * $rates['serving']['latefee_applies'] * $rates['late_fee']['cost'];
                            $registration_type = 'Serving';
                        } elseif ($this->request->data['Attendee']['nurse'] == 1) {
                            $this->request->data['Attendee']['rate'] = $rates['nurse']['cost'] + $late_reg * $rates['nurse']['latefee_applies'] * $rates['late_fee']['cost'];
                            //Need to add check for FTTA or non-FTTA nurse.
                            $finance_comment = 'Nurse(s)';
                            $registration_type = 'Nurse';
                            if ($this->request->data['Attendee']['comment'] == null) $this->request->data['Attendee']['comment'] = 'Nurse';
                            else $this->request->data['Attendee']['comment'] = 'Nurse; '.$this->request->data['Attendee']['comment'];
                        } elseif ($this->request->data['Attendee']['group'] == 'OWN') {
                            $this->request->data['Attendee']['rate'] = $rates['ft_nolodging']['cost'] + $late_reg * $rates['ft_nolodging']['latefee_applies'] * $rates['late_fee']['cost'];
                            $finance_comment = 'No lodging:';
                            $registration_type = 'FT_nolodging';
                        } else {
                            $this->request->data['Attendee']['rate'] = $rates['ft']['cost'] + $late_reg * $rates['ft']['latefee_applies'] * $rates['late_fee']['cost'];
                            $registration_type = 'FT_lodging';
                        }
                        
                        //If after first deadline, check for potential matching cancels for replacements
                        if ($finance_type == 2) {
                            $this->Attendee->AttendeeFinanceCancel->unbindModel(array(
                                'belongsTo' => array('AddAttendee')
                            ));
                            $cancellations = $this->Attendee->AttendeeFinanceCancel->find('all',array(
                                'conditions' => array(
                                    'AttendeeFinanceCancel.add_attendee_id' => null,
                                    'AttendeeFinanceCancel.cancel_attendee_id NOT' => null,
                                    'Finance.conference_id' => $this->request->data['Attendee']['conference_id'],
                                    'Finance.locality_id' => $this->request->data['Attendee']['locality_id'],
                                    'Finance.finance_type_id' => 4
                                    //'Cancel.created >' => date('Y-m-d',$conference_dates['first_deadline']),
                                ),
                                'contain' => array(
                                    'CancelAttendee' => array(
                                        'fields' => array(
                                            'CancelAttendee.id',
                                            'CancelAttendee.locality_id',
                                            'CancelAttendee.status_id',
                                            'CancelAttendee.group',
                                            'CancelAttendee.comment',
                                            'CancelAttendee.rate'
                                        ),
                                        'Cancel'
                                    ),
                                    'Finance' => array(
                                        'fields' => array(
                                            'Finance.id',
                                            'Finance.finance_type_id',
                                            'Finance.comment'
                                        ),
                                    )
                                ),
                            ));
                            
                            foreach ($cancellations as $cancellation):
                                //Determine registration type of each unreplaced cancellation after first deadline
                                if ($cancellation['CancelAttendee']['locality_id'] <= 3) {
                                    $cancellation_reg_type = 'Serving';
                                } elseif (strpos($cancellation['CancelAttendee']['comment'],'Nurse') !== false) {
                                    if ($cancellation['CancelAttendee']['status_id'] == 6) {
                                        //Need to change when we distinguish between FTTA nurse and regular nurse
                                        $cancellation_reg_type = 'Nurse';
                                    } else {
                                        $cancellation_reg_type = 'Nurse';
                                    }
                                } elseif ($cancellation['CancelAttendee']['group'] == 'OWN') {
                                    $cancellation_reg_type = 'FT_nolodging';
                                } else {
                                    $cancellation_reg_type = 'FT_lodging';
                                }
                                
                                //If current unreplaced canceled attendee registration type matches late add attendee, stop checking rest of cancellations and get current canceled attendee ID
                                if ($cancellation_reg_type == $registration_type && ($this->request->data['Attendee']['rate'] == $cancellation['CancelAttendee']['rate'] || $this->request->data['Attendee']['rate'] == $cancellation['CancelAttendee']['rate'] + 10)) {
                                    $matched_replacement = $cancellation;
                                    break;
                                }
                            endforeach;
                        }
                        
                        //Check for matched replacement
                        if (isset($matched_replacement)) {
                            //Adjust added attendee's rate
                            $this->request->data['Attendee']['rate'] = $matched_replacement['CancelAttendee']['rate'];
                            
                            //Create replacement finance and modify original cancel AttendeeFinance to reflect replacement
                            $this->request->data['AttendeeFinanceAdd'][0] = array(
                                'id' => $matched_replacement['AttendeeFinanceCancel']['id'],
                                'Finance' => array(
                                    'conference_id' => $this->request->data['Attendee']['conference_id'],
                                    'receive_date' => date('Y-m-d',strtotime('now')),
                                    'locality_id' => $this->request->data['Attendee']['locality_id'],
                                    'finance_type_id' => 5,
                                    'count' => '0',
                                    'rate' => '0',
                                    'charge' => null,
                                    'payment' => null,
                                    'balance' => null,
                                    'comment' => null,
                                    )
                            );
                        } else {
                            //If there is no matched replacement possible
                            //Check for existing finances entries for same kind of transaction
                            $existing_finances = $this->Attendee->AttendeeFinanceAdd->Finance->find('all',array(
                                'conditions' => array(
                                    'Finance.conference_id' => $this->request->data['Attendee']['conference_id'],
                                    'Finance.locality_id' => $this->request->data['Attendee']['locality_id'],
                                    'Finance.rate' => $this->request->data['Attendee']['rate'],
                                    'Finance.finance_type_id' => $finance_type,
                                    'Finance.comment LIKE' => '%'.$finance_comment.'%',
                                    ),
                                'fields' => array('Finance.id', 'Finance.conference_id', 'Finance.receive_date', 'Finance.locality_id', 'Finance.finance_type_id', 'Finance.count', 'Finance.rate', 'Finance.charge', 'Finance.payment', 'Finance.balance', 'Finance.comment'),
                                'recursive' => -1,
                                ));
                            
                            //If existing finance entry found, update entry with new count.
                            if (count($existing_finances) >= 1) {
                                $this->request->data['AttendeeFinanceAdd'][0] = array(
                                    'finance_id' => $existing_finances[0]['Finance']['id'],
                                    'Finance' => array(
                                        'id' => $existing_finances[0]['Finance']['id'],
                                        'receive_date' => date('Y-m-d',strtotime('now')),
                                        'finance_type_id' => $existing_finances[0]['Finance']['finance_type_id'],
                                        'conference_id' => $existing_finances[0]['Finance']['conference_id'],
                                        'locality_id' => $existing_finances[0]['Finance']['locality_id'],
                                        'count' => $existing_finances[0]['Finance']['count'] + 1,
                                        'rate' => $existing_finances[0]['Finance']['rate'],
                                        'charge' => null,
                                        'payment' => $existing_finances[0]['Finance']['payment'],
                                        'balance' => '0.00',
                                    )
                                );
                            } else {
                                //Otherwise add new finance entry for this transaction
                                $this->request->data['AttendeeFinanceAdd'][0] = array(
                                    'Finance' => array(
                                        'conference_id' => $this->request->data['Attendee']['conference_id'],
                                        'receive_date' => date('Y-m-d',strtotime('now')),
                                        'locality_id' => $this->request->data['Attendee']['locality_id'],
                                        'finance_type_id' => $finance_type,
                                        'count' => 1,
                                        'rate' => $this->request->data['Attendee']['rate'],
                                        'charge' => '',
                                        'payment' => '',
                                        'balance' => '0.00',
                                        'comment' => $finance_comment,
                                ));
                            }
                        }
                        
                        //TODO change to save all 3 models at one time to prevent partial saves
                        if ($this->Attendee->saveAssociated($this->request->data,array('validate' => true,'deep' => true))) {
                                if (isset($matched_replacement)) {
                                    //Decrease count of original cancellation finance
                                    $this->Attendee->AttendeeFinanceCancel->Finance->id = $matched_replacement['Finance']['id'];
                                    $this->Attendee->AttendeeFinanceCancel->Finance->save(array(
                                        'count',$this->Attendee->AttendeeFinanceCancel->Finance->field('count') - 1,
                                        'rate' => $matched_replacement['Finance']['rate'],
                                        'charge' => null,
                                        'payment' => $matched_replacement['Finance']['payment'],
                                        'balance' => null,
                                        ));
                                    
                                    //Modify Cancel record accordingly
                                    $this->Attendee->Cancel->id = $matched_replacement['CancelAttendee']['Cancel']['id'];
                                    $this->Attendee->Cancel->saveField('replaced',$this->request->data['Attendee']['first_name'].' '.$this->request->data['Attendee']['last_name']);                            
                                }
                                
                                $this->Session->setFlash(__('The attendee has been saved'),'success');
                                if (isset($this->request->data['submit'])) {
                                    //$this->Session->delete('Attendee');
                                    if (in_array($this->Auth->user('UserType.account_type_id'),array('2','3'))) {
                                        $this->redirect(array('action' => 'process'));
                                    } else {
                                        $this->redirect(array('action' => 'index'));
                                    }
                                }
                                if (isset($this->request->data['save_add'])) {
                                    $this->Session->write('Attendee.conference_id',$this->request->data['Attendee']['conference_id']);
                                    $this->Session->write('Attendee.gender',$this->request->data['Attendee']['gender']);
                                    $this->Session->write('Attendee.campus_id',$this->request->data['Attendee']['campus_id']);
                                    $this->redirect(array('action' => 'add'));
                                }
			} elseif (empty($this->request->data['Attendee']['conference_id'])) {
				$this->Session->setFlash(__('A conference was not selected. The attendee could not be saved.'),'failure');
                        } else {
				$this->Session->setFlash(__('The attendee could not be saved. Please, try again.'),'failure');
			}
		}
                $conferences = $this->Attendee->Conference->find('list',array('conditions' => array('Conference.id' => $this->Attendee->Conference->current_term_conferences())));
		$locality = $this->Auth->user('locality_id');
                $locality_ids = array_merge(array(1, 2, 3),$this->Attendee->Locality->RegistrationStep->find('list',array('conditions' => array('RegistrationStep.conference_id' => $this->Session->read('Conference.default'),'RegistrationStep.user_id =' => $this->Auth->user('id')),'fields' => 'RegistrationStep.locality_id')));
                if (in_array($this->Auth->user('UserType.account_type_id'),array(2, 3))) {
                    $localities = $this->Attendee->Locality->find('list', array('conditions' => array('Locality.id' => $locality_ids)));
                } elseif ($this->Auth->user('UserType.account_type_id') == 4) {
                    $localities = $this->Attendee->Locality->find('list',array('conditions' => array('Locality.id' => $locality)));
                }
                //$localities = $this->Attendee->Locality->find('list');
		$campuses = $this->Attendee->Campus->find('list');
		$statuses = $this->Attendee->Status->find('list', array('conditions' => array('Status.id >' => 1), 'order' => 'Status.id'));
		//$lodgings = $this->Attendee->Lodging->find('list');
		//$creators = $this->Attendee->Creator->find('list');
		//$modifiers = $this->Attendee->Modifier->find('list');
                $this->set('conference_id',$this->Session->read('Attendee.conference_id'));
                $this->set('gender',$this->Session->read('Attendee.gender'));
                $this->set('campus_id',$this->Session->read('Attendee.campus_id'));

		$this->set(compact('conferences', 'locality', 'localities', 'campuses', 'statuses', 'lodgings', 'creators', 'modifiers'));
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
                                'locality_id' => $this->request->data['Attendee']['locality_id'],
                                'registration' => 0,);
                            $this->Attendee->OnsiteRegistration->create($onsite);
                            $this->Attendee->OnsiteRegistration->save($onsite);
                            //$this->Session->setFlash(__('Thank you for registering. Your total cost is.'),'success');
                            $this->redirect(array('action' => 'verify', $this->Attendee->id));
			} else {
                            $this->Session->setFlash(__('Your information could not be saved. Please contact a serving one.'),'failure');
			}
		}
                $three_days_ago = date('Y-m-d', strtotime('-4 days'));
                $current_conference = $this->Attendee->Conference->find('list',array('conditions' => array('Conference.start_date < NOW()',"Conference.start_date >= '$three_days_ago'")));
                $localities = $this->Attendee->Locality->find('list', array('conditions' => array('Locality.id >' => '3'/**,'Locality.id NOT' => '44'**/),'fields' => 'Locality.city'));
                $campuses = $this->Attendee->Campus->find('list');
		$statuses = $this->Attendee->Status->find('list', array(/**'conditions' => array('Status.id >' => 1), **/'order' => 'Status.id'));
		$this->set(compact('current_conference', 'localities', 'campuses', 'statuses'));
                if($this->Session->read('Attendee.selfadd') == !null) $this->request->data = $this->Session->read('Attendee.selfadd');
                $this->Session->delete('Attendee.selfadd');
                
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
                            if(in_array($attendee['Attendee']['PT'],array(null,0))) {
                                $this->Session->setFlash(__('You are registered full time and cannot change any information on this site. Please contact a serving one to change any information or to check in.'),'warning');
                                $this->redirect(array('controller' => 'pages','action' => 'display','registration'));
                            } else {
                                //$this->redirect(array('action' => 'selfedit',$this->request->data['Attendee']['Match']));
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
                                        'locality_id' => $this->request->data['Attendee']['locality_id'],
                                        'registration' => 0,);
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
                            $this->loadModel('Rate');
                            $rates = $this->Rate->find('list',array('fields' => 'Rate.cost'));
                            $onsite = array('registration' => '1');
                            $table = '3';
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
                                    $cost = $rates[1] + $rates[8];
                                    $onsite = array_merge($onsite,array('need_badge' => '1'));
                                    $table = '4';
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
                                            $table = '4';
                                            break;
                                        case ('3'):
                                            $cost = '65';
                                            $this->Attendee->set(array('PT' => '1'));
                                            $part_time = 1;
                                            break;
                                        case ('2'):
                                        case ('1'):
                                            $this->Attendee->set(array('PT' => '1'));
                                            $cost = $rates[9]*count(array_filter($attendee['Attendee']['pt_meals'])) + $rates[10]*count(array_filter($attendee['Attendee']['pt_misc']));
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
                                    'description' => 'Late registration',
                                    'count' => '1',
                                    'rate' => $cost,
                                    'charge' => null,
                                    'payment' => null,
                                    'balance' => null,
                                    'comment' => $attendee['Attendee']['first_name'].' '.$attendee['Attendee']['last_name']
                                ));
                                $this->Attendee->Locality->Finance->save($finance);
                            } else $table = '0';
                            if($part_time === 1) {
                                $part_time = array('attendee_id' => $attendee['Attendee']['id']);
                                foreach($attendee['Attendee']['pt_meetings'] as $pt_meeting):
                                    $part_time = array_merge($part_time,array($part_time_mtgs[$pt_meeting] => 1));
                                endforeach;
                                foreach($attendee['Attendee']['pt_meals'] as $pt_meal):
                                    $part_time = array_merge($part_time,array($part_time_meals[$pt_meal] => 1));
                                endforeach;
                                if(empty($attendee['PartTimeRegistration'])) {
                                    $this->Attendee->PartTimeRegistration->create($part_time);
                                    $this->Attendee->PartTimeRegistration->save($part_time);
                                } else {
                                    foreach($attendee['PartTimeRegistrations'] as $ptreg):
                                        debug($ptreg);
                                    endforeach;
                                    exit;
                                }
                            }
                            $this->Attendee->set(array('rate' => $cost));
                            $onsite_id = $this->Attendee->OnsiteRegistration->find('list',array('conditions' => array('OnsiteRegistration.attendee_id' => $attendee['Attendee']['id'])));
                            $this->Attendee->OnsiteRegistration->id = $onsite_id;
                            $this->Attendee->OnsiteRegistration->set(array('registration' => 1));
                            $this->Attendee->OnsiteRegistration->save($onsite);
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
                            //$this->redirect(array('action' => 'selfedit',$id));
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
                        //Updates other allergy information to comments
                        if (!empty($this->request->data['Attendee']['other_allergies']) && strpos($this->request->data['Attendee']['comment'],'Other Allergies:') === false) {
                            $this->request->data['Attendee']['comment'] = 'Other Allergies: '.str_replace(';',',',$this->request->data['Attendee']['other_allergies']).'; '.$this->request->data['Attendee']['comment'];
                        }
                        
                        //changes first and last names to correct case
                        $this->request->data['Attendee']['first_name'] = ucwords($this->request->data['Attendee']['first_name']);
                        $this->request->data['Attendee']['last_name'] = ucwords($this->request->data['Attendee']['last_name']);
                        
                        //Changes group field to all caps
                        $this->request->data['Attendee']['group'] = strtoupper($this->request->data['Attendee']['group']);
                        
                        //Get related attendee information
                        $created = $this->Attendee->field('created',array('Attendee.id' => $this->request->data['Attendee']['id']));
                        $this->request->data['Attendee']['locality_id'] = $this->Attendee->field('locality_id',array('Attendee.id' => $this->request->data['Attendee']['id']));
                        
                        //Sets rate based on save time related to the two registration deadlines
                        //TODO Consider linking rates to Conference deadlines.
                        $conference_dates = $this->Attendee->Conference->conference_dates($this->request->data['Attendee']['conference_id']);
                        
                        //Get rate structure
                        $conference = $this->Attendee->Conference->find('all',array('conditions' => array('Conference.id' => $this->request->data['Attendee']['conference_id']),'recursive' => -1));
                        $conference_location = $conference[0]['Conference']['conference_location_id'];
                        $rates = $this->Attendee->Conference->ConferenceLocation->Rate->conference_rates($conference_location);
                        
                        //Determine if initial registration was submitted after first deadline.
                        if (strtotime($created) > $conference_dates['first_deadline']) {
                            $late_reg = 1;
                            $finance_type = 2;
                        } else {
                            $late_reg = 0;
                            $finance_type = 1;
                        }
                        
                        $finance_comment = '';
                        
                        if($this->Auth->user('UserType.account_type_id') == 4 && strtotime('now') > $conference_dates['second_deadline']) {
                            $this->Session->setFlash(__('Registration is now closed. No further changes can be made. For simple attendee information changes, please contact the registration team.'),'failure');
                            //TODO Add an independent method (maybe in beforeSave) to check for this instead of in each method.
                            //TODO Do the check not when saving, but when opening the form.
                            $this->redirect(array('action' => 'index'));
                        } elseif ($this->request->data['Attendee']['locality_id'] <= 3) {
                            $this->request->data['Attendee']['rate'] = $rates['serving']['cost'] + $late_reg * $rates['serving']['latefee_applies'] * $rates['late_fee']['cost'];
                            $new_registration_type = 'Serving';
                        } elseif ($this->request->data['Attendee']['nurse'] == 1) {
                            $this->request->data['Attendee']['rate'] = $rates['nurse']['cost'] + $late_reg * $rates['nurse']['latefee_applies'] * $rates['late_fee']['cost'];
                            $finance_comment = 'Nurse(s)';
                            $new_registration_type = 'Nurse';
                            if ($this->request->data['Attendee']['comment'] == null) $this->request->data['Attendee']['comment'] = 'Nurse';
                            elseif (strpos($this->request->data['Attendee']['comment'],'Nurse') !== false) {}
                            else $this->request->data['Attendee']['comment'] = 'Nurse; '.$this->request->data['Attendee']['comment'];
                        } elseif ($this->request->data['Attendee']['group'] == 'OWN') {
                            $this->request->data['Attendee']['rate'] = $rates['ft_nolodging']['cost'] + $late_reg * $rates['ft_nolodging']['latefee_applies'] * $rates['late_fee']['cost'];
                            $finance_comment = 'No lodging:';
                            $new_registration_type = 'FT_nolodging';
                        } else {
                            $this->request->data['Attendee']['rate'] = $rates['ft']['cost'] + $late_reg * $rates['ft']['latefee_applies'] * $rates['late_fee']['cost'];
                            $new_registration_type = 'FT_lodging';
                        }
                        
                        //Checks the original finance and sees if it needs to be adjusted.
                        $attendee_finance = $this->Attendee->AttendeeFinanceAdd->find('first',array('conditions' => array('AttendeeFinanceAdd.add_attendee_id' => $this->request->data['Attendee']['id']),'recursive' => -1));
                        $this->Attendee->AttendeeFinanceAdd->read(null,$attendee_finance['AttendeeFinanceAdd']['id']);
                        $original_finance = $this->Attendee->AttendeeFinanceAdd->Finance->find('first',array('conditions' => array('Finance.id' => $attendee_finance['AttendeeFinanceAdd']['finance_id']),'recursive' => -1));
                        //TODO account for finances that are replacements and/or rate changes and make rate change finance if pre-registered attendee changes rate after first deadline
                        if ($this->request->data['Attendee']['rate'] !== $original_finance['Finance']['rate']) {
                            $change_finance = 1;
                            
                            //Remove nurse comment from attendee if applicable
                            if (strpos($original_finance['Finance']['comment'],'Nurse') !== false && $new_registration_type !== 'Nurse') {
                                if(strpos($this->request->data['Attendee']['comment'],'Nurse;') !== false) {
                                    $this->request->data['Attendee']['comment'] = str_replace('Nurse;','',$this->request->data['Attendee']['comment']);
                                } elseif ($this->request->data['Attendee']['comment'] == 'Nurse') {
                                    $this->request->data['Attendee']['comment'] = '';
                                } else {
                                    $this->request->data['Attendee']['comment'] = str_replace('Nurse','',$this->request->data['Attendee']['comment']);
                                }
                            }
                            
                            //Check for existing finances entries for same kind of transaction
                            $existing_finances = $this->Attendee->AttendeeFinanceAdd->Finance->find('all',array(
                                'conditions' => array(
                                    'Finance.conference_id' => $this->request->data['Attendee']['conference_id'],
                                    'Finance.locality_id' => $this->request->data['Attendee']['locality_id'],
                                    'Finance.rate' => $this->request->data['Attendee']['rate'],
                                    'Finance.finance_type_id' => $finance_type,
                                    'Finance.comment LIKE' => '%'.$finance_comment.'%',
                                    ),
                                'fields' => array('Finance.id', 'Finance.conference_id', 'Finance.receive_date', 'Finance.locality_id', 'Finance.finance_type_id', 'Finance.count', 'Finance.rate', 'Finance.charge', 'Finance.payment', 'Finance.balance', 'Finance.comment'),
                                'recursive' => -1,
                                ));
                        
                            //If existing finance entry found, update entry with new count.
                            if (count($existing_finances) >= 1) {
                                $this->request->data['AttendeeFinanceAdd'][0] = array(
                                    'finance_id' => $existing_finances[0]['Finance']['id'],
                                    'Finance' => array(
                                        'id' => $existing_finances[0]['Finance']['id'],
                                        'receive_date' => date('Y-m-d',strtotime('now')),
                                        'finance_type_id' => $existing_finances[0]['Finance']['finance_type_id'],
                                        'conference_id' => $existing_finances[0]['Finance']['conference_id'],
                                        'locality_id' => $existing_finances[0]['Finance']['locality_id'],
                                        'count' => $existing_finances[0]['Finance']['count'] + 1,
                                        'rate' => $existing_finances[0]['Finance']['rate'],
                                        'charge' => null,
                                        'payment' => $existing_finances[0]['Finance']['payment'],
                                        'balance' => '0.00',
                                    )
                                );
                            } else {
                                //Otherwise add new finance entry for this transaction
                                $this->request->data['AttendeeFinanceAdd'][0] = array(
                                    'Finance' => array(
                                        'conference_id' => $this->request->data['Attendee']['conference_id'],
                                        'receive_date' => date('Y-m-d',strtotime('now')),
                                        'locality_id' => $this->request->data['Attendee']['locality_id'],
                                        'finance_type_id' => $finance_type,
                                        'count' => 1,
                                        'rate' => $this->request->data['Attendee']['rate'],
                                        'charge' => '',
                                        'payment' => '',
                                        'balance' => '0.00',
                                        'comment' => $finance_comment,
                                ));
                            }
                        }
			
                        if ($this->Attendee->saveAssociated($this->request->data,array('validate' => true,'deep' => true))) {
                                if ($change_finance == 1) {
                                    $this->Attendee->AttendeeFinanceAdd->Finance->id = $original_finance['Finance']['id'];
                                    $this->Attendee->AttendeeFinanceAdd->Finance->save(array(
                                        'count' => $original_finance['Finance']['count'] - 1,
                                        'rate' => $original_finance['Finance']['rate'],
                                        'charge' => null,
                                        'payment' => $original_finance['Finance']['payment'],
                                        'balance' => null,
                                    ));
                                }
                                
				//$this->_flash(__('The attendee has been saved',true),'success');
                                $this->Session->setFlash(__('The attendee has been saved'),'success');
				if (in_array($this->Auth->user('UserType.account_type_id'),array('2','3'))) {
                                //if ($this->UserType->find('list',array('conditions' => array('UserType.user_id =' => $this->Auth->user('id'),'UserType.account_type_id' => array('2','3'))))) {
                                    $this->redirect(array('action' => 'process'));
                                } else $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The attendee could not be saved. Please, try again.'),'failure');
			}
		} else {
			$options = array('conditions' => array('Attendee.' . $this->Attendee->primaryKey => $id));
			$this->request->data = $this->Attendee->find('first', $options);
                        
                        //Move other allergies information to other allergies field
                        if (strpos($this->request->data['Attendee']['comment'],'Other Allergies:') !== false) {
                            $comment = explode(';',$this->request->data['Attendee']['comment']);
                            foreach ($comment as $k => $v):
                                if (strpos($v,'Other Allergies:') !== false) {
                                    $this->request->data['Attendee']['other_allergies'] = trim(str_replace('Other Allergies:','',$v));
                                    unset($comment[$k]);
                                    break;
                                } //elseif (strpos($v,'Nurse') !== false) {
                                    //unset($comment[$k]);
                                //}
                            endforeach;
                            $this->request->data['Attendee']['comment'] = trim(implode(';',$comment));
                        }
                        
                        //Determine if nurse box needs to be checked
                        if (strpos($this->request->data['Attendee']['comment'],'Nurse') !== false) {
                            $this->request->data['Attendee']['nurse'] = 1;
                       }
		}
                $conferences = $this->Attendee->Conference->find('list',array('conditions' => array('Conference.id' => $this->Attendee->Conference->current_term_conferences())));
		$this->set('locality', $this->Auth->user('Locality.id'));
		$localities = $this->Attendee->Locality->find('list');
		$campuses = $this->Attendee->Campus->find('list');
		$statuses = $this->Attendee->Status->find('list', array('conditions' => array('Status.id >' => 1), 'order' => 'Status.id'));
		$lodgings = $this->Attendee->Lodging->find('list');
		$this->set(compact('conferences', 'localities', 'campuses', 'statuses', 'lodgings'));
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
                $campuses = $this->Attendee->Campus->find('list');
		$statuses = $this->Attendee->Status->find('list', array(/**'conditions' => array('Status.id >' => 1), **/'order' => 'Status.id'));
		$this->set(compact('current_conference', 'localities', 'campuses', 'statuses'));
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
                
                $this->Attendee->contain(array(
                    'AttendeeFinanceAdd' => array(
                        'Finance' => array(
                            'fields' => array('comment')
                        )
                    )
                ));
                $attendee = $this->Attendee->read(null, $id);

                $conference_dates = $this->Attendee->Conference->conference_dates($attendee['Attendee']['conference_id']);
                
                if($this->Auth->user('UserType.account_type_id') == 4 && strtotime('now') > $conference_dates['second_deadline']) {
                    $this->Session->setFlash(__('Registration has been closed. Please have your designated brother/sister conference contact notify the registration desk of any cancellatios at the conference.'),'failure');
                    $this->redirect(array('action' => 'index'));
                } elseif (strtotime('now') > $conference_dates['first_deadline']) {
                    //Determine type of registration of canceled attendee
                    if ($attendee['Attendee']['locality_id'] <= 3) {
                        $canceled_reg_type = 'Serving';
                    } elseif (strpos($attendee['Attendee']['comment'],'Nurse') !== false) {
                        if ($attendee['Attendee']['status_id'] == 6) {
                            //Need to change when we distinguish between FTTA nurse and regular nurse.
                            $canceled_reg_type = 'Nurse';
                        } else {
                            $canceled_reg_type = 'Nurse';
                        }
                    } elseif ($attendee['Attendee']['group'] == 'OWN') {
                        $canceled_reg_type = 'FT_nolodging';
                    } else {
                        $canceled_reg_type = 'FT_lodging';
                    }
                    
                    //Check for matching add that could be matched as replacement
                    $late_adds = $this->Attendee->AttendeeFinanceAdd->find('all',array(
                        'conditions' => array(
                            'AttendeeFinanceAdd.cancel_attendee_id' => null,
                            'Finance.conference_id' => $attendee['Attendee']['conference_id'],
                            'Finance.locality_id' => $attendee['Attendee']['locality_id'],
                            'AddAttendee.created >' => $conference_dates['first_deadline']
                        ),
                        'contain' => array(
                            'AddAttendee' => array(
                                'fields' => array(
                                    'AddAttendee.id',
                                    'AddAttendee.locality_id',
                                    'AddAttendee.status_id',
                                    'AddAttendee.group',
                                    'AddAttendee.comment',
                                    'AddAttendee.rate',
                                    'AddAttendee.created'
                                )
                            ),
                            'Finance' => array(
                                'fields' => array(
                                    'Finance.finance_type_id',
                                    'Finance.comment'
                                )
                            )
                        ),
                    ));
                    
                    if (isset($late_adds) && $attendee['AttendeeFinanceAdd'][0]['cancel_attendee_id'] == null) {
                        foreach ($late_adds as $late_add):
                            //Determine registration type of each non-replacement add after first deadline
                            if ($late_add['AddAttendee']['locality_id'] <= 3) {
                                $potential_replacement_reg_type = 'Serving';
                            } elseif (strpos($late_add['AddAttendee']['comment'],'Nurse') !== false) {
                                if ($late_add['AddAttendee']['status_id'] == 6) {
                                    //Need to change when we distinguish between FTTA nurse and regular nurse.
                                    $potential_replacement_reg_type = 'Nurse';
                                } else {
                                    $potential_replacement_reg_type = 'Nurse';
                                }
                            } elseif ($late_add['AddAttendee']['group'] == 'OWN') {
                                $potential_replacement_reg_type = 'FT_nolodging';
                            } else {
                                $potential_replacement_reg_type = 'FT_lodging';
                            }
                            
                            //If current non-replacement late add attendee registration type matches cancelled attendee, stop checking rest of attendees and get late add attendee ID
                            if ($potential_replacement_reg_type == $canceled_reg_type && ($attendee['Attendee']['rate'] == $late_add['AddAttendee']['rate'] || $attendee['Attendee']['rate'] + 10 == $late_add['AddAttendee']['rate'])) {
                                $matched_replacement = $late_add;
                                break;
                            }
                        endforeach;
                    }
                    
                    //Check for matched replacement
                    if (isset($matched_replacement)) {
                        //Adjust late add attendee's rate
                        $this->Attendee->id = $matched_replacement['AddAttendee']['id'];
                        $this->Attendee->saveField('rate',$attendee['Attendee']['rate']);
                                                
                        //Create replacement finance
                        $this->Attendee->AttendeeFinanceCancel->Finance->create($finance = array(
                            'conference_id' => $attendee['Attendee']['conference_id'],
                            'receive_date' => date('Y-m-d',strtotime($matched_replacement['AddAttendee']['created'])),
                            'locality_id' => $attendee['Attendee']['locality_id'],
                            'finance_type_id' => 5,
                            'count' => '0',
                            'rate' => '0',
                            'charge' => null,
                            'payment' => null,
                            'balance' => null,
                            'comment' => null
                        ));
                        $this->Attendee->AttendeeFinanceCancel->Finance->save($finance);
                        $finance['id'] = $this->Attendee->AttendeeFinanceCancel->Finance->id;
                        
                        //Modify late add attendee attendees_finances record to reflect replacement
                        $this->Attendee->AttendeeFinanceCancel->id = $matched_replacement['AttendeeFinanceAdd']['id'];
                        $this->Attendee->AttendeeFinanceCancel->save(array(
                            'finance_id' => $finance['id'],
                            'cancel_attendee_id' => $attendee['Attendee']['id']
                        ));
                        
                        //Decrease count of original late add attendee finance
                        $this->Attendee->AttendeeFinanceCancel->Finance->id = $matched_replacement['AttendeeFinanceAdd']['finance_id'];
                        $this->Attendee->AttendeeFinanceCancel->Finance->saveField('count',$this->Attendee->AttendeeFinanceCancel->Finance->field('count') - 1
                        );
                    } else{
                        //After first deadline without replacement match create new cancel finance
                        //Check for existing finances entries for same kind of transaction
                        $existing_finances = $this->Attendee->AttendeeFinanceCancel->Finance->find('all',array(
                            'conditions' => array(
                                'Finance.conference_id' => $attendee['Attendee']['conference_id'],
                                'Finance.locality_id' => $attendee['Attendee']['locality_id'],
                                'Finance.rate' => $attendee['Attendee']['rate'],
                                'Finance.finance_type_id' => 4,
                            ),
                            'fields' => array('Finance.id', 'Finance.conference_id', 'Finance.receive_date', 'Finance.locality_id', 'Finance.finance_type_id', 'Finance.count', 'Finance.rate', 'Finance.charge', 'Finance.payment', 'Finance.balance', 'Finance.comment'),
                            'recursive' => -1,
                        ));
                            
                        //If existing finance entry found, update entry with new count.
                        if (count($existing_finances) >= 1) {
                            $finance['id'] = $existing_finances[0]['Finance']['id'];
                            $this->Attendee->AttendeeFinanceCancel->Finance->id = $existing_finances[0]['Finance']['id'];
                            $this->Attendee->AttendeeFinanceCancel->Finance->read(array(
                                'Finance.id',
                                'Finance.conference_id',
                                'Finance.receive_date',
                                'Finance.locality_id',
                                'Finance.finance_type_id',
                                'Finance.count',
                                'Finance.rate',
                                'Finance.charge',
                                'Finance.payment',
                                'Finance.balance',
                            ));
                            $this->Attendee->AttendeeFinanceCancel->Finance->set(array(
                                'receive_date' => date('Y-m-d',strtotime('now')),
                                'count' => $existing_finances[0]['Finance']['count'] - 1,
                                'charge' => null,
                                'balance' => '0.00',
                            ));
                            $this->Attendee->AttendeeFinanceCancel->Finance->save();
                        } else {
                            //Otherwise add new finance entry for this transaction
                            $this->Attendee->AttendeeFinanceCancel->Finance->create($finance = array(
                                'conference_id' => $attendee['Attendee']['conference_id'],
                                'receive_date' => date('Y-m-d',strtotime('now')),
                                'locality_id' => $attendee['Attendee']['locality_id'],
                                'finance_type_id' => 4,
                                'count' => '-1',
                                'rate' => $attendee['Attendee']['rate'],
                                'charge' => null,
                                'payment' => null,
                                'balance' => null,
                                'comment' => null
                            ));
                            $this->Attendee->AttendeeFinanceCancel->Finance->save($finance);
                            $finance['id'] = $this->Attendee->AttendeeFinanceCancel->Finance->id;
                        }
                        
                        $this->Attendee->AttendeeFinanceCancel->create($attendee_finance = array(
                            'finance_id' => $finance['id'],
                            'cancel_attendee_id' => $attendee['Attendee']['id'],
                        ));
                        $this->Attendee->AttendeeFinanceCancel->save($attendee_finance);
                    }
                } else {
                    //Before first deadline remove finance and attendees_finance entries
                    //Find original finance
                    $attendee_finance = $this->Attendee->AttendeeFinanceCancel->find('first',array('conditions' => array('AttendeeFinanceCancel.add_attendee_id' => $attendee['Attendee']['id'])));
                    $original_finance = $this->Attendee->AttendeeFinanceCancel->Finance->find('first',array('conditions' => array('Finance.id' => $attendee_finance['AttendeeFinanceCancel']['finance_id'])));
                    
                    //Decrease original finance count by 1
                    $this->Attendee->AttendeeFinanceCancel->Finance->read(null,$original_finance['Finance']['id']);
                    $this->Attendee->AttendeeFinanceCancel->Finance->set('count', $original_finance['Finance']['count'] - 1);
                    $this->Attendee->AttendeeFinanceCancel->Finance->save();
                    
                    //Delete original AttendeeFinance
                    $this->Attendee->AttendeeFinanceCancel->delete($attendee_finance['AttendeeFinanceCancel']['id']);
                }
                
                //Cancel attendee
                $this->Attendee->Cancel->create($cancel = array(
                    'attendee_id' => $attendee['Attendee']['id'],
                    'conference_id' => $attendee['Attendee']['conference_id']
                    ));
                $this->Attendee->Cancel->save($cancel);
                
                //TODO make all changes in one save function
                
                $this->Session->setFlash(__('Attendee as been cancelled'),'success');
                if (in_array($this->Auth->user('UserType.account_type_id'),array('2','3'))) {
                    $this->redirect(array('action' => 'process'));
                } else {
                    $this->redirect(array('action' => 'index'));
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
 * cancel method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function cancel($id = null) {
                if ($this->request->is('post') || $this->request->is('put')) {
                        $barcode = $this->request->data['Attendee']['barcode'];
                        $attendee = $this->Attendee->find('first', array('conditions' => array('Attendee.barcode'=>$barcode)));
                        if ( $attendee != null ){
                            if ($attendee['Attendee']['cancel'] == NULL && $this->Attendee->CheckIn->find('count',array('conditions' => array('CheckIn.attendee_id' => $attendee['Attendee']['id']))) == NULL){
                                $this->Attendee->id = $attendee['Attendee']['id'];
                                $this->request->data['Attendee']['lodging_id'] = null;
                                $this->request->data['Attendee']['cancel'] = date('Y-m-d H:i:s');
                                if (strlen($this->request->data['Attendee']['replaced_by']) > 1) $this->request->data['Attendee']['comment'] = $attendee['Attendee']['comment'].'; Replaced by '.$this->request->data['Attendee']['replaced_by'];
                                if ($this->Attendee->save($this->request->data)) {
                                    $this->Session->setFlash(__('The attendee '.$attendee['Attendee']['first_name'].' '.$attendee['Attendee']['last_name'].' has been canceled'),'success');
                                } else {
                                    $this->Session->setFlash(__('The attendee '.$attendee['Attendee']['first_name'].' '.$attendee['Attendee']['last_name'].' could not be canceled. Please, try again.'),'failure');
                                }
                            } elseif ($this->Attendee->CheckIn->find('count',array('conditions' => array('CheckIn.attendee_id' => $attendee['Attendee']['id']))) > 0) {
				$this->Session->setFlash(__('The attendee '.$attendee['Attendee']['first_name'].' '.$attendee['Attendee']['last_name'].' has already been checked in.'),'failure');
                            } elseif ($attendee['Attendee']['cancel'] !== NULL) {
                                $this->Session->setFlash(__('The attendee '.$attendee['Attendee']['first_name'].' '.$attendee['Attendee']['last_name'].' is already canceled.'),'warning');
                            }
                        } else {
                            $this->Session->setFlash(__('The ID from your input is invalid'),'failure');
                        }
		} else {
                    //$this->request->data = $this->Attendee->read(null, $id);
		}
                //$this->set('attendee', $this->Attendee->read(null, $id));
        }
        
        public function cancel_report() {
            $this->Attendee->recursive = 1;
            $this->paginate = array(
                'conditions' => array('Attendee.cancel NOT' => null),
                'order' => array('Attendee.locality_id' => 'asc')
            );
        }
        
        public function noshow_report() {
            $this->Attendee->recursive = 0;
            $no_shows = $this->Attendee->find('all',array('joins' => array(array('alias' => 'CheckIn','table' => 'check_ins','foreignKey' => false,'conditions' => array('CheckIn.attendee_id = Attendee.id'))),'conditions' => array('CheckIn.id' => null)));
            //debug($no_shows);
            $this->set(compact('no_shows'));
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
}