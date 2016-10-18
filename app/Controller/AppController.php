<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

var $components = array('RequestHandler','Session');
var $helpers = array(
        'Html',
        'Form',
        'Session',
        'Text',
		'Thumbnail'
    );

/**
 * slugify method
 *
 * @throws NotFoundException
 * @param string $text
 * @return string
 */
	static public function slugify($text)
	{ 
	  // replace non letter or digits by -
	  $text = preg_replace('~[^\\pL\d]+~u', '-', $text);
	  // trim
	  $text = trim($text, '-');
	  // transliterate
	  $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
	  // lowercase
	  $text = strtolower($text);
	  // remove unwanted characters
	  $text = preg_replace('~[^-\w]+~', '', $text);
	  if (empty($text))
	  {
		return 'n-a';
	  }
	  return $text;
	}
	
	function _checkAdmin() {				
		if (!$this->Session->check('Admin'))
        {        	
			if ($this->RequestHandler->isAjax()) {
        	 	$this->layout = 'ajax';
        	 	$json = array();
        	 	$json['status'] = -2; /* deslogueado */
        	 	$json['mensaje'] = 'Usuario / Clave incorrectas.';
        	 	echo json_encode($json);
        	 	exit();
        	}else{
        		$this->redirect(array('controller'=>'admins','action'=>'login'));
            	exit();
        	}
        	
        }
	
	}
	
	function checkPlatform(){
		App::import('Vendor', 'mobile/Mobile_Detect');
		$detect = new Mobile_Detect;
		if($detect->isMobile()) {
			$this->layout = 'mobile';
			$this->mobile = true;
			$this->set('mobile',true);
			return 'mobile';
		}
		return 'default';
	}
	
	function beforeRender(){
		if($this->checkPlatform()=='mobile'){
			$viewDir = App::path('View');
			$mobileViewFile = $viewDir[0].$this->viewPath.'/mobile/'.$this->view.'.ctp';
			if (file_exists($mobileViewFile)) {
				$this->viewPath .= DS.'mobile';
			}
		}
	}
	
	public function beforeFilter(){
		$this->checkPlatform();
		
		if (isset($this->request->params['prefix']) && $this->request->params['prefix'] == 'control' &&  $this->name!='Admins' && $this->action!='login' && $this->action!='logout') {				
			$this->_checkAdmin();
		}        

        if (isset($this->request->params['control'])) {
        	$this->layout = 'control';
        }
		
		/* * * * * AGREGADO PARA CHEQUEAR EL EXPLORADOR * * * * */
    	
    	$user_agent = $_SERVER['HTTP_USER_AGENT'];
		$navegadores = array(  
			'Opera' => 'Opera',  
			'Mozilla Firefox'=> '(Firebird)|(Firefox)',  
			'Galeon' => 'Galeon',  
			'Mozilla'=>'Gecko',  
			'MyIE'=>'MyIE',  
			'Lynx' => 'Lynx',  
			'Netscape' => '(Mozilla/4\.75)|(Netscape6)|(Mozilla/4\.08)|(Mozilla/4\.5)|(Mozilla/4\.6)|(Mozilla/4\.79)',  
			'Konqueror'=>'Konqueror',
			'IE9' => '(MSIE 9\.[0-9]+)',  
			'IE8' => '(MSIE 8\.[0-9]+)',
			'IE7' => '(MSIE 7\.[0-9]+)',  
			'IE6' => '(MSIE 6\.[0-9]+)',  
			'IE5' => '(MSIE 5\.[0-9]+)',  
			'IE4' => '(MSIE 4\.[0-9]+)',  
		);  
		$out = 'Desconocido';
		foreach($navegadores as $navegador=>$pattern){  
			if (eregi($pattern, $user_agent) and $out == 'Desconocido'){
				$out = $navegador;
			}	  
		}  
		(!defined('NAVEGADOR') ? define('NAVEGADOR', $out) : '');		
		
		/*Provincias*/
        App::import('Model','Provincia');
        $this->Provincia = new Provincia();
        $provincias = $this->Provincia->find('list');
        $this->set('provincias', $provincias);
        $plan = array(
            'Plan' => array(
                'id' => null
            )
        );
        $this->set('plan', $plan);
	
	}
	
	function armar_link($options){
    	
		$link = "";
    	
    	foreach($options as $key => $option){
    		$link .= $key . ":" . $option . "/";
    	}

		return $link;
    }

	function conversion($page){
		$conversion_data = Configure::read('conversion.data');
		$this->set('data',$conversion_data[$page]);
		$this->layout = 'ajax';
		return $this->render('/Pages/conversion');
	}
}