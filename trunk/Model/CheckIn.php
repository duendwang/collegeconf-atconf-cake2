<?php
App::uses('AppModel', 'Model');
/**
 * CheckIn Model
 *
 * @property Attendee $Attendee
 */
class CheckIn extends AppModel {

/**
 * contain
 *
 * @var array
 */
        public $contain = array(
            'Attendee' => array(
                'fields' => array('Attendee.name'),
                'Locality' => array(
                    'fields' => array('Locality.name')
                )
            )
        );

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'attendee_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
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
		'Attendee' => array(
			'className' => 'Attendee',
			'foreignKey' => 'attendee_id',
			'conditions' => '',
			'fields' => '',
			'order' => '',
                        'counterCache' => true
		)
	);

}
