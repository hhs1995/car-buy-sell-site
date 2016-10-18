<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php echo $this->Html->charset(); ?>
	<title><?php echo $title_for_layout;?></title>
	<meta name="google-site-verification" content="4Iyca2TwBYFr2C0OI2x8ui6uLboKLwTe7DJR7AkCMi4" />
	<link rel="shortcut icon" href="<?php echo $this->webroot.'img/tuplanya/favicon.ico';?>" />
	<?php
		//echo $this->Html->meta('icon');
		echo $this->Html->css(array('tuplanya','jquery-ui-1.9.0.custom/jquery-ui-1.9.0.custom','jquery.selectBox'));
		echo $this->Html->script(array('jquery-1.7.1.min','jquery-ui-1.8.19.custom/js/jquery-ui-1.8.19.custom.min','jquery.selectBox.min','swfobject'));
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
		echo $this->element('ga'); //Google analytics

		if(NAVEGADOR == 'IE9' or NAVEGADOR == 'IE8' or NAVEGADOR =='IE7'){
        	echo $this->Html->css(array(
            	'especial_ie8'
        	));
        	if(NAVEGADOR == 'IE7')	
        	echo $this->Html->css(array(
            	'especial_ie7'
        	));
        }
	?>
</head>
<?php $controller = $this->request->params['controller']; $action = $this->request->params['action']; ?>
<body id="<?php echo str_replace('_', '-', $this->action); ?>-page" class="static-page">
  <div id="main" class="<?php echo strtolower($controller).'-'.strtolower($action); ?>">
    <div id="fondo-ppal">
		<div class="header">
		  <div class="content-content">
			<?php
						if(isset($session['User']) and !is_null($session['User'])){
						echo $this->Html->link('', array('controller'=>'users', 'action'=>'index'), array('class'=>'logo'));
						}else{
						echo $this->Html->link('','/',array('class'=>'logo'));
					}
			?>
			<div id="nav-header">
				<p>Seguinos en</p>
				<div id="iconos-sociales">
				<?php /*echo $this->Html->link('', 'https://www.facebook.com/TuPlanYa', array('title'=>'Facebook', 'class'=>'icono-social icono-facebook','target'=>'_blank'));*/ ?>
				<?php echo $this->Html->link('', 'https://twitter.com/Tu_Plan_Ya', array('title'=>'Twitter', 'class'=>'icono-social icono-twitter','target'=>'_blank')); ?>
				<?php echo $this->Html->link('', 'https://plus.google.com/b/112879566511298785031/112879566511298785031/posts', array('title'=>'Plus', 'class'=>'icono-social icono-plus','target'=>'_blank')); ?>
			</div>
			</div>
			
			<?php
			$controller = $this->request->params['controller'];
			$action = $this->request->params['action'];
			?>
			<div class="buscador-codigo">
			
					<?php 
					function ae_detect_ie()
					{
						if (isset($_SERVER['HTTP_USER_AGENT']) && 
						(strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== false))
							return true;
						else
							return false;
					}	
					
					
					//BUscador codigo
					/*echo $this->Form->create('Filter',array('url'=>array('controller'=>'filtros','action'=>'filtro')));
					if (ae_detect_ie()){
					echo $this->Form->input('code',array('label'=>false,'value'=>'Buscar por código','required'=>true,'id'=>'codigo','name'=>'data[Filtro][codigo]','class'=>'codigo',));
					}else{echo $this->Form->input('code',array('label'=>false,'placeholder'=>'Buscar por código','required'=>true,'id'=>'codigo','name'=>'data[Filtro][codigo]','class'=>'codigo',));}
					echo $this->Form->submit('Enviar');
					echo $this->Form->end();?>*/
					
					//Buscador palabra clave
					echo $this->Form->create('Filter',array('url'=>array('controller'=>'planes','action'=>'busqueda')));
					if (ae_detect_ie()){
					echo $this->Form->input('keyword',array('label'=>false,'value'=>'Buscar por palabra clave','required'=>true,'id'=>'keyword','name'=>'data[Filtro][keyword]','class'=>'codigo',));
					}else{echo $this->Form->input('keyword',array('label'=>false,'placeholder'=>'Buscar por palabra clave','required'=>true,'id'=>'keyword','name'=>'data[Filtro][keyword]','class'=>'codigo',));}
					echo $this->Form->submit('Buscar');
					echo $this->Form->end();?>

			</div>
			
			<ul class="header-menu">
				<li><?php echo $this->Html->link($this->Html->image('tuplanya/icon_home.png'), array('controller'=>'planes', 'action'=>'inicio'), array('title'=>'Ir a la página principal','class="'.($controller == 'planes' && $action == 'inicio' ? 'actual' : '').' home"','escape'=>false)); ?></li>			
				<li><?php echo $this->Html->link('Planes nuevos', array('controller'=>'planes', 'action'=>'nuevos'), array('title'=>'Planes nuevos','class'=>($controller == 'planes' && ($action == 'nuevos') ? 'actual' : ''))); ?></li>	
				<li><?php echo $this->Html->link('Planes adjudicados', array('controller'=>'planes', 'action'=>'adjudicados'), array('title'=>'Planes adjudicados','class'=>($controller == 'planes' && $action == 'adjudicados' ? 'actual' : ''))); ?></li>				
				<li><?php echo $this->Html->link('Planes sin adjudicar', array('controller'=>'planes', 'action'=>'comenzados'), array('title'=>'Planes comenzados','class'=>($controller == 'planes' && $action == 'comenzados' ? 'actual' : ''))); ?></li>
				
				<li class ="rightli"><?php echo $this->Html->link('Canjeá tu plan ya', array('controller'=>'planes', 'action'=>'canje'), array('title'=>'Canjeá tu plan de ahorro ahora','class'=>($controller == 'planes' && $action == 'canje' ? 'actual' : ''))); ?></li>
				<li class ="rightli"><?php echo $this->Html->link('Vendé tu plan ya', array('controller'=>'planes', 'action'=>'venta'), array('title'=>'Vendé tu plan de ahorro ahora','class'=>($controller == 'planes' && $action == 'venta' ? 'actual' : ''))); ?></li>				

			
			</ul>
		  </div>
		</div>		
		<div id="<?php echo str_replace('_', '-', $this->action); ?>" class="content-front">			
			<div class="content-content">
			<?php //echo $this->Session->flash(); ?>
			<?php echo $this->fetch('content');/*echo $this->element('sql_dump');*/?>			
			</div>
		</div>
    </div>
	<div class="footer">
      <div class="content-content">
        <div class="parts">
          <div class="footer-part p1">
            <div class="footer-logo"></div>
          </div>
          <div class="footer-part p2">
            <div class="column c1">
              <div class="column-content"><?php echo $this->Html->link('Home', array('controller'=>'planes', 'action'=>'inicio')); ?></div>
              <div class="column-content"><?php echo $this->Html->link('Nosotros', array('controller'=>'pages', 'action'=>'nosotros')); ?></div>              			  
			  									<div class="column-content"><?php echo $this->Html->link('Preguntas frecuentes', array('controller'=>'pages', 'action'=>'preguntas_frecuentes'), array('title'=>'Preguntas frecuentes','class'=>($controller == 'pages' && $action == 'preguntas_frecuentes' ? 'actual' : ''),'escape'=>false)); ?></div>
            </div>
            <div class="column c2">
              <div class="column-content"><?php echo $this->Html->link('Comprá Tu Plan Ya', array('controller'=>'planes', 'action'=>'todos')); ?></div>
              <div class="column-content"><?php echo $this->Html->link('Canjeá Tu Plan Ya', array('controller'=>'planes', 'action'=>'canje')); ?></div>
              <div class="column-content"><?php echo $this->Html->link('Vende Tu Plan Ya', array('controller'=>'planes', 'action'=>'venta')); ?></div>			  
            </div>
            <div class="column c3">
              <div class="column-content">&nbsp;</div>			  
              <div class="column-content"><?php echo $this->Html->link('Contacto', array('controller'=>'pages', 'action'=>'contacto')); ?></div>
              <div class="column-content"><?php echo $this->Html->link('RRHH', 'mailto:cv@tuplanya.com'); ?></div>
            </div>
          </div>
     <div class="footer-part p3">
				<p>Seguinos en</p>
				<div id="iconos-sociales">
				<?php /*echo $this->Html->link('', 'https://www.facebook.com/TuPlanYa', array('title'=>'Facebook', 'class'=>'icono-social icono-facebookf','target'=>'_blank')); */?>
				<?php echo $this->Html->link('', 'https://twitter.com/Tu_Plan_Ya', array('title'=>'Twitter', 'class'=>'icono-social icono-twitterf','target'=>'_blank')); ?>
				<?php echo $this->Html->link('', 'https://plus.google.com/b/112879566511298785031/112879566511298785031/posts', array('title'=>'Plus', 'class'=>'icono-social icono-plusf','target'=>'_blank')); ?>
				</div>
    </div>
      </div>
	  <?php echo $this->element('form-html5-jquery'); ?>
		<?php
			if ($this->params['controller'] == 'planes') {
				switch($this->params['action']) {
					case 'inicio':
					case 'todos':
					case 'nuevos':
					case 'adjudicados':
					case 'comenzados':
					case 'busqueda':
					case 'ver':
					echo $this->element('formPopup');
				}
			}
		?>
    </div>
<?php echo $this->Js->writeBuffer(); // Write cached scripts ?>
</body>
</html>
