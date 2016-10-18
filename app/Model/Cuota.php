<?php
App::uses('AppModel', 'Model');
/**
 * Cuota Model
 *
 * @property Planesnuevo $Planesnuevo
 */
class Cuota extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'planesnuevo_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'texto' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'orden' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
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
		'Plan' => array(
			'className' => 'Plan',
			'foreignKey' => 'planes_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
	
	function getOrdenMaximo($plan_id){
		$data_orden = $this->query('SELECT MAX(Cuota.orden) AS orden_maximo from cuotas AS Cuota WHERE Cuota.planes_id = '.$plan_id);
		return ($data_orden[0][0]['orden_maximo'] == NULL)?0:$data_orden[0][0]['orden_maximo']+1;
	}
}
