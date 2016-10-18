<?php
App::uses('AppController', 'Controller');
/**
 * Planesusados Controller
 *
 * @property Planesusado $Planesusado
 */
class FiltrosController extends AppController {

	public function filtro(){
		
		$mensaje = '';
		/*Si filtro por el codigo del plan*/
		if(!empty($this->request->data['Filtro']['codigo'])){
			$codigo = $this->request->data['Filtro']['codigo'];
			App::import('Model','Plan');
			$this->Plan = new Plan();
			$plan = $this->Plan->find('first',array('conditions'=>array('Plan.codigo'=>$codigo),'recursive'=>-1,'fields'=>array('id','slug')));
			/*Lo mando al ver con el id ingresado.*/
			if(empty($plan)){
				$array_url = array(
					'controller'=>'planes',
					'action'=>'ver',
					$codigo
				);
			}else{
				$array_url = array(
					'controller'=>'planes',
					'action'=>'ver',
					'id'=>$plan['Plan']['id'],
					'slug'=>$plan['Plan']['slug']
				);
			}
			
			$this->redirect($array_url);			
		}
		
		
		
		if(!empty($this->request->data)){
			$action = (!empty($this->request->data['Filtro']['tipo']) ? $this->request->data['Filtro']['tipo'] : 'nuevos');
			$marca_id = $this->request->data['Filtro']['marca_id'];
			$this->redirect(array('controller'=>'planes','action'=>$action,$marca_id));
		}
		
		$this->redirect('/');
		
	}
	
}
