<?php
App::uses('AppController', 'Controller');
/**
 * Planesusados Controller
 *
 * @property Planesusado $Planesusado
 */
class ModelosftopcionesController extends AppController {
	
	public function agregar_ftopcion_ajax(){
		$this->autoRender = false;
		$this->layout = null;
		
		$json['resultado'] = 0;
		$json['opcion'] = array();		
		
		if(!empty($this->request->data)){
			/*Grabo la opcion en la tabla modelosftopciones*/
			if($this->Modelosftopcion->save($this->request->data)){
				$json['resultado'] = 1;
				/*Traigo los datos de la ftopcion agregada*/
				App::import('Model','Ftopcion');
				$this->Ftopcion = new Ftopcion();
				$this->Ftopcion->id = $this->request->data['Modelosftopcion']['ftopcion_id'];			
				$json['opcion'] = $this->Ftopcion->read();
				//debug($json['opcion']);
				$json['id'] = $this->Modelosftopcion->id;
			}
		}		
		
		echo json_encode($json);
		exit;
	}
	
	function delete(){
		$this->autoRender = false;
		$this->layout = null;

		if(!empty($this->request->data)){
			$id = $this->request->data['Modelosftopcion']['id'];
			$this->Modelosftopcion->id = $id;
			if($this->Modelosftopcion->delete()){
				$resultado = 'success';
			}else{
				$resultado = 'error';
			}
		}				
		$this->set('resultado', json_encode(array('resultado'=>$resultado, 'id'=>$id)));
		$this->render('/Elements/ajax');
	}
	
	function load_ftopciones(){
		$this->autoRender = false;
		$this->layout = null;
		
		if(!empty($this->request->data)){
			$modelo_id = $this->request->data['Modelosftopcion']['modelo_id'];
			$this->Modelosftopcion->Behaviors->attach('Containable');
			$this->Modelosftopcion->recursive = -1;
			$modelosftopciones = $this->Modelosftopcion->find('all',array('conditions'=>array('modelo_id'=>$modelo_id),'contain'=>array('Ftopcion'=>array('Label'=>'Categoria'))));
			debug($modelosftopciones);
			foreach($modelosftopciones as $element){
				$array_ftopciones[$element['Ftopcion']['Label']['categoria_id']][] = $element;
			}
			debug($array_ftopciones);
		}
		
		exit;
	}	
	
}
