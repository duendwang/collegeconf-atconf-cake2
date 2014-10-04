<?php
App::uses('AppModel', 'Model');
/**
 * Rate Model
 *
 * @property ConferenceLocation $ConferenceLocation
 * @property RateType $RateType
 */
class Rate extends AppModel {

//TODO need to set up displayfield and virtualfield to pull from other tables

/**
 * conferenceRates method
 * 
 * @return array
 */

        public function conference_rates ($conference_location = null) {
            $conference_rates = $this->find('all',array('conditions' => array('Rate.conference_location_id' => $conference_location),'recursive' => 0));
            foreach ($conference_rates as $rate):
                switch ($rate['Rate']['rate_type_id']) {
                    case 1:
                        $rates['ft']['cost'] = $rate['Rate']['cost'];
                        $rates['ft']['latefee_applies'] = $rate['Rate']['latefee_applies'];
                        break;
                    case 2:
                        $rates['ft_nolodging']['cost'] = $rate['Rate']['cost'];
                        $rates['ft_nolodging']['latefee_applies'] = $rate['Rate']['latefee_applies'];
                        break;
                    case 3:
                        $rates['ftta']['cost'] = $rate['Rate']['cost'];
                        $rates['ftta']['latefee_applies'] = $rate['Rate']['latefee_applies'];
                        break;
                    case 5:
                        $rates['nurse']['cost'] = $rate['Rate']['cost'];
                        $rates['nurse']['latefee_applies'] = $rate['Rate']['latefee_applies'];
                        break;
                    case 6:
                        $rates['serving']['cost'] = $rate['Rate']['cost'];
                        $rates['serving']['latefee_applies'] = $rate['Rate']['latefee_applies'];
                        break;
                    case 7:
                        $rates['sat_only']['cost'] = $rate['Rate']['cost'];
                        $rates['sat_only']['latefee_applies'] = $rate['Rate']['latefee_applies'];
                        break;
                    case 8:
                        $rates['late_fee']['cost'] = $rate['Rate']['cost'];
                        $rates['late_fee']['latefee_applies'] = $rate['Rate']['latefee_applies'];
                        break;
                    case 9:
                        $rates['meal']['cost'] = $rate['Rate']['cost'];
                        $rates['meal']['latefee_applies'] = $rate['Rate']['latefee_applies'];
                        break;
                    case 10:
                        $rates['booklet']['cost'] = $rate['Rate']['cost'];
                        $rates['booklet']['latefee_applies'] = $rate['Rate']['latefee_applies'];
                        break;
                    case 11:
                        $rates['water']['cost'] = $rate['Rate']['cost'];
                        $rates['water']['latefee_applies'] = $rate['Rate']['latefee_applies'];
                        break;
                }
            endforeach;
            return $rates;
        }

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'rate_type_id';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'conference_location_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				'allowEmpty' => false,
				'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'rate_type_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				'allowEmpty' => false,
				'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'cost' => array(
			'money' => array(
				'rule' => array('money'),
				//'message' => 'Your custom message here',
				'allowEmpty' => false,
				'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'latefee_applies' => array(
			'boolean' => array(
				'rule' => array('boolean'),
				//'message' => 'Your custom message here',
				'allowEmpty' => false,
				'required' => true,
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
		),
		'RateType' => array(
			'className' => 'RateType',
			'foreignKey' => 'rate_type_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
