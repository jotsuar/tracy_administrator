<div>
	<?php foreach ($datos as $value):?>
	<form method ="post" action="<?php echo base_url()."convenio/actualizar"?>">
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
		<h2>Modificar convenio</h2>
	<input type="hidden" name="id_convenio" value="<?php echo $value->id?>">
	<label for="Numero">Numero Convenio </label>
	<input type="text" name="numero_convenio" value="<?php echo $value->numero_convenio ?>">
	<label for="Empresa"> <?php echo $empresa?> </label>
	<select name="id_empresa" id="evento">
	<?php foreach ($combo as $values):?>
	<option value="<?php echo $value->id ?>"> <?php echo $value->nombre ?> </option>
	<?php endforeach;?>
	</select>

	<label for="txtFecha_inicio">Fecha inicio *</label>
	<input type="date" name="txtFecha_inicio" id="txtFecha_inicio" value="<?php echo $value->fecha_inicio?>"/>

	<label for="txtFecha_fin">Fecha inicio *</label>
	<input type="date" name="txtFecha_fin" id="txtFecha_fin" value="<?php echo $value->fecha_fin?>"/>

	<label for="txtCosto">Costo *</label>
	<input type="text" name="txtCosto" id="txtCosto" value="<?php echo $value->costo?>"/>

	<?php if ($empresa != "Banco"):?>

	<label for="txtVenta">Venta *</label>
	<input type="text" name="txtVenta" id="txtVenta" value="<?php echo $value->venta?>"/>
	

	<?php endif;?>


		<label for="estado_convenio">Estado</label>
		<select name="estado" id="estado">

			
			<?php if($value->estado):?>
				<option value="1" selected="selected">Activo</option>
			<?php else:?>
				<option value="1">Activo</option>
			<?php endif;?>

			<?php if(!$value->estado):?>
				<option value="0" selected="selected">Inactivo</option>
			<?php else:?>
				<option value="0">Inactivo</option>
			<?php endif;?>

		</select>


		
		<div class="groupButton">
			<button type="button" class="consultar" data-link="<?php echo base_url()."convenio/consultar_convenio/0/".$value->tipo_convenio?>"><span></span>Consultar</button>
			<button type="submit"><span></span>Modificar</button>
		</div>
				<?php endforeach;?>
	</form>

</div>