<?php
App::uses('AppController', 'Controller');
/**
 * Planesusados Controller
 *
 * @property Planesusado $Planesusado
 */
class ModeloseqopcionesController extends AppController {
	
	public function agregar_eqopcion_ajax(){
		$this->autoRender = false;
		$this->layout = null;
		
		$json['resultado'] = 0;
		
		if(!empty($this->request->data)){
			$modelo_id = $this->request->data['Modeloseqopcion']['modelo_id'];
			
			/*Armo el array para guardar todas las eqopciones de ese modelo*/
			$eqopciones = $this->request->data['Modeloseqopcion']['eqopciones'];
			$array_eqopciones = explode(',',$eqopciones);			
			
			if(!empty($array_eqopciones)){				
				/*Borro primero todas las eqopciones de ese modelo*/
				if($this->Modeloseqopcion->deleteAll(array('Modeloseqopcion.modelo_id'=>$modelo_id))){					
					$errores = 0;
					foreach($array_eqopciones as $eqopcion){
						/*Grabo las opciones en la tabla modeloseqopciones*/
						$this->Modeloseqopcion->create();
						$modeloseqopcion = array(
												'Modeloseqopcion'=>array(
													'modelo_id' => $modelo_id,
													'eqopcion_id' => $eqopcion
												)
											);
						
						if(!$this->Modeloseqopcion->save($modeloseqopcion)){
							$errores++;
						}
					}
				}
								
			}
		}		
		
		($errores == 0 ? $json['resultado'] = 1 : $resultado = 0);
		echo json_encode($json);
		exit;
	}
	
	function delete(){
		$this->autoRender = false;
		$this->layout = null;

		if(!empty($this->request->data)){
			$id = $this->request->data['Modeloseqopcion']['id'];
			$this->Modeloseqopcion->id = $id;
			if($this->Modeloseqopcion->delete()){
				$resultado = 'success';
			}else{
				$resultado = 'error';
			}
		}				
		$this->set('resultado', json_encode(array('resultado'=>$resultado, 'id'=>$id)));
		$this->render('/Elements/ajax');
	}
	
	function load_eqopciones(){
		$this->autoRender = false;
		$this->layout = null;
		
		if(!empty($this->request->data)){
			$modelo_id = $this->request->data['Modeloseqopcion']['modelo_id'];
			$this->Modeloseqopcion->Behaviors->attach('Containable');
			$this->Modeloseqopcion->recursive = -1;
			$modeloseqopciones = $this->Modeloseqopcion->find('all',array('conditions'=>array('modelo_id'=>$modelo_id),'contain'=>array('Ftopcion'=>array('Label'=>'Categoria'))));
			foreach($modeloseqopciones as $element){
				$array_eqopciones[$element['Ftopcion']['Label']['categoria_id']][] = $element;
			}
			debug($array_eqopciones);
		}
		
		exit;
	}	
	
}
