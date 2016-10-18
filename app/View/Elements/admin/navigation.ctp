<div id="nav">
    <ul class="sf-menu">

        <li>
            <a href="#"><span class="ui-icon ui-icon-folder-open"></span><?php echo __('Planes',true); ?></a>
 			<ul>
               <li><?php echo $this->Html->link('<span class="ui-icon ui-icon-document"></span>' . __('Lista', true), array('plugin' => 0, 'controller' => 'planes', 'action' => 'index'), array('escape' => false)); ?></li>
               <li><?php echo $this->Html->link('<span class="ui-icon ui-icon-plus"></span>' . __('Agregar Plan', true), array('plugin' => 0, 'controller' => 'planes', 'action' => 'add'), array('class' => 'separator', 'escape' => false)); ?></li>
			   <li><?php echo $this->Html->link('<span class="ui-icon ui-icon-plus"></span>' . __('Editar precios', true), array('plugin' => 0, 'controller' => 'planes', 'action' => 'edit_prices'), array('class' => 'separator', 'escape' => false)); ?></li> 
 			</ul>
        </li>
		
		<li>
            <a href="#"><span class="ui-icon ui-icon-tag"></span><?php echo __('Modelos',true); ?></a>
            <ul>
                <li><?php echo $this->Html->link('<span class="ui-icon ui-icon-document"></span>' . __('Lista', true), array('plugin' => 0, 'controller' => 'modelos', 'action' => 'index'), array('escape' => false)); ?></li>       
				<li><?php echo $this->Html->link('<span class="ui-icon ui-icon-plus"></span>' . __('Agregar Modelo', true), array('plugin' => 0, 'controller' => 'modelos', 'action' => 'add'), array('class' => 'separator', 'escape' => false)); ?></li> 
            </ul>
        </li>
		
        
		<li>
            <a href="#"><span class="ui-icon ui-icon-tag"></span><?php echo __('Marcas',true); ?></a>
            <ul>
                <li><?php echo $this->Html->link('<span class="ui-icon ui-icon-document"></span>' . __('Lista', true), array('plugin' => 0, 'controller' => 'marcas', 'action' => 'index'), array('escape' => false)); ?></li>       
				<li><?php //echo $this->Html->link('<span class="ui-icon ui-icon-plus"></span>' . __('Agregar Modelo', true), array('plugin' => 0, 'controller' => 'modelos', 'action' => 'add'), array('class' => 'separator', 'escape' => false)); ?></li> 
            </ul>
        </li>
		
		<li>
            <a href="#"><span class="ui-icon ui-icon-person"></span><?php echo __('Administradores',true); ?></a>
            <ul>
                <li><?php echo $this->Html->link('<span class="ui-icon ui-icon-document"></span>' . __('Lista', true), array('plugin' => 0, 'controller' => 'admins', 'action' => 'index'), array('escape' => false)); ?></li>
                <li><?php echo $this->Html->link('<span class="ui-icon ui-icon-plus"></span>' . __('Agregar', true), array('plugin' => 0, 'controller' => 'admins', 'action' => 'add'), array('escape' => false)); ?></li>
            </ul>
        </li>
		
		<li>
            <a href="#"><span class="ui-icon ui-icon-mail-closed"></span><?php echo __('Consultas',true); ?></a>
            <ul>
                <li><?php echo $this->Html->link('<span class="ui-icon ui-icon-document"></span>' . __('Lista', true), array('plugin' => 0, 'controller' => 'contactos', 'action' => 'index'), array('escape' => false)); ?></li>                
            </ul>
        </li>
        
  <li>
            <a href="#"><span class="ui-icon ui-icon-document"></span><?php echo __('Textos dinámicos',true); ?></a>
            <ul>
                <li><?php echo $this->Html->link('<span class="ui-icon ui-icon-document"></span>' . __('Lista', true), array('plugin' => 0, 'controller' => 'textosdinamicos', 'action' => 'index'), array('escape' => false)); ?></li>
            </ul>
		</li>
		
	</ul>
</div>