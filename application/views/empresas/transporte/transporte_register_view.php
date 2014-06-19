<form method ="post" action="<?php echo base_url()?>transporte/registrar">
	<?php if(isset($ok) && $ok):?>
		<div class="ok">
			<p>Registro realizado corrrectamente</p>
		</div>
	<?php else:?>
		<div class="data_error">
			<?php echo validation_errors();?>
		</div>
	<?php endif;?>
	<h2>Registro de transporte</h2>
	<label for="nit_empresa">Nit *</label>
	<input type="text" name="nit_empresa" id="nit_empresa" value="<?php echo (isset($ok) && $ok) ? '':set_value('nit_empresa')?>"/>

	<label for="nombre_empresa">Nombre *</label>
	<input type="text" name="nombre_empresa" id="nombre_empresa" value="<?php echo (isset($ok) && $ok) ? '':set_value('nombre_empresa')?>"/>

	<label for="direccion_empresa">Dirección *</label>
	<input type="text" name="direccion_empresa" id="direccion_empresa" value="<?php echo (isset($ok) && $ok) ? '':set_value('direccion_empresa')?>"/>

	<label for="telefono_empresa">Teléfono *</label>
	<input type="text" name="telefono_empresa" id="telefono_empresa" value="<?php echo (isset($ok) && $ok) ? '':set_value('telefono_empresa')?>"/>

	<label for="correo_empresa">Correo *</label>
	<input type="text" name="correo_empresa" id="correo_empresa" value="<?php echo (isset($ok) && $ok) ? '':set_value('correo_empresa')?>"/>

	<label for="seguro_transporte">Seguro transporte *</label>
	<select name="seguro_transporte" id="seguro_transporte">
		<option value="1">SI</option>
		<option value="0">NO</option>
	</select>

	<div class="groupButton">
		<button type="submit"><span></span>Guardar</button>
		<button type="button" class="consultar" data-link="<?php echo base_url()?>transporte/consultar"><span></span>Consultar</button>
	</div>
</form>