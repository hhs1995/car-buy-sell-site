<?php $url_img = 'http://www.tuplanya.com/';?>
<table style="font-family:Arial">
	<!-- HEADER -->
	<tr>
		<td height=130 width=800 style="background-repeat:repeat-x" background="<?php echo $url_img;?>img/tuplanya/email/header-bg.png">
			<img src="<?php echo $url_img;?>img/tuplanya/email/logo.png" style="padding-left:40px;">
		</td>
	</tr>	
	
	<tr>
		<td style="background:#f3f3f3;height:80px;padding:60px;">			
			<p style="font-size:16px;color:#929095"><b>TuPlanYa</b> agradece el contacto e interés en la búsqueda realizada.
			En menos de 24 hs nuestro equipo de profesionales procesará su consulta y se pondrá en contacto con usted.</p>
			<p style="font-size:16px;color:#929095"><b>Muchas Gracias.</b></p>
		</td>
	</tr>

	<!-- FOOTER -->
	<tr>
		<td style="border-top:1px solid #e4e4e4;padding:10px 0 0 20px;font-size:11px;color:#b8b8b8;">
			<?php echo $this->Html->link('tuplanya.com.ar',$url_img,array('style'=>'font-size:11px;color:#b8b8b8;text-decoration:none'));?> - 2012
		</td>
	</tr>
</table>