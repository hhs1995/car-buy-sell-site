<?php
App::uses('AppModel', 'Model');
/**
 * Segmento Model
 *
 * @property Version $Version
 */
class Segmento extends AppModel {


var $displayField = 'denominacion';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Modelo' => array(
			'className' => 'Modelo',
			'foreignKey' => 'segmento_id',
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
