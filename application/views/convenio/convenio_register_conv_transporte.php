<form method ="post" action="<?php echo base_url()?>convenio/registrar_conv_transporte">
	<?php if(isset($ok) && $ok):?>
		<div class="ok">
			<p>Registro realizado corrrectamente</p>
		</div>
	<?php else:?>
		<div class="data_error">
			<?php echo validation_errors();?>
		</div>
	<?php endif;?>

	<h2>Registro de convenio para empresas de transpote</h2>
	<label for="txtFecha_convenio">Fecha del convenio *</label>
	<input type="date" name="txtFecha_convenio" id="txtFecha_convenio" value="<?php echo (isset($ok) && $ok) ? '':set_value('txtFecha_convenio')?>"/>

	<label for="txtCosto">Costo *</label>
	<input type="text" name="txtCosto" id="txtCosto" value="<?php echo (isset($ok) && $ok) ? '':set_value('txtCosto')?>"/>

	<label for="txtVenta">Venta *</label>
	<input type="text" name="txtVenta" id="txtVenta" value="<?php echo (isset($ok) && $ok) ? '':set_value('txtVenta')?>"/>


	<label for="txtCupos">Cupos *</label>
	<input type="text" name="txtCupos" id="txtCupos" value="<?php echo (isset($ok) && $ok) ? '':set_value('txtCupos')?>"/>

	<label for="txtFecha_inicio">Fecha inicio *</label>
	<input type="date" name="txtFecha_inicio" id="txtFecha_inicio" value="<?php echo (isset($ok) && $ok) ? '':set_value('txtFecha_inicio')?>"/>

	<label for="txtFecha_fin">Fecha inicio *</label>
	<input type="date" name="txtFecha_fin" id="txtFecha_fin" value="<?php echo (isset($ok) && $ok) ? '':set_value('txtFecha_fin')?>"/>

	<div class="groupButton">
		<button type="submit"><span></span>Guardar</button>
		<button type="button" class="consultar" data-link="<?php echo base_url()?>convenio/consultar_convenio_transporte"><span></span>Consultar</button>
	</div>
</form>