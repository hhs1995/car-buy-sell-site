<?php
App::uses('AppController', 'Controller');
/**
 * Planesusados Controller
 *
 * @property Planesusado $Planesusado
 */
class FtopcionesController extends AppController {
	
	public function cargar_opciones_por_label(){
		//debug($this->request->query);		
		$json = array();
		$ftopciones = array();
		
		if(!empty($this->request->query['label'])){
			$label_id = $this->request->query['label'];
			$string = $this->request->query['name_startsWith'];
			$ftopciones = $this->Ftopcion->find('all',array('conditions'=>array(
																'Ftopcion.label_id'=>$label_id,
																'Ftopcion.denominacion LIKE' => $string.'%'
															),
															'fields'=>array('id','denominacion')));
			if(!empty($ftopciones)){
				foreach($ftopciones as $opcion){
					$json[] = array('label'=>$opcion['Ftopcion']['denominacion'],'value'=>$opcion['Ftopcion']['id']);
				} 
			}
		}
		
		echo json_encode($json);
		exit;
	}
	
	public function agregar_ftopcion_ajax(){
		$this->autoRender = false;
		$this->layout = null;
		
		$json['resultado'] = 0;
		$json['id'] = -1;

		if(!empty($this->request->data)){
			if($this->Ftopcion->save($this->request->data)){
				$json['resultado'] = 1;
				$json['id'] = $this->Ftopcion->id;
			}
		}
		
		echo json_encode($json);
		exit;
	}
	
}
