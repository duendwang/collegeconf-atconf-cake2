<?php
App::uses('AppController', 'Controller');
/**
 * CheckIns Controller
 *
 * @property CheckIn $CheckIn
 */
class CheckInsController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->CheckIn->recursive = 0;
		$this->set('checkIns', $this->paginate());
	}

/**
 * report method
 *
 * @return void
 */
	public function report() {
                $check_ins = $this->CheckIn->find('all',array('fields' => array('DISTINCT(CheckIn.attendee_id)','CheckIn.timestamp'),'recursive' => 2));
                debug($check_ins);
                exit;
                //$attendees = $this->CheckIn->Attendee->find('all');
                $check_in_count = 0;
                $high_school_count = 0;
                $college_count = 0;
                $not_checked_in_count = 0;
                $FriPM = 0;
                $FriNight = 0;
                $SatB = 0;
                $SatL = 0;
                $SatD = 0;
                $SatPM = 0;
                $SatNight = 0;
                $LDB = 0;
                $LDL = 0;
                /**debug(date('Y-m-d H:i:s', strtotime('10/28/2012')));
                debug(strtotime('10/28/2012'));
                debug(strtotime('10/28/2012 18:00'));
                debug(date('Y-m-d H:i:s', strtotime('10/28/2012 18:00')));
                debug(date('Y-m-d H:i:s', strtotime('10/28/2012 18:00:00')));
                exit;**/
                $this->loadmodel('Conference');
                $three_days_ago = date('Y-m-d', strtotime('-3 days'));
                $start_date = $this->Conference->find('first',array('conditions' => array("Conference.start_date >= '$three_days_ago'",'Conference.start_date <= NOW()'),'fields' => array('Conference.start_date'),'recursive' => 0));
                $start_date = strtotime($start_date['Conference']['start_date']);
                debug($start_date);
                exit;
                /**debug(date('Y-m-d H:i:s', strtotime('+1 day 21:30',$start_date)));
                debug(strtotime('2012-10-26'));
                debug(date('Y-m-d',strtotime('-3 days')));
                debug(date('Y-m-d'));
                debug(date('Y-m-d H:i:s',strtotime('18:00', strtotime($start_date[1]))));
                exit;**/
                //debug($check_ins);
                //exit;
                foreach ($check_ins as $check_in):
                    $check_in_count = $check_in_count + 1;
                    if ($check_in['Attendee']['status_id'] === 1) $high_school_count = $high_school_count + 1;
                    elseif (in_array($check_in['Attendee']['status_id'],array(2,3,4,5))) $college_count = $college_count + 1;
                    if ($check_in['CheckIn']['timestamp'] < strtotime('21:30:00',$start_date)) $FriPM = $FriPM + 1;
                    elseif ($check_in['CheckIn']['timestamp'] < strtotime('+1 day',$start_date)) $FriNight = $FriNight + 1;
                    elseif ($check_in['CheckIn']['timestamp'] < strtotime('+1 day 09:00',$start_date)) $SatB = $SatB + 1;
                    elseif ($check_in['CheckIn']['timestamp'] < strtotime('+1 day 13:00',$start_date)) $SatL = $SatL + 1;
                    elseif ($check_in['CheckIn']['timestamp'] < strtotime('+1 day 19:00',$start_date)) $SatD = $SatD + 1;
                    elseif ($check_in['CheckIn']['timestamp'] < strtotime('+1 day 21:00',$start_date)) $SatPM = $SatPM + 1;
                    elseif ($check_in['CheckIn']['timestamp'] < strtotime('+2 days',$start_date)) $SatNight = $SatNight + 1;
                    elseif ($check_in['CheckIn']['timestamp'] < strtotime('+2 days 09:00',$start_date)) $LDB = $LDB + 1;
                    elseif ($check_in['CheckIn']['timestamp'] < strtotime('+2 day 13:00',$start_date)) $LDL = $LDL + 1;
                endforeach;
                /**foreach ($attendees as $attendee):
                    if ($this->CheckIn->find('count',array('conditions' => array('CheckIn.attendee_id' => $attendee['Attendee']['id']))) === false) $not_checked_in_count = $not_checked_in_count + 1;
                endforeach;**/
                /*$check_in_entries = $this->Attendee->query("SELECT name,
			COUNT(check_in_id) as count
			FROM attendees as Attendee
			INNER JOIN time_codes as Time_Code
			ON Attendee.check_in_id=Time_Code.id
			GROUP BY Attendee.check_in_id");
			
		$high_school_count = $this->Attendee->query("SELECT name,
			COUNT(status_id) as count
			FROM attendees as Attendee
			INNER JOIN statuses as Status
			ON Attendee.status_id=Status.id
			WHERE status_id = 1 AND check_in_id IS NOT NULL");
			
		$college_count = $this->Attendee->query("SELECT name,
			COUNT(status_id) as count
			FROM attendees as Attendee
			INNER JOIN statuses as Status
			ON Attendee.status_id=Status.id
			WHERE status_id BETWEEN 2 AND 5 AND check_in_id IS NOT NULL");
				
		$checked_in_count = $this->Attendee->query("SELECT COUNT(first_name) as count
			FROM attendees as Attendee
			WHERE check_in_id IS NOT NULL");
			
		$not_checked_in_count = $this->Attendee->query("SELECT COUNT(first_name) as count
			FROM attendees as Attendee
			WHERE check_in_id IS NULL");
			
		$canceled_count = $this->Attendee->query("SELECT COUNT(cancel_id) as count
			FROM attendees as Attendee
			WHERE cancel_id IS NOT NULL");
           
                //print_r($report_entries);
            
                $this->set('check_in_entries', $check_in_entries);
			$this->set('high_school_count', $high_school_count);
			$this->set('college_count', $college_count);
			$this->set('checked_in_count', $checked_in_count);
			$this->set('not_checked_in_count', $not_checked_in_count);
			$this->set('canceled_count', $canceled_count);$this->CheckIn->recursive = 0;
                */
		//$this->set('checkIns', $this->paginate());
                $this->set(compact('check_in_count','high_school_count','college_count','not_checked_in_count'));
                $this->set(compact('FriPM','FriNight','SatB','SatL','SatD','SatPM','SatNight','LDB','LDL'));
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->CheckIn->exists($id)) {
			throw new NotFoundException(__('Invalid check in'));
		}
		$options = array('conditions' => array('CheckIn.' . $this->CheckIn->primaryKey => $id));
		$this->set('checkIn', $this->CheckIn->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->CheckIn->create();
			if ($this->CheckIn->save($this->request->data)) {
				$this->Session->setFlash(__('The check in has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The check in could not be saved. Please, try again.'));
			}
		}
		$attendees = $this->CheckIn->Attendee->find('list');
		$this->set(compact('attendees'));
	}

