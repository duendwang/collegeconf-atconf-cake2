<?php
App::uses('AppController', 'Controller');
/**
 * Attendees Controller
 *
 * @property Attendee $Attendee
 */
class AttendeesController extends AppController {

/**
 * requirementCheck method
 *
 * @return array Returns array of messages except when called from home page,
 *  in which case it returns true/false.
 */
	function _requirementCheck($locality_ids = null) {
		if (is_null($locality_ids)) {
                    switch ($this->Auth->user('UserType.account_type_id')) {
                        case 1:
                        case 2:
                        case 3:
                            $locality_ids = $this->Attendee->Locality->RegistrationStep->find('list',array('conditions' => array('RegistrationStep.conference_id' => $this->Session->read('Conference.default'),'RegistrationStep.user_id =' => $this->Auth->user('id')),'fields' => 'RegistrationStep.locality_id'));
                            break;
                        case 4:
                            $locality_ids = $this->Auth->user('locality_id');
                            break;
                    }
		}
                //TODO Test and fix checking requirements for registration team
                
                $conferences = $this->Attendee->Conference->find('list',array('conditions' => array('Conference.id' => $this->Attendee->Conference->current_term_conferences(),'Conference.start_date > NOW()'),'fields' => array('Conference.id')));
                
                $attendees = $this->Attendee->find('all',array('conditions' => array('Attendee.conference_id' => $conferences,'Attendee.locality_id' => $locality_ids,'Attendee.cancel_count' => 0),'recursive' => -1));
		foreach ($attendees as $attendee):
                    if(strlen($attendee['Attendee']['gender']) === 0) {$requirement_messages[] = array('Gender information is missing for <a href="'.Router::url(array('controller' => 'attendees','action' => 'edit',$attendee['Attendee']['id']),false).'">'.$attendee['Attendee']['first_name'].' '.$attendee['Attendee']['last_name'].'</a>. Please fill in this information.','warning');}
                    if(strlen($attendee['Attendee']['conference_id']) === 0) {$requirement_messages[] = array('A conference has not been selected for <a href="'.Router::url(array('controller' => 'attendees','action' => 'edit',$attendee['Attendee']['id']),false).'">'.$attendee['Attendee']['first_name'].' '.$attendee['Attendee']['last_name'].'</a>. Please select a conference.','warning');}
                    if(strlen($attendee['Attendee']['cell_phone']) === 0) {$requirement_messages[] = array('A cell phone was not listed for <a href="'.Router::url(array('controller' => 'attendees','action' => 'edit',$attendee['Attendee']['id']),false).'">'.$attendee['Attendee']['first_name'].' '.$attendee['Attendee']['last_name'].'</a>. We must have a cell phone number to contact '.$attendee['Attendee']['first_name'].' in the event of an emergency.','warning');}
                    if(strlen($attendee['Attendee']['email']) === 0) {$requirement_messages[] = array('An email was not listed for <a href="'.Router::url(array('controller' => 'attendees','action' => 'edit',$attendee['Attendee']['id']),false).'">'.$attendee['Attendee']['first_name'].' '.$attendee['Attendee']['last_name'].'</a>. We must have an email address for conference notifications and announcements.','warning');}
                    //if(strlen($attendee['Attendee']['city_state']) === 0) {$requirement_messages[] = array('The city and state of residence was not indicated for <a href="'.Router::url(array('controller' => 'attendees','action' => 'edit',$attendee['Attendee']['id']),false).'">'.$attendee['Attendee']['first_name'].' '.$attendee['Attendee']['last_name'].'</a>. Please fill in this information.','warning');}
                    if(strlen($attendee['Attendee']['status_id']) === 0) {$requirement_messages[] = array('A status was not indicated for <a href="'.Router::url(array('controller' => 'attendees','action' => 'edit',$attendee['Attendee']['id']),false).'">'.$attendee['Attendee']['first_name'].' '.$attendee['Attendee']['last_name'].'</a>.','warning');}
                    if(strlen($attendee['Attendee']['campus_id']) === 0 && in_array($attendee['Attendee']['status_id'],array(2,3,4,5))) {$requirement_messages[] = array('No college campus was indicated for <a href="'.Router::url(array('controller' => 'attendees','action' => 'edit',$attendee['Attendee']['id']),false).'">'.$attendee['Attendee']['first_name'].' '.$attendee['Attendee']['last_name'].'</a>.','warning');}
                    if(strlen($attendee['Attendee']['group']) === 0) {$requirement_messages[] = array('A hospitality group was not indicated for <a href="'.Router::url(array('controller' => 'attendees','action' => 'edit',$attendee['Attendee']['id']),false).'">'.$attendee['Attendee']['first_name'].' '.$attendee['Attendee']['last_name'].'</a>.','warning');}
                    if(in_array($attendee['Attendee']['group'],array('LOCAL','HOST'))) {
                        if(strlen($attendee['Attendee']['host_name']) === 0) {$requirement_messages[] = array('Prearranged hospitality information was not indicated for <a href="'.Router::url(array('controller' => 'attendees','action' => 'edit',$attendee['Attendee']['id']),false).'">'.$attendee['Attendee']['first_name'].' '.$attendee['Attendee']['last_name'].'</a>. We need this information to ensure hospitality houses do not become overbooked.','warning');}
                        else {
                            if (strlen($attendee['Attendee']['host_address']) === 0) {$requirement_messages[] = array('Prearranged hospitality address information is missing for <a href="'.Router::url(array('controller' => 'attendees','action' => 'edit',$attendee['Attendee']['id']),false).'">'.$attendee['Attendee']['first_name'].' '.$attendee['Attendee']['last_name'].'</a>. We need this information to ensure hospitality houses do not become overbooked.','warning');}
                            if (strlen($attendee['Attendee']['host_phone']) === 0) {$requirement_messages[] = array('Prearranged hospitality phone information is missing for <a href="'.Router::url(array('controller' => 'attendees','action' => 'edit',$attendee['Attendee']['id']),false).'">'.$attendee['Attendee']['first_name'].' '.$attendee['Attendee']['last_name'].'</a>. We need this information to ensure hospitality houses do not become overbooked.','warning');}
                        }
                    }
		endforeach;
                
                foreach ($conferences as $conference):
                    $conference = $this->Attendee->Conference->find('first',array(
                        'conditions' => array('Conference.id' => $conference),
                        'contain' => array(
                            'ConferenceLocation'
                        )
                    ));
                    
                    $sis_count = $this->Attendee->find('count',array('conditions' => array('Attendee.conference_id' => $conference['Conference']['id'],'Attendee.locality_id' => $locality_ids,'Attendee.gender' => 'S')));
                    $sis_cc_count = $this->Attendee->find('count',array('conditions' => array('Attendee.conference_id' => $conference['Conference']['id'],'Attendee.locality_id' => $locality_ids,'Attendee.gender =' => 'S','Attendee.conf_contact' => 1)));
                    $bro_count = $this->Attendee->find('count',array('conditions' => array('Attendee.conference_id' => $conference['Conference']['id'],'Attendee.locality_id' => $locality_ids,'Attendee.gender' => 'B')));
                    $bro_cc_count = $this->Attendee->find('count',array('conditions' => array('Attendee.conference_id' => $conference['Conference']['id'],'Attendee.locality_id' => $locality_ids,'Attendee.gender =' => 'B','Attendee.conf_contact' => 1)));
                    if($sis_count > 0) {
                        if($sis_cc_count > 1) {$requirement_messages[] = array('More than one sister conference contact is selected. Please select one only.','warning');}
                        elseif ($sis_cc_count == 0) {$requirement_messages[] = array('No sister conference contact is selected. Please make sure to select a conference contact that can attend the conference full time and has ready access to email.','warning');}
                    }
                    if($bro_count > 0) {
                        if($bro_cc_count > 1) {$requirement_messages[] = array('More than one brother conference contact is selected. Please select one only.','warning');}
                        elseif ($bro_cc_count == 0) {$requirement_messages[] = array('No brother conference contact is selected. Please make sure to select a conference contact that can attend the conference full time and has ready access to email.','warning');}
                    }
                    //Can be moved outside conference foreach
                    $newone_cc = $this->Attendee->find('count',array('conditions' => array('Attendee.conference_id' => $conference['Conference']['id'],'Attendee.locality_id' => $locality_ids,'Attendee.new_one' => 1,'Attendee.conf_contact' => 1)));
                    if($newone_cc > 0) {$requirement_messages[] = array('A new one was selected as the conference contact. Because of the nature of the conference contact service, please select another conference contact.','warning');}
                
                    if ($conference['ConferenceLocation']['id'] == 1) {
                        //Used during Big Bear
                        $others_count = $this->Attendee->find('count',array('conditions' => array('Attendee.conference_id' => $conference['Conference']['id'],'Attendee.locality_id' => $locality_ids,'Attendee.status_id NOT' => array(1,2,3,4,5))));
                        $students_count = $this->Attendee->find('count',array('conditions' => array('Attendee.conference_id' => $conference['Conference']['id'],'Attendee.locality_id' => $locality_ids,'Attendee.status_id' => array(1,2,3,4,5))));
                        if($others_count > $students_count/2) {$requirement_messages[] = array('Your student to non-student ratio is less than 2:1. Please fellowship with the registration team if there is a particular need.','warning');}
                        
                        //Checks if 1)any groups are mixed gender and 2)if any groups are too large
                        $hosp_groups = $this->Attendee->find('all',array('conditions' => array('Attendee.conference_id' => $conference['Conference']['id'],'Attendee.locality_id' => $locality_ids,'NOT' => array('Attendee.group' => array('','OWN'))),'group' => array('Attendee.group','Attendee.gender'),'fields' => array('Attendee.group','Attendee.gender','count(`Attendee`.`id`) as count'),'recursive' => -1));
                        foreach ($hosp_groups as $hosp_group):
                            if ($hosp_group['Attendee']['gender'] == 'B') {
                                if ($this->Attendee->find('count',array('conditions' => array('Attendee.conference_id' => $conference['Conference']['id'],'Attendee.locality_id' => $locality_ids,'Attendee.group' => $hosp_group['Attendee']['group']),))) {
                                    $requirement_messages[] = array('Both brothers and sisters are assigned to the hospitality group '.h($hosp_group['Attendee']['group']).'. Please only assign either brothers or sisters to this group and move to the rest to another group.','warning');
                                }
                                if ($hosp_group[0]['count'] > 10) {
                                    $requirement_messages[] = array('Too many brothers are assigned to hospitality group '.h($hosp_group['Attendee']['group']).'. Please only assign a maximum of 10 brothers to each hospitality group.','warning');
                                }
                            } elseif ($hosp_group['Attendee']['gender'] == 'S' && $hosp_group[0]['count'] > 4) {
                                $requirement_messages[] = array('Too many sisters are assigned to hospitality group '.h($hosp_group['Attendee']['group']).'. Please only assign a maximum of 4 sisters to each hospitality group.','warning');
                            }
                        endforeach;
                    }
                endforeach;
                
                if (!empty($requirement_messages)) {
                    if ($this->request['controller'] == 'attendees' && $this->request['action'] == 'index') {
                        foreach ($requirement_messages as $requirement_message):
                            $this->_flash(__($requirement_message[0],true),$requirement_message[1]);
                        endforeach;
                    } elseif ($this->request['controller'] == 'attendees' && $this->request['action'] == 'process') {
                        $this->set(compact('requirement_messages'));
                    } else return true;
                }
	}

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Attendee->recursive = 0;
                if($this->Auth->user('UserType.account_type_id') == 4) {
                    $this->paginate = array(
                        'conditions' => array('Attendee.conference_id' => $this->Session->read('Conference.selected'),'Attendee.locality_id =' => $this->Auth->user('locality_id'),'Attendee.cancel_count' => 0),
                        'contain' => $this->Attendee->contain,
                        'limit' => 200,
                    );
                    $this->_requirementCheck();
		} else $this->paginate = array(
                    'conditions' => array('Attendee.conference_id' => $this->Session->read('Conference.selected'),'Attendee.cancel_count' => 0),
                    //'contain' => $this->Attendee->contain,
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
 * report method
 * 
 * @return void
 */
        public function report() {
            $this->Attendee->recursive = 0;
            
        }

/**
 * process method
 *
 * @return void
 */
	public function process($locality = null) {
                $locality_ids = $this->Attendee->Locality->RegistrationStep->find('list',array('conditions' => array('RegistrationStep.conference_id' => $this->Session->read('Conference.default'),'RegistrationStep.user_id =' => $this->Auth->user('id')),'fields' => 'RegistrationStep.locality_id'));
                $this->set('localities',$this->Attendee->Locality->find('list',array('conditions' => array('Locality.id' => $locality_ids),'recursive' => 0,'order' => 'Locality.name')));
                $this->Attendee->recursive = 0;
                if(isset($locality)) {
                    $this->paginate = array(
                        'conditions' => array('Attendee.conference_id' => $this->Session->read('Conference.default'),'Attendee.locality_id =' => $locality),
                        'limit' => 100
                    );
                    $this->set('rate_summaries',$this->Attendee->find('all',array('conditions' => array('Attendee.conference_id' => $this->Session->read('Conference.default'),'Attendee.locality_id' => $locality,'Attendee.cancel_count' => 0),'fields' => array('Attendee.rate','COUNT(Attendee.id) as count','SUM(Attendee.rate) as charge'),'group' => array('Attendee.rate'))));
                    //Only for Anaheim
                    //$this->set('hosp_summaries',$this->Attendee->find('all',array('conditions' => array('Attendee.conference_id' => $this->Session->read('Conference.default'),'Attendee.locality_id' => $locality,'Attendee.cancel_count' => 0),'fields' => array('Attendee.group','COUNT(Attendee.id) as count'),'group' => array('Attendee.group'))));
                } else {
                    $this->paginate = array(
                        'conditions' => array('Attendee.conference_id' => $this->Session->read('Conference.selected'),'Attendee.locality_id' => $locality_ids),
                        'limit' => 100
                    );
                }
		$this->set('attendees', $this->paginate());
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
 * register method
 *
 * @return void
 */
	public function register() {
		if ($this->request->is('post')) {
			$this->Attendee->create();
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
                        
                        if (strtotime('now') > $conference_dates['first_deadline'] && $this->request->data['Attendee']['locality_id'] !== 2) {
                            $late_reg = 0;
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
                                ));
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
                                
                                $this->Session->setFlash(__('You have been registered.'),'success');
				$this->redirect(array('controller' => 'pages', 'action' => 'display','home'));
			} elseif (empty($this->request->data['Attendee']['conference_id'])) {
                                $this->Session->setFlash(__('A conference was not selected. Please select a conference.'),'failure');
                        } else {
				$this->Session->setFlash(__('You could not be registered. Please, try again.'),'failure');
			}
		}
                $user = $this->Auth->user();
                $conferences = $this->Attendee->Conference->find('list',array('conditions' => array('Conference.id' => $this->Attendee->Conference->current_term_conferences())));
                $localities = $this->Attendee->Locality->find('list', array('conditions' => array('Locality.id' => array(2,$this->Auth->user('Locality.id')))));
                $campuses = $this->Attendee->Campus->find('list');
		$statuses = $this->Attendee->Status->find('list', array('conditions' => array('Status.id >' => 1), 'order' => 'Status.id'));
		//$lodgings = $this->Attendee->Lodging->find('list');
		$this->set(compact('user','conferences', 'localities', 'campuses', 'statuses', 'lodgings'));
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