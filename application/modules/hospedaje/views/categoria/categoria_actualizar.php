<form method ="post" id = "form" action="<?php echo base_url()?>hospedaje/modificar_categoria">
	<?php if($ok):?>
		<div class="message success">
			<p>Modificación realizada correctamente</p>
		</div>
	<?php endif;?>
	<?php if(!$ok):?>
		<div class="message error">
			<?php echo validation_errors();?>
		</div>
	<?php endif;?>
	<h2>Modificar categoría</h2>
	<?php foreach ($datos as $value):?>
		<input type="hidden" name="id" value="<?php echo $value->id?>"/>

		<label for="categoria">Categoría *</label>
		<input type="text" name="categoria" id="categoria" value="<?php echo $value->categoria?>">

		<label for="descripcion">Descripción</label>
		<textarea rows="7" cols="5" name="descripcion" id="descripcion" ><?php echo $value->descripcion?></textarea>
	<?php endforeach;?>		
	<div class="group_button">
		<button type="button" class="data btn" data-link="<?php echo base_url()?>hospedaje/consultar_categoria">
			<span class="glyphicon glyphicon-remove-circle"></span> Cancelar
		</button>

		<button type="submit" class = "btn">
			<span class="glyphicon glyphicon-edit"></span> Modificar
		</button>
	</div>
</form>