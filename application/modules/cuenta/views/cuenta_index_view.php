<div class="nav content_menu four_items">
	<ul>
		<li><a href="<?php echo base_url()?>cuenta/cuenta_cliente">Cliente</a></li>
	<?php if($this->session->userdata('rol')==1):?>
		<li><a href="<?php echo base_url()?>cuenta/cuenta_empleado">Empleado</a></li>
	<?php endif;?>
	<li><a href="<?php echo base_url()?>cuenta/reestablecer">Mi cuenta</a></li>
	</ul>
</div>