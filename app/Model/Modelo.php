<?php
App::uses('AppModel', 'Model');
/**
 * Modelo Model
 *
 * @property Marca $Marca
 * @property Foto $Foto
 * @property Planesnuevo $Planesnuevo
 * @property Planesusado $Planesusado
 * @property Version $Version
 * @property Video $Video
 */
class Modelo extends AppModel {

var $displayField = 'denominacion';
/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'denominacion' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Debe ingresar la denominacion',
				'allowEmpty' => false,
				'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'marca_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Debe ingresar la marca',
				'allowEmpty' => false,
				'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'segmento_id' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Debe ingresar el segmento',
				'allowEmpty' => false,
				'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'precio0km' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Debe ingresar el precio del 0km',
				'allowEmpty' => false,
				'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Debe ser un numero el precio del 0km',
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
		'Marca' => array(
			'className' => 'Marca',
			'foreignKey' => 'marca_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Segmento' => array(
			'className' => 'Segmento',
			'foreignKey' => 'segmento_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Foto' => array(
			'className' => 'Foto',
			'foreignKey' => 'modelo_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => 'Foto.orden',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Plan' => array(
			'className' => 'Plan',
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
		),
		'Video' => array(
			'className' => 'Video',
			'foreignKey' => 'modelo_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => 'Video.orden',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Modeloseqopcion' => array(
			'className' => 'Modeloseqopcion',
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
		),
		'Modelosftopcion' => array(
			'className' => 'Modelosftopcion',
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
