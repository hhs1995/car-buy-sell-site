<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Tu Plan Ya - CONTROL</title>
	<link rel="shortcut icon" href="<?php echo $this->webroot.'img/tuplanya/favicon.ico';?>" />
    <?php
        echo $this->Html->script(array('jquery.min'));
        echo $this->Html->css(array(
            'reset',
            'pantalla_completa',
            'jquery-ui-1.9.0.custom/jquery-ui-1.9.0.custom',
            'admin',
			/*'960'*/
        ));
        echo $this->Html->script(array(
			'jquery-ui-1.8.19.custom/js/jquery-ui-1.8.19.custom.min',            
            'admin',            
			'jquery.elastic-1.6.1.js',
            'superfish',
            'supersubs',
            'jquery.tipsy',
			'ajaxupload'
        ));
        echo $scripts_for_layout;
				
    ?>
	<script>
	jQuery(document).ajaxStart(function(){
		$("div#actualizando").show();
	})
	
	jQuery(document).ajaxStop(function(){
		$("div#actualizando").hide();
	})
	</script>
</head>

<body>
    <div id="wrapper">
        <div id="header">
            <div class="container_16">
                <div class="grid_8">
                    <div id="logo" style="height:25px;">
                        <?php echo $this->element('admin/logo'); ?>
                    </div>
                </div>
                <div class="div-quick">
                    <?php echo $this->element('admin/quick'); ?>
                </div>
				<div id="actualizando">Actualizando...</div>
                <div class="clear">&nbsp;</div>
            </div>
            <div class="clear">&nbsp;</div>
        </div>

        <div id="nav-container">
            <div class="container_16" style="padding-left:15px;">
                <?php echo $this->element("admin/navigation"); ?>
            </div>
        </div>
        <div id="main" class="container_16">
            <div class="grid_16">
                <div id="content">
                    <?php
                        echo $content_for_layout;
                    ?>
                </div>
            </div>
            <div class="clear">&nbsp;</div>
        </div>

        <?php echo $this->element('admin/footer'); ?>

    </div>
<?php
// DEBUG 
//echo $cakeDebug;
//echo $this->element('sql_dump');
?>
    </body>
</html>