<?php
App::uses('AppModel', 'Model');
/**
 * Attendee Model
 *
 * @property Cancel $Cancel
 * @property CheckIn $CheckIn
 * @property OnsiteRegistration $OnsiteRegistration
 * @property PartTimeRegistration $PartTimeRegistration
 * @property Conference $Conference
 * @property Locality $Locality
 * @property Campus $Campus
 * @property Status $Status
 * @property Lodging $Lodging
 * @property User $Creator
 * @property User $Modifier
 * @property RegistrationType $RegistrationType
 * @property Payment $Payment
 * @property AttendeeFinance $AttendeeFinance
 * @property AttendeeFinance $AttendeeFinanceCancel
 */
class Attendee extends AppModel {

/**
 * contain
 *
 * @var array
 */
        public $contain = array(
            'Campus' => array(
                'fields' => 'Campus.name'
            ),
            'Cancel',
            'CheckIn',
            'Conference' => array(
                'fields' => 'Conference.code'
            ),
            'Locality' => array(
                'fields' => 'Locality.name'
            ),
            'Lodging' => array(
                'fields' => 'Lodging.code'
            ),
            'Status' => array(
                'fields' => 'Status.code'
            )
        );

        public $actsAs = array('Search.Searchable','Containable');

        public $filterArgs = array(
                array('name' => 'name', 'type' => 'query', 'method' => 'filterName'),
                array('name' => 'locality', 'type' => 'query', 'field' => 'Locality.name', 'method' => 'filterLocality')
        );
        
        public function filterName($data, $field = null){
            if(empty($data['name'])){
                return array();
            }
            $name = '%' . $data['name'] . '%';
            return array (
                'OR' => array (
                    $this->alias . '.first_name LIKE' => $name,
                    $this->alias . '.last_name LIKE' => $name,
					'CONCAT('.$this->alias.'.first_name,\' \','.$this->alias.'.last_name) LIKE' => $name
                )
            );
        }
        
        public function filterLocality($data, $field = null){
            if(empty($data['locality'])){
                return array();
            }
            $locality = '%' . $data['locality'] . '%';
            return array (
                    'Locality.name LIKE' => $locality
            );
        }

/**
 * construct method
 * 
 * @return void
 */

        public function __construct($id = false, $table = null, $ds = null) {
            parent::__construct($id, $table, $ds);
            $this->virtualFields['name'] = sprintf('CONCAT(%s.first_name, " ", %s.last_name)', $this->alias, $this->alias);
        }

/**
 * beforeSave callback
 *
 * return true
 */

