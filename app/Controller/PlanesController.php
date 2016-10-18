<?php
App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email'); 

/**
 * Planes Controller
 *
 * @property Plan $Plan
 */
class PlanesController extends AppController {

	public $paginate = array();
	public $find = array();
	
/**
 * index method
 *
 * @return void
 */
 

		
	public function todos($marca_id=null){
		$this->set('planes', $this->porTipo(null, $marca_id));
		$this->set('tipo', 'todos');
		$this->set('marca_id', $marca_id);
		$this->view = 'lista';
	}

	public function nuevos($marca_id=null){
		$this->set('planes', $this->porTipo('Nuevo', $marca_id));
		$this->set('tipo', 'nuevos');
		$this->set('marca_id', $marca_id);
		$this->Plan->Modelo->Marca->recursive = -1;
		$this->set('marcas',$this->Plan->Modelo->Marca->find('list'));
		$this->set('nombres_plan',$this->Plan->Modelo->Marca->find('list',array('fields'=>array('id','nombre_plan'))));
		$this->set('modelos',$this->Plan->Modelo->find('list'));
		$this->set('tipos',$this->Plan->getEnumValues('tipo'));
		$this->view = 'lista';
	}
	
	public function adjudicados($marca_id=null){
		$this->set('planes', $this->porTipo('Adjudicado', $marca_id));
		$this->set('tipo', 'adjudicados');
		$this->set('marca_id', $marca_id);
		$this->set('marcas',$this->Plan->Modelo->Marca->find('list'));
		$this->set('nombres_plan',$this->Plan->Modelo->Marca->find('list',array('fields'=>array('id','nombre_plan'))));
		$this->set('modelos',$this->Plan->Modelo->find('list'));
		$this->set('tipos',$this->Plan->getEnumValues('tipo'));
		$this->view = 'lista';
	}

	public function comenzados($marca_id=null){
		$this->set('planes', $this->porTipo('Comenzado', $marca_id));
		$this->set('tipo', 'comenzados');
		$this->set('marca_id', $marca_id);
		$this->set('marcas',$this->Plan->Modelo->Marca->find('list'));
		$this->set('nombres_plan',$this->Plan->Modelo->Marca->find('list',array('fields'=>array('id','nombre_plan'))));
		$this->set('modelos',$this->Plan->Modelo->find('list'));
		$this->set('tipos',$this->Plan->getEnumValues('tipo'));
		$this->view = 'lista';
	}
	
	public function busqueda(){						
		$conditions = array();
		$filtroSession = $this->Session->read();
		
		/*Filtro Palabras clave*/
		if(isset($this->request->data['Filtro']['keyword'])){
			if($this->request->data['Filtro']['keyword'] != ''){
				$conditions = array('MATCH
				(Plansearch.marca,Plansearch.modelo,Plansearch.denominacion,Plansearch.volanta,
				Plansearch.descripcion,Plansearch.tags,Plansearch.tipo,Plansearch.metadescription,Plansearch.nombre_plan,
				Plansearch.segmento,Plansearch.labels)
				AGAINST("'.$this->request->data['Filtro']['keyword'].'")');
				$view = true;   
			}
		}
		
		/*Filtro Precio*/
		if(isset($this->request->data['Filtro']['precioPlan'])){
			if($this->request->data['Filtro']['precioPlan'] != ''){
				$array_precios = explode('-',$this->request->data['Filtro']['precioPlan']);
				$precio_min = $array_precios[0];
				$precio_max = $array_precios[1];
				//$this->Plan->find['conditions']['Plan.tipo'] = $this->request->data['Filtro']['tipo'];
				$url_conditions['Filtro']['precioPlan'] = $this->request->data['Filtro']['precioPlan'];                   
				$conditions['Plan.precioPlan >='] = $precio_min;
				$conditions['Plan.precioPlan <='] = $precio_max;
				$view = true;                   
			}
		}
		
		// Filtro Tipo
		if(isset($this->request->data['Filtro']['tipo'])){
			if($this->request->data['Filtro']['tipo'] != ''){
				//$this->Plan->find['conditions']['Plan.tipo'] = $this->request->data['Filtro']['tipo'];
				$url_conditions['Plan.tipo'] = $this->request->data['Filtro']['tipo'];                   
				$conditions['Plan.tipo'] = $this->request->data['Filtro']['tipo'];
				$view = true;                   
			}
		}
		
		
		// Filtro Marca
		if(isset($this->request->data['Filtro']['marca_id'])){				
			if((int)$this->request->data['Filtro']['marca_id'] != ''){
				//$this->Plan->find['conditions']['Modelo.marca_id'] = $this->request->data['Filtro']['marca_id'];
				$url_conditions['Modelo.marca_id'] = $this->request->data['Filtro']['marca_id'];                   
				$conditions['Modelo.marca_id'] = $this->request->data['Filtro']['marca_id'];
				$view = true;                   
			}
		}
	
		
		// Filtro Modelo
		if(isset($this->request->data['Filtro']['modelo_id'])){
			if((int)$this->request->data['Filtro']['modelo_id'] != ''){					
				//$this->Plan->find['conditions']['Plan.modelo_id'] = $this->request->data['Filtro']['modelo_id'];
				$url_conditions['Plan.modelo_id'] = $this->request->data['Filtro']['modelo_id'];                   
				$conditions['Plan.modelo_id'] = $this->request->data['Filtro']['modelo_id'];
				$view = true;                   
			}
		}
		
		if(!empty($conditions)){
			$this->Session->write('Filtro',$conditions);		
		}
		

		$this->Plan->bindModel(array(
    'hasOne' => array(
        'Plansearch' => array(
        				'className' => 'Plansearch',
            'foreignKey' => 'plan_id'
        )
    )
  ));
    
		$this->Plan->Behaviors->attach('Containable');
		
		$planes = $this->Plan->find('all',array(
								'conditions'=>(!empty($conditions) ? $conditions : $filtroSession['Filtro']),
								'contain'=>array('Modelo'=>array('Marca'),'Plantipo','Cuota','Plansearch'),
								'order'=>(isset($conditions['Plan.tipo']) && $conditions['Plan.tipo'] == 'nuevo' ? 'Modelo.precio0km DESC' : 'Plan.precioPlan DESC')
							)
						);

		if(!empty($planes)){
			foreach($planes as $key => $Plan){
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
				
				/*if($Plan['Plan']['tipo'] == 'Nuevo'){						
					$planes[$key]['Plan']['precio_visible'] = $precioCuota1;			
				}else{
					$planes[$key]['Plan']['precio_visible'] = $Plan['Plan']['precioPlan'];
					$planes[$key]['Plan']['cuota_promedio'] = $precioCuotaPromedio;
				}*/
				$planes[$key]['Plan']['precio_visible'] = $Plan['Plan']['precioPlan'];
			}
		}
		$planes2 = array_values($planes);
		$this->set('planes',$planes2);		
		$this->set('tipos',$this->Plan->getEnumValues('tipo'));
		$this->set('marcas',$this->Plan->Modelo->Marca->find('list'));
		$this->set('modelos',$this->Plan->Modelo->find('list'));
		$this->set('filtroSession',$filtroSession);   //Uso esta variable para seguir con el filtro si me voy de la pantalla y para guardar los valores en los inputs
		$this->view = 'lista';
	}


	private function porTipo($tipo=null,$marca_id=null ){
		$this->Plan->recursive = 1;
		$params['conditions'] = array('Plan.estado'=>'Activo');
		$params['order'] = 'Plan.precioPlan DESC';
		
		/*Si es plan NUEVO se ordena por precio 0KM*/
		if(strtolower($tipo) == 'nuevo'){
			$params['order'] = 'Modelo.precio0km DESC';
		}

		switch(strtolower($tipo)):
			case 'adjudicado':
			case 'comenzado':
			case 'nuevo':
				$params['conditions']['Plan.tipo'] = $tipo;
			break;
		endswitch;
		
		if(!empty($marca_id)):
			$params['conditions']['Modelo.marca_id'] = $marca_id;
		endif;
		
		$planes = $this->Plan->find('all', $params);
		
		if(!empty($planes)){
			foreach($planes as $key => $Plan){
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
				/*
				if($Plan['Plan']['tipo'] == 'Nuevo'){						
					$planes[$key]['Plan']['precio_visible'] = $precioCuota1;			
				}else{
					$planes[$key]['Plan']['precio_visible'] = $Plan['Plan']['precioPlan'];
					$planes[$key]['Plan']['cuota_promedio'] = $precioCuotaPromedio;
				}*/
				$planes[$key]['Plan']['precio_visible'] = $Plan['Plan']['precioPlan'];
			}
		}
		return $planes;
	}
/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */

	public function ver($id = null, $tele=false, $newLayout=false)
	{
		if($newLayout){$this->view = 'vernew';}
		$this->Plan->id = $id;
		if (!$this->Plan->exists()) {
			//throw new NotFoundException(__('Invalid Plan'));
			$this->redirect(array('action'=>'invalid'));
		}
		
		/*CADA VER QUE ENTRO LE AGREGO UNA VISITA AL PLAN Y HAGO UN INSERT EN EL HISTORIAL*/
		$cant_visitas = $this->Plan->read('cant_visitas',$this->Plan->id);		
		$cant_visitas['Plan']['cant_visitas']++;
		if(!$this->Plan->saveField('cant_visitas',$cant_visitas['Plan']['cant_visitas'])){						
			$this->Session->setFlash('No se ha podido grabar la visita');
			$this->redirect('/');
		}else{
			/*HAGO UN INSERT EN EL HISTORIAL DE VISITAS*/
			App::import('Model','Historialvisita');
			$this->Historialvisita = new Historialvisita();
			$historialvisita['plan_id'] = $this->Plan->id;			
			$this->Historialvisita->save($historialvisita);
		}
		
		$this->Plan->Behaviors->attach('Containable');
		$this->Plan->contain(array('Cuota','Plantipo','Modelo'=>array('Foto','Video','Marca')));
		$Plan = $this->Plan->read(null, $id);
		$Plan['Modelo']['Marca']['denominacion_id'] = $this->slugify($Plan['Modelo']['Marca']['denominacion']);	
		
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
			$Plan['Plan']['precio_visible'] = $precioCuota1;
			$Plan['Plan']['descuento_internet'] = $precioCuota1-$Plan['Plan']['precioPlan'];
		}else{
			$Plan['Plan']['precio_visible'] = $Plan['Plan']['precioPlan'];
			$Plan['Plan']['cuota_promedio'] = $precioCuotaPromedio;
		}
		$Plan['Plan']['precio_visible'] = $Plan['Plan']['precioPlan'];
		
		
		$this->set('plan', $Plan);
		$this->set('tipo', strtolower($Plan['Plan']['tipo']));
		$this->set('marca_id', $Plan['Modelo']['marca_id']);
		
		/*Provincias*/
		App::import('Model','Provincia');
		$this->Provincia = new Provincia();
		$provincias = $this->Provincia->find('list');
		$this->set('provincias', $provincias);
		
		/*Categorias*/
		App::import('Model','Categoria');
		$this->Categoria = new Categoria();
		$ft_categorias = $this->Categoria->find('list',array('conditions'=>array('tipo'=>'Ficha Tecnica')));
		$eq_categorias = $this->Categoria->find('list',array('conditions'=>array('tipo'=>'Equipamiento')));
		
		/*Ficha tecnica*/			
			
			/*Labels*/
			App::import('Model','Label');
			$this->Label = new Label();
			$this->Label->Behaviors->attach('Containable');
			$labels = $this->Label->find('all',array('conditions'=>array()));			
			foreach($labels as $element){
				$array_labels[$element['Label']['categoria_id']][] = $element;
			}
			/*Modelosftopciones*/
			App::import('Model','Modelosftopcion');
			$this->Modelosftopcion = new Modelosftopcion();
			$this->Modelosftopcion = new Modelosftopcion();
			$this->Modelosftopcion->Behaviors->attach('Containable');
			$this->Modelosftopcion->recursive = -1;
			$modelosftopciones = $this->Modelosftopcion->find('all',array('conditions'=>array('modelo_id'=>$Plan['Modelo']['id']),'contain'=>array('Ftopcion'=>'Label')));
			
			
			foreach($modelosftopciones as $element){
				$array_ftopciones[$element['Ftopcion']['Label']['id']] = $element;
			}
						
		/*FIN Ficha tecnica*/

		/*Equipamiento*/
			App::import('Model','Modeloseqopcion');
			$this->Modeloseqopcion = new Modeloseqopcion();
			$this->Modeloseqopcion->Behaviors->attach('Containable');
			$this->Modeloseqopcion->recursive = -1;
			$modeloseqopciones = $this->Modeloseqopcion->find('all',array('conditions'=>array('modelo_id'=>$Plan['Modelo']['id']),'contain'=>array('Eqopcion'=>'Categoria')));
			foreach($modeloseqopciones as $element){
				$array_eqopciones[$element['Eqopcion']['Categoria']['id']][] = $element;
			}
		/*FIN Equipamiento*/
		
		$this->set(compact('ft_categorias','ftopciones','array_labels','array_ftopciones','eq_categorias','array_eqopciones'));
	}
	
