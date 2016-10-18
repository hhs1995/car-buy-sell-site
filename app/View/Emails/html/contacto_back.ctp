<?php $p_style = 'font-size:16px;color:#929095;line-height:1.5';?>
<?php $li_style = 'list-style-type:disc;color:#F19B00;font-size:16px;margin-bottom:7px;';?>
<p style="<?php echo $p_style;?>">Ha llegado una nueva consulta de un contacto en <b>TuPlanYa</b></p>
<?php if(isset($plan)){ ?>
	<p style="<?php echo $p_style;?>">Datos del plan:</p>
	<ul>
		<li style="<?php echo $li_style; ?>"><span style="color:#929095;"><?php echo $plan['Modelo']['denominacion']; ?></span></li>
		<li style="<?php echo $li_style; ?>"><span style="color:#929095;"><?php echo $plan['Plantipo']['denominacion']; ?></span></li>
		<li style="<?php echo $li_style; ?>"><span style="color:#929095;">ESTADO: <?php echo $plan['Plan']['tipo']; ?></span></li>
		<li style="<?php echo $li_style; ?>"><span style="color:#929095;">CÓDIGO: <?php echo $plan['Plan']['codigo']; ?></span></li>
		<li style="<?php echo $li_style; ?>"><span style="color:#929095;">ID: <?php echo $plan['Plan']['id']; ?></span></li>
	</ul>
<?php } ?>
<p style="<?php echo $p_style;?>">Dispositivo desde el que se contacta: <?php echo (isset($mobile)?'Dispositivo mobil':'Computadora'); ?></p>
<p style="<?php echo $p_style;?>">Los datos son los siguientes:</p>
<p style="<?php echo $p_style;?>">
	<ul>
		<?php echo (!empty($contacto['nombre_apellido']) ? '<li style="'.$li_style.'"><span style="color:#929095;">Nombre: '.$contacto['nombre_apellido'].'</span></li>' : '');?>
		<?php echo (!empty($contacto['email']) ? '<li style="'.$li_style.'"><span style="color:#929095;">Email: '.$contacto['email'].'</span></li>' : '');?>
		<?php echo (!empty($contacto['telefono']) ? '<li style="'.$li_style.'"><span style="color:#929095;">Teléfono: '.$contacto['telefono'].'</li></span>' : '');?>
		<?php echo (!empty($contacto['celular']) ? '<li style="'.$li_style.'"><span style="color:#929095;">Celular: '.$contacto['celular'].'</span></li>' : '');?>
		<?php echo (!empty($contacto['empresa']) ? '<li style="'.$li_style.'"><span style="color:#929095;">Empresa: '.$contacto['empresa'].'</span></li>' : '');?>
		<?php echo (!empty($contacto['vehiculo']) ? '<li style="'.$li_style.'"><span style="color:#929095;">Vehiculo: '.$contacto['vehiculo'].'</span></li>' : '');?>
		<?php echo (!empty($contacto['cuotas_pagas']) ? '<li style="'.$li_style.'"><span style="color:#929095;">Cuotas Pagas: '.$contacto['cuotas_pagas'].'</span></li>' : '');?>
		<?php echo (!empty($contacto['zona']) ? '<li style="'.$li_style.'"><span style="color:#929095;">Zona: '.$contacto['zona'].'</span></li>' : '');?>	
		<!-- Arma Tu Plan a Tu Medida-->
		<?php echo (!empty($contacto['horarios']) ? '<li style="'.$li_style.'"><span style="color:#929095;">Horarios: '.$contacto['horarios'].'</span></li>' : '');?>	
		<?php echo (!empty($contacto['dinero_contas']) ? '<li style="'.$li_style.'"><span style="color:#929095;">¿Con cuánto dinero contas?: '.$contacto['dinero_contas'].'</span></li>' : '');?>	
		<?php echo (!empty($contacto['dinero_mes']) ? '<li style="'.$li_style.'"><span style="color:#929095;">Dinero por mes: '.$contacto['dinero_mes'].'</span></li>' : '');?>	
		
		<?php echo (!empty($contacto['comentarios']) ? '<li style="'.$li_style.'"><span style="color:#929095;">Comentarios: '.$contacto['comentarios'].'</span></li>' : '');?>
	</ul>
</p>