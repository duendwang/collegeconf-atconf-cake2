<?php
App::uses('AppModel', 'Model');
/**
 * Conference Model
 *
 * @property ConferenceLocation $ConferenceLocation
 * @property Attendee $Attendee
 * @property Cancel $Cancel
 * @property ConferenceDeadlineException $ConferenceDeadlineException
 * @property Finance $Finance
 * @property Lodging $Lodging
 * @property OnsiteRegistration $OnsiteRegistration
 * @property PartTimeRegistration $PartTimeRegistration
 * @property Payment $Payment
 * @property RegistrationStep $RegistrationStep
 */
class Conference extends AppModel {
    
    //App::uses('CakeSession', 'Model/Datasource');

/*
 * function currentTermConferences
 * 
 * return array
 * 
 * Get all conferences in this term
 */
    public function current_term_conferences() {
        $current_month = date('n');
        $current_year = date('Y');
        
        //determine the current term
        if ($current_month <= 6) $current_term = 'Spring';
        else if ($current_month >= 7) $current_term = 'Fall';
        
        //find all conferences in current term
        $near_conferences = $this->find('list',array(
            'conditions' => array(
                'Conference.year' => $current_year,
                'Conference.term' => $current_term
                ),
            'fields' => 'Conference.id',
            'order' => 'Conference.start_date',
            'recursive' => -1
        ));
        
        return $near_conferences;
    }

/**
 * conferenceDates method
 * 
 * @return array
 */

        public function conference_dates($conference = null) {
            if ($conference == null) {
                $conference = $_SESSION['Conference']['default'];
            }
            $start_date = $this->find('list',array('conditions' => array('Conference.id' => $conference),'fields' => 'Conference.start_date'));
            $conference_deadlines = $this->ConferenceDeadlineException->ConferenceDeadline->find('all',array('conditions' => array('ConferenceDeadline.id' => array('6','8'))));
            $conference_deadline_exceptions = $this->ConferenceDeadlineException->find('all',array('conditions' => array('ConferenceDeadlineException.conference_id' => $conference,'ConferenceDeadlineException.conference_deadline_id' => array('6','8'))));
            foreach ($conference_deadlines as $deadline):
                if ($deadline['ConferenceDeadline']['id'] === '6') $first_deadline = strtotime('-'.(($deadline['ConferenceDeadline']['weeks_before']*7)+(6-$deadline['ConferenceDeadline']['weekday_id'])-1).' days',strtotime($start_date[$conference]));
                if ($deadline['ConferenceDeadline']['id'] === '8') $second_deadline = strtotime('-'.(($deadline['ConferenceDeadline']['weeks_before']*7)+(6-$deadline['ConferenceDeadline']['weekday_id'])-1).' days',strtotime($start_date[$conference]));
            endforeach;
            if (!empty($conference_deadline_exceptions)) {
                foreach ($conference_deadline_exceptions as $exception):
                    if ($exception['ConferenceDeadlineException']['conference_deadline_id'] === '6') $first_deadline = strtotime('+1 day',strtotime($exception['ConferenceDeadlineException']['date']));
                    if ($exception['ConferenceDeadlineException']['conference_deadline_id'] === '8') $second_deadline = strtotime('+1 day',strtotime($exception['ConferenceDeadlineException']['date']));
                endforeach;
            }
            $conference_dates['start'] = strtotime($start_date[$conference]);
            $conference_dates['first_deadline'] = $first_deadline;
            $conference_dates['second_deadline'] = $second_deadline;
            $conference_dates['end'] = strtotime('+2 days',$conference_dates['start']);
            return $conference_dates;
        }

/**
 * construct method
 * 
 * @return void
 */

        public function __construct($id = false, $table = null, $ds = null) {
            parent::__construct($id, $table, $ds);
            $this->virtualFields['name'] = sprintf('CONCAT(%s.term, " ", %s.year, " ", %s.part, ": ", %s.start_date)', $this->alias, $this->alias, $this->alias, $this->alias);
        }

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'term' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				'allowEmpty' => false,
				'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'year' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				'allowEmpty' => false,
				'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'maxlength' => array(
				'rule' => array('maxlength', 4),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'part' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				'allowEmpty' => false,
				'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'conference_location_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				'allowEmpty' => true,
				'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'start_date' => array(
			'date' => array(
				'rule' => array('date'),
				//'message' => 'Your custom message here',
				'allowEmpty' => true,
				'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'code' => array(
			'alphanumeric' => array(
				'rule' => array('alphanumeric'),
				//'message' => 'Your custom message here',
				'allowEmpty' => true,
				'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'ConferenceLocation' => array(
			'className' => 'ConferenceLocation',
			'foreignKey' => 'conference_location_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Attendee' => array(
			'className' => 'Attendee',
			'foreignKey' => 'conference_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Cancel' => array(
			'className' => 'Cancel',
			'foreignKey' => 'conference_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'ConferenceDeadlineException' => array(
			'className' => 'ConferenceDeadlineException',
			'foreignKey' => 'conference_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Finance' => array(
			'className' => 'Finance',
			'foreignKey' => 'conference_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Lodging' => array(
			'className' => 'Lodging',
			'foreignKey' => 'conference_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'OnsiteRegistration' => array(
			'className' => 'OnsiteRegistration',
			'foreignKey' => 'conference_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'PartTimeRegistration' => array(
			'className' => 'PartTimeRegistration',
			'foreignKey' => 'conference_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Payment' => array(
			'className' => 'Payment',
			'foreignKey' => 'conference_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
                'PotentialAttendee' => array(
			'className' => 'PotentialAttendee',
			'foreignKey' => 'conference_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'RegistrationStep' => array(
			'className' => 'RegistrationStep',
			'foreignKey' => 'conference_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
                'RegistrationTeamsLocalities' => array(
			'className' => 'RegistrationTeamsLocality',
			'foreignKey' => 'conference_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

}
