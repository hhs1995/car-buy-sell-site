<?php
App::uses('AppModel', 'Model');
/**
 * Planesusado Model
 *
 * @property Modelo $Modelo
 * @property Version $Version
 * @property Plantipo $Plantipo
 */
class Plan extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'denominacion';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'denominacion' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Debe ingresar la denominación del plan',
				'allowEmpty' => false,
				'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'slug' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Slug Incorrecto',
				'allowEmpty' => false,
				'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'modelo_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message'=>'El modelo no es correcto',
				'allowEmpty' => false,
				'required' => true,
			),
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Debe ingresar un modelo',
				'allowEmpty' => false,
				'required' => true,
			)
		),
		'descripcion' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Debe ingresar la descripción',
				'allowEmpty' => false,
				'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),		
		'tipo' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Debe ingresar el tipo de plan',
				'allowEmpty' => false,
				'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'cuotaPura' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'El precio de la Cuota Pura no es correcto',
				'allowEmpty' => false,
				'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Debe ingresar el precio de la Cuota pura',
				'allowEmpty' => false,
				'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),		
		'plantipo_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'El tipo de plan no es correcto',
				'allowEmpty' => false,
				'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Debe ingresar el tipo de plan',
				'allowEmpty' => false,
				'required' => true,
			)
		),
		'cuotasCantidad' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'La cantidad de cuotas no es correcta',
				'allowEmpty' => false,
				'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Debe ingresar el la cantidad de cuotas',
				'allowEmpty' => false,
				'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			
			
			
		),
		'cuotasPagas' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'La cantidad de cuotas pagas no es correcta',
				'allowEmpty' => false,
				'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Debe ingresar la cantidad de cuotas pagas',
				'allowEmpty' => false,
				'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		)
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
		'Plantipo' => array(
			'className' => 'Plantipo',
			'foreignKey' => 'plantipo_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
	public $hasMany = array(
		'Cuota' => array(
			'className' => 'Cuota',
			'foreignKey' => 'planes_id',
			'conditions' => '',
			'fields' => '',
			'order' => 'Cuota.orden'
		),
		'Contacto' => array(
			'className' => 'Contacto',
			'foreignKey' => 'plan_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
	);
	
	
	

	
	public function destacado($tipo=null,$marca_id=null, $cantidad=CANTIDAD_DESTACADOS ){
		$this->recursive = 1;
		$params['conditions'] = array('Plan.estado'=>'Activo','Plan.destacado'=>1);

		switch(strtolower($tipo)):
			case 'adjudicado':
			case 'comenzado':
			case 'nuevo':
				$params['conditions']['Plan.tipo'] = $tipo;
			break;
		endswitch;
		$params['limit'] = $cantidad;
		
		if(!empty($marca_id)):
			$params['conditions']['Modelo.marca_id'] = $marca_id;
		endif;				
		
		$cantidad = $this->find('count',array('conditions'=>$params['conditions']));		
		$destacados = $this->find('all',array('conditions'=>$params['conditions']));
		$random_array = array();

		if($cantidad > CANTIDAD_DESTACADOS){
			while(count($random_array) < CANTIDAD_DESTACADOS){
				$rand = rand(0,$cantidad-1);
				$random_array[$destacados[$rand]['Plan']['id']] = $destacados[$rand];								
			}
		}else{
			$random_array = $destacados;
		}
		
		if(!empty($random_array)){
			foreach($random_array as $key => $Plan){
				/*Le asigno el precio y la cuota a mostrar*/
				
				//Primero verifico si tiene Cuota 1 (nuevos) y Cuota Promedio (adjudicados, comenzados)
				$precioCuota1 = null;
				$precioCuotaPromedio = null;	
				if(!empty($Plan['Cuota'])){		
					foreach($Plan['Cuota'] as $cuota){
						if($cuota['tipos_info'] == 'Cuota 1'){
							$precioCuota1 = $cuota['valor'];					
						}
						if($cuota['tipos_info'] == 'Cuota promedio'){
							$precioCuotaPromedio = $cuota['valor'];
						}
					}
				}
				
				if($Plan['Plan']['tipo'] == 'Nuevo'){						
					$random_array[$key]['Plan']['precio_visible'] = $precioCuota1;			
				}else{
					$random_array[$key]['Plan']['precio_visible'] = $Plan['Plan']['precioPlan'];
					$random_array[$key]['Plan']['cuota_promedio'] = $precioCuotaPromedio;
				}
			}
		}
		
		return $random_array;
	}
	
	public function getTemplateName($template = null){
		$array_templates = array(
			'Contacto' => 'contacto',
			'Venta' => 'venta',
			'Canje' => 'canje',
			'Preguntas Frecuentes' => 'preguntas_frecuentes',
			'Plan a tu medida' => 'a_tu_medida',
			'Consulta Plan' => 'consulta_plan',
			'Grandes Clientes' => 'grandes_clientes',
			'Consulta Popup' => 'consulta_plan'
		);
		
		return $array_templates[$template];
	}
	
	public function aftersave()
	{
		App::import('Model','Plansearch');
		$search = new Plansearch();
		
		if (!empty($this->data['Plan']['modelo_id']))
		{
			$cantidad = $search->find('count',array('conditions'=>array('plan_id'=>$this->data['Plan']['id'])));
			if ($cantidad<1){
				App::import('Model','Modelo');
				$mmodel = new Modelo();
				$modelo = $mmodel->find('first',array('conditions'=>array('Modelo.id'=>$this->data['Plan']['modelo_id'])));
				
		
				$searchdata['Plansearch']['plan_id'] = $this->id;	
				$searchdata['Plansearch']['marca'] = $modelo['Marca']['denominacion'];	
				$searchdata['Plansearch']['modelo'] = $modelo['Modelo']['denominacion'];	
				$searchdata['Plansearch']['denominacion'] = $this->data['Plan']['denominacion'];
				$searchdata['Plansearch']['volanta'] = $this->data['Plan']['volanta'];	
				$searchdata['Plansearch']['descripcion'] = $this->data['Plan']['descripcion'];	
				$searchdata['Plansearch']['tags'] = $this->data['Plan']['tags'];	
				$searchdata['Plansearch']['tipo'] = $this->data['Plan']['tipo'];	
				$searchdata['Plansearch']['metadescription'] = '';	
				$searchdata['Plansearch']['nombre_plan'] = $modelo['Marca']['nombre_plan'];	
				$searchdata['Plansearch']['segmento'] = $modelo['Segmento']['denominacion'];	
				$searchdata['Plansearch']['labels'] = '';	
				
				$search->save($searchdata);}
		}
	}
	
	
}
