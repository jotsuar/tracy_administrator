<form method = "post" id = "form" action = "<?php echo base_url()?>transport_company/vehiculo">
	<?php if(isset($ok) && $ok):?>
		<div class="message success">
			<p>Registro realizado correctamente</p>
		</div>
	<?php else:?>
		<div class="message error">
			<?php echo validation_errors();?>
		</div>
	<?php endif;?>

	<h2>Registro de vehículo</h2>

	<label for = "empresa">Nombre empresa *</label>
	<select name = "empresa" id = "empresa">
	 	<?php if(isset($empresas) && $empresas):?>
			<?php foreach ($empresas as $empresa):?>
			<option value="<?php echo $empresa->id ?>"> <?php echo $empresa->nombre?></option>
			<?php endforeach;?>
		<?php endif;?>
	</select>
	
	<label for = "placa">Placa *</label>
	<input type = "text" name = "placa" id = "placa" 
	value = "<?php echo (isset($ok) && $ok) ? '' : set_value('placa')?>"/>

	<label for = "tipo">Tipo vehículo *</label>
	  <select name = "tipo" id="tipo"> 
		<?php foreach ($tipo_vehiculos as $tipo):?>
		<option value = "<?php echo $tipo->id ?>"> <?php echo $tipo->nombre?></option>
		<?php endforeach;?>
	</select>  
	
	<label for = "descripcion">Descripción</label>
	<textarea id = "descripcion" name = "descripcion" rows="10" cols="50" 
	value="<?php echo (isset($ok) && $ok) ? '':set_value('descripcion_vehiculo')?>"/></textarea>

	<label for = "cupos">Cupo máximo *</label>
	<input type = "number" name = "cupos" id="cupos" 
	value="<?php echo (isset($ok) && $ok) ? '' : set_value('cupos')?>"/>

	<div class="group_button">
		<button type = "button" class = "data btn" data-link = "<?php echo base_url()?>transport_company/vehiculo/consultar">
			<span class = "glyphicon glyphicon-list-alt"></span> Consultar
		</button>
		<button type = "submit" class = "btn">
			<span class = "glyphicon glyphicon-floppy-disk"></span> Guardar
		</button>
	</div>
</form>