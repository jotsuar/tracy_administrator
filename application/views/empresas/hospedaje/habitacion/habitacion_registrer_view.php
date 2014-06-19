<form method ="post" action="<?php echo base_url()?>habitacion">
	<?php if(isset($ok) && $ok):?>
		<div class="ok">
			<p>Registro realizado corrrectamente</p>
		</div>
	<?php else :?>
		<div class="data_error">
			<?php echo validation_errors();?>
		</div>
	<?php endif;?>
	<h2>Registro de Habitaciones</h2>
	<label for="Hospejdaje">Hospedaje al que pertenece</label>
	<select name="hospedaje" >
		<?php if(isset($hospedaje)):?>
			<?php foreach ($hospedaje as $value):?>
				<option value="<?php echo $value->id?>"><?php echo $value->nombre?></option>
			<?php endforeach;?>
		<?php endif;?>		
	</select>
		<label for="Tipo">Tipo Habitacion</label>
	<select name="tipo" >
		<?php if(isset($tipo)):?>
			<?php foreach ($tipo as $value):?>
				<option value="<?php echo $value->id?>"><?php echo $value->nombre?></option>
			<?php endforeach;?>
		<?php endif;?>
	</select>
	<label for="descripcion">Comodidades</label>
	<textarea rows="7" cols="30" name="comodidades" id="descripcion" value="<?php echo (isset($ok) && $ok) ? '':set_value('comodidades')?>"></textarea>
	<label for="Cantidad">Cantidad</label>
	<input type="text" name="cantidad" value="" placeholder="1">	
	
	<div class="groupButton">
		<button type="button" class="consultar" data-link="<?php echo base_url()?>servicio_add/consultar"><span></span>Consultar</button>
		<button type="submit"><span></span>Guardar</button>
	</div>
</form>