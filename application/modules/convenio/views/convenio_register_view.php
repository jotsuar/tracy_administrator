<form method ="post" id="form" action="<?php echo base_url()."convenio/registrar/".$tipo_empresa?>">
	<?php if(isset($ok) && $ok):?>
		<div class="message success">
			<p>Registro realizado correctamente</p>
		</div>
	<?php else:?>
		<div class="data_error">
			<?php echo validation_errors(); echo $mensaje?>
		</div>
	<?php endif;?>
	
	<h2>Registro de convenio <?php echo $empresa?></h2>

	<label for="Numero">Numero Convenio </label>
	<input type="text" name="numero_convenio" value="<?php echo (isset($ok) && $ok) ? '':set_value('numero_convenio')?>">
	<label for="Empresa"> <?php echo $empresa?> </label>
	<select name="id_empresa" id="evento">
		<?php foreach ($combo as $value):?>
		<option value="<?php echo $value->id ?>"> <?php echo $value->nombre ?> </option>
		<?php endforeach;?>
	</select>

	<label for="txtFecha_inicio">Fecha inicio *</label>
	<input type="date" name="txtFecha_inicio" id="txtFecha_inicio" value="<?php echo (isset($ok) && $ok) ? '':set_value('txtFecha_inicio')?>"/>

	<label for="txtFecha_fin">Fecha Fin *</label>
	<input type="date" name="txtFecha_fin" id="txtFecha_fin" value="<?php echo (isset($ok) && $ok) ? '':set_value('txtFecha_fin')?>"/>

	<label for="txtCosto">Costo *</label>
	<input type="text" name="txtCosto" id="txtCosto" value="<?php echo (isset($ok) && $ok) ? '':set_value('txtCosto')?>"/>

	<?php if ($empresa != "Banco"):?>

	<label for="txtVenta">Venta *</label>
	<input type="text" name="txtVenta" id="txtVenta" value="<?php echo (isset($ok) && $ok) ? '':set_value('txtVenta')?>"/>
	

	<?php endif;?>


	<div class="group_button">
		<button type="button" class="btn data" data-link="<?php echo base_url()."convenio/consultar_convenio/0/".$tipo_empresa?>">
			<span class = "glyphicon glyphicon-list-alt"></span> Consultar
		</button>
		<button type="submit" class="btn">
			<span class = "glyphicon glyphicon-floppy-disk"></span> Guardar
		</button>
	</div>
</form>