<?php
App::uses('AppModel', 'Model');
App::uses('ConferenceDeadline', 'Model');
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
 * function currentConference
 * 
 * return array
 * 
 * Get all conferences in this term
 */
    public function current_conference() {
        //find conference that is still going on
        $current_conference = $this->find('list',array(
            'conditions' => array(
                'Conference.start_date < NOW()',
                'Conference.start_date >' => date('Y-m-d',strtotime('-3 days')),
            ),
            'fields' => 'Conference.id',
            'recursive' => -1,
        ));
        
        return $current_conference;
    }

/**
 * conferenceInfo method
 * 
 * @return array
 */

        public function conference_info($conference_id = null, $pre_conf = false) {
            if ($conference_id == null) {
                $conference_id = $this->current_conference();
            } elseif ($conference_id === true) {
                $conference_id = $this->current_conference();
                $pre_conf = true;
            }
            
            $conference = $this->find('first',array('conditions' => array('Conference.id' => $conference_id),'fields' => array('Conference.start_date','Conference.conference_location_id','Conference.code'),'recursive' => -1));
            
            $conference_info['code'] = $conference['Conference']['code'];
            $conference_info['location'] = $conference['Conference']['conference_location_id'];
            $conference_info['start_date'] = strtotime($conference['Conference']['start_date']);
            $conference_info['end_date'] = strtotime('+3 days',$conference_info['start_date']);
            
            //TODO add check to see if need to return current conference id only.
            
            if ($pre_conf == true) {
                $ConferenceDeadline = new ConferenceDeadline();
                $deadlines = $ConferenceDeadline->find('all', array(
                    'conditions' => array('ConferenceDeadline.id' => array(6,8)),
                    'recursive' => 0
                ));
                $exceptions = $this->ConferenceDeadlineException->find('all', array(
                    'conditions' => array(
                        'ConferenceDeadlineException.conference_id' => $conference_id,
                        'ConferenceDeadlineException.conference_deadline_id' => array(6,8),
                    ),
                    'recursive' => -1,
                ));
                
                $deadline_array = array(
                    6 => 'first_deadline',
                    8 => 'second_deadline'
                );
                foreach($deadlines as $deadline):
                    $conference_info[$deadline_array[$deadline['ConferenceDeadline']['id']]] = strtotime($deadline['Weekday']['name'] . ' ' . ($deadline['ConferenceDeadline']['weeks_before']-1) . ' weeks ago ' . $deadline['ConferenceDeadline']['time'],$conference_info['start_date']);
                endforeach;
                
                if (!empty($exceptions)) {
                    foreach($exceptions as $exception):
                        $conference_info[$deadline_array[$exception['ConferenceDeadlineException']['conference_deadline_id']]] = strtotime($exception['ConferenceDeadlineException']['date'] . ' ' . $exception['ConferenceDeadlineException']['time']);
                    endforeach;
                }
            }
            
            return $conference_info;
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
