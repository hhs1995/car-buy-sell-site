<?php
App::uses('AppController', 'Controller');
/**
 * Planesusados Controller
 *
 * @property Planesusado $Planesusado
 */
class LectorController extends AppController {

	
	public function planes(){
		
			$file = "http://planes.demotores.com.ar/planes-ahorro-autos/cZ2QQspZ1?view=jsonfacets";
			$data = file_get_contents($file);
			$ar = json_decode($data);
			var_dump($ar->selectable[0]); // MARCA
			//var_dump($ar->selectable[4]); // SEGMENTO
			exit;
	
	
	
	}


	public function modelo(){
		$marcas = array(
			array('id' => 1, 'url' =>'/planes-ahorro-autos-fiat/cZ35QQspZ1'), //Fiat
			array('id' => 2, 'url' =>'/planes-ahorro-autos-volkswagen/cZ92QQspZ1'), //Volsk
			array('id' => 3, 'url' =>'/planes-ahorro-autos-chevrolet/cZ23QQspZ1'), //Chevy
			array('id' => 4, 'url' =>'/planes-ahorro-autos-renault/cZ80QQspZ1'), //Renault
			array('id' => 5, 'url' =>'/planes-ahorro-autos-ford/cZ36QQspZ1'), //Ford
			array('id' => 6, 'url' =>'/planes-ahorro-autos-citroen/cZ25QQspZ1'), //Citroen
			array('id' => 7, 'url' =>'/planes-ahorro-autos-peugeot/cZ73QQspZ1') //Peugeot
		);

		
		App::import('Model', 'Modelo');
		$modeloModel = new Modelo();
		
		foreach($marcas as $marca){
			var_dump("http://planes.demotores.com.ar".$marca['url']."?view=jsonfacets");
			$file = "http://planes.demotores.com.ar".$marca['url']."?view=jsonfacets";
			$data = file_get_contents($file);
			$ar = json_decode($data);
			$modelosSite =$ar->selectable[0]->slices;
			foreach($modelosSite as $modelo){
				var_dump($modelosSite);
				$i = array();
				$i['marca_id'] =$marca['id'];
				$i['denominacion'] = $modelo->label;
				$i['slug'] = $this->slugify($modelo->label);
				var_dump($modelo->label);
				$modeloModel->create();
				$modeloModel->save($i);
		
			}
		}	
		exit;
		
	}
	
	public function segmento(){
	

		$file = "http://autos.demotores.com.ar/nuevos/autos/vtZ1QQcoZ27QQpgZ1?view=jsonfacets";
		$data = file_get_contents($file);
		$ar = json_decode($data);
		App::import('Model', 'Segmento');
		$segmentoModel = new Segmento();
		foreach( $ar->selectable[1]->slices as $segmento):
			$segmentoModel->create();
			$i=array();
			$i['denominacion'] = $segmento->label;
			//$i['slug'] = $this->slugify($segmento->label);
			$segmentoModel->save($i);
			var_dump($i);
		endforeach;
		//var_dump($ar->selectable[1]->slices);
		//$gestor = fopen("http://autos.demotores.com.ar/nuevos/autos/vtZ1QQcoZ27QQpgZ1?view=jsonfacets", "r");
		
		exit;
	
	}

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
