<?php echo $this->element('setmetatags',array("pagename" => basename(__FILE__, ".ctp"))); ?>
<div id="pagina-inicio">
	<div id="slider-ppal">
	</div>
	<div id="menu-marcas">
	</div>
	<div id="buscador-mini">
		<h3>Buscador</h3>
	</div>
	<div id="mensaje">
		<h2>Bienvenido</h2>
		<p>Tu plan ya contamos con los más aptos profesionales del mercado automotriz para proporcionar un plan a medida para nuestros clientes. Sea compra venta o adquisición de planes ya comenzados tu plan ya te proporciona la mejor oferta del mercado. Con más de 10 años de experiencia.</p>
	</div>
	<div id="contenedor-banner-chicos">
		<?php echo $this->Html->link('', array('controller'=>'front_pages', 'action'=>'coming_soon'), array('title'=>'', 'id'=>'banner-1','class'=>'banner-chico')); ?>
		<?php echo $this->Html->link('', array('controller'=>'front_pages', 'action'=>'coming_soon'), array('title'=>'', 'id'=>'banner-2','class'=>'banner-chico')); ?>
		<?php echo $this->Html->link('', array('controller'=>'front_pages', 'action'=>'coming_soon'), array('title'=>'', 'id'=>'banner-3','class'=>'banner-chico')); ?>
	</div>
	<?php echo $this->element('banner-grande')?>
</div>