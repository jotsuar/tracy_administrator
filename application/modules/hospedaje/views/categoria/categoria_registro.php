<form method ="post" id = "form" action="<?php echo base_url()?>hospedaje/registrar_categoria">
	<?php if(isset($ok) && $ok):?>
		<div class="message success">
			<p>Registro realizado corrrectamente</p>
		</div>
	<?php else :?>
		<div class="message error">
			<?php echo validation_errors();?>
		</div>
	<?php endif;?>
	<h2>Registro de categoría</h2>
	<label for="categoria">Categoría *</label>
	<input type="text" name="categoria" id="categoria" value="<?php echo (isset($ok) && $ok) ? '':set_value('categoria')?>" placeholder = "5 Estrellas"/>

	<label for="descripcion">Descripción</label>
	<textarea rows="7" cols="30" name="descripcion" id="descripcion"></textarea>
	
	<div class = "group_button">
		<button type="button" class="data btn" data-link="<?php echo base_url()?>hospedaje/consultar_categoria">
			<span class = "glyphicon glyphicon-list-alt"></span> Consultar
		</button>
		<button type="submit" class="btn">
			<span class = "glyphicon glyphicon-floppy-disk"></span> Guardar
		</button>
	</div>
</form>