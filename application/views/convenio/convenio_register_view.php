<form method ="post" action="<?php echo base_url()?>convenio/registrar_conv_hospedaje">
	<?php if(isset($ok) && $ok):?>
		<div class="ok">
			<p>Registro realizado corrrectamente</p>
		</div>
	<?php else:?>
		<div class="data_error">
			<?php echo validation_errors();?>
		</div>
	<?php endif;?>

	<h2>Registro de convenio hospedaje</h2>
	<label for="txtFecha_convenio">Fecha del convenio *</label>
	<input type="date" name="txtFecha_convenio" id="txtFecha_convenio" value="<?php echo (isset($ok) && $ok) ? '':set_value('txtFecha_convenio')?>"/>

	<label for="txtCosto">Costo *</label>
	<input type="text" name="txtCosto" id="txtCosto" value="<?php echo (isset($ok) && $ok) ? '':set_value('txtCosto')?>"/>

	<label for="txtVenta">Venta *</label>
	<input type="text" name="txtVenta" id="txtVenta" value="<?php echo (isset($ok) && $ok) ? '':set_value('txtVenta')?>"/>

	<div class="groupButton">
		<button type="submit"><span></span>Guardar</button>
		<button type="button" class="consultar" data-link="<?php echo base_url()?>convenio/consultar_convenio_hospedaje"><span></span>Consultar</button>
	</div>
</form>