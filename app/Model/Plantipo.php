<?php
App::uses('AppModel', 'Model');
/**
 * Plantipo Model
 *
 * @property Planesnuevo $Planesnuevo
 * @property Planesusado $Planesusado
 */
class Plantipo extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'denominacion';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(		
		'Plan' => array(
			'className' => 'Plan',
			'foreignKey' => 'plantipo_id',
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
