<?php
App::uses('AppController', 'Controller');
/**
 * Planesusados Controller
 *
 * @property Planesusado $Planesusado
 */
class CuotasController extends AppController {

	public function agregar_por_ajax(){
		$this->autoRender = false;
		$this->layout = null;
		$resultado = array('exito'=>0,'mensaje'=>'Error. No se ha podido grabar la cuota','cuota'=>-1);		
		
		if(!empty($this->request->data)){			
			$this->request->data['Cuota']['orden'] = $this->Cuota->getOrdenMaximo($this->request->data['Cuota']['planes_id']);
			if($this->Cuota->save($this->request->data)){
				/*Le asigno el id a la cuota*/
				$this->request->data['Cuota']['id'] = $this->Cuota->id;
				$resultado = array('exito'=>1,'mensaje'=>'Se ha agregado la cuota con exito','cuota'=>$this->request->data);				
			}
		}
		
		
		echo json_encode($resultado);
		exit();
	}
	
	public function grabarOrden(){
		$this->autoRender = false;
		$this->layout = false;
		$resultado = 'success';		
		//var_dump($this->params['form']['imagenes']);
		$cuotas_str = $this->request->data['cuotas'];
		$cuotas_arr = explode(',', $cuotas_str);
		$data['Cuota']['plan_id'] = $this->request->data['plan'];
		$data['Cuota']['orden'] = 1;		
		foreach($cuotas_arr as $cuota):
			$id = substr($cuota, strrpos($cuota,'_')+1);
			if(!empty($id)):
				$this->Cuota->create();
				$this->Cuota->id = $id;
				if (!$this->Cuota->save($data)):
					$resultado = 'error';
				endif;
			$data['Cuota']['orden']++;
			endif;
		endforeach;
		$this->set('resultado', json_encode(array('resultado'=>$resultado, 'orden'=>$cuotas_arr)));
		$this->render('/Elements/ajax');
	}
	
	function delete(){
		$this->autoRender = false;
		$this->layout = null;
		
		if(!empty($this->request->data)){
			$id = $this->request->data['Cuota']['id'];
			$this->Cuota->id = $id;
			if($this->Cuota->delete()){
				$resultado = 'success';
			}else{
				$resultado = 'error';
			}
		}				
		$this->set('resultado', json_encode(array('resultado'=>$resultado, 'id'=>$id)));
		$this->render('/Elements/ajax');
	}
	
}
