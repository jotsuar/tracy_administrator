<div>
	
	<form method ="post" action="<?php echo base_url()?>transporte/actualizar_tipo_vehiculo">
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
		<h2>Modificar de tipo vehiculo</h2>
		<?php foreach ($datos as $value):?>
		<input type="hidden" name="id" value="<?php echo $value->id?>"/>

		
	<label for="nombre_vehiculo">vehiculo *</label>
	<input type="text" name="nombre_vehiculo" id="nombre_vehiculo" value="<?php echo $value->nombre?>"/>

<!-- 		<label for="estado">Estado</label>
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

		</select> -->

		<?php endforeach;?>
		
		<div class="groupButton">
			<button type="button" class="consultar" data-link="<?php echo base_url()?>consultar_tipo_vehiculo"><span></span>Consultar</button>
			<button type="submit"><span></span>Modificar</button>
		</div>
	</form>

</div>
