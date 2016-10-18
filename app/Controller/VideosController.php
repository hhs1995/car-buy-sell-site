<?php
App::uses('AppController', 'Controller');
/**
 * Versiones Controller
 *
 * @property Version $Version
 */
class VideosController extends AppController {

	public $paginate = array();
	/*var $components = array('Image');*/
	
	function grabarOrden(){
		$this->autoRender = false;
		$this->layout = false;
		$resultado = 'success';		
		//var_dump($this->params['form']['imagenes']);
		$videos_str = $this->request->data['videos'];
		$videos_arr = explode(',', $videos_str);
		$data['Video']['modelo_id'] = $this->request->data['modelo'];
		$data['Video']['orden'] = 1;		
		foreach($videos_arr as $video):
			$id = substr($video, strrpos($video,'_')+1);
			if(!empty($id)):
				$this->Video->create();
				$this->Video->id = $id;
				if (!$this->Video->save($data)):
					$resultado = 'error';
				endif;
			$data['Video']['orden']++;
			endif;
		endforeach;
		$this->set('resultado', json_encode(array('resultado'=>$resultado, 'orden'=>$videos_arr)));
		$this->render('/Elements/ajax');
	}
		
	function addVideo()
	{
		$id = $this->request->data['id'];
		$url_video = $this->request->data['url_video'];
		$texto_video = $this->request->data['texto_video'];
		if(isset($id) && isset($url_video))
		{
			//var_dump($id)
			if(!empty($id) && !empty($url_video))
			{					
				//agarro los ultimos 11 digitos del link youtube(id del video en el embed)
				$id_url_video = $this->Video->parseYoutubeId($url_video);
				$existe = @fopen($url_video,'r');
				if($existe == true)
				{
					$params = array(
						'conditions' => array('modelo_id = '.$id),
						'recursive' => 1,
						'fields' => array('max(Video.orden) as orden')
					
					);
					$max = $this->Video->find('first',$params);

					if($max[0]['orden'] == '')
					{
						$orden = 1;
					}else{
	
						$orden = ++$max[0]['orden'];
					}
					$this->Video->create();
					$video['modelo_id'] = $id;					
					$video['archivo'] = $id_url_video;
					$video['orden'] = $orden;
					$video['texto'] = $texto_video;

					if(!$this->Video->save($video))
					{
						$json['resultado'] = 'Error';
					
					}else{
						
						$id_nuevo = $this->Video->id;
						$json['resultado'] = 'Exito';					
						$json['mensaje'] = 
					'<li id="vid_el_'.$id_nuevo.'" class="item_video">												
						<img title="'.$video['texto'].'" src="http://i1.ytimg.com/vi/'.$video['archivo'].'/default.jpg">						
						<ul class="herramientas">
							<li title="Borrar" class="ui-state-default ui-corner-all"><a href = "javascript:void(0)" onclick="vid.del('.$id_nuevo.','.$video['modelo_id'].')" ><span class="ui-icon ui-icon-close"></span></a></li>
						</ul>
					</li>';	
					
	
					}				
				
				//si no existe la url del video
				}else{
					$json['resultado'] = 'Error';
					$json['mensaje'] = 'URL inválida';
					//var_dump($json);
				}	
			
			//si no escribio nada en el campo url
			}else{
				
				$json['resultado'] = 'Error';
				$json['mensaje'] = 'Error. Debe ingresar la url del video'; 
			}
		
		//si no fueron seteadas las variables
		}else{
			$json['resultado'] = 'Error';
			$json['mensaje'] = 'Error. Debe ingresar la url del video'; 
		}
		
		echo json_encode($json);
		exit(0);

	}
	
	function videoDelete(){
		//var_dump($this->request->data);
		$this->autoRender = false;
		$this->layout = false;
		
		if(!empty($this->request->data)):
			$id = intval($this->request->data['Video']['id']);
			if (!$file = $this->Video->read('archivo',$id)) {
				//$this->Session->setFlash(__('Invalid id for media', true));
				$this->set('resultado', "{resultado:'error', mensaje:'Id de foto invalida'}");
			}	
			
			if ($this->Video->delete($id)) {
				if(is_file(WWW_ROOT.UPLOAD_IMG_PATH.$file)):
						unlink(WWW_ROOT.UPLOAD_IMG_PATH.$file);
				endif;
				
				$this->set('resultado', "{resultado:'success', id: ".$id."}");
			}else{
				$this->set('resultado', "{resultado:'error', id: ".$id."}");
			}	
		endif;
		$this->render('/Elements/ajax');
	}
	
	function videoEdit(){
		$this->autoRender = false;
		$this->layout = false;
		//var_dump($this->data->request);
		if(!empty($this->data->request)):
			$id = intval($this->data->request['Foto']['id']);
			if (!$file = $this->Foto->read('data',$id)) {
				$this->Session->setFlash(__('Invalid id for media', true));
				$this->set('resultado', "{resultado:'error'}");
			}	
			if ($this->Foto->save($this->data->request)) {
//				unlink(ROOT.UPLOAD_IMG_PATH_THUMB.$file);
//				unlink(ROOT.UPLOAD_IMG_PATH_BIG.$file);
				$this->set('resultado', "{resultado:'success', id: ".$id."}");
			}	
		endif;
		$this->render('/Elements/ajax');
	}
	
	function grabar_texto(){
		$this->autoRender = false;
		$this->layout = false;
		$resultado = 0;
		if(!empty($this->data->request)){
			$this->Foto->id = $this->data->request['Foto']['modelo_id'];
			if($this->Foto->saveField('texto',$this->data->request['Foto']['texto'])){
				$resultado = 1;
				$mensaje = 'El texto se ha guardado con éxito';
			}
		}else{
			$mensaje = 'Data inválida';
		}
		echo json_encode($json = array('resultado'=>$resultado,'mensaje'=>$mensaje));
		$this->render('/Elements/ajax');
		exit(0);

	}
}
