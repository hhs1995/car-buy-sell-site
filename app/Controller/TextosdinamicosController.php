<?php
App::uses('AppController', 'Controller');
/**
 * textos dinamicos Controller
 *
 * @property Contactos $Contacto
 */
class TextosdinamicosController extends AppController {
	
	var $paginate = array();
	var $uses = array('Textosdinamico');	
	
	public function control_index(){

		$this->paginate['order'] = 'Textosdinamico.nombre';
		$this->set('Textosdinamicos', $this->paginate());				
	}
	
	public function control_editar()
	{
		$this->Textosdinamico->id = $this->data['Textosdinamico']['id'];
		
		if ($this->Textosdinamico->saveField('valor', $this->data['Textosdinamico']['valor']))
		{
		echo 'ok';
		}
		else 
		{
		echo 'salio mal';
		}		
		$this->render(false);
		
	}	
	
	public function get($nombre) 
    {
        // Si la petición fue realizada por medio de requestAction

        if(isset($this->params['requested'])) {
            return $this->Textosdinamico->find('first',array('conditions'=>array('Textosdinamico.nombre'=>$nombre)));
      		}
}
}