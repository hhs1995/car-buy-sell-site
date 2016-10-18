<?php $url_img = 'http://www.tuplanya.com/'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN">
<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" >
	<title><?php echo $title_for_layout;?></title>
</head>
<body>
	<div class="body" style="background-color: #f9c801; height: 400px; width: 600px; margin:0 auto;">
		<div class="content" style="background-color: #FFFFFF; margin: 8px; position: relative; top: 8px; height: 340px;">
			<div class="head" style="
				margin:0 auto;
				background: #fefefe; /* Old browsers */
				background: -moz-linear-gradient(top, #fefefe 0%, #e9e9e9 100%); /* FF3.6+ */
				background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#fefefe), color-stop(100%,#e9e9e9)); /* Chrome,Safari4+ */
				background: -webkit-linear-gradient(top, #fefefe 0%,#e9e9e9 100%); /* Chrome10+,Safari5.1+ */
				background: -o-linear-gradient(top, #fefefe 0%,#e9e9e9 100%); /* Opera 11.10+ */
				background: -ms-linear-gradient(top, #fefefe 0%,#e9e9e9 100%); /* IE10+ */
				background: linear-gradient(to bottom, #fefefe 0%,#e9e9e9 100%); /* W3C */
				filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#fefefe', endColorstr='#e9e9e9',GradientType=0 ); /* IE6-9 */
				height: 110px;
				border-bottom: double;
				border-bottom-color: #dedede;
				border-bottom-width: 4px;
				text-align: center;
			">
				<img src="<?php echo $url_img;?>img/tuplanya/email/logo.png">
				<?php if(isset($img_concesionario)){ ?><img src="<?php echo $url_img;?>img/tuplanya/<?php echo $img_concesionario;?>"><?php } ?>
			</div>
			<div class="texto" style="margin:0 auto; position: relative; top: 25px; width: 470px; font-family: Arial; font-size: 15px!important; line-height:1.5;">
				<?php echo $this->fetch('content');?>
			</div>	
		</div>
		<div class="footer" style="position: relative; 	top: 18px; margin-top: 5px; font-size:12px; font-weight: bold; text-align: center; color:#FFFFFF;">
			<?php echo $this->Html->link('tuplanya.com.ar',$url_img,array('style'=>'color:#FFFFFF!important; font-family: Arial; text-decoration: none;'));?> - 2014
		</div>
	</div>
</body>
</html>