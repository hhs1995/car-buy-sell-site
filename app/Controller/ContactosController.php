<?php
App::uses('AppController', 'Controller');
/**
 * Contactos Controller
 *
 * @property Contactos $Contacto
 */
class ContactosController extends AppController {
	
	var $paginate = array();
	
	public function control_index(){
		$url_conditions = array();
		if(!isset($this->request->data['Filter']['limpiar']) or $this->request->data['Filter']['limpiar'] == "false"){			
			
			// Filter Tipo
			if(isset($this->request->data['Filter']['tipo'])){
				if($this->request->data['Filter']['tipo'] != ''){
					$this->paginate['conditions']['Contacto.tipo'] = $this->request->data['Filter']['tipo'];
					$url_conditions['Filter.tipo'] = $this->request->data['Filter']['tipo'];                   
					$view = true;                   
				}
			}
			if(isset($this->passedArgs['Filter.tipo'])){
				if($this->passedArgs['Filter.tipo'] != '0'){
					$this->paginate['conditions']['Contacto.tipo'] = $this->passedArgs['Filter.tipo'];
					$url_conditions['Filter.tipo'] = $this->passedArgs['Filter.tipo'];
					$view = true;                                   
				}
			}
			
			// Filtro Fecha desde
			if(isset($this->request->data['Filter']['fecha_desde'])){
				if($this->request->data['Filter']['fecha_desde'] != ''){
					$fecha_formateada = date('Y-m-d h:i:s', strtotime($this->request->data['Filter']['fecha_desde']));
					$this->paginate['conditions']['Contacto.created >= ?'] = $fecha_formateada.' 00:00:00';
					$url_conditions['Filter.fecha_desde'] = str_replace('/','-',$this->request->data['Filter']['fecha_desde']);										
				}
			}
			if(isset($this->passedArgs['Filter.fecha_desde'])){
				if($this->passedArgs['Filter.fecha_desde'] != ''){
					$fecha_formateada = date('Y-m-d h:i:s', strtotime($this->passedArgs['Filter.fecha_desde']));					
					$this->paginate['conditions']['Contacto.created >= ?'] = $fecha_formateada.' 00:00:00';
					$url_conditions['Filter.fecha_desde'] = str_replace('/','-',$this->passedArgs['Filter.fecha_desde']);					
				}
			}

			// Filtro Fecha hasta
			if(isset($this->request->data['Filter']['fecha_hasta'])){
				if($this->request->data['Filter']['fecha_hasta'] != ''){
					$fecha_formateada = date('Y-m-d h:i:s', strtotime($this->request->data['Filter']['fecha_hasta']));
					$this->paginate['conditions']['Contacto.created <= ?'] = $fecha_formateada.' 23:59:59';
					$url_conditions['Filter.fecha_hasta'] = str_replace('/','-',$this->request->data['Filter']['fecha_hasta']);					
				}
			}
			if(isset($this->passedArgs['Filter.fecha_hasta'])){
				if($this->passedArgs['Filter.fecha_hasta'] != ''){
					$fecha_formateada = date('Y-m-d h:i:s', strtotime($this->passedArgs['Filter.fecha_hasta']));
					$this->paginate['conditions']['Contacto.created <= ?'] = $fecha_formateada.' 23:59:59';
					$url_conditions['Filter.fecha_hasta'] = str_replace('/','-',$this->passedArgs['Filter.fecha_hasta']);
				}
			}
			
			// Filter estado
			if(isset($this->request->data['Filter']['estado'])){
				if($this->request->data['Filter']['estado'] != ''){
					$this->paginate['conditions']['Contacto.estado'] = $this->request->data['Filter']['estado'];
					$url_conditions['Filter.estado'] = $this->request->data['Filter']['estado'];                   
					$view = true;                   
				}
			}
			if(isset($this->passedArgs['Filter.estado'])){
				if($this->passedArgs['Filter.estado'] != '0'){
					$this->paginate['conditions']['Contacto.estado'] = $this->passedArgs['Filter.estado'];
					$url_conditions['Filter.estado'] = $this->passedArgs['Filter.estado'];
					$view = true;                                   
				}
			}
						
		}
		
		$this->paginate['order'] = 'Contacto.created DESC';
		$this->Contacto->Behaviors->attach('Containable');	
		$this->set('tipos',$this->Contacto->getEnumValues('tipo'));	
		$this->set('Contactos', $this->paginate());				
		$this->set('url_conditions', $url_conditions);
		$this->set('link',$this->armar_link($url_conditions));
	}
	
	public function control_delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->Contacto->id = $id;
		if (!$this->Contacto->exists()) {
			throw new NotFoundException(__('Invalid Contacto'));
		}
		if ($this->Contacto->delete()) {
			$this->Session->setFlash(__('Contacto deleted'));
			/*Para volver al filtro que tenia*/
			$link = '';
			if (!empty($this->passedArgs)){
				$link = $this->armar_link($this->passedArgs);
			}
			$this->redirect('/control/contactos/index/'.$link);
		}
		$this->Session->setFlash(__('Contacto was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
	
	
	public function control_view($id = null) {
		
		App::import('Model','Contactohistorial');
		$this->Contactohistorial = new Contactohistorial();
		
		$this->Contacto->id = $id;
		if (!$this->Contacto->exists()) {
			throw new NotFoundException(__('Invalid Contacto'));
		}
		
		/*Para volver al filtro que tenia*/
		$link = '';
		if (!empty($this->passedArgs)){
			$link = $this->armar_link($this->passedArgs);
		}
		
		
		$this->set('tipos',$this->Contactohistorial->getEnumValues('tipo'));		
		$this->set('estados',$this->Contactohistorial->getEnumValues('estado'));
				$this->set('estadoscontacto',$this->Contacto->getEnumValues('estado'));			
		$this->set('Contacto', $this->Contacto->read(null));
		$this->set('link',$link);
		$this->set('id',$this->Contacto->id);		
		
		
	}
	
	public function control_guardarDescripcion()
	{
		App::import('Model','Contactohistorial');
		$this->Contactohistorial = new Contactohistorial();
		$this->Contactohistorial->create();

		if ($this->Contactohistorial->save($this->data))
		{
			$json['resultado'] = 1;			
			$this->Contactohistorial->recursive=-1;			
			$json['Contactohistorial']=$this->Contactohistorial->read(null,$this->Contactohistorial->id);
			$date = date_create($json['Contactohistorial']['Contactohistorial']['created']);
			$fecha = date_format($date,'d-m-Y H:i:s');
			$json['fecha'] = $fecha;
			
		}
		else 
		{
			$json['resultado'] = 0;
		}		
		echo json_encode($json); 		
		$this->render(false);
		
	}
	
	
	public function control_grabarDescripcion()
	{
		App::import('Model','Contactohistorial');
		$this->Contactohistorial = new Contactohistorial();

		$this->Contactohistorial->id = $this->data['Contactohistorial']['id'];
		if ($this->Contactohistorial->saveField('texto', $this->data['Contactohistorial']['descripcion']))
		{
		echo 'ok';
		}
		else {
			echo 'salio mal';}		
		$this->render(false);
		
	}
	public function control_grabarEstado()
	{
		App::import('Model','Contactohistorial');
		$this->Contactohistorial = new Contactohistorial();

		$this->Contactohistorial->id = $this->data['Contactohistorial']['id'];
		if ($this->Contactohistorial->saveField('estado', $this->data['Contactohistorial']['estado']))
		{
		echo 'ok';
		}
		else {
			echo 'salio mal';}		
		$this->render(false);
		
	}	
	public function control_grabarTipo()
	{
		App::import('Model','Contactohistorial');
		$this->Contactohistorial = new Contactohistorial();

		$this->Contactohistorial->id = $this->data['Contactohistorial']['id'];
		if ($this->Contactohistorial->saveField('tipo', $this->data['Contactohistorial']['tipo']))
		{
		echo 'ok';
		}
		else {
			echo 'salio mal';}		
		$this->render(false);
		
	}
	
		public function control_cambiarstatus()
	{
		$this->Contacto->id = $this->data['Contacto']['id'];
		if ($this->Contacto->saveField('estado', $this->data['Contacto']['estado']))
		{
		echo 'ok';
		}
		else {
			echo 'salio mal';}		
		$this->render(false);
		
	}
	
	public function control_eliminarHistorial()
	{
		App::import('Model','Contactohistorial');
		$this->Contactohistorial = new Contactohistorial();

		$this->Contactohistorial->id = $this->data['Contactohistorial']['id'];
		
		if (!$this->Contactohistorial->exists()) {
			throw new NotFoundException(__('Invalid Historial'));
		}
		if ($this->Contactohistorial->delete()) {
			$this->Session->setFlash(__('Historial deleted'));
		}
		$this->render(false);		
	}	
	
	
	
	
}