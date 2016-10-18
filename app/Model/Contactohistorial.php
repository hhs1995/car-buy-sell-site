<?php
App::uses('AppModel', 'Model');
/**
 * Segmento Model
 *
 * @property Version $Version
 */
class Contactohistorial extends AppModel {


var $useTable = 'contactohistoriales';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Contactohistorial' => array(
			'className' => 'Contactohistorial',
			'foreignKey' => 'contacto_id',
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

