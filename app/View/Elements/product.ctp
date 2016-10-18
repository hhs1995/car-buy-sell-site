<div style="display: none;" itemscope itemtype="http://data-vocabulary.org/Product">
	<span itemprop="brand"><?php echo $data['Modelo']['Marca']['denominacion']; ?></span>
	<span itemprop="name"><?php echo $data['Modelo']['denominacion']; ?></span>
	<img itemprop="image" src="<?php echo Router::url('/'.$data['Modelo']['imagen']); ?>" />
	<span itemprop="description">
		<?php echo $data['Modelo']['Marca']['nombre_plan'].'. '.
		$data['Plantipo']['denominacion'].'. '.
		$data['Plan']['cuotasCantidad'].' cuotas. ';//.
		//$data['Plan']['descripcion']; ?>
	</span>
	<span itemprop="category" content="Vehículos y recambios"></span>
	<!--<span itemprop="identifier" content="mpn:925872"></span>-->
	<!--<span itemprop="review" itemscope itemtype="http://data-vocabulary.org/Review-aggregate">
		<span itemprop="rating">4,4</span> estrellas sobre un total de <span itemprop="count">89</span> opiniones
	</span>-->
	<span itemprop="offerDetails" itemscope itemtype="http://data-vocabulary.org/Offer">
		<meta itemprop="currency" content="ARS" />
		<span itemprop="price"><?php echo $data['Plan']['precioPlan']; ?></span>
		<!--<time itemprop="priceValidUntil" datetime="2020-11-05"></time>-->
		<span itemprop="seller">Tu Plan Ya</span>
		<span itemprop="condition" content="new"></span>
		<span itemprop="availability" content="in_stock"></span>
	</span>
</div>