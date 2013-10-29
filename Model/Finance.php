<?php
App::uses('AppModel', 'Model');
/**
 * Finance Model
 *
 * @property Conference $Conference
 * @property Locality $Locality
 * @property FinanceType $FinanceType
 * @property User $Creator
 * @property User $Modifier
 * @property AttendeesFinance $FinanceAttendee
 */
class Finance extends AppModel {

/**
 * contain
 *
 * @var array
 */
        public $contain = array(
            'Locality' => array(
                'fields' => array('Locality.name')
            ),
            'Conference' => array(
                'fields' => array('Conference.code')
            ),
            'FinanceType' => array(
                'fields' => array('FinanceType.name')
            ),
            'Creator' => array(
                'fields' => array('Creator.username')
            ),
            'Modifier' => array(
                'fields' => array('Modifier.username')
            ),
            'FinanceAttendee' => array(
                'AddAttendee' => array(
                    'fields' => 'AddAttendee.name'
                ),
                'CancelAttendee' => array(
                    'fields' => 'CancelAttendee.name'
                )
            )
        );

        public $actsAs = array('Search.Searchable');

        public $filterArgs = array(
                array('name' => 'locality', 'type' => 'query', 'field' => 'Locality.city', 'method' => 'filterLocality')
        );
        
        public function filterLocality($data, $field = null){
            if(empty($data['locality'])){
                return array();
            }
            $locality = '%' . $data['locality'] . '%';
            return array (
                    'Locality.city LIKE' => $locality
            );
        }

/**
 * beforeSave callback
 *
 * return true
 */

        public function beforeSave($options = array()) {
            if (empty($this->data[$this->alias]['id'])) {
                $this->data[$this->alias]['creator_id'] = $_SESSION['Auth']['User']['id'];
            } else {
                $this->data[$this->alias]['modifier_id'] = $_SESSION['Auth']['User']['id'];
            }
            
            if ($this->data[$this->alias]['charge'] == null || $this->data[$this->alias]['charge'] == 0) $this->data[$this->alias]['charge'] = $this->data[$this->alias]['count'] * $this->data[$this->alias]['rate']*(-1);
            $this->data[$this->alias]['balance'] = $this->data[$this->alias]['payment'] + $this->data[$this->alias]['charge'];
            return true;
        }

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'conference_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				'allowEmpty' => false,
				'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'receive_date' => array(
			'date' => array(
				'rule' => array('date'),
				//'message' => 'Your custom message here',
				'allowEmpty' => false,
				'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'locality_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				'allowEmpty' => false,
				'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'finance_type_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				'allowEmpty' => false,
				'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'count' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				'allowEmpty' => true,
				'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'rate' => array(
			'money' => array(
				'rule' => array('money'),
				//'message' => 'Your custom message here',
				'allowEmpty' => true,
				'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'charge' => array(
			'money' => array(
				'rule' => array('money'),
				//'message' => 'Your custom message here',
				'allowEmpty' => true,
				'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'payment' => array(
			'money' => array(
				'rule' => array('money'),
				//'message' => 'Your custom message here',
				'allowEmpty' => true,
				'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'balance' => array(
			'money' => array(
				'rule' => array('money'),
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
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Conference' => array(
			'className' => 'Conference',
			'foreignKey' => 'conference_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Locality' => array(
			'className' => 'Locality',
			'foreignKey' => 'locality_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'FinanceType' => array(
			'className' => 'FinanceType',
			'foreignKey' => 'finance_type_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
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
		)
	);

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'FinanceAttendee' => array(
			'className' => 'AttendeesFinance',
			'foreignKey' => 'finance_id',
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
