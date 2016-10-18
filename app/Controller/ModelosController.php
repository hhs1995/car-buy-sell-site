<?php
App::uses('AppController', 'Controller');
/**
 * Versiones Controller
 *
 * @property Version $Version
 */
class ModelosController extends AppController {

	public $paginate = array();
	public $components = array('Upload');

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
			   $this->paginate['conditions']['upper(Modelo.denominacion) LIKE concat(concat(\'%\',upper( ? )),\'%\')'] = $this->request->data['Filter']['denominacion'];
			   $url_conditions['Filter.denominacion'] = $this->request->data['Filter']['denominacion'];                 			   
			   $view = true;
			}
			if (isset($this->passedArgs['Filter.denominacion']) && ($this->passedArgs['Filter.denominacion'] != "")){
			   $this->paginate['conditions']['upper(Modelo.denominacion) LIKE concat(concat(\'%\',upper( ? )),\'%\')'] = $this->passedArgs['Filter.denominacion'];
			   $url_conditions['Filter.denominacion'] = $this->passedArgs['Filter.denominacion'];                  			   
			   $view = true;
			}
			
			// Filter Marca
			if(isset($this->request->data['Filter']['marca_id'])){
				if($this->request->data['Filter']['marca_id'] != ''){
					$this->paginate['conditions']['Modelo.marca_id'] = $this->request->data['Filter']['marca_id'];
					$url_conditions['Filter.marca_id'] = $this->request->data['Filter']['marca_id'];                   
					$view = true;                   
				}
			}
			if(isset($this->passedArgs['Filter.marca_id'])){
				if($this->passedArgs['Filter.marca_id'] != '0'){
					$this->paginate['conditions']['Modelo.marca_id'] = $this->passedArgs['Filter.marca_id'];
					$url_conditions['Filter.marca_id'] = $this->passedArgs['Filter.marca_id'];
					$view = true;                                   
				}
			}
			
			// Filter Segmento
			if(isset($this->request->data['Filter']['segmento_id'])){
				if($this->request->data['Filter']['segmento_id'] != ''){
					$this->paginate['conditions']['Modelo.segmento_id'] = $this->request->data['Filter']['segmento_id'];
					$url_conditions['Filter.segmento_id'] = $this->request->data['Filter']['segmento_id'];                   
					$view = true;                   
				}
			}
			if(isset($this->passedArgs['Filter.segmento_id'])){
				if($this->passedArgs['Filter.segmento_id'] != '0'){
					$this->paginate['conditions']['Modelo.segmento_id'] = $this->passedArgs['Filter.segmento_id'];
					$url_conditions['Filter.segmento_id'] = $this->passedArgs['Filter.segmento_id'];
					$view = true;                                   
				}
			}
		}
		
		$this->Modelo->Behaviors->attach('Containable');
		$this->paginate['contain'] = array('Marca','Segmento');
		$this->set('Modelos', $this->paginate());
		$this->set('marcas',$this->Modelo->Marca->find('list'));
		$this->set('segmentos',$this->Modelo->Segmento->find('list'));
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
		$this->Modelo->id = $id;
		if (!$this->Modelo->exists()) {
			throw new NotFoundException(__('Invalid Modelo'));
		}
		$this->set('Modelo', $this->Modelo->read(null, $id));
	}

/**
 * control_add method
 *
 * @return void
 */
	public function control_add() {
		if ($this->request->is('post')) {
			$this->Modelo->create();
			//debug($this->request->data);
			//exit;
			/*Me fijo si cargo alguna imagen (principal)*/
			if(!empty($this->request->data['Modelo']['imagen']['tmp_name'])){
				srand((double)microtime()*1000000); 
				$path = UPLOAD_IMG_PATH_MODELOS.'principal/';
				$random =  rand(0,8000);
				$titulo_filename = str_replace(' ','-',$this->request->data['Modelo']['denominacion']); 
				$name = 'img-'.$titulo_filename.'-'.$random.'.jpg';				
				$imagen = $this->Upload->upload($this->request->data['Modelo']['imagen'],$path, $name, array('type' => 'resize', 'size' => IMG_MODELOS_PRINCIPAL_WIDTH, 'output' => 'jpg'));
				if($imagen){
					$imgOk = false;
					$this->log("Error uploading imagen: " .
					implode(" | ", $this->Upload->errors),'upload');
				}else{
					$this->request->data['Modelo']['imagen'] = $name;
				}
			}

			// Creo el slug automaticamente 
			$this->request->data['Modelo']['slug'] = $this->slugify($this->request->data['Modelo']['denominacion']); 
			if ($this->Modelo->save($this->request->data)) {
				$this->Session->setFlash(__('The Modelo has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Modelo could not be saved. Please, try again.'));
			}
		}
		$marcas = $this->Modelo->Marca->find('list');
		$segmentos = $this->Modelo->Segmento->find('list');
		$this->set(compact('marcas','segmentos'));
	}

