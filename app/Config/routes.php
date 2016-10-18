<?php
/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different urls to chosen controllers and their actions (functions).
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
 * @package       app.Config
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
/**
 * Here, we are connecting '/' (base path) to controller called 'Pages',
 * its action called 'display', and we pass a param to select the view file
 * to use (in this case, /app/View/Pages/home.ctp)...
 */
	Router::connect('/', array('controller' => 'planes', 'action' => 'inicio'));
/**
 * ...and connect the rest of 'Pages' controller's urls.
 */
	Router::connect('/pages/*', array('controller' => 'pages', 'action' => 'display'));
	
	/*Admin*/
	
	Router::connect('/control',array('controller'=>'planes', 'action'=>'contactos','control'=>true));

	Router::connect('/planes-de-ahorro', array('controller' => 'planes', 'action' => 'todos'));
	Router::connect('/canjea-tu-plan-ya', array('controller' => 'planes', 'action' => 'canje'));
	Router::connect('/vende-tu-plan-ya', array('controller' => 'planes', 'action' => 'venta'));
	Router::connect('/preguntas-frecuentes', array('controller' => 'pages', 'action' => 'preguntas_frecuentes'));
	Router::connect('/contacto', array('controller' => 'pages', 'action' => 'contacto'));
	Router::connect('/grandes-clientes', array('controller' => 'pages', 'action' => 'grandes_clientes'));
	Router::connect('/nosotros', array('controller' => 'pages', 'action' => 'nosotros'));
	Router::connect('/plan-a-tu-medida', array('controller' => 'planes', 'action' => 'a_tu_medida'));
	
	Router::connect('/planes-de-ahorro/nuevos', array('controller' => 'planes', 'action' => 'nuevos'));
	Router::connect('/planes-de-ahorro/nuevos', array('controller' => 'planes', 'action' => 'nuevos',0));
	Router::connect('/planes-de-ahorro/nuevos/volkswagen', array('controller' => 'planes', 'action' => 'nuevos', VW));
	Router::connect('/planes-de-ahorro/nuevos/fiat', array('controller' => 'planes', 'action' => 'nuevos', FIAT));
	Router::connect('/planes-de-ahorro/nuevos/peugeot', array('controller' => 'planes', 'action' => 'nuevos', PEUGEOT));
	Router::connect('/planes-de-ahorro/nuevos/citroen', array('controller' => 'planes', 'action' => 'nuevos', CITROEN));
	Router::connect('/planes-de-ahorro/nuevos/ford', array('controller' => 'planes', 'action' => 'nuevos', FORD));
	Router::connect('/planes-de-ahorro/nuevos/chevrolet', array('controller' => 'planes', 'action' => 'nuevos', CHEVY));
	Router::connect('/planes-de-ahorro/nuevos/renault', array('controller' => 'planes', 'action' => 'nuevos', RENAULT));
	
	Router::connect('/planes-de-ahorro/adjudicados', array('controller' => 'planes', 'action' => 'adjudicados'));
	Router::connect('/planes-de-ahorro/adjudicados', array('controller' => 'planes', 'action' => 'adjudicados',0));
	Router::connect('/planes-de-ahorro/adjudicados/volkswagen', array('controller' => 'planes', 'action' => 'adjudicados', VW));
	Router::connect('/planes-de-ahorro/adjudicados/fiat', array('controller' => 'planes', 'action' => 'adjudicados', FIAT));
	Router::connect('/planes-de-ahorro/adjudicados/peugeot', array('controller' => 'planes', 'action' => 'adjudicados', PEUGEOT));
	Router::connect('/planes-de-ahorro/adjudicados/citroen', array('controller' => 'planes', 'action' => 'adjudicados', CITROEN));
	Router::connect('/planes-de-ahorro/adjudicados/ford', array('controller' => 'planes', 'action' => 'adjudicados', FORD));
	Router::connect('/planes-de-ahorro/adjudicados/chevrolet', array('controller' => 'planes', 'action' => 'adjudicados', CHEVY));
	Router::connect('/planes-de-ahorro/adjudicados/renault', array('controller' => 'planes', 'action' => 'adjudicados', RENAULT));
	
	Router::connect('/planes-de-ahorro/comenzados', array('controller' => 'planes', 'action' => 'comenzados'));
	Router::connect('/planes-de-ahorro/comenzados', array('controller' => 'planes', 'action' => 'comenzados',0));
	Router::connect('/planes-de-ahorro/comenzados/volkswagen', array('controller' => 'planes', 'action' => 'comenzados', VW));
	Router::connect('/planes-de-ahorro/comenzados/fiat', array('controller' => 'planes', 'action' => 'comenzados', FIAT));
	Router::connect('/planes-de-ahorro/comenzados/peugeot', array('controller' => 'planes', 'action' => 'comenzados', PEUGEOT));
	Router::connect('/planes-de-ahorro/comenzados/citroen', array('controller' => 'planes', 'action' => 'comenzados', CITROEN));
	Router::connect('/planes-de-ahorro/comenzados/ford', array('controller' => 'planes', 'action' => 'comenzados', FORD));
	Router::connect('/planes-de-ahorro/comenzados/chevrolet', array('controller' => 'planes', 'action' => 'comenzados', CHEVY));
	Router::connect('/planes-de-ahorro/comenzados/renault', array('controller' => 'planes', 'action' => 'comenzados', RENAULT));
	
	Router::connect('/amarok', array('controller' => 'planes', 'action' => 'ver', 91, false, true));
	
	Router::connect('/plan-de-ahorro/:id-:slug',array('controller' => 'planes', 'action' => 'ver'),array('pass' => array('id','slug'),'id' => '[0-9]+'));
	
	Router::parseExtensions('rss','xml');  //parse XML extension
	Router::connect('/sitemap', array('controller' => 'sitemaps', 'action' => 'index')); //rewrite URL
/**
 * Load all plugin routes.  See the CakePlugin documentation on 
 * how to customize the loading of plugin routes.
 */
	CakePlugin::routes();

/**
 * Load the CakePHP default routes. Only remove this if you do not want to use
 * the built-in default routes.
 */
	require CAKE . 'Config' . DS . 'routes.php';
