<?php
$url = 'http://youtu.be/'.$url_video;
//$url = parseYoutubeId($url_video);
//var_dump($url);
//var_dump($url);
$existe = @fopen($url, 'r');
//var_dump($existe);
if($existe == true)
{
	/*echo '<object width="'.(!empty($width) ? $width : 425).'" height="'.(!empty($height) ? $height : 355).'">
	<param name="movie" value="http://youtu.be/'.$url_video.'?rel=1&color1=0x2b405b&
	color2=0x6b8ab6&border=1&fs=1"></param>
	<param name="allowFullScreen" value="true"></param>
	<embed src="http://youtu.be/'.$url_video.'?rel=1&color1=0x2b405b&color2=0x6b8ab6&border=1&fs=1"
	type="application/x-shockwave-flash"
	width="'.(!empty($width) ? $width : 425).'" height="'.(!empty($height) ? $height : 355).'" 
	allowfullscreen="true"></embed>
	</object>';*/
	
	echo '<iframe width="'.$width.'" height="'.$height.'" src="http://www.youtube.com/embed/'.$url_video.'" frameborder="0" allowfullscreen></iframe>';

}else{

	echo ($html->image('no_image.gif',array('alt'=> 'No imagen')));
}
	?>
