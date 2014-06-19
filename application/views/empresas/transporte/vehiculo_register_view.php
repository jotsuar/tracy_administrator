<form method ="post" action="<?php echo base_url()?>transporte/registrar_vehiculo">
	<?php if(isset($ok) && $ok):?>
		<div class="ok">
			<p>Registro realizado corrrectamente</p>
		</div>
	<?php else:?>
		<div class="data_error">
			<?php echo validation_errors();?>
		</div>
	<?php endif;?>
	<h2>Registro de vehiculo</h2>

	<label for="empresa">Nombre empresa *</label>
	<select name="empresa" id="empresa">
	 	<?php if(isset($empresa) && $empresa):?>
			<?php foreach ($empresa as $value):?>
			<option value="<?php echo $value->id ?>"> <?php echo $value->nombre?></option>
			<?php endforeach;?>
		<?php endif;?>
	</select>
	
	<label for="matricula_vehiculo">Matricula *</label>
	<input type="text" name="matricula_vehiculo" id="matricula_vehiculo" value="<?php echo (isset($ok) && $ok) ? '':set_value('matricula_vehiculo')?>"/>

	<label for="tipo_vehiculo">Tipo Vehiculo *</label>
	  <select name="tipo_vehiculo" id="tipo_vehiculo"> 
		<?php if(isset($tipo_vehiculo) && $tipo_vehiculo):?>
		<?php foreach ($tipo_vehiculo as $value):?>
		<option value="<?php echo $value->id ?>"> <?php echo $value->nombre?></option>
		<?php endforeach;?>
		<?php endif;?> 
	</select>  
	
	<label for="descripcion_vehiculo">Descripcion *</label>
	<textarea id="descripcion_vehiculo" name="descripcion_vehiculo" rows="10" cols="50" value="<?php echo (isset($ok) && $ok) ? '':set_value('descripcion_vehiculo')?>"/></textarea>

	<label for="cupos">Cupo Maximo *</label>
	<input type="text" name="cupos" id="cupos" value="<?php echo (isset($ok) && $ok) ? '':set_value('cupos')?>"/>
<!-- 
	<label for="Estado_vehiculo">Estado *</label>
	<input type="text" name="Estado_vehiculo" id="Estado_vehiculo" value="<?php echo (isset($ok) && $ok) ? '':set_value('Estado_vehiculo')?>"/>
 -->
	<div class="groupButton">
		<button type="submit"><span></span>Guardar</button>
		<button type="button" class="consultar" data-link="<?php echo base_url()?>transporte/consultar_vehiculo"><span></span>Consultar</button>
	</div>
</form>