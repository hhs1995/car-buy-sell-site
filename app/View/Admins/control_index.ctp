<div class="admins index">
    <h2><?php __('Administradores');?></h2>

    <div class="actions">
        <ul>
            <li><?php echo $this->Html->link(__('Nuevo Administrador', true), array('action'=>'add')); ?></li>
        </ul>
    </div>

    <table cellpadding="0" cellspacing="0">
    <?php
        $tableHeaders =  $this->Html->tableHeaders(array(
            $this->Paginator->sort('id'),
            __('Rol', true),
            $this->Paginator->sort('username'),
            $this->Paginator->sort('nombre'),
            $this->Paginator->sort('apellido'),
            $this->Paginator->sort('email'),
            __('Acciones', true),
        ));
        echo $tableHeaders;

        $rows = array();
        foreach ($users AS $user) {
            $actions  = $this->Html->link(__('Edit', true), array('controller' => 'admins', 'action' => 'edit', $user['Admin']['id']));
            //$actions .= ' ' . $layout->adminRowActions($user['Admin']['id']);
          $actions .= ' ' . $this->Html->link(__('Delete', true), array(
                'controller' => 'admins',
                'action' => 'delete',
                $user['Admin']['id'],
              /*  'token' => $this->params['_Token']['key'],*/
            ), null, __('Are you sure?', true));

            $rows[] = array(
                $user['Admin']['id'],
                $user['Admin']['rol'],
                $user['Admin']['username'],
                $user['Admin']['nombre'],
                $user['Admin']['apellido'],
                $user['Admin']['email'],
                $actions,
            );
        }

        echo $this->Html->tableCells($rows);
    ?>
    </table>
</div>

<!--<div class="paging"><?php echo $this->Paginator->numbers(); ?></div>
<div class="counter"><?php echo $this->Paginator->counter(array('format' => __('Pagina %page%/%pages%, mostrando %current% items de %count% totales, empezando desde %start%, terminando en %end%', true))); ?></div>-->