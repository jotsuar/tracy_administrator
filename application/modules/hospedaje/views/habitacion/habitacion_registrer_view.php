<form method ="post" id ="form" action="<?php echo base_url()?>hospedaje/habitacion/">
	<?php if(isset($ok) && $ok):?>
		<div class = "message success">
			<p>Registro realizado correctamente</p>
		</div>
	<?php else :?>
		<div class = "message error">
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
	<input type="number" name="cantidad" value="" placeholder="1">	

	<label for="Cantidad">Valor $</label>
	<input type="text" name="valor" value="" placeholder="200000">	
	
	<div class="group_button">
		<button type="button" class="data btn" data-link="<?php echo base_url()?>hospedaje/habitacion/consultar">
			<span class = "glyphicon glyphicon-list-alt"></span> Consultar
		</button>

		<button class = "btn" type="submit">
			<span class = "glyphicon glyphicon-floppy-disk"></span> Guardar
		</button>
	</div>
</form>