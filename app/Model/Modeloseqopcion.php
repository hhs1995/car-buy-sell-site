<?php
App::uses('AppModel', 'Model');
/**
 * Segmento Model
 *
 * @property Version $Version
 */
class Modeloseqopcion extends AppModel {

var $useTable = 'modelos_eqopciones';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Eqopcion' => array(
			'className' => 'Eqopcion',
			'foreignKey' => 'eqopcion_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Modelo' => array(
			'className' => 'Modelo',
			'foreignKey' => 'modelo_id',
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
