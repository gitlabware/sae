<header class="navbar navbar-inverse">
    <ul class="nav navbar-nav-custom">
        <li>
            <a href="javascript:void(0)" onclick="App.sidebar('toggle-sidebar');">
                <i class="fa fa-bars fa-fw"></i>
            </a>
        </li>
        <li class="dropdown">
            <a href="<?php echo $this->Html->url(array('controller' => 'Edificios', 'action' => 'ambientes')); ?>" title="Ambientes">
                <i class="gi gi-tags"></i>
            </a>
        </li>
        <li class="dropdown">
            <a href="<?php echo $this->Html->url(array('controller' => 'Cuentas', 'action' => 'index')); ?>" title="Cuentas - Bancos/Cajas">
                <i class="gi gi-cargo"></i>
            </a>
        </li>
        <li class="dropdown">
            <a href="<?php echo $this->Html->url(array('controller' => 'Presupuestos', 'action' => 'index')); ?>" title="Presupuestos">
                <i class="gi gi-coins"></i>
            </a>
        </li>
        <li class="dropdown">
            <a href="<?php echo $this->Html->url(array('controller' => 'Comprobantes', 'action' => 'no_comprobados')); ?>" title="Comprobantes pendientes">
                <i class="gi gi-justify"></i>
            </a>
        </li>
        <li class="dropdown">
            <a href="javascript:" title="Imprimir" onclick="pop_print();">
                <i class="gi gi-print"></i>
            </a>
        </li>
    </ul>
</header>
