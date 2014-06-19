<form method ="post" action="<?php echo base_url()?>servicio_add/registrar_servicio">
	<?php if(isset($ok) && $ok):?>
		<div class="ok">
			<p>Registro realizado corrrectamente</p>
		</div>
	<?php else :?>
		<div class="data_error">
			<?php echo validation_errors();?>
		</div>
	<?php endif;?>
	<h2>Registro de servicio adicional</h2>
	<label for="Tipo">Tipo Servicio</label>
	<select name="tipo" >
		<?php if(isset($tipo)):?>
			<?php foreach ($tipo as $value):?>
				<option value="<?php echo $value->id?>"><?php echo $value->nombre?></option>
			<?php endforeach;?>
		<?php endif;?>
		
	</select>
	<label for="nombre">Nombre *</label>
	<input type="text" name="nombre" id="nombre" value="<?php echo (isset($ok) && $ok) ? '':set_value('nombre')?>"/>

	<label for="descripcion">Descripción</label>
	<textarea rows="7" cols="30" name="descripcion" id="descripcion" value="<?php echo (isset($ok) && $ok) ? '':set_value('descripcion')?>"></textarea>
	
	<div class="groupButton">
		<button type="button" class="consultar" data-link="<?php echo base_url()?>servicio_add/consultar"><span></span>Consultar</button>
		<button type="submit"><span></span>Guardar</button>
	</div>
</form>