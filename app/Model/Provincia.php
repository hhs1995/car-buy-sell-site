<?php
App::uses('AppModel', 'Model');
/**
 * Cuota Model
 *
 * @property Planesnuevo $Planesnuevo
 */
class Provincia extends AppModel {

	public $displayField = 'denominacion';
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
	public $hasMany = array(
		'Contacto' => array(
			'className' => 'Contacto',
			'foreignKey' => 'provincia_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
	
	
}
