<?php
App::uses('AppController', 'Controller');
/**
 * Planesusados Controller
 *
 * @property Planesusado $Planesusado
 */
class PlanesusadosController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Planesusado->recursive = 0;
		$this->set('planesusados', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Planesusado->id = $id;
		if (!$this->Planesusado->exists()) {
			throw new NotFoundException(__('Invalid planesusado'));
		}
		$this->set('planesusado', $this->Planesusado->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Planesusado->create();
			if ($this->Planesusado->save($this->request->data)) {
				$this->Session->setFlash(__('The planesusado has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The planesusado could not be saved. Please, try again.'));
			}
		}
		$modelos = $this->Planesusado->Modelo->find('list');
		$this->set(compact('modelos'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->Planesusado->id = $id;
		if (!$this->Planesusado->exists()) {
			throw new NotFoundException(__('Invalid planesusado'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Planesusado->save($this->request->data)) {
				$this->Session->setFlash(__('The planesusado has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The planesusado could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Planesusado->read(null, $id);
		}
		$modelos = $this->Planesusado->Modelo->find('list');
		$this->set(compact('modelos'));
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
		$this->Planesusado->id = $id;
		if (!$this->Planesusado->exists()) {
			throw new NotFoundException(__('Invalid planesusado'));
		}
		if ($this->Planesusado->delete()) {
			$this->Session->setFlash(__('Planesusado deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Planesusado was not deleted'));
		$this->redirect(array('action' => 'index'));
	}

/**
 * control_index method
 *
 * @return void
 */
	public function control_index() {
		$this->Planesusado->recursive = 0;
		$this->set('planesusados', $this->paginate());
	}

/**
 * control_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function control_view($id = null) {
		$this->Planesusado->id = $id;
		if (!$this->Planesusado->exists()) {
			throw new NotFoundException(__('Invalid planesusado'));
		}
		$this->set('planesusado', $this->Planesusado->read(null, $id));
	}

/**
 * control_add method
 *
 * @return void
 */
	public function control_add() {
		if ($this->request->is('post')) {
			$this->Planesusado->create();
			if ($this->Planesusado->save($this->request->data)) {
				$this->Session->setFlash(__('The planesusado has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The planesusado could not be saved. Please, try again.'));
			}
		}
		$modelos = $this->Planesusado->Modelo->find('list');
		$this->set(compact('modelos'));
	}

/**
 * control_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function control_edit($id = null) {
		$this->Planesusado->id = $id;
		if (!$this->Planesusado->exists()) {
			throw new NotFoundException(__('Invalid planesusado'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Planesusado->save($this->request->data)) {
				$this->Session->setFlash(__('The planesusado has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The planesusado could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Planesusado->read(null, $id);
		}
		$modelos = $this->Planesusado->Modelo->find('list');
		$this->set(compact('modelos'));
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
		$this->Planesusado->id = $id;
		if (!$this->Planesusado->exists()) {
			throw new NotFoundException(__('Invalid planesusado'));
		}
		if ($this->Planesusado->delete()) {
			$this->Session->setFlash(__('Planesusado deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Planesusado was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
