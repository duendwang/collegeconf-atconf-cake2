<?php
App::uses('AppModel', 'Model');
/**
 * AttendeesFinance Model
 *
 * @property Finance $Finance
 * @property Attendee $Add
 * @property Attendee $Cancel
 */
class AttendeesFinance extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'finance_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				'allowEmpty' => false,
				'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'add_attendee_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				'allowEmpty' => true,
				'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'cancel_attendee_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
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
		'Finance' => array(
			'className' => 'Finance',
			'foreignKey' => 'finance_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'AddAttendee' => array(
			'className' => 'Attendee',
			'foreignKey' => 'add_attendee_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'CancelAttendee' => array(
			'className' => 'Attendee',
			'foreignKey' => 'cancel_attendee_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
