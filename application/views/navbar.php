<nav class = "nav navbar" id="navbar">
  <ul>


<?php if($this->session->userdata('rol')==1):?>

  
    <li>
      <a href="<?php echo base_url()?>login/index" id="acerca_de">
        <span class="glyphicon glyphicon-tag"></span> 
        <span class="item-text">Acerda de</span>
      </a>
    </li>

    <li>
      <a href="<?php echo base_url()?>reserva" id="inicio">
        <span class="glyphicon glyphicon-home"></span> 
        <span>Inicio</span>
      </a>
    </li>

    <li>
      <a href="javascript:void(0);">
        <span class="glyphicon glyphicon-stats"></span> 
        <span>Empresas</span>
      </a>
      <ul class="sub">
        <li><a href="<?php echo base_url()?>hospedaje"><span>Hospedaje</span></a></li>
        <li><a href="<?php echo base_url()?>transport_company"><span>Transporte</span></a></li>
        <li><a href="<?php echo base_url()?>banco"><span>Banco</span></a></li>
        <li><a href="<?php echo base_url()?>evento"><span>Evento</span></a></li>
        <li><a href="<?php echo base_url()?>additional_service"><span>Servicio adicional</span></a></li>
      </ul>
    </li>

    <li>
      <a href="<?php echo base_url()?>citytour" id="citytour">
        <span class="glyphicon glyphicon-road"></span>  
        <span class="item">City tour</span>
      </a>
    </li>

    <li>
      <a href="<?php echo base_url()?>convenio" id="convenio">
        <span class="glyphicon glyphicon-list-alt"></span>  
        <span>Convenio</span>
      </a>
    </li>

    <li>
      <a href="<?php echo base_url()?>usuario/cliente" id="cliente">
        <span class="glyphicon glyphicon-user"></span> 
        <span>Cliente</span>
      </a>
    </li>

    <li>
      <a href="<?php echo base_url()?>usuario/empleado" id="empleado">
        <span class="glyphicon glyphicon-user"></span>
        <span>Empleado</span>
      </a>
    </li>

    <li>
      <a href="<?php echo base_url()?>reserva" id="reserva">
        <span class="glyphicon glyphicon-usd"></span> 
        <span>Reservas</span>
      </a>
    </li>

    <li>
      <a href="<?php echo base_url()?>paquete/index" id="paquete">
        <span class="glyphicon glyphicon-home"></span>  
        <span>Paquetes</span>
      </a>
    </li>

    <li>
      <a href="<?php echo base_url()?>informe/index" id="informe">
        <span class="glyphicon glyphicon-paperclip"></span>  
        <span>Informes</span>
      </a>
    </li>

    <li>
      <a href="<?php echo base_url()?>cuenta" id="cuenta">
        <span class="glyphicon glyphicon-home"></span> 
        <span>Cuentas de usuario</span>
      </a>
    </li>

    <li>
      <a href="<?php echo base_url()?>novedad/index" id="novedad">
        <span class="glyphicon glyphicon-file"></span>  
        <span>Novedades</span>
      </a>
    </li>


    <li>
      <a href="<?php echo base_url()?>buckup/index" id="bakups">
        <span class="glyphicon glyphicon-lock"></span>  
        <span>Bakups</span>
      </a>
    </li>

    <li>
      <a href="<?php echo base_url()?>" id="ayuda">
        <span class="glyphicon glyphicon-question-sign"></span>  
        <span>Ayuda</span>
      </a>
    </li>

  <?php else:?>


          <li>
      <a href="<?php echo base_url()?>" id="acerca_de">
        <span class="glyphicon glyphicon-tag"></span> 
        <span class="item-text">Acerda de</span>
      </a>
    </li>

    <li>
      <a href="<?php echo base_url()?>" id="inicio">
        <span class="glyphicon glyphicon-home"></span> 
        <span>Inicio</span>
      </a>
    </li>
        <li>
      <a href="<?php echo base_url()?>usuario/cliente" id="cliente">
        <span class="glyphicon glyphicon-user"></span> 
        <span>Cliente</span>
      </a>
    </li>
        <li>
      <a href="<?php echo base_url()?>cuenta" id="cuenta">
        <span class="glyphicon glyphicon-home"></span> 
        <span>Cuentas de usuario</span>
      </a>
    </li>

    <li>
      <a href="<?php echo base_url()?>novedad/index" id="novedad">
        <span class="glyphicon glyphicon-file"></span>  
        <span>Novedades</span>
      </a>
    </li>
        <li>
      <a href="<?php echo base_url()?>" id="ayuda">
        <span class="glyphicon glyphicon-question-sign"></span>  
        <span>Ayuda</span>
      </a>
    </li>

    <?php endif;?>

  </ul>
</nav>