<form method ="post" id="form" action="<?php echo base_url()?>paquete/modificar_tipo">
	<?php if(isset($ok) && $ok):?>
		<div class="message success">
			<p>La modificacion realizado correctamente</p>
		</div>
	<?php else :?>
		<div class="message error">
			<?php echo validation_errors();?>
		</div>
	<?php endif;?>
	<h2>Modificar de tipo de paquete</h2>

	<?php foreach ($datos as $value):?>
	<input type="hidden" name="id" value="<?php echo $value->id?>">
	<label for="nombre">Nombre *</label>
	<input type="text" name="nombre" id="descrripcion" value="<?php echo $value->descripcion?>"/>
	<?php endforeach;?>
	<div class = "group_button">
		<button type="button" class="data btn" data-link="<?php echo base_url()?>paquete/consultar_tipo/0">
			<span class = "glyphicon glyphicon-list-alt"></span> Consultar
		</button>
		<button type="submit" class="btn" name="btn_modificar" value="btn_modificar">
			<span class = "glyphicon glyphicon-floppy-disk"></span> Guardar
		</button>
	</div>
</form>