        public function beforeSave($options = array()) {
            if (!empty($_SESSION['Auth']['User'])) {
                if (empty($this->data[$this->alias]['id'])) {
                    $this->data[$this->alias]['creator_id'] = $_SESSION['Auth']['User']['id'];
                } else {
                    $this->data[$this->alias]['modifier_id'] = $_SESSION['Auth']['User']['id'];
                }
            }
            return true;
        }
        
/*
 * getStatus method
 * 
 * @return string
 */
        public function get_status($id) {
            if($attendee = $this->find('first',array('conditions' => array('Attendee.id' => $id)))) {
                if ($attendee['Attendee']['check_in_count'] == 1 && $attendee['Attendee']['cancel_count'] == 1) {
                    $status = 'Checked in and canceled';
                } elseif ($attendee['Attendee']['check_in_count'] == 1) {
                    $status = 'Checked in';
                } elseif ($attendee['Attendee']['cancel_count'] == 1) {
                    $status = 'Canceled';
                } else {
                    $status = 'Registered';
                }
            } else {
                $status = 'Not registered';
            }
            return $status;
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
		'conference_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Please select a conference',
				'allowEmpty' => false,
				'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'first_name' => array(
			'alpha' => array(
				'rule' => '/^[a-z\s]+$/i', //TODO copy to all first and last name fields
				'message' => 'Required. Letters only.',
				'allowEmpty' => false,
				'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'last_name' => array(
			'alpha' => array(
				'rule' => '/^[a-z\s]+$/i',
				'message' => 'Required. Letters only.',
				'allowEmpty' => false,
				'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'gender' => array(
			'inlist' => array(
				'rule' => array('inlist',array('B','S')),
				'message' => 'Required',
				'allowEmpty' => false,
				'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'maxlength' => array(
				'rule' => array('maxlength',1),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'locality_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Locality must be selected',
				'allowEmpty' => false,
				'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
                //TODO customize with validation function
		'campus_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Campus must be selected',
				'allowEmpty' => true,
				'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'lrc' => array(
			'boolean' => array(
				'rule' => array('boolean'),
				//'message' => 'Your custom message here',
				'allowEmpty' => true,
				'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'conf_contact' => array(
			'boolean' => array(
				'rule' => array('boolean'),
				//'message' => 'Your custom message here',
				'allowEmpty' => true,
				'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'new_one' => array(
			'boolean' => array(
				'rule' => array('boolean'),
				//'message' => 'Your custom message here',
				'allowEmpty' => true,
				'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'group' => array(
			'alphanumeric' => array(
				'rule' => array('alphanumeric'),
				//'message' => 'Your custom message here',
				'allowEmpty' => true,
				'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'allergies' => array(
			'alphanumeric' => array(
				'rule' => array('alphanumeric'),
				//'message' => 'Your custom message here',
				'allowEmpty' => true,
				'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'maxlength' => array(
				'rule' => array('maxlength',3),
				//'message' => 'Your custom message here',
				//'allowEmpty' => true,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'status_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Required',
				'allowEmpty' => false,
				'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'cell_phone' => array(
			'phone' => array(
				'rule' => array('phone',null,'us'),
				'message' => 'Invalid US phone #',
				'allowEmpty' => false,
				'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'email' => array(
			'email' => array(
				'rule' => array('email'),
				'message' => 'Required',
				'allowEmpty' => false,
				'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'lodging_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				'allowEmpty' => true,
				'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		//TODO find out how money validation works
                'rate' => array(
			'money' => array(
				'rule' => array('money','left'),
				//'message' => 'Your custom message here',
				'allowEmpty' => true,
				'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'paid_at_conf' => array(
			'money' => array(
				'rule' => array('money','left'),
				//'message' => 'Your custom message here',
				'allowEmpty' => true,
				'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'amt_paid' => array(
			'money' => array(
				'rule' => array('money','left'),
				//'message' => 'Your custom message here',
				'allowEmpty' => true,
				'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'paid_date' => array(
			'date' => array(
				'rule' => array('date'),
				//'message' => 'Your custom message here',
				'allowEmpty' => true,
				'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'creator_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				'allowEmpty' => true,
				'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'created' => array(
			'datetime' => array(
				'rule' => array('datetime'),
				//'message' => 'Your custom message here',
				'allowEmpty' => true,
				'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'modifier_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				'allowEmpty' => true,
				'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'modified' => array(
			'datetime' => array(
				'rule' => array('datetime'),
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
 * hasOne associations
 *
 * @var array
 */
	public $hasOne = array(
		'Cancel' => array(
			'className' => 'Cancel',
			'foreignKey' => 'attendee_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'CheckIn' => array(
			'className' => 'CheckIn',
			'foreignKey' => 'attendee_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'OnsiteRegistration' => array(
			'className' => 'OnsiteRegistration',
			'foreignKey' => 'attendee_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'PartTimeRegistration' => array(
			'className' => 'PartTimeRegistration',
			'foreignKey' => 'attendee_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		
	);

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Conference' => array(
			'className' => 'Conference',
			'foreignKey' => 'conference_id',
			'conditions' => '',
                        //'type' => 'left',
			'fields' => '',
			'order' => '',
                        //'counterCache' => 'false',
                        //'counterScope' => 'false'
		),
		'Locality' => array(
			'className' => 'Locality',
			'foreignKey' => 'locality_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Campus' => array(
			'className' => 'Campus',
			'foreignKey' => 'campus_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Status' => array(
			'className' => 'Status',
			'foreignKey' => 'status_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Lodging' => array(
			'className' => 'Lodging',
			'foreignKey' => 'lodging_id',
			'conditions' => '',
			'fields' => '',
			'order' => '',
                        'counterCache' => true,
                        'counterScope' => array(
                            'Attendee.cancel_count' => 0
                        )
		),
		'Creator' => array(
			'className' => 'User',
			'foreignKey' => 'creator_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Modifier' => array(
			'className' => 'User',
			'foreignKey' => 'modifier_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
                'RegistrationType' => array(
			'className' => 'RegistrationType',
			'foreignKey' => 'registration_type_id',
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
		'Payment' => array(
			'className' => 'Payment',
			'foreignKey' => 'attendee_id',
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
                'AttendeeFinanceAdd' => array(
			'className' => 'AttendeesFinance',
			'foreignKey' => 'add_attendee_id',
			//'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'AttendeeFinanceCancel' => array(
			'className' => 'AttendeesFinance',
			'foreignKey' => 'cancel_attendee_id',
			//'dependent' => false,
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
