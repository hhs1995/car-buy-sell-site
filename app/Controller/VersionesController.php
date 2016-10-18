<?php
App::uses('AppController', 'Controller');
/**
 * Versiones Controller
 *
 * @property Version $Version
 */
class VersionesController extends AppController {

	public $paginate = array();
/**
 * control_index method
 *
 * @return void
 */
	public function control_index() {
		$this->Version->Behaviors->attach('Containable');
		$this->paginate['contain'] = array('Modelo'=>'Marca','Segmento');
		$this->set('versiones', $this->paginate());
	}

/**
 * control_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function control_view($id = null) {
		$this->Versione->id = $id;
		if (!$this->Versione->exists()) {
			throw new NotFoundException(__('Invalid version'));
		}
		$this->set('version', $this->Versione->read(null, $id));
	}

/**
 * control_add method
 *
 * @return void
 */
	public function control_add() {
		if ($this->request->is('post')) {
			$this->Version->create();
			// Creo el slug automaticamente 
			$this->request->data['Version']['slug'] = $this->slugify($this->request->data['Version']['denominacion']); 
			if ($this->Version->save($this->request->data)) {
				$this->Session->setFlash(__('The version has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The version could not be saved. Please, try again.'));
			}
		}
		
		$modelos = $this->Version->Modelo->find('list');
		$segmentos = $this->Version->Segmento->find('list');
		$transmisiones = $this->Version->getEnumValues('transmision');
		$combustibles = $this->Version->getEnumValues('combustible');
		$this->set(compact('modelos', 'segmentos','transmisiones','combustibles'));
	}

/**
 * control_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function control_edit($id = null) {
		$this->Version->id = $id;
		if (!$this->Version->exists()) {
			throw new NotFoundException(__('Invalid version'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			// Creo el slug automaticamente 
			$this->request->data['Modelo']['slug'] = $this->slugify($this->request->data['Version']['denominacion']); 
			if ($this->Version->save($this->request->data)) {
				$this->Session->setFlash(__('The version has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The version could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Version->read(null, $id);
		}
		$modelos = $this->Version->Modelo->find('list');
		$segmentos = $this->Version->Segmento->find('list');
		$this->set(compact('modelos', 'segmentos'));
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
		$this->Version->id = $id;
		if (!$this->Version->exists()) {
			throw new NotFoundException(__('Invalid version'));
		}
		if ($this->Version->delete()) {
			$this->Session->setFlash(__('Version deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Version was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
	
	public function cargarVersionesPorModelo(){
		$this->autoRender = false;
		$this->layout = null;
		$versiones = array(''=>'No hay versiones disponibles');
		
		if(!empty($this->data['Version']['modelo_id'])){
			$modelo_id = $this->data['Version']['modelo_id'];
			$versiones = $this->Version->find('list',array(
													'conditions'=>array(
														'modelo_id'=>$modelo_id
													)
												)
											);
		}
		
		echo json_encode((!empty($versiones) ? $versiones : array(''=>'No hay versiones disponibles')));
		
	}
}
