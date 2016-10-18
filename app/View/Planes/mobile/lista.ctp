<?php 
	$tipo = $this->request->params['action'];
	if (isset($this->request->params['pass'][0])){
		echo $this->element('setmetatags',array('pagename' => 'planes-'.$tipo,'idmarca'=>$this->request->params['pass'][0]));
	}else{
		echo $this->element('setmetatags',array('pagename' => 'planes-'.$tipo,));
	}
	$marca_id = (!empty($this->request->params['pass'][0]) ? $this->request->params['pass'][0] : '');
?>
<script language="javascript">
	/*$(document).ready(function(){
		$(this).removeClass('clicked');
		$('.item').click(function(){
			$(this).addClass('clicked');
		});
	})*/
</script>
<div class="planes index">
	<ul class="tipos">
		<li><?php echo $this->Html->link(__('Planes Nuevos'), array('controller'=>'planes', 'action'=>'nuevos',(!empty($marca_id) ? $marca_id : '0')), array('title'=>'Planes de ahorro automotor nuevos','class'=>	(($tipo=='nuevos')?'actual':''))); ?></li>
		<li><?php echo $this->Html->link(__('Planes Adjudicados'), array('controller'=>'planes', 'action'=>'adjudicados',(!empty($marca_id) ? $marca_id : '0')), array('title'=>'Planes de ahorro automotor adjudicados','class'=>	(($tipo=='adjudicados')?'actual':''))); ?></li>
		<li><?php echo $this->Html->link(__('Planes Sin Adjudicar'), array('controller'=>'planes', 'action'=>'comenzados',(!empty($marca_id) ? $marca_id : '0')), array('title'=>'Planes de ahorro automotor comenzados','class'=>	(($tipo=='comenzados')?'actual':''))); ?></li>
	</ul>   
	<div class="listado">
		<?php
			if(!empty($planes)){				
				foreach ($planes as $plan){
					$thumb = '';				
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
					} ?>
					<a class="item" href="<?php echo $this->Html->url(array('controller' => 'planes', 'action' => 'ver','id'=>$plan['Plan']['id'],'slug'=>$plan['Plan']['slug'])); ?>">
						<div class="imagen" style="background-image:url('<?php echo $thumb;?>');"></div>
						<div class="description">
							<!--<div class="container"><?php echo $this->Html->link('',array('controller' => 'planes', 'action' => 'ver', 'id'=>$plan['Plan']['id'],'slug'=>$plan['Plan']['slug']));?></div>-->
							<h2><?php echo $plan['Plan']['denominacion']; ?></h2>
							<div class="volanta"><?php echo strip_tags($plan['Plantipo']['denominacion'],'<strong><span><em>'); ?></div>
							<div class="pie">
								<?php if($plan['Plan']['tipo'] != 'Nuevo'){?>
									<div class="cuotas-pagas"><?php echo $plan['Plan']['cuotasPagas'].'/'.$plan['Plan']['cuotasCantidad'];?></div>
									<div class="cuotas-cantidad"><?php echo __('Cuotas Pagas',true);?></div>
								<?php } ?>
								<div class="cuota-desde">Cuota desde:</div>
								<div class="precio"><?php echo h( $this->Number->format($plan['Plan']['precio_visible'], array('places' => 0,'before' => '$ ','escape' => false,'decimals' => ',','thousands' => '.'))); ?></div>
								<div class="cuota-pura"><?php echo ($plan['Plan']['tipo'] != 'Nuevo' ? 'cuota: '.h($this->Number->format($plan['Plan']['cuota_promedio'], array('places' => 0,'before' => '$ ','escape' => false,'decimals' => ',','thousands' => '.'))) : '');?></div>
							</div>
						</div>
					</a>
				<?php }
			}else{
				echo '<div class="mensaje-no-results">'.__('No hay resultados disponibles',true).'</div>';
			}
		?>			
		<div style="clear:both"></div>
	</div>
</div>