/**
 * control_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function control_edit($id = null) {
		$this->Modelo->id = $id;
		if (!$this->Modelo->exists()) {
			throw new NotFoundException(__('Invalid Modelo'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			
			if(!empty($this->request->data['Modelo']['imagen']['tmp_name'])){				
				srand((double)microtime()*1000000); 
				$ext = substr(strrchr($this->request->data['Modelo']['imagen']['type'], "/"), 1);
				$path = UPLOAD_IMG_PATH_MODELOS.'principal/';
				$random =  rand(0,8000);
				$titulo_filename = str_replace(' ','-',$this->request->data['Modelo']['denominacion']); 
				$name = 'img-'.$titulo_filename.'-'.$random.'.'.$ext;				
				$imagen = $this->Upload->upload($this->request->data['Modelo']['imagen'],$path, $name, array('type' => 'resize', 'size' => IMG_MODELOS_PRINCIPAL_WIDTH, 'output' => 'png'));
				if($imagen){
					$imgOk = false;
					$this->log("Error uploading imagen: " .
					implode(" | ", $this->Upload->errors),'upload');
				}else{
					$this->request->data['Modelo']['imagen'] = $name;
				}
			}else{
				$this->request->data['Modelo']['imagen'] = $this->request->data['Modelo']['imagen_anterior'];
			}
			
			// Creo el slug automaticamente 
			$this->request->data['Modelo']['slug'] = $this->slugify($this->request->data['Modelo']['denominacion']); 
			if ($this->Modelo->save($this->request->data)) {
				
				/*Para volver al filtro que tenia*/
				$link = '';
				if (!empty($this->passedArgs)){
					$link = $this->armar_link($this->passedArgs);
				}
				
				$this->Session->setFlash(__('The Modelo has been saved'));
				$this->redirect('/control/modelos/index/'.$link);
			} else {
				$this->Session->setFlash(__('The Modelo could not be saved. Please, try again.'));
				
				/*Vuelvo a traer los videos y las fotos*/
				$videos = $this->Modelo->Video->find('all',array('conditions'=>array('Video.modelo_id'=>$id)));				
				$fotos = $this->Modelo->Foto->find('all',array('conditions'=>array('Foto.modelo_id'=>$id)));				
				foreach($videos as $video){
					$this->request->data['Video'][] = $video['Video'];
				}
				foreach($fotos as $foto){
					$this->request->data['Foto'][] = $foto['Foto'];
				}			
				
				/*Guardo la imagen anterior*/
				$this->request->data['Modelo']['imagen_anterior'] = $this->request->data['Modelo']['imagen'];
				
				
				
			}
		} else {
			$this->request->data = $this->Modelo->read(null, $id);
			$this->request->data['Modelo']['imagen_anterior'] = $this->request->data['Modelo']['imagen'];
			
		}
		
		$marcas = $this->Modelo->Marca->find('list');
		$segmentos = $this->Modelo->Segmento->find('list');
		
		/*Categorias*/
		App::import('Model','Categoria');
		$this->Categoria = new Categoria();
		$ft_categorias = $this->Categoria->find('list',array('conditions'=>array('tipo'=>'Ficha Tecnica')));
		$eq_categorias = $this->Categoria->find('list',array('conditions'=>array('tipo'=>'Equipamiento')));
		
		/*Equipamiento*/
		
		App::import('Model','Eqopcion');
		$this->Eqopcion = new Eqopcion();
		$this->Eqopcion->Behaviors->attach('Containable');
		$eqopciones = $this->Eqopcion->find('all',array('contain'=>array('Categoria')));
		foreach($eqopciones as $element){
			$array_eqopciones[$element['Categoria']['id']][] = $element;
		}
					
		App::import('Model','Modeloseqopcion');
		$this->Modeloseqopcion = new Modeloseqopcion();
		$this->Modeloseqopcion->Behaviors->attach('Containable');
		$this->Modeloseqopcion->recursive = -1;
		$modeloseqopciones = $this->Modeloseqopcion->find('all',array('conditions'=>array('modelo_id'=>$id),'contain'=>array('Eqopcion'=>'Categoria')));			
			
		/*FIN Equipamiento*/
		
		/*Ficha tecnica*/
		App::import('Model','Modelosftopcion');
		$this->Modelosftopcion = new Modelosftopcion();
		$this->Modelosftopcion->Behaviors->attach('Containable');
		$this->Modelosftopcion->recursive = -1;
		$modelosftopciones = $this->Modelosftopcion->find('all',array('conditions'=>array('modelo_id'=>$id),'contain'=>array('Ftopcion'=>array('Label'=>'Categoria'))));
		
		foreach($modelosftopciones as $element){
			if(isset($element['Ftopcion']['Label']['categoria_id'])){
				$array_ftopciones[$element['Ftopcion']['Label']['categoria_id']][] = $element;
			}
		}
		
		$this->set(compact('marcas','segmentos','ft_categorias','eq_categorias','array_ftopciones','array_eqopciones','eqopciones','modeloseqopciones'));
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
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->Modelo->id = $id;
		if (!$this->Modelo->exists()) {
			throw new NotFoundException(__('Invalid Modelo'));
		}
		if ($this->Modelo->delete()) {
			$this->Session->setFlash(__('Modelo deleted'));
			/*Para volver al filtro que tenia*/
			$link = '';
			if (!empty($this->passedArgs)){
				$link = $this->armar_link($this->passedArgs);
			}
			$this->redirect('/control/modelos/index/'.$link);
		}
		$this->Session->setFlash(__('Modelo was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
	
	public function cargarModelosPorMarca(){
		$this->autoRender = false;
		$this->layout = null;
		$modelos = array(''=>'No hay modelos disponibles');
		
		if(!empty($this->data['Modelo']['marca_id'])){
			$marca_id = $this->data['Modelo']['marca_id'];
			$modelos = $this->Modelo->find('list',array('conditions'=>array('marca_id'=>$marca_id)));
		}
		
		echo json_encode((!empty($modelos) ? $modelos : array(''=>'No hay modelos disponibles')));
		
	}
	
	public function AddCategoriaEquipamiento(){
		$this->autoRender = false;
		$this->layout = null;
		
		if(!empty($this->data)){
			$json['resultado'] = 0;
			App::import('Model','Eqopcion');
			$this->Eqopcion = new Eqopcion();
			if($this->Eqopcion->save($this->data)){
				$json['resultado'] = 1;
				$json['id'] = $this->Eqopcion->id;
			}
			echo json_encode($json);
		}
		exit;
	}
}

	
