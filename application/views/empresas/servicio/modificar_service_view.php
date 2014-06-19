<div>
<form method ="post" action="<?php echo base_url()?>servicio_add/actualizar_servicio">
	<?php if(isset($ok) && $ok):?>
		<div class="ok">
			<p>Registro Actualizado corrrectamente</p>
		</div>
	<?php else :?>
		<div class="data_error">
			<?php echo validation_errors();?>
		</div>
	<?php endif;?>
	<h2>Actualizacion de servicios adicionales</h2>
	<?php foreach ($datos as $value):?>
		<label for="Tipo">Tipo Servicio</label>
		<?php $id_tipo = $value->id_2;  ?>
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
		<textarea rows="7" cols="30" name="descripcion" 
		id="descripcion" /><?php echo $value->descripcion?></textarea>
	<?php endforeach;?>
	
	<div class="groupButton">
		<button type="button" class="consultar" data-link="<?php echo base_url()?>servicio_add/consultar"><span></span>Consultar</button>
		<button type="submit"><span></span>Guardar</button>
	</div>
</form>
<div>