<?php
	// echo "<pre>";
	// print_r($vehiculo);
	// exit();
?>

<form method ="post" id = "form" action="<?php echo base_url()?>transporte/vehiculo/modificar">
	<?php if(isset($ok) && $ok):?>
		<div class = "message success">
			<p>Modificación realizada correctamente</p>
		</div>
		<?php else:?>
			<div class="message error">
		<?php echo validation_errors();?>
		</div>
	<?php endif;?>
	<h2>Modificar vehículo</h2>
	<input type="hidden" name="id" value="<?php echo $vehiculo->id?>"/>

	<label for="empresa">Nombre empresa *</label>
	<select name="empresa" id="empresa">
		<?php foreach ($empresas as $empresa):?>
			<?php if($empresa->id == $vehiculo->id_transporte):?>
			<option value="<?php echo $empresa->id?>" selected="selected"> <?php echo $empresa->nombre?></option>
			<?php else:?>
			<option value="<?php echo $empresa->id?>"> <?php echo $empresa->nombre?></option>
			<?php endif;?>
		<?php endforeach;?>
	</select>

	<label for="placa">Matricula *</label>
	<input type="text" name="placa" id="placa" value="<?php echo $vehiculo->placa?>"/>

	<label for="tipo">Vehiculo*</label>
	<select name="tipo" id="tipo"> 
		<?php foreach ($tipo_vehiculos as $tipo_vehiculo):?>
		<?php if($tipo_vehiculo->id == $vehiculo->id_tipo_vehiculo):?>
			<option value="<?php echo $tipo_vehiculo->id?>" selected="selected"> <?php echo $tipo_vehiculo->nombre?></option>
		<?php else:?>
		<option value="<?php echo $tipo_vehiculo->id?>"> <?php echo $tipo_vehiculo->nombre?></option>
		<?php endif;?>
		<?php endforeach;?>
	</select>


	<label for="descripcion">Descripcion *</label>
	<textarea id="descripcion" name="descripcion" rows="10" cols="50">
		<?php echo trim($vehiculo->descripcion)?>
	</textarea>

	<label for="cupos">Cupo Maximo *</label>
	<input type="number" name="cupos" id="cupos" value="<?php echo $vehiculo->cupo_maximo?>"/>

	<label for="estado">Estado</label>
	<select name="estado" id="estado">
		<?php if($vehiculo->estado):?>
			<option value="1" selected="selected">Activo</option>
			<option value="0">Inactivo</option>
		<?php else:?>
		<option value="0" selected="selected">Inactivo</option>
		<option value="1">Activo</option>
		<?php endif;?>
	</select>

	<div class="group_button">
		<button type="button" class="data btn" data-link="<?php echo base_url()?>transporte/vehiculo/consultar">
			<span class="glyphicon glyphicon-remove-circle"></span> Cancelar
		</button>
		<button type="submit" class="btn">
			<span class = "glyphicon glyphicon-edit"></span> Modificar
		</button>
	</div>
</form>