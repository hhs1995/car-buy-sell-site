<?php
App::uses('AppController', 'Controller');
/**
 * Planesnuevos Controller
 *
 * @property Planesnuevo $Planesnuevo
 */
class PlanesnuevosController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index($marca_id = null) {
		$this->Planesnuevo->recursive = 1;
		$params['conditions'] = array('Planesnuevo.estado'=>'Activo');
		if(!empty($marca_id)):
			$params['conditions']['Modelo.marca_id'] = $marca_id;
		endif;
		$this->set('planesnuevos', $this->Planesnuevo->find('all', $params));
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Planesnuevo->id = $id;
		if (!$this->Planesnuevo->exists()) {
			throw new NotFoundException(__('Invalid planesnuevo'));
		}
		$this->set('planesnuevo', $this->Planesnuevo->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Planesnuevo->create();
			if ($this->Planesnuevo->save($this->request->data)) {
				$this->Session->setFlash(__('The planesnuevo has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The planesnuevo could not be saved. Please, try again.'));
			}
		}
		$modelos = $this->Planesnuevo->Modelo->find('list');
		$versiones = $this->Planesnuevo->Version->find('list');
		$this->set(compact('modelos', 'versiones'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->Planesnuevo->id = $id;
		if (!$this->Planesnuevo->exists()) {
			throw new NotFoundException(__('Invalid planesnuevo'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Planesnuevo->save($this->request->data)) {
				$this->Session->setFlash(__('The planesnuevo has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The planesnuevo could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Planesnuevo->read(null, $id);
		}
		$modelos = $this->Planesnuevo->Modelo->find('list');
		$versiones = $this->Planesnuevo->Version->find('list');
		$this->set(compact('modelos', 'versiones'));
	}

/**
 * delete method
 *
 * @throws MethodNotAllowedException
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->Planesnuevo->id = $id;
		if (!$this->Planesnuevo->exists()) {
			throw new NotFoundException(__('Invalid planesnuevo'));
		}
		if ($this->Planesnuevo->delete()) {
			$this->Session->setFlash(__('Planesnuevo deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Planesnuevo was not deleted'));
		$this->redirect(array('action' => 'index'));
	}

/**
 * control_index method
 *
 * @return void
 */
	public function control_index() {
		$this->Planesnuevo->recursive = 0;
		$this->set('planesnuevos', $this->paginate());
	}

/**
 * control_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function control_view($id = null) {
		$this->Planesnuevo->id = $id;
		if (!$this->Planesnuevo->exists()) {
			throw new NotFoundException(__('Invalid planesnuevo'));
		}
		$this->set('planesnuevo', $this->Planesnuevo->read(null, $id));
	}

/**
 * control_add method
 *
 * @return void
 */
	public function control_add() {
		if ($this->request->is('post')) {
			$this->Planesnuevo->create();
			if ($this->Planesnuevo->save($this->request->data)) {
				$this->Session->setFlash(__('The planesnuevo has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The planesnuevo could not be saved. Please, try again.'));
			}
		}
		$modelos = $this->Planesnuevo->Modelo->find('list');
		$versiones = $this->Planesnuevo->Version->find('list');
		$this->set(compact('modelos', 'versiones'));
	}

/**
 * control_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function control_edit($id = null) {
		$this->Planesnuevo->id = $id;
		if (!$this->Planesnuevo->exists()) {
			throw new NotFoundException(__('Invalid planesnuevo'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Planesnuevo->save($this->request->data)) {
				$this->Session->setFlash(__('The planesnuevo has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The planesnuevo could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Planesnuevo->read(null, $id);
		}
		$modelos = $this->Planesnuevo->Modelo->find('list');
		$versiones = $this->Planesnuevo->Version->find('list');
		$this->set(compact('modelos', 'versiones'));
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
		$this->Planesnuevo->id = $id;
		if (!$this->Planesnuevo->exists()) {
			throw new NotFoundException(__('Invalid planesnuevo'));
		}
		if ($this->Planesnuevo->delete()) {
			$this->Session->setFlash(__('Planesnuevo deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Planesnuevo was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
