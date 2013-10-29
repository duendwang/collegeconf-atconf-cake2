<?php
App::uses('AppModel', 'Model');
/**
 * User Model
 *
 * @property RegistrationTeamMember $RegistrationTeamMember
 * @property UserType $UserType
 * @property Locality $Locality
 * @property Status $Status
 * @property Campus $Campus
 * @property RegistrationStep $RegistrationStep
 * @property Attendee $AttendeeCreate
 * @property Attendee $AttendeeModify
 * @property Cancel $CancelCreate
 * @property Cancel $CancelModify
 * @property Email $EmailCreate
 * @property Email $EmailModify
 * @property Finance $FinanceCreate
 * @property Finance $FinanceModify
 * @property Payment $PaymentCreate
 * @property Payment $PaymentModify
 * @property RegistrationStep $RegistrationStepCreate
 * @property RegistrationStep $RegistrationStepModify
 */
class User extends AppModel {

/**
 * Act As
 *
 * @var string
 */
        public $actsAs = array('Acl' => array('type' => 'requester'));

/*
 * constuct method
 * 
 * @return void
 */

       public function __construct($id = false, $table = null, $ds = null) {
           parent::__construct($id, $table, $ds);
           $this->virtualFields['name'] = sprintf('CONCAT(%s.first_name, " ", %s.last_name)', $this->alias, $this->alias);
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
		'username' => array(
			'alphanumeric' => array(
				'rule' => array('alphanumeric'),
				'message' => 'Letters and numbers only',
				'allowEmpty' => false,
				'required' => true,
				//'last' => false, // Stop validation after this rule
				'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'password' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Blank passwords not allowed.',
				'allowEmpty' => false,
				'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'cell_phone' => array(
			'phone' => array(
				'rule' => array('phone',null,'us'),
				//'message' => 'Your custom message here',
				'allowEmpty' => true,
				'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'email' => array(
			'email' => array(
				'rule' => array('email'),
				//'message' => 'Your custom message here',
				'allowEmpty' => true,
				'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'locality_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				'allowEmpty' => true,
				'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'status_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				'allowEmpty' => true,
				'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'campus_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				'allowEmpty' => true,
				'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'active' => array(
			'boolean' => array(
				'rule' => array('boolean'),
				//'message' => 'Your custom message here',
				'allowEmpty' => false,
				'required' => true,
				//'last' => false, // Stop validation after this rule
				'on' => 'create', // Limit validation to 'create' or 'update' operations
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
		'RegistrationTeamsMember' => array(
			'className' => 'RegistrationTeamsMember',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
                'UserType' => array(
			'className' => 'UserType',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
		
	);

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Locality' => array(
			'className' => 'Locality',
			'foreignKey' => 'locality_id',
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
		'Campus' => array(
			'className' => 'Campus',
			'foreignKey' => 'campus_id',
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
		'RegistrationStep' => array(
			'className' => 'RegistrationStep',
			'foreignKey' => 'user_id',
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
		'AttendeeCreate' => array(
			'className' => 'Attendee',
			'foreignKey' => 'creator_id',
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
		'AttendeeModify' => array(
			'className' => 'Attendee',
			'foreignKey' => 'modifier_id',
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
		'CancelCreate' => array(
			'className' => 'Cancel',
			'foreignKey' => 'creator_id',
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
		'CancelModify' => array(
			'className' => 'Cancel',
			'foreignKey' => 'modifier_id',
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
		'EmailCreate' => array(
			'className' => 'Email',
			'foreignKey' => 'creator_id',
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
		'EmailModify' => array(
			'className' => 'Email',
			'foreignKey' => 'modifier_id',
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
		'FinanceCreate' => array(
			'className' => 'Finance',
			'foreignKey' => 'creator_id',
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
		'FinanceModify' => array(
			'className' => 'Finance',
			'foreignKey' => 'modifier_id',
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
		'PaymentCreate' => array(
			'className' => 'Payment',
			'foreignKey' => 'creator_id',
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
		'PaymentModify' => array(
			'className' => 'Payment',
			'foreignKey' => 'modifier_id',
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
		'RegistrationStepCreate' => array(
			'className' => 'RegistrationStep',
			'foreignKey' => 'creator_id',
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
		'RegistrationStepModify' => array(
			'className' => 'RegistrationStep',
			'foreignKey' => 'modifier_id',
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
                
	);

/**
 * beforeSave method
 *
 * @return null
 */
	public function beforeValidate($options = array()) {
            if (!empty($this->data[$this->alias]['new_password'])) {
                $this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['new_password']);
            }
            return true;
	}

/**
 * parentNode method
 *
 * @return array
 */
        public function parentNode() {
            if (!$this->id && empty($this->data)) {
                return null;
            }
            if (isset($this->data['UserType']['account_type_id'])) {
                $account_type_id = $this->data['UserType']['account_type_id'];
            } else {
                $user_type = $this->UserType->find('list',array('conditions' => array('UserType.user_id' => $this->id),'order' => 'UserType.account_type_id','fields' => 'UserType.account_type_id'));
                $account_type_id = reset($user_type);
            }
            if (!$account_type_id) {
                return null;
            } else {
                return array('AccountType' => array('id' => $account_type_id));
            }
        }

}
