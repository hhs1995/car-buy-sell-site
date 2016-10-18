<?php
App::uses('AppController', 'Controller');
//App::import('Vendor', 'ValumsFileUploader');

/**
 * Versiones Controller
 *
 * @property Version $Version
 */
class FotosController extends AppController {

	public $paginate = array();
	public $components = array('Image');
	
	public function grabarOrden(){
		$this->autoRender = false;
		$this->layout = false;
		$resultado = 'success';		
		//var_dump($this->params['form']['imagenes']);
		$imagenes_str = $this->request->data['imagenes'];
		$imagenes_arr = explode(',', $imagenes_str);
		$data['Foto']['modelo_id'] = $this->request->data['modelo'];
		$data['Foto']['orden'] = 1;		
		foreach($imagenes_arr as $imagen):
			$id = substr($imagen, strrpos($imagen,'_')+1);
			if(!empty($id)):
				$this->Foto->create();
				$this->Foto->id = $id;
				if (!$this->Foto->save($data)):
					$resultado = 'error';
				endif;
			$data['Foto']['orden']++;
			endif;
		endforeach;
		$this->set('resultado', json_encode(array('resultado'=>$resultado, 'orden'=>$imagenes_arr)));
		$this->render('/Elements/ajax');
	}
	
	function imageAdd() {		
		//Configure::write('debug',0);
		$resultado = 'error';
		$this->autoRender = false;
		$this->layout = false;
		srand((double)microtime()*1000000); 
		$random =  rand(0,8000); 
		$name_id = $this->request->data['Foto']['modelo_id'];
		$id = null;
		if (!empty($this->request->data)) {
			// Desactivamos el rendering de la vista para este m?todo
			if (isset($this->request->data['Foto']['File'])){								
				$tamanios = array(
								'big'=>array(
									'width'=>800,
									'height'=>600
								),
								'thumb'=>array(
									'width' => 80,
									'height' => 60
								)
							);
				$thumb = $this->Image->upload_image_and_thumbnail($this->request->data['Foto']['File'],'name', UPLOAD_IMG_PATH_MODELOS,$name_id,$tamanios);				
				// Si no se crea correctamente
				if (!isset($thumb)){
					// Generamos un log con los errores
					$this->log("Error uploading imagen (thumb): " .
						implode(" | ", $this->Upload->errors),'upload');
				}else{
					// Si la miniatura se ha creado subimos el fichero a tama?o original
						$this->request->data['Foto']['archivo'] = $thumb;
						$this->request->data['Foto']['orden'] = $this->Foto->getOrdenMaximo($this->request->data['Foto']['modelo_id']);
						$this->Foto->create();
						// Si la imagen se sube correctamente enviamos el nombre de ?sta al usuario
						//echo $this->Upload->result;
						if ($this->Foto->save($this->request->data)) {
							$id = $this->Foto->id;
							//$this->Session->setFlash(__('The media has been saved', true));
							$resultado =  'success';
						} else {
							//$this->Session->setFlash(__('The media could not be saved. Please, try again.', true));
							$resultado =  'error';
						}
												
					}
				}
									
		}
		
		$this->set('resultado', "{resultado:'".$resultado."', filename: '".$thumb."', id:".$id."}");	
		$this->render('/Elements/ajax');
	}
	
	public function mediaDelete(){
		$this->autoRender = false;
		$this->layout = false;
		if(!empty($this->request->data)):
			$id = intval($this->request->data['Foto']['id']);
			if (!$file = $this->Foto->read('archivo',$id)) {
				//$this->Session->setFlash(__('Invalid id for media', true));
				$this->set('resultado', "{resultado:'error', mensaje:'Id de foto invalida'}");
			}	
			
			if ($this->Foto->delete($id)) {
				if(is_file(WWW_ROOT.UPLOAD_IMG_PATH.$file)):
						unlink(WWW_ROOT.UPLOAD_IMG_PATH.$file);
				endif;
				
				$this->set('resultado', "{resultado:'success', id: ".$id."}");
			}	
		endif;
		$this->render('/Elements/ajax');
	}
	
	public function mediaEdit(){
		$this->autoRender = false;
		$this->layout = false;
		//var_dump($this->request->data);
		if(!empty($this->request->data)):
			$id = intval($this->request->data['Foto']['id']);
			if (!$file = $this->Foto->read('data',$id)) {
				$this->Session->setFlash(__('Invalid id for media', true));
				$this->set('resultado', "{resultado:'error'}");
			}	
			if ($this->Foto->save($this->request->data)) {
//				unlink(ROOT.UPLOAD_IMG_PATH_THUMB.$file);
//				unlink(ROOT.UPLOAD_IMG_PATH_BIG.$file);
				$this->set('resultado', "{resultado:'success', id: ".$id."}");
			}	
		endif;
		$this->render('/elements/ajax');
	}
	
}
