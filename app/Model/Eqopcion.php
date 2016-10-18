<?php
App::uses('AppModel', 'Model');
/**
 * Segmento Model
 *
 * @property Version $Version
 */
class Eqopcion extends AppModel {


var $displayField = 'denominacion';
var $useTable = 'eq_opciones';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Categoria' => array(
			'className' => 'Categoria',
			'foreignKey' => 'categoria_id',
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
	
	public $hasMany = array(
		'Modeloseqopcion' => array(
			'className' => 'Modeloseqopcion',
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
		)
	);

}
