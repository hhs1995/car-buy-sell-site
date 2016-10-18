<?php class SitemapsController extends AppController{
var $name = 'Sitemaps';
var $uses = array('Plan');
var $helpers = array('Time');
var $components = array('RequestHandler');
 
function index(){
			$this->layout="empty";
			$this->set('planes', $this->Plan->find('all',array('order'=>'Plan.created DESC')));
//debug logs will destroy xml format, make sure were not in drbug mode
			Configure::write ('debug', 0);
header('Content-type: text/xml');
echo "<?xml version=\"1.0\" encoding='UTF-8'?>";
}
}	?>