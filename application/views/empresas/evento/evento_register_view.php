<form method ="post" action="<?php echo base_url()?>evento/registrar">
	<?php if(isset($ok) && $ok):?>
		<div class="ok">
			<p>Registro realizado corrrectamente</p>
		</div>
	<?php else:?>
		<div class="data_error">
			<?php echo validation_errors();?>
		</div>
	<?php endif;?>

	<h2>Registro de evento</h2>
	

	<label for="txtNombre_evento">Nombre *</label>
	<input type="text" name="txtNombre_evento" id="txtNombre_evento" value="<?php echo (isset($ok) && $ok) ? '':set_value('txtNombre_evento')?>"/>

	<label for="txtDescripcion_evento">Descripcion *</label>
	<input type="text" name="txtDescripcion_evento" id="txtDescripcion_evento" value="<?php echo (isset($ok) && $ok) ? '':set_value('txtDescripcion_evento')?>"/>

	<label for="txtValor_compra">Valor compra *</label>
	<input type="text" name="txtValor_compra" id="txtValor_compra" value="<?php echo (isset($ok) && $ok) ? '':set_value('txtValor_compra')?>"/>

	<label for="txtValor_venta">Valor venta *</label>
	<input type="text" name="txtValor_venta" id="txtValor_venta" value="<?php echo (isset($ok) && $ok) ? '':set_value('txtValor_venta')?>"/>

	<label for="txtDireccion_evento">Direccion *</label>
	<input type="text" name="txtDireccion_evento" id="txtDireccion_evento" value="<?php echo (isset($ok) && $ok) ? '':set_value('txtDireccion_evento')?>"/>

	<label for="txtCupos">Cupos *</label>
	<input type="text" name="txtCupos" id="txtCupos" value="<?php echo (isset($ok) && $ok) ? '':set_value('txtCupos')?>"/>

	<label for="txtLugar">Lugar *</label>
	<input type="text" name="txtLugar" id="txtLugar" value="<?php echo (isset($ok) && $ok) ? '':set_value('txtLugar')?>"/>

	<label for="txtFecha_inicio">Fecha de ininicio *</label>
	<input type="date" name="txtFecha_inicio" id="txtFecha_inicio" value="<?php echo (isset($ok) && $ok) ? '':set_value('txtFecha_inicio')?>"/>

	<label for="txtFecha_fin">Fecha fin *</label>
	<input type="date" name="txtFecha_fin" id="txtFecha_fin" value="<?php echo (isset($ok) && $ok) ? '':set_value('txtFecha_fin')?>"/>

	<label for="txtHora_ingreso">Hora del evento *</label>
	<input type="time" name="txtHora_ingreso" id="txtHora_ingreso" value="<?php echo (isset($ok) && $ok) ? '':set_value('txtHora_ingreso')?>"/>

	<label for="txtHora_salida">Hora de terminacion *</label>
	<input type="time" name="txtHora_salida" id="txtHora_salida" value="<?php echo (isset($ok) && $ok) ? '':set_value('txtHora_salida')?>"/>

	<div class="groupButton">
		<button type="submit"><span></span>Guardar</button>
		<button type="button" class="consultar" data-link="<?php echo base_url()?>evento/consultar"><span></span>Consultar</button>
	</div>
</form>