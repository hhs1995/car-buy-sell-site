<?php
/* Depende de la pagina desde donde se llame este objeto tiene que linkear a: planes adjudicados, comenzados y nuevos */
$controlador = 'planes';
?>
<div class="menu-marcas-listado-completo">
	<a href="<?php echo $this->Html->url(array('controller'=>$controlador, 'action'=>$accion, FIAT)); ?>" id="marca-item-fiat" class="marca-item<?php echo ($marca_id == FIAT ? ' actual' : ''); ?>">
		Fiat
		<div class="img-concesionario" ></div>
	</a>
	<a href="<?php echo $this->Html->url(array('controller'=>$controlador, 'action'=>$accion, VW)); ?>" id="marca-item-vw" class="marca-item<?php echo ($marca_id == FIAT ? ' actual' : ''); ?>">
		Volkswagen
		<div class="img-concesionario" ></div>
	</a>
	<a href="<?php echo $this->Html->url(array('controller'=>$controlador, 'action'=>$accion, FORD)); ?>" id="marca-item-ford" class="marca-item<?php echo ($marca_id == FIAT ? ' actual' : ''); ?>">
		Ford
		<div class="img-concesionario" ></div>
	</a>
	<a href="<?php echo $this->Html->url(array('controller'=>$controlador, 'action'=>$accion, RENAULT)); ?>" id="marca-item-renault" class="marca-item<?php echo ($marca_id == FIAT ? ' actual' : ''); ?>">
		Renault
		<div class="img-concesionario" ></div>
	</a>
	<a href="<?php echo $this->Html->url(array('controller'=>$controlador, 'action'=>$accion, PEUGEOT)); ?>" id="marca-item-peugeot" class="marca-item<?php echo ($marca_id == FIAT ? ' actual' : ''); ?>">
		Peugeot
		<div class="img-concesionario" ></div>
	</a>
	<a href="<?php echo $this->Html->url(array('controller'=>$controlador, 'action'=>$accion, CITROEN)); ?>" id="marca-item-citroen" class="marca-item<?php echo ($marca_id == FIAT ? ' actual' : ''); ?>">
		Citroen
		<div class="img-concesionario" ></div>
	</a>
	<a href="<?php echo $this->Html->url(array('controller'=>$controlador, 'action'=>$accion, CHEVY)); ?>" id="marca-item-chevy" class="marca-item<?php echo ($marca_id == FIAT ? ' actual' : ''); ?>">
		Chevrolet
		<div class="img-concesionario" ></div>
	</a>
	<a href="<?php echo $this->Html->url(array('controller'=>$controlador, 'action'=>$accion)); ?>" id="marca-item-todaslasmarcas" class="marca-item<?php echo (empty($marca_id) ? ' actual' : ''); ?>">
		Todas
	</a>
</div>