	public function invalid(){
		$conditions = array(
			'Plan.estado'=>'Activo',
			'Plan.destacado'=>1
		);
		
		$cantidad = $this->Plan->find('count',array('conditions'=>$conditions));
		$planes = $this->Plan->find('all',array('conditions'=>$conditions));
		$random_array = array();
		if($cantidad > CANTIDAD_DESTACADOS){
			while(count($random_array) < CANTIDAD_DESTACADOS){
				$rand = rand(0,$cantidad-1);
				$random_array[$planes[$rand]['Plan']['id']] = $planes[$rand];								
			}
		}else{
			$random_array = $planes;
		}
		
		$this->set('planes',$random_array);
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @return void
 */
	public function inicio() {
		$destacados['comenzados'] = $this->Plan->destacado('comenzado');
		$destacados['nuevos'] = $this->Plan->destacado('nuevo');
		$destacados['adjudicados'] = $this->Plan->destacado('adjudicado');
		$this->set('destacados', $destacados);
		$marcas = $this->Plan->Modelo->Marca->find('list');
		$tipos = array(
					'nuevos' => 'Nuevo',
					'adjudicados' => 'Adjudicado',
					'comenzados' => 'Comenzado'					
				);
		$this->set(compact('marcas','tipos'));
		$this->set('nombres_plan',$this->Plan->Modelo->Marca->find('list',array('fields'=>array('id','nombre_plan'))));
	}
	
	

/**
 * control_index method
 *
 * @return void
 */
	public function control_index() {				
		$url_conditions = array();
		
		if(!isset($this->request->data['Filter']['limpiar']) or $this->request->data['Filter']['limpiar'] == "false"){			
			// Filter denominacion
			if (isset($this->request->data['Filter']['denominacion']) && ($this->request->data['Filter']['denominacion'] != "")){
			   $this->paginate['conditions']['upper(Plan.denominacion) LIKE concat(concat(\'%\',upper( ? )),\'%\')'] = $this->request->data['Filter']['denominacion'];
			   $url_conditions['Filter.denominacion'] = $this->request->data['Filter']['denominacion'];                 			   
			   $view = true;
			}
			if (isset($this->passedArgs['Filter.denominacion']) && ($this->passedArgs['Filter.denominacion'] != "")){
			   $this->paginate['conditions']['upper(Plan.denominacion) LIKE concat(concat(\'%\',upper( ? )),\'%\')'] = $this->passedArgs['Filter.denominacion'];
			   $url_conditions['Filter.denominacion'] = $this->passedArgs['Filter.denominacion'];                  			   
			   $view = true;
			}
			
			
			// Filter estado
			if (isset($this->request->data['Filter']['estado']) && ($this->request->data['Filter']['estado'] != "")){
			   $this->paginate['conditions']['upper(Plan.estado) LIKE concat(concat(\'%\',upper( ? )),\'%\')'] = $this->request->data['Filter']['estado'];
			   $url_conditions['Filter.estado'] = $this->request->data['Filter']['estado'];                 
			   $view = true;
			}
			if (isset($this->passedArgs['Filter.estado']) && ($this->passedArgs['Filter.estado'] != "")){
			   $this->paginate['conditions']['upper(Plan.estado) LIKE concat(concat(\'%\',upper( ? )),\'%\')'] = $this->passedArgs['Filter.estado'];
			   $url_conditions['Filter.estado'] = $this->passedArgs['Filter.estado'];                  
			   $view = true;
			}
			
			// Filter tipo
			if (isset($this->request->data['Filter']['tipo']) && ($this->request->data['Filter']['tipo'] != "")){
			   $this->paginate['conditions']['upper(Plan.tipo) LIKE concat(concat(\'%\',upper( ? )),\'%\')'] = $this->request->data['Filter']['tipo'];
			   $url_conditions['Filter.tipo'] = $this->request->data['Filter']['tipo'];                 
			   $view = true;
			}
			if (isset($this->passedArgs['Filter.tipo']) && ($this->passedArgs['Filter.tipo'] != "")){
			   $this->paginate['conditions']['upper(Plan.tipo) LIKE concat(concat(\'%\',upper( ? )),\'%\')'] = $this->passedArgs['Filter.tipo'];
			   $url_conditions['Filter.tipo'] = $this->passedArgs['Filter.tipo'];                  
			   $view = true;
			}
			
			// Filter Plan Tipo
			if(isset($this->request->data['Filter']['plantipo_id'])){
				if($this->request->data['Filter']['plantipo_id'] != ''){
					$this->paginate['conditions']['Plan.plantipo_id'] = $this->request->data['Filter']['plantipo_id'];
					$url_conditions['Filter.plantipo_id'] = $this->request->data['Filter']['plantipo_id'];                   
					$view = true;                   
				}
			}
			if(isset($this->passedArgs['Filter.plantipo_id'])){
				if($this->passedArgs['Filter.plantipo_id'] != '0'){
					$this->paginate['conditions']['Plan.plantipo_id'] = $this->passedArgs['Filter.plantipo_id'];
					$url_conditions['Filter.plantipo_id'] = $this->passedArgs['Filter.plantipo_id'];
					$view = true;                                   
				}
			}
			
			// Filter Modelos
			if(isset($this->request->data['Filter']['modelo_id'])){
				if($this->request->data['Filter']['modelo_id'] != ''){
					$this->paginate['conditions']['Plan.modelo_id'] = $this->request->data['Filter']['modelo_id'];
					$url_conditions['Filter.modelo_id'] = $this->request->data['Filter']['modelo_id'];                   
					$view = true;                   
				}
			}
			if(isset($this->passedArgs['Filter.modelo_id'])){
				if($this->passedArgs['Filter.modelo_id'] != '0'){
					$this->paginate['conditions']['Plan.modelo_id'] = $this->passedArgs['Filter.modelo_id'];
					$url_conditions['Filter.modelo_id'] = $this->passedArgs['Filter.modelo_id'];
					$view = true;                                   
				}
			}
		}
		
		
		$this->paginate['order']=array('created'=>'desc');
		$this->Plan->Behaviors->attach('Containable');
		$this->Plan->Modelo->Behaviors->attach('Containable');
		$this->paginate['contain'] = array('Modelo','Plantipo');				
		$this->set('Planes', $this->paginate());	
		$this->set('tipos',$this->Plan->getEnumValues('tipo'));
		$this->set('estados',$this->Plan->getEnumValues('estado'));
		$this->set('planestipos',$this->Plan->Plantipo->find('list'));
		$modelos_array = $this->Plan->Modelo->find('all',array(
														'join' => array(
															array(
																'table' => 'marcas',
																'alias' => 'Marca',
																'type' => 'LEFT',
																'conditions' => array(
																	'Modelo.marca_id = Marca.id'
																)
															)
														),
														'contain'=>array('Marca'),
														'order'=>('Marca.denominacion , Modelo.denominacion'),
														'fields'=>array('CONCAT(Marca.denominacion, \' - \', Modelo.denominacion,\'\') as `Modelo.denom`','Modelo.id')
													)
												);
		foreach($modelos_array as $modelo){
			$modelos[$modelo['Modelo']['id']] = $modelo[0]['Modelo.denom'];
		}
		
		$link = $this->armar_link($url_conditions);
		//debug($link);
		$this->set('modelos',$modelos);
		$this->set('url_conditions', $url_conditions);
		$this->set('link',$this->armar_link($url_conditions));
	}

/**
 * control_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function control_view($id = null) {
		$this->Plan->id = $id;
		if (!$this->Plan->exists()) {
			throw new NotFoundException(__('Invalid Plan'));
		}
		$this->set('Plan', $this->Plan->read(null, $id));
	}

/**
 * control_add method
 *
 * @return void
 */
	public function control_add() {
		if ($this->request->is('post')) {
			$this->Plan->create();
			/*Creo el Slug*/
			$this->request->data['Plan']['slug'] = $this->slugify($this->request->data['Plan']['denominacion']);			
			
			
			if ($this->Plan->save($this->request->data)) {
				/*Le asigno un Codigo Unique al azar*/					
				/*$Modelo = $this->Plan->Modelo->read(null,$this->request->data['Plan']['modelo_id']);					
				$marca_code = str_pad($Modelo['Modelo']['marca_id'], 2, "0", STR_PAD_LEFT);									 
				$modelo_code = str_pad($Modelo['Modelo']['id'], 3, "0", STR_PAD_LEFT);*/
				$plan_code = str_pad($this->Plan->id, 4, "0", STR_PAD_LEFT);
				$codigo = $plan_code;				
				$this->Plan->saveField('codigo',$codigo);

				
				$this->Session->setFlash(__('El plan se ha guardado correctamente. Recuerde completar las cuotas para finalizar la carga.'));
				$this->redirect(array('action' => 'edit',$this->Plan->id));
			} else {
				$this->Session->setFlash(__('The Plan could not be saved. Please, try again.'));
			}
		}
		
		$modelos = $this->Plan->Modelo->find('list');
		$marcas = $this->Plan->Modelo->Marca->find('list');		
		$plantipo = $this->Plan->Plantipo->find('list');
		$estados = $this->Plan->getEnumValues('estado');
		$tipos = $this->Plan->getEnumValues('tipo');


		$this->set(compact('modelos', 'marcas', 'plantipo', 'estados', 'tipos'));
	}

/**
 * control_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function control_edit($id = null) {
		$this->Plan->id = $id;
		if (!$this->Plan->exists()) {
			throw new NotFoundException(__('Invalid Plan'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			/*Creo el Slug*/
			$this->request->data['Plan']['slug'] = $this->slugify($this->request->data['Plan']['denominacion']);
			if ($this->Plan->save($this->request->data)) {
				
				/*Para volver al filtro que tenia*/
				$link = '';
				if (!empty($this->passedArgs)){
					$link = $this->armar_link($this->passedArgs);
				}
				
				$this->Session->setFlash(__('The Plan has been saved'));
				$this->redirect('/control/planes/index/'.$link);
			} else {
				$this->Session->setFlash(__('The Plan could not be saved. Please, try again.'));
				
				/*Traigo las cuotas*/
				App::import('Model','Cuota');
				$this->Cuota = new Cuota();
				$cuotas = $this->Cuota->find('all',array('conditions'=>array('Cuota.planes_id'=>$id),'recursive'=>-1));
				$this->set(compact('cuotas'));
				//Primero verifico si tiene Cuota 1 (nuevos) y Cuota Promedio (adjudicados, comenzados)
				$precioCuota1 = null;
				$precioCuotaPromedio = null;	
				if(!empty($cuotas)){		
					foreach($cuotas as $cuota){
						if($cuota['Cuota']['tipos_info'] == 'Cuota 1'){
							$precioCuota1 = $cuota['Cuota']['valor'];					
						}
						if($cuota['Cuota']['tipos_info'] == 'Cuota promedio'){
							$precioCuotaPromedio = $cuota['Cuota']['valor'];
						}
					}
				}
				
				if($this->request->data['Plan']['tipo'] == 'Nuevo'){						
					$this->request->data['Plan']['precio_visible'] = $precioCuota1;			
				}else{
					$this->request->data['Plan']['precio_visible'] = $this->request->data['Plan']['precioPlan'];
					$this->request->data['Plan']['cuota_promedio'] = $precioCuotaPromedio;
				}
				
				$this->request->data['Plan']['precio_visible'] = $this->request->data['Plan']['precioPlan'];
				
				/*Traigo el Plan Tipo*/
				$this->Plan->Plantipo->recursive = -1;
				$plantipo = $this->Plan->Plantipo->read(null,$this->request->data['Plan']['plantipo_id']);
				if(!empty($plantipo)){
					$this->request->data['Plantipo'] = $plantipo['Plantipo'];
				}				
				
			}
		} else {
			$this->request->data = $this->Plan->read(null, $id);
			
			/*Le asigno el precio y la cuota a mostrar*/

			//Primero verifico si tiene Cuota 1 (nuevos) y Cuota Promedio (adjudicados, comenzados)
			$precioCuota1 = null;
			$precioCuotaPromedio = null;	
			if(!empty($this->request->data['Cuota'])){		
				foreach($this->request->data['Cuota'] as $cuota){
					if($cuota['tipos_info'] == 'Cuota 1'){
						$precioCuota1 = $cuota['valor'];					
					}
					if($cuota['tipos_info'] == 'Cuota promedio'){
						$precioCuotaPromedio = $cuota['valor'];
					}
				}
			}
			
			if($this->request->data['Plan']['tipo'] == 'Nuevo'){						
				$this->request->data['Plan']['precio_visible'] = $precioCuota1;			
			}else{
				$this->request->data['Plan']['precio_visible'] = $this->request->data['Plan']['precioPlan'];
				$this->request->data['Plan']['cuota_promedio'] = $precioCuotaPromedio;
			}
			$this->request->data['Plan']['precio_visible'] = $this->request->data['Plan']['precioPlan'];
		}
		
