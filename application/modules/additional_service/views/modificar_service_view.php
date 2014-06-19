<form method ="post" id="form" action="<?php echo base_url()?>additional_service/actualizar_servicio">
	<?php if(isset($ok) && $ok):?>
		<div class="message success">
			<p>Registro Actualizado correctamente</p>
		</div>
	<?php else :?>
		<div class="message error">
			<?php echo validation_errors();?>
		</div>
	<?php endif;?>
	<h2>Actualización de servicios adicionales</h2>
	<?php foreach ($datos as $value):?>
		<label for="tipo">Tipo Servicio</label>
		<?php $id_tipo = $value->id_2;?>
		<select name="tipo" >
			<option value="<?php echo $value->id_2?>" selected><?php echo $value->nombres?></option>
			<?php if(isset($tipo)):?>
				<?php foreach ($tipo as $values):?>
					<?php if($values->id!=$id_tipo):?>
						<option value="<?php echo $values->id?>"><?php echo $values->nombre?></option>
					<?php endif;?>
				<?php endforeach;?>
			<?php endif;?>
		</select>

		<input type="hidden" name="id" value="<?php echo $value->id?>"/>
		<label for="nombre">Nombre *</label>
		<input type="text" name="nombre" id="nombre" value="<?php echo $value->nombre?>"/>

		<label for="descripcion">Descripción</label>
		<textarea rows="7" cols="30" name="descripcion" id="descripcion">
			<?php echo trim($value->descripcion)?>
		</textarea>
	<?php endforeach;?>
	
	<div class="group_button">
		<button type="button" class="data btn" data-link="<?php echo base_url()?>additional_service/consultar">
			<span class="glyphicon glyphicon-remove-circle"></span> Cancelar
		</button>
		<button type="submit" class="btn">
			<span class="glyphicon glyphicon-edit"></span> Modificar
		</button>
	</div>
</form>