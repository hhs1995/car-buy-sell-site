<?php echo $this->element('setmetatags',array("pagename" => basename(__FILE__, ".ctp"))); ?>
<script language="javascript">
	$(document).ready(function(){
		$('#tab-destacado-nuevos').show();
		$("SELECT").selectBox();
		/*$(this).removeClass('clicked');
		$('.item').click(function(){
			$(this).addClass('clicked');
		});*/
	})

	function verTab(tipo){
		$('.tipos a').removeClass('actual');
		$('#tab-'+tipo).addClass('actual');
		$('.tab-destacado').hide();
		$('#tab-destacado-'+tipo).show();
	}
</script>
<div class="planes">
	<ul class="tipos">
		<li><?php echo $this->Html->link(__('Planes Nuevos'), 'javascript:void(0)', array('onclick'=>'verTab("nuevos")','title'=>'Planes de ahorro automotor nuevos','id'=>'tab-nuevos','class'=> 'actual',)); ?></li>
		<li><?php echo $this->Html->link(__('Planes Adjudicados'), 'javascript:void(0)', array('onclick'=>'verTab("adjudicados")','title'=>'Planes de ahorro automotor adjudicados','id'=>'tab-adjudicados')); ?></li>
		<li><?php echo $this->Html->link(__('Planes Sin adjudicar'), 'javascript:void(0)', array('onclick'=>'verTab("comenzados")','title'=>'Planes de ahorro automotor comenzados','id'=>'tab-comenzados')); ?></li>
	</ul>
	<div class="listado">
		<?php foreach ($destacados as $tipo=>$planes){ ?>
			<div id="tab-destacado-<?php echo $tipo; ?>" class="tab-destacado">
				<?php 
					if(is_array($planes)){
						foreach ($planes as $tipo=>$plan){
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
							}
							?>
							<a class="item" href="<?php echo $this->Html->url(array('controller' => 'planes', 'action' => 'ver','id'=>$plan['Plan']['id'],'slug'=>$plan['Plan']['slug'])); ?>">
								<div class="imagen" style="background-image:url('<?php echo $thumb;?>');"></div>
								<div class="description">
									<h2><?php echo $plan['Plan']['denominacion']; ?></h2>
									<div class="volanta"><?php echo strip_tags($plan['Plantipo']['denominacion'],'<strong><span><em>'); ?></div>
									<div class="pie">
										<?php if($plan['Plan']['tipo'] != 'Nuevo'){ ?>
											<div class="cuotas-pagas"><?php echo $plan['Plan']['cuotasPagas'].'/'.$plan['Plan']['cuotasCantidad'];?></div>
											<div class="cuotas-cantidad"><?php echo __('Cuotas Pagas',true);?></div>
										<?php } ?>
										<div class="precio">Cuota desde: <?php echo h( $this->Number->format($plan['Plan']['precio_visible'], array('places' => 0,'before' => '$ ','escape' => false,'decimals' => ',','thousands' => '.'))); ?></div>
										<div class="cuota-pura"><?php echo ($plan['Plan']['tipo'] != 'Nuevo' ? 'cuota: '.h($this->Number->format($plan['Plan']['cuota_promedio'], array('places' => 0,'before' => '$ ','escape' => false,'decimals' => ',','thousands' => '.'))) : '');?></div>
									</div>
								</div>
							</a>
						<?php }
					}
				?>
			</div>
		<?php } ?>
	</div>
</div>