		$modelos = $this->Plan->Modelo->find('list');
		$marcas = $this->Plan->Modelo->Marca->find('list');		
		$plantipo = $this->Plan->Plantipo->find('list');
		$estados = $this->Plan->getEnumValues('estado');
		$tipos = $this->Plan->getEnumValues('tipo');
		
		App::import('Model','Cuota');
		$this->Cuota = new Cuota();
		$tipos_info = $this->Cuota->getEnumValues('tipos_info');
		App::import('Model','Categoria');
		$this->Categoria = new Categoria();
		$ft_categorias = $this->Categoria->find('list',array('conditions'=>array('tipo'=>'Ficha Tecnica')));
		$eq_categorias = $this->Categoria->find('list',array('conditions'=>array('tipo'=>'Equipamiento')));

		$tipos = $this->Plan->getEnumValues('tipo');
		
		$this->set(compact('modelos', 'marcas', 'plantipo', 'estados', 'tipos','tipos_info','ft_categorias','eq_categorias'));
		
	}
	
	public function control_edit_prices(){
		if(!empty($this->data)){
			$error = false;
			$data = json_decode($this->data);
			$planes = array();
			foreach($data as $input){
				$exploded = explode('-',$input[0]);
				$plan_id = $exploded[count($exploded)-1];
				$parametro = $exploded[0];
				$valor = $input[1];
				if($parametro != 'cuota'){
					$planes[$plan_id]['Plan'][$parametro] = $valor;
				}else{
					$planes[$plan_id]['Cuotas'][$exploded[1]] = $valor;
				}
			}
			foreach($planes as $plan_id => $plan){
				$this->Plan->id = $plan_id;
				if(isset($plan['Plan'])){
					foreach($plan['Plan'] as $parametro => $valor){
						if(!$this->Plan->saveField($parametro,$valor)){$error = true;}
					}
				}
				if(isset($plan['Cuotas'])){
					foreach($plan['Cuotas'] as $cuota_id => $valor){
						$this->Plan->Cuota->id = $cuota_id;
						if(!$this->Plan->Cuota->saveField('valor',$valor)){$error = true;}
					}
				}
			}
			if($error){echo 'error';}else{echo 'ok';}
			exit;
		}
		$this->Plan->Modelo->Marca->Behaviors->attach('Containable');
		$marcas = $this->Plan->Modelo->Marca->find('all',array('fields'=>array('denominacion'),'contain'=>array('Modelo'=>array('denominacion','Plan'=>array('Cuota','Plantipo')))));		
		$this->set('marcas',$marcas);
	}

/**
 * control_delete method
 *
 * @throws MethodNotAllowedException
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function control_delete($id = null) {
		//debug($this->passedArgs);
		//exit;
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->Plan->id = $id;
		if (!$this->Plan->exists()) {
			throw new NotFoundException(__('Invalid Plan'));
		}
		if ($this->Plan->delete()) {
			$this->Session->setFlash(__('Plan deleted'));
			/*Para volver al filtro que tenia*/
			$link = '';
			if (!empty($this->passedArgs)){
				$link = $this->armar_link($this->passedArgs);
			}
			$this->redirect('/control/planes/index/'.$link);
		}
		$this->Session->setFlash(__('Plan was not deleted'));
		
		
	}
	
	public function enviar_consulta(){

		$this->autoRender = false;
		$this->layout = null;
		$mensaje = 'No se ha podido enviar la consulta correctamente';
		
		if(!empty($this->request->data)){
			/*Guardo el contacto en la base*/
			App::import('Model','Contacto');
			$this->Contacto = new Contacto();
			//var_dump($this->request->data);
			
			if(isset($this->request->data['Contacto']['origen'])){
				$comentarios = '';
				$pat = '/.+/';
				if(preg_match($pat,$this->request->data['Contacto']['origen'])){
					//$comentarios .= $this->request->data['Contacto']['origen'].' '.$this->request->data['Contacto']['comentarios'];
					$comentarios .= $this->request->data['Contacto']['comentarios'].'<br/>[Enviado desde: '.$this->request->data['Contacto']['origen'].']';
					$this->request->data['Contacto']['comentarios'] = $comentarios;
				}
				unset($this->request->data['Contacto']['origen']);
			}
			
			if($this->Contacto->save($this->request->data)){
				
				/*email al usuario*/
				$cakemail = new CakeEmail(array('charset' => 'UTF-8'));
				
				if(isset($this->request->data['Contacto']['plan_id'])){
					//Tomo la marca/concesionario del plan
					$this->Plan->Behaviors->attach('Containable');
					$plan = $this->Plan->find('first',array(
						'conditions'=>array('Plan.id'=>$this->request->data['Contacto']['plan_id']),
						'contain'=>array('Modelo'=>array('Marca'),'Plantipo')
					));
					
					switch($plan['Modelo']['marca_id']){
						case 5:
						$cakemail->viewVars(array('img_concesionario'=>'logo_dietrich.png'));
						break;
						
						case 2:
						$cakemail->viewVars(array('img_concesionario'=>'logo_dietrich.png'));
						break;
					}				
				}
				
				$cakemail->from(array('info@tuplanya.com'=>'Consultas TuPlanYa'))
						->template($this->Plan->getTemplateName($this->request->data['Contacto']['tipo']))
						->emailFormat('html')
						->to($this->request->data['Contacto']['email'])
						->bcc('lbustos@enclave.com.ar','nskolaris@enclave.com.ar') 
						->subject('Consulta Tu Plan Ya');
				
				if($cakemail->send() == true){

					$mensaje = 'TuPlanYa está procesando tu pedido.<br><br>Dentro de las próximas 24hs un profesional de nuestro equipo se contactará con vos para seguir avanzando en tu necesidad. <br><br><br>Gracias por elegir y confiar en TuPlanYa.';
					
					/*Mensaje a TuPlanYa*/
					$cakemail2 = new CakeEmail(array('charset' => 'UTF-8'));
					
					$bcc = array('lbustos@tuplanya.com','jazamendia@tuplanya.com','nskolaris@enclave.com.ar');
					
					if(isset($plan)){
						$cakemail2->viewVars(array('plan'=>$plan));
						$mails = explode(',',$plan['Modelo']['Marca']['mails']);
						if(!empty($plan['Modelo']['Marca']['mails'])){
							foreach($mails as $mail){
								array_push($bcc,$mail);
							}	
						}
					}
					
					if(isset($this->mobile)){
						$cakemail2->viewVars(array('mobile'=>true));
					}
					
					$cakemail2->from(array('info@tuplanya.com'=>'Consultas TuPlanYa'))
					->template('contacto_back')
					->emailFormat('html')
					->to('info@tuplanya.com')
					->bcc($bcc)
					->subject('Consulta Tu Plan Ya -'.$this->request->data['Contacto']['tipo'])
					->viewVars(array('contacto' => $this->request->data['Contacto']))
					->send();
				}
			}

		$this->set('resultado',$mensaje);
		$this->render('/Elements/ajax');
		}
	}
	
	function test_email(){
		$this->layout = null;
	}
	
	function todos_tele($marca_id=null){		
		$planes = $this->porTipo(null, $marca_id);
		//$this->set('marca_id', $marca_id);
		echo json_encode($planes);
		$this->Render = false;
		$this->autoRender = false;
		$this->layout = false;
	}	
	
	function nuevos_tele($marca_id=null){		
		$planes = $this->porTipo('Nuevo', $marca_id);
		//$this->set('marca_id', $marca_id);
		echo json_encode($planes);
		$this->Render = false;
		$this->autoRender = false;
		$this->layout = false;
	}	

	function adjudicados_tele($marca_id=null){		
		$planes = $this->porTipo('Adjudicado', $marca_id);
		//$this->set('marca_id', $marca_id);
		echo json_encode($planes);
		$this->Render = false;
		$this->autoRender = false;
		$this->layout = false;
	}	
	
	function comenzados_tele($marca_id=null){		
		$planes = $this->porTipo('Comenzado', $marca_id);
		//$this->set('marca_id', $marca_id);
		echo json_encode($planes);
		$this->Render = false;
		$this->autoRender = false;
		$this->layout = false;
	}
	
	function cargar_tele($categoria=0)
	{
		switch ($categoria){
			case 0:
			$this->todos_tele();
			break;
			
			case 1:
			$this->nuevos_tele();
			break;
			
			case 2:
			$this->adjudicados_tele();
			break;
			
			case 3:
			$this->comenzados_tele();
			break;
		}
	}
	
	function agregar_plansearch()
	{
		App::import('Model','Plansearch');
		$search = new Plansearch();
		App::import('Model','Modelo');
		$mmodel = new Modelo();
		$planes = $this->Plan->find('all');
		foreach ($planes as $data){
			$modelo = $mmodel->find('first',array('conditions'=>array('Modelo.id'=>$data['Plan']['modelo_id'])));
			$searchdata['Plansearch']['plan_id'] = $data['Plan']['id'];	
			$searchdata['Plansearch']['marca'] = $modelo['Marca']['denominacion'];	
			$searchdata['Plansearch']['modelo'] = $modelo['Modelo']['denominacion'];	
			$searchdata['Plansearch']['denominacion'] = $data['Plan']['denominacion'];
			$searchdata['Plansearch']['volanta'] = $data['Plan']['volanta'];	
			$searchdata['Plansearch']['descripcion'] = $data['Plan']['descripcion'];	
			$searchdata['Plansearch']['tags'] = $data['Plan']['tags'];	
			$searchdata['Plansearch']['tipo'] = $data['Plan']['tipo'];	
			$searchdata['Plansearch']['metadescription'] = '';	
			$searchdata['Plansearch']['nombre_plan'] = $modelo['Marca']['nombre_plan'];	
			$searchdata['Plansearch']['segmento'] = $modelo['Segmento']['denominacion'];	
			$searchdata['Plansearch']['labels'] = '';	
			
			$search->create();
			$search->save($searchdata);

		}
	}
	
	public function canje(){

    }

    public function venta(){

    }

    public function a_tu_medida(){

    }
}