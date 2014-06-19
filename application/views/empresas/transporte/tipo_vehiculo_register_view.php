<form method ="post" action="<?php echo base_url()?>transporte/tipo_vehiculo">
	<?php if(isset($ok) && $ok):?>
		<div class="ok">
			<p>Registro realizado corrrectamente</p>
		</div>
	<?php else:?>
		<div class="data_error">
			<?php echo validation_errors();?>
		</div>
	<?php endif;?>
	<h2>Registro de tipo vehiculo</h2>


	<label for="nombre_vehiculo">vehiculo *</label>
	<input type="text" name="nombre_vehiculo" id="nombre_vehiculo" value="<?php echo (isset($ok) && $ok) ? '':set_value('nombre_vehiculo')?>"/>

	<div class="groupButton">
		<button type="submit"><span></span>Guardar</button>
		<button type="button" class="consultar" data-link="<?php echo base_url()?>transporte/consultar_tipo_vehiculo"><span></span>Consultar</button>
	</div>
</form>