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
});
</script>
	<div id="mensaje-invalid-codigo"><?php echo __('El código que ingresó es inválido',true);?></div>
	<div class="tab-panel">
		<h3 class="title">Otros Planes</h3>
		<div class="listado-planes">
			<?php
			if(!empty($planes)){				
				foreach ($planes as $plan):
				?>
					<?php
				   $thumb = $this->Thumbnail->render($plan['Modelo']['imagen'], array(
					  'path' => UPLOAD_IMG_PATH_MODELOS_PRINCIPAL,
					  'cachePath' => 'principal',
					  'newWidth' => 300,
					  'newHeight' => 220,
					  'resizeOption'=>'crop',
					  'quality' => '100',
					  'absoluteCachePath' => WWW_ROOT,
					));
					$thumb = Router::url('/'.$thumb);
					?>
				<div class="item" style="background-image:url('<?php echo $thumb;?>');background-repeat:no-repeat;">
					<?php echo ($plan['Plan']['vendido'] == 1 ? $this->Html->image('tuplanya/vendido.png',array('class'=>'vendido')) : '');?>
					<?php echo ($plan['Plan']['reservado'] == 1 ? $this->Html->image('tuplanya/reservado.png',array('class'=>'reservado')) : '');?>
					<div class="container"><?php echo $this->Html->link('',array('controller' => 'planes', 'action' => 'ver', 'id'=>$plan['Plan']['id'],'slug'=>$plan['Plan']['slug']));?></div>
					<h2><?php echo $this->Html->link($plan['Plan']['denominacion'], array('controller' => 'planes', 'action' => 'ver', $plan['Plan']['id'])); ?></h2>
					<div class="volanta"><?php echo h($plan['Plantipo']['denominacion']); ?></div>
					<div class="codigo">Cod: <?php echo $plan['Plan']['codigo'];?></div>
					<p class="descripcion"><?php echo h(strip_tags($plan['Plan']['volanta'])); ?></p>
					<div class="pie">
						<?php if($plan['Plan']['tipo'] != 'Nuevo'){?>
							<div class="cuotas-pagas"><?php echo $plan['Plan']['cuotasPagas'].'/'.$plan['Plan']['cuotasCantidad'];?></div>
							<div class="cuotas-cantidad"><?php echo __('Cuotas Pagas',true);?></div>
						<?php } ?>
						<div class="precio"><?php echo h( $this->Number->format($plan['Plan']['precioPlan'], array('places' => 0,'before' => '$ ','escape' => false,'decimals' => ',','thousands' => '.'))); ?></div>
						<div class="cuota-pura">cuota: <?php echo h($this->Number->format($plan['Plan']['cuotaPura'], array('places' => 0,'before' => '$ ','escape' => false,'decimals' => ',','thousands' => '.'))); ?></div>
					</div>
				</div>
			<?php endforeach;
			}else{
				echo '<div class="mensaje-no-results">'.__('No hay planes similares disponibles',true).'</div>';
			}
			?>			
			<div style="clear:both"></div>
		</div>
	</div>
</div>
