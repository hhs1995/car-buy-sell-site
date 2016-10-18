<?php
App::uses('AppController', 'Controller');

class MarcasController extends AppController{

	public $paginate = array();

	public function control_index()
	{
		$url_conditions = array();		
		$this->Marca->recursive = -1;
		$this->set('Marcas', $this->paginate());
		$this->set('url_conditions', $url_conditions);
		$this->set('link',$this->armar_link($url_conditions));
	}

	public function control_edit($id = null)
	{
		$this->Marca->id = $id;
		
		if(!$this->Marca->exists()){
			throw new NotFoundException(__('Invalid Marca'));
		}
		
		if($this->request->is('post') || $this->request->is('put')){
			if($this->Marca->save($this->request->data)){
				$link = '';
				if (!empty($this->passedArgs)){
					$link = $this->armar_link($this->passedArgs);
				}
				$this->Session->setFlash(__('The Marca has been saved'));
				$this->redirect('/control/Marcas/index/'.$link);
			}else{
				$this->Session->setFlash(__('The Marca could not be saved. Please, try again.'));
			}
		}else{
			$this->request->data = $this->Marca->read(null,$id);
		}
	}
}