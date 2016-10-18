<?php
App::uses('AppModel', 'Model');
/**
 * Planesusado Model
 *
 * @property Modelo $Modelo
 * @property Version $Version
 * @property Plantipo $Plantipo
 */
class Plansearch extends AppModel {

/**
 * Display field
 *
 * @var string
 */
public $useTable = 'plansearch';
/**
 * Validation rules
 *
 * @var array
 */


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Plan' => array(
			'className' => 'Plan',
			'foreignKey' => 'plan_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
	);
	
	
}
