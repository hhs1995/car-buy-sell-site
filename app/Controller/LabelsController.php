<?php
App::uses('AppController', 'Controller');

class LabelsController extends AppController{

	public function cargarLabelsPorCategoria()
	{
		$this->autoRender = false;
		$this->layout = null;
		$labels = array(''=>'No hay Labels disponibles');
		
		if(!empty($this->request->data['Label']['categoria_id'])){
			$ids = '';
			$categoria_id = $this->request->data['Label']['categoria_id'];
			
			if(!empty($this->request->data['Label']['ids'])){
			$ids = explode(',',$this->request->data['Label']['ids']);			
			}
			
			$conditions = array('Label.categoria_id'=>$categoria_id);			
			
			/*Si ids no viene vacio, saca esos labels*/
			if(!empty($ids)){
				$conditions['NOT']['Label.id'] = $ids; 
			}
			
			$labels = $this->Label->find('list',array('conditions'=>$conditions,'fields'=>array('id','denominacion')));
		}
		
		echo json_encode((!empty($labels) ? $labels : array(''=>'No hay labels disponibles')));
	}
	
	public function AddLabel()
	{
		$this->autoRender = false;
		$this->layout = null;
		$json['resultado'] = 0;
		
		if($this->Label->save($this->data)){
			$json['resultado'] = 1;
		}
		
		echo json_encode($json);
		exit;
	}

}
