<script>
	$(document).ready(function(){
		$('.item').hover(
		  function () {
			$(this).addClass("hover");
		  },
		  function () {
			
			$(this).removeClass("hover");
		  }
		);
		
		<?php if($this->request->params['action'] == 'busqueda'){?>
			show_form_busqueda_avanzada();
		<?php } ?>
	})
	
</script>
<?php 

$tipo = $this->request->params['action'];
if (isset($this->request->params['pass'][0]))
{
echo $this->element('setmetatags',array('pagename' => 'planes-'.$tipo,'idmarca'=>$this->request->params['pass'][0]));
}
else
{
echo $this->element('setmetatags',array('pagename' => 'planes-'.$tipo,));
}


?>
<?php $marca_id = (!empty($this->request->params['pass'][0]) ? $this->request->params['pass'][0] : '');?>

<div class="planes index">
	<div class="top-lista">		
		<?php echo $this->element('busqueda-avanzada');?>
	</div>
	<?php echo $this->element('banner-grande')?>
	<?php echo $this->element('listado-planes-menu-marcas', array('accion'=>($tipo != 'busqueda' ? $tipo : 'nuevos'), 'marca_id'=>$marca_id))?>
	
	<ul class="tab-menu">
	<li><?php echo $this->Html->link(__('Planes Nuevos'), array('controller'=>'planes', 'action'=>'nuevos',(!empty($marca_id) ? $marca_id : '0')), array('title'=>'Planes de ahorro automotor nuevos','class'=>	(($tipo=='nuevos')?'actual':''))); ?></li>
		<li><?php echo $this->Html->link(__('Planes Adjudicados'), array('controller'=>'planes', 'action'=>'adjudicados',(!empty($marca_id) ? $marca_id : '0')), array('title'=>'Planes de ahorro automotor adjudicados','class'=>	(($tipo=='adjudicados')?'actual':''))); ?></li>
		<li><?php echo $this->Html->link(__('Planes Sin Adjudicar'), array('controller'=>'planes', 'action'=>'comenzados',(!empty($marca_id) ? $marca_id : '0')), array('title'=>'Planes de ahorro automotor comenzados','class'=>	(($tipo=='comenzados')?'actual':''))); ?></li>
		
		<?php echo ($tipo == 'busqueda' ? '<li>'.$this->Html->link(__('Resultados de la búsqueda'), array('controller'=>'planes', 'action'=>'nuevos'), array('title'=>'Planes de ahorro automotor nuevos','class'=>(($tipo=='busqueda')?'actual':''))).'</li>' : '');?>
	</ul>
			           
	<div class="tab-panel">
	<div class="descripciones">
  <div class="adjudicados texto">Estos planes están listos para que elijas el modelo del auto que querés y comiences a disfrutar de tu auto YA! totalmente en pesos y sin interés directo de fábrica.</div>
  <div class="comenzados texto">Estos planes están listos para licitar y participar de los sorteos.  Vos programás la entrega y la cantidad de cuotas que querés financiar!!</div>
  <div class="nuevos texto" style="display:block">Es la forma de comprar tu auto financiado hasta el 100% del auto que elijas sin requisitos, en pesos y sin interés. </div>
  </div>
		<div class="listado-planes">
			<?php
			if(!empty($planes)){				
				foreach ($planes as $plan):
				$thumb = '';				
				?>
					<?php
					if(!empty($plan['Modelo']['imagen'])){
						$thumb = $this->Thumbnail->render($plan['Modelo']['imagen'], array(
							'path' => UPLOAD_IMG_PATH_MODELOS_PRINCIPAL,
							'cachePath' => UPLOAD_IMG_HELPER_CACHE.'principal',
							'newWidth' => 300,
							'newHeight' => 220,
							'resizeOption'=>'crop',
							'quality' => '90',
							'absoluteCachePath' => WWW_ROOT,
						));
					$thumb = Router::url('/'.$thumb);
					}
					?>
				<div class="item" style="background-image:url('<?php echo $thumb;?>');background-repeat:no-repeat;">
					<?php echo ($plan['Plan']['vendido'] == 1 ? $this->Html->image('tuplanya/vendido.png',array('class'=>'vendido')) : '');?>
					<?php echo ($plan['Plan']['reservado'] == 1 ? $this->Html->image('tuplanya/reservado.png',array('class'=>'reservado')) : '');?>
					<div class="container"><?php echo $this->Html->link('',array('controller' => 'planes', 'action' => 'ver', 'id'=>$plan['Plan']['id'],'slug'=>$plan['Plan']['slug']));?></div>
					<h2><?php echo $this->Html->link($plan['Plan']['denominacion'], array('controller' => 'planes', 'action' => 'ver', $plan['Plan']['id'],$plan['Plan']['slug'])); ?></h2>
					<div class="volanta"><?php echo strip_tags($plan['Plantipo']['denominacion'],'<strong><span><em>'); ?></div>
					<p class="descripcion"><?php echo strip_tags($plan['Plan']['volanta'],'<strong><span><em>'); ?></p>
					<div class="pie">
						<?php if($plan['Plan']['tipo'] != 'Nuevo'){?>
							<div class="cuotas-pagas"><?php echo $plan['Plan']['cuotasPagas'].'/'.$plan['Plan']['cuotasCantidad'];?></div>
							<div class="cuotas-cantidad"><?php echo __('Cuotas Pagas',true);?></div>
						<?php } ?>
						<div class="cuota-desde">Cuota desde</div>
						<div class="precio"><?php echo h( $this->Number->format($plan['Plan']['precio_visible'], array('places' => 0,'before' => '$ ','escape' => false,'decimals' => ',','thousands' => '.'))); ?></div>
						<div class="cuota-pura"><?php echo ($plan['Plan']['tipo'] != 'Nuevo' ? 'cuota: '.h($this->Number->format($plan['Plan']['cuota_promedio'], array('places' => 0,'before' => '$ ','escape' => false,'decimals' => ',','thousands' => '.'))) : '');?></div>
					</div>
				</div>
			<?php endforeach;
			}else{
				echo '<div class="mensaje-no-results">'.__('No hay resultados disponibles',true).'</div>';
			}
			?>			
			<div style="clear:both"></div>
			
	</div>
	<div class="aclaracion" >*Los precios están sujetos a posible variación de la fábrica.</div>
	</div>	
	</div>
	<?php echo $this->element('banner-grande-home')?>

</div>
