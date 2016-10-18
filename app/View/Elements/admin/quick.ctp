<div id="quick">
<div>
	<?php
		if( $this->Session->read('Admin') != null) { 
			echo __("Usuario: ", true) . $this->Session->read('Admin.nombre').' '.$this->Session->read('Admin.apellido').' ('.$this->Session->read('Admin.username').')'; 
			echo " | " . $this->Html->link(__("Salir", true).'', array('plugin' => 0, 'controller' => 'admins', 'action' => 'logout'));
		}
	?>
</div>
<script language="javascript">

</script>
</div>