<?php
/* Depende de la pagina desde donde se llame este objeto tiene que linkear a: planes adjudicados, comenzados y nuevos */

$controlador = 'planes';
$id = "marca-item-";
if(isset($mobile) && $mobile){$id="logo_";}
?>

<div class="menu-marcas-listado">
		<a href="<?php echo $this->Html->url(array('controller'=>$controlador, 'action'=>$accion, FIAT)); ?>" id="<?php echo $id; ?>fiat" class="marca-item">
			Fiat
			<div class="img-concesionario" ></div>
		</a>
		<a href="<?php echo $this->Html->url(array('controller'=>$controlador, 'action'=>$accion, VW)); ?>" id="<?php echo $id; ?>vw" class="marca-item">
			Volkswagen
			<div class="img-concesionario" ></div>
		</a>
		<a href="<?php echo $this->Html->url(array('controller'=>$controlador, 'action'=>$accion, FORD)); ?>" id="<?php echo $id; ?>ford" class="marca-item">
			Ford
			<div class="img-concesionario" ></div>
		</a>
		<a href="<?php echo $this->Html->url(array('controller'=>$controlador, 'action'=>$accion, RENAULT)); ?>" id="<?php echo $id; ?>renault" class="marca-item">
			Renault
			<div class="img-concesionario" ></div>
		</a>
		<a href="<?php echo $this->Html->url(array('controller'=>$controlador, 'action'=>$accion, PEUGEOT)); ?>" id="<?php echo $id; ?>peugeot" class="marca-item">
			Peugeot
			<div class="img-concesionario" ></div>
		</a>
		<a href="<?php echo $this->Html->url(array('controller'=>$controlador, 'action'=>$accion, CITROEN)); ?>" id="<?php echo $id; ?>citroen" class="marca-item">
			Citroen
			<div class="img-concesionario" ></div>
		</a>
		<a href="<?php echo $this->Html->url(array('controller'=>$controlador, 'action'=>$accion, CHEVY)); ?>" id="<?php echo $id; ?>chevy" class="marca-item">
			Chevrolet
			<div class="img-concesionario" ></div>
		</a>
</div>