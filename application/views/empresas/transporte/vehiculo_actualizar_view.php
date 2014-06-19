<div>
	
	<form method ="post" action="<?php echo base_url()?>transporte/actualizar">
		<?php if($ok):?>
			<div class="ok">
				<p>Modificación realizada corrrectamente</p>
			</div>
		<?php endif;?>
		<?php if(!$ok):?>
			<div class="data_error">
				<?php echo validation_errors();?>
			</div>
		<?php endif;?>
		<h2>Modificar Vehiculo</h2>
		<?php foreach ($datos as $value):?>
	<input type="hidden" name="id" value="<?php echo $value->id?>"/>

	<label for="empresa">Nombre empresa *</label>
	<select name="empresa" id="empresa">
	 	<?php if(isset($empresa) && $empresa):?>
			<?php foreach ($empresa as $values):?>
			<option value="<?php echo $values->id?>" selected="selected"> <?php echo $values->nombre?></option>
			<?php endforeach;?>
		<?php endif;?>
	</select>

	
	<label for="matricula_vehiculo">Matricula *</label>
	<input type="text" name="matricula_vehiculo" id="matricula_vehiculo" value="<?php echo $value->matricula?>"/>

		<label for="tipo_vehiculos">Vehiculo*</label>
	
	 <select name="tipo_vehiculo" id="tipo_vehiculo"> 
		<?php if(isset($tipo_vehiculo) && $tipo_vehiculo):?>
		<?php foreach ($tipo_vehiculo as $values):?>
		<option value="<?php echo $values->id?>" selected="selected"> <?php echo $values->nombre?></option>
		<?php endforeach;?>
		<?php endif;?> 
	</select>
 
	
	<label for="descripcion_vehiculo">Descripcion *</label>
	<textarea id="descripcion_vehiculo" name="descripcion_vehiculo" rows="10" cols="50" value=""/><?php echo $value->descripcion?></textarea>

	<label for="cupos">Cupo Maximo *</label>
	<input type="text" name="cupos" id="cupos" value="<?php echo $value->cupo_maximo?>"/>
<!-- 
	<label for="Estado_vehiculo">Estado *</label>
	<input type="text" name="Estado_vehiculo" id="Estado_vehiculo" value="<?php echo (isset($ok) && $ok) ? '':set_value('Estado_vehiculo')?>"/>
 -->
		<label for="Estado_vehiculo">Estado</label>
		<select name="Estado_vehiculo" id="Estado_vehiculo">

			<?php if($value->estado):?>
				<option value="1" selected="selected">Activo</option>
			<?php else:?>
				<option value="1">Activo</option>
			<?php endif;?>

			<?php if(!$value->estado):?>
				<option value="0">Inactivo</option>
			<?php else:?>
				<option value="0">Inactivo</option>
			<?php endif;?>

		</select>

		<?php endforeach;?>
		
		<div class="groupButton">
			<button type="button" class="consultar" data-link="<?php echo base_url()?>transporte/consultar"><span></span>Consultar</button>
			<button type="submit"><span></span>Modificar</button>
		</div>
	</form>

</div>
