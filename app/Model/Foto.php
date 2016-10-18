<?php
App::uses('AppModel', 'Model');
/**
 * Foto Model
 *
 * @property Modelo $Modelo
 */
class Foto extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'modelo_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
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
		'archivo' => array(
			'notempty' => array(
				'rule' => array('notempty'),
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
		'Modelo' => array(
			'className' => 'Modelo',
			'foreignKey' => 'modelo_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
	function getOrdenMaximo($modelo_id){
		$data_orden = $this->query('SELECT MAX(Foto.orden) AS orden_maximo from fotos AS Foto WHERE Foto.modelo_id = '.$modelo_id);
		return ($data_orden[0][0]['orden_maximo'] == NULL)?0:$data_orden[0][0]['orden_maximo']+1;
	}
	
	function getFotosNotaOrdenadas($modelo_id){
		$this->recursive = -1;
		return $this->find('all',array('conditions'=>array('modelo_id'=>$modelo_id),'order'=>'Foto.orden'));
	}
	
	function forzarMedidas($image = array()){
		$heightForzadoSlider = 265;
		$heightForzadoDestacado1 = 140;
		$widthForzadoDestacado2 = 175;		
		if(!empty($image) && is_array($image)){
			$info = getimagesize($image['tmp_name']);								
			$tamanios_forzados['slider']['height'] = $heightForzadoSlider;			
			$tamanios_forzados['slider']['width'] = floor(($heightForzadoSlider * $info[0]) / $info[1]);
			$tamanios_forzados['destacado1']['height'] = $heightForzadoDestacado1;				
			$tamanios_forzados['destacado1']['width'] = floor(($heightForzadoDestacado1 * $info[0]) / $info[1]);
			$tamanios_forzados['destacado2']['width'] = $widthForzadoDestacado2;				
			$tamanios_forzados['destacado2']['height'] = floor(($widthForzadoDestacado2 * $info[1]) / $info[0]);
			
		}
		return $tamanios_forzados;
	}
}