/**
 * checkIn method
 *
 * @param string $id
 * @return void
 */
	public function checkIn($id = null) {
		//$this->loadModel('Attendee');
                if ($this->request->is('post') || $this->request->is('put')) {
                        $barcode = $this->request->data['CheckIn']['barcode'];
                        //debug($barcode);
                        //echo 'attendee.id:'.$id;
                        $attendee = $this->CheckIn->Attendee->find('first', array('conditions' => array('Attendee.barcode'=>$barcode)));
                        //debug($attendee);
                        //echo 'attendee.first_name:'.$attendee['Attendee']['first_name'];
                        //$this->Attendee->set($attendee['Attendee']);
                        //echo 'id:'.$this->Attendee->id;
                        //echo 'check_in_id'.$this->Attendee->check_in_id;
                        //debug($this->CheckIn->find('count',array('conditions' => array('CheckIn.attendee_id' => $attendee['Attendee']['id']))) === NULL);
                        //exit;
                        if ( $attendee != null ){
                            if($this->CheckIn->find('count',array('conditions' => array('CheckIn.attendee_id' => $attendee['Attendee']['id']))) == NULL){
                                $this->CheckIn->create();
                                $this->request->data['CheckIn']['attendee_id'] = $attendee['Attendee']['id'];
                                $this->request->data['CheckIn']['timestamp'] = '';
                                if ($this->CheckIn->save($this->request->data)) {
                                    $this->Session->setFlash(__('The attendee '.$attendee['Attendee']['first_name'].' '.$attendee['Attendee']['last_name'].' has been checked in'),'success');
                                } else {
                                    $this->Session->setFlash(__('The attendee '.$attendee['Attendee']['first_name'].' '.$attendee['Attendee']['last_name'].' could not be checked in. Please, try again.'),'failure');
                                }
                            } else {
				$this->Session->setFlash(__('The attendee '.$attendee['Attendee']['first_name'].' '.$attendee['Attendee']['last_name'].' is already checked in.'),'warning');
                            }
                        }else {
                            $this->Session->setFlash(__('The ID from your input is invalid'),'failure');
                        }
		} else {
                    //$this->request->data = $this->Attendee->read(null, $id);
		}
                //$this->set('attendee', $this->Attendee->read(null, $id));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->CheckIn->exists($id)) {
			throw new NotFoundException(__('Invalid check in'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->CheckIn->save($this->request->data)) {
				$this->Session->setFlash(__('The check in has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The check in could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('CheckIn.' . $this->CheckIn->primaryKey => $id));
			$this->request->data = $this->CheckIn->find('first', $options);
		}
		$attendees = $this->CheckIn->Attendee->find('list');
		$this->set(compact('attendees'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->CheckIn->id = $id;
		if (!$this->CheckIn->exists()) {
			throw new NotFoundException(__('Invalid check in'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->CheckIn->delete()) {
			$this->Session->setFlash(__('Check in deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Check in was not deleted'));
		$this->redirect(array('action' => 'index'));
	}


/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->CheckIn->recursive = 0;
		$this->set('checkIns', $this->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->CheckIn->exists($id)) {
			throw new NotFoundException(__('Invalid check in'));
		}
		$options = array('conditions' => array('CheckIn.' . $this->CheckIn->primaryKey => $id));
		$this->set('checkIn', $this->CheckIn->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->CheckIn->create();
			if ($this->CheckIn->save($this->request->data)) {
				$this->Session->setFlash(__('The check in has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The check in could not be saved. Please, try again.'));
			}
		}
		$attendees = $this->CheckIn->Attendee->find('list');
		$this->set(compact('attendees'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->CheckIn->exists($id)) {
			throw new NotFoundException(__('Invalid check in'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->CheckIn->save($this->request->data)) {
				$this->Session->setFlash(__('The check in has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The check in could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('CheckIn.' . $this->CheckIn->primaryKey => $id));
			$this->request->data = $this->CheckIn->find('first', $options);
		}
		$attendees = $this->CheckIn->Attendee->find('list');
		$this->set(compact('attendees'));
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->CheckIn->id = $id;
		if (!$this->CheckIn->exists()) {
			throw new NotFoundException(__('Invalid check in'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->CheckIn->delete()) {
			$this->Session->setFlash(__('Check in deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Check in was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
