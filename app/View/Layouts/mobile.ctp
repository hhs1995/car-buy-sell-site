<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php echo $this->Html->charset(); ?>
	<title><?php echo $title_for_layout;?></title>
	<meta name="google-site-verification" content="4Iyca2TwBYFr2C0OI2x8ui6uLboKLwTe7DJR7AkCMi4" />
	<meta name="viewport" content="user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, width=device-width, target-densitydpi=medium-dpi" />
	<link rel="shortcut icon" href="<?php echo $this->webroot.'img/tuplanya/favicon.ico';?>" />
	<?php
		echo $this->Html->css(array('tuplanya','mobile','jquery-ui-1.9.0.custom/jquery-ui-1.9.0.custom','jquery.selectBox'));
		echo $this->Html->script(array('http://code.jquery.com/jquery-latest.min.js','jquery-ui-1.8.19.custom/js/jquery-ui-1.8.19.custom.min','jquery.selectBox.min','swfobject'));
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
		echo $this->element('ga'); //Google analytics
		echo $this->element('mobile_scripts');
	?>
</head>
<body>
	<?php $controller = $this->request->params['controller']; $action = $this->request->params['action']; ?>
	<div id="container" class="<?php echo strtolower($controller).'-'.strtolower($action); ?>">
		<div id="header">
			<div class="top">
				<?php echo $this->Html->link('','/',array('class'=>'logo')); ?>
				<?php echo $this->Html->link('','/contacto',array('class'=>'contacto')); ?>
			</div>
			<div class="bottom">
				<?php echo $this->Html->link('','javascript:void(0)',array('onClick'=>'showMenu("paginas");','class'=>'btn-menu btn')); ?>
				<ul class="menu contenedor" id="paginas">
					<li><?php echo $this->Html->link('Inicio', array('controller'=>'planes', 'action'=>'inicio'), array('title'=>'Ir a la página principal','class="'.($controller == 'planes' && $action == 'inicio' ? 'actual' : '').' home"','escape'=>false)); ?></li>			
					<li><?php echo $this->Html->link('Planes nuevos', array('controller'=>'planes', 'action'=>'nuevos'), array('title'=>'Planes nuevos','class'=>($controller == 'planes' && ($action == 'nuevos') ? 'actual' : ''))); ?></li>	
					<li><?php echo $this->Html->link('Planes adjudicados', array('controller'=>'planes', 'action'=>'adjudicados'), array('title'=>'Planes adjudicados','class'=>($controller == 'planes' && $action == 'adjudicados' ? 'actual' : ''))); ?></li>				
					<li><?php echo $this->Html->link('Planes sin adjudicar', array('controller'=>'planes', 'action'=>'comenzados'), array('title'=>'Planes comenzados','class'=>($controller == 'planes' && $action == 'comenzados' ? 'actual' : ''))); ?></li>
					<li><?php echo $this->Html->link('Canjeá tu plan ya', array('controller'=>'planes', 'action'=>'canje'), array('title'=>'Canjeá tu plan de ahorro ahora','class'=>($controller == 'planes' && $action == 'canje' ? 'actual' : ''))); ?></li>
					<li><?php echo $this->Html->link('Vendé tu plan ya', array('controller'=>'planes', 'action'=>'venta'), array('title'=>'Vendé tu plan de ahorro ahora','class'=>($controller == 'planes' && $action == 'venta' ? 'actual' : ''))); ?></li>				
				</ul>
				<?php echo $this->Html->link('','javascript:void(0)',array('onClick'=>'showMenu("marcas");','class'=>'btn-marcas btn')); ?>
				<div class="menu-marcas contenedor" id="marcas">
					<?php echo $this->element('listado-planes-menu-marcas-inicio', array('accion'=>'nuevos')); ?>
				</div>
				<?php echo $this->Html->link('','javascript:void(0)',array('onClick'=>'showMenu("search");','class'=>'btn-busqueda btn')); ?>
				<div class="busqueda contenedor" id="search">
					<?php
						//Buscador palabra clave
						echo $this->Form->create('Filter',array('url'=>array('controller'=>'planes','action'=>'busqueda')));
							echo $this->Form->input('keyword',array('label'=>false,'placeholder'=>'Buscar por palabra clave','required'=>true,
							'id'=>'keyword','name'=>'data[Filtro][keyword]','class'=>'codigo',));
						echo $this->Form->submit('Buscar');
						echo $this->Form->end();
					?>
				</div>
				<?php echo $this->Html->link('', array('controller'=>'pages', 'action'=>'contacto'),array('class'=>'btn-contacto btn')); ?>
			</div>
		</div>
		<div id="content"><?php echo $this->fetch('content'); ?></div>
		<div id="footer">
			<div><?php echo $this->Html->link('Nosotros', array('controller'=>'pages', 'action'=>'nosotros')); ?></div>              			  
			<div><?php echo $this->Html->link('FAQ', array('controller'=>'pages', 'action'=>'preguntas_frecuentes'), array('title'=>'Preguntas frecuentes','class'=>($controller == 'pages' && $action == 'preguntas_frecuentes' ? 'actual' : ''),'escape'=>false)); ?></div>
		</div>
	</div>
	<?php echo $this->Js->writeBuffer(); // Write cached scripts ?>
</body>
</html>