<?php
App::uses('AppModel', 'Model');
/**
 * Lodging Model
 *
 * @property Conference $Conference
 * @property Locality $Locality
 * @property Attendee $Attendee
 */
class Lodging extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	
        public $displayField = 'BB_name';

        public $actsAs = array('Search.Searchable','Containable');

        public $filterArgs = array(
                array('name' => 'name', 'type' => 'query', 'method' => 'filterName'),
                array('name' => 'locality', 'type' => 'query', 'field' => 'Locality.city', 'method' => 'filterLocality'),
                array('name' => 'city', 'type' => 'query', 'method' => 'filterCity')
        );
        
        public function filterName($data, $field = null){
            if(empty($data['name'])){
                return array();
            }
            $name = '%' . $data['name'] . '%';
            return array (
                    $this->alias . '.name LIKE' => $name
            );
        }
        
        public function filterLocality($data, $field = null){
            if(empty($data['locality'])){
                return array();
            }
            $locality = '%' . $data['locality'] . '%';
            return array (
                    'Locality.city LIKE' => $locality
            );
        }
        
        public function filterCity($data, $field = null){
            if(empty($data['name'])){
                return array();
            }
            $city = '%' . $data['name'] . '%';
            return array (
                
                    $this->alias . '.city' => $city
            );
        }

//TODO Set up virtual field according to location of conference, and displayField accordinngly

/*
 * construct method
 * 
 * @return void
 */

        public function __construct($id = false, $table = null, $ds = null) {
            parent::__construct($id, $table, $ds);
            $this->virtualFields['BB_name'] = sprintf('CONCAT(%s.name, " ", %s.room)', $this->alias, $this->alias);
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
		'code' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				'allowEmpty' => false,
				'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'home_phone' => array(
			'phone' => array(
				'rule' => array('phone'),
				//'message' => 'Your custom message here',
				'allowEmpty' => true,
				'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'cell_phone' => array(
			'phone' => array(
				'rule' => array('phone'),
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
			'foreignKey' => 'lodging_id',
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
