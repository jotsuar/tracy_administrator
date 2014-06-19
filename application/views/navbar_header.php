<header class = "nav navbar-header">
		<a href="<?php echo base_url()?>">
			<img src = "<?php echo base_url()?>public/img/ico/logo.png" alt="traveling city" title="traveling city"/>
		</a>
	<span class = "slogan" title="Traveling city">Tracy</span>
	<a href="<?php echo base_url()?>home/logout_ci">Cerrar Sesion <?php echo $this->session->userdata('username') ?></a>
</header>