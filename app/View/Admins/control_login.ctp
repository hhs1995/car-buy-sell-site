<div class="admins login form">
    <?php echo $this->Form->create('Admin', array('url' => array('controller' => 'admins', 'action' => 'login')));?>
        <fieldset>
        <?php
            echo $this->Form->input('username', array('label'=>'Nombre de usuario'));
            echo $this->Form->input('password', array('label'=>'Clave'));
        ?>
        </fieldset>
	<?php
        echo $this->Form->end(__('Ingresar', true));
    ?>
</div>