<form method ="post" action="<?php echo base_url()?>hospedaje/registrar_categoria">
	<?php if(isset($ok) && $ok):?>
		<div class="ok">
			<p>Registro realizado corrrectamente</p>
		</div>
	<?php else :?>
		<div class="data_error">
			<?php echo validation_errors();?>
		</div>
	<?php endif;?>
	<h2>Registro de categoría</h2>
	<label for="categoria">Categoría *</label>
	<input type="text" name="categoria" id="categoria" value="<?php echo (isset($ok) && $ok) ? '':set_value('categoria')?>" placeholder = "5 Estrellas"/>

	<label for="descripcion">Descripción</label>
	<textarea rows="7" cols="30" name="descripcion" id="descripcion"></textarea>
	
	<div class="groupButton">
		<button type="button" class="consultar" data-link="<?php echo base_url()?>hospedaje/consultar_categoria"><span></span>Consultar</button>
		<button type="submit"><span></span>Guardar</button>
	</div>
</form>