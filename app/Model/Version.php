<?php
App::uses('AppModel', 'Model');
/**
 * Version Model
 *
 * @property Modelo $Modelo
 * @property Segmento $Segmento
 * @property Planesnuevo $Planesnuevo
 * @property Planesusado $Planesusado
 */
class Version extends AppModel {

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
				'message' => 'Debe ingresar la denominación',
				'allowEmpty' => false,
				'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		/*'slug' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),*/
		'modelo_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Debe ingresar el modelo',
				'allowEmpty' => false,
				'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'segmento_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Debe ingresar el segmento',
				'allowEmpty' => false,
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
		'Modelo' => array(
			'className' => 'Modelo',
			'foreignKey' => 'modelo_id',
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
		/*'Planesnuevo' => array(
			'className' => 'Planesnuevo',
			'foreignKey' => 'version_id',
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
		'Planesusado' => array(
			'className' => 'Planesusado',
			'foreignKey' => 'version_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),*/
		'Plan' => array(
			'className' => 'Plan',
			'foreignKey' => 'version_id',
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
