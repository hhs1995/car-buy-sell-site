<?php
$ok = false;
while($nro_servidor < 5)
{
	$url = @fopen('http://i'.$nro_servidor.'.ytimg.com/vi/'.$url_video.'/default.jpg','r');
	if($url == true)
	{
		echo '<img title="'.(!empty($titulo) ? $titulo : 'Sin titulo').'" src="http://i'.$nro_servidor.'.ytimg.com/vi/'.$url_video.'/default.jpg">';
		$nro_servidor = 5;
		$ok = true;
	}
	$nro_servidor++;
}
//var_dump($ok);
if(!$ok)
{
	//echo '<img title="'.(!empty($titulo) ? $titulo : 'Sin titulo').'" src="http://i3.ytimg.com/vi/Z--QLkNMAug/default.jpg">';
	echo ($this->Html->image('no_image.gif',array('alt'=> 'No imagen')));
}
?>