<?php
App::uses('AppModel', 'Model');
/**
 * Segmento Model
 *
 * @property Version $Version
 */
class Historialvisita extends AppModel {


var $useTable = 'historial_visitas';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Plan' => array(
			'className' => 'Plan',
			'foreignKey' => 'plan_id',
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
