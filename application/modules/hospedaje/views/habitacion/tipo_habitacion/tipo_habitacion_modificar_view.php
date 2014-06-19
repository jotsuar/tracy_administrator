<div>
	<form method ="post" id = "form" action="<?php echo base_url()?>hospedaje/tipo_habitacion/modificar">
		<?php if($ok):?>
			<div class = "message success">
				<p>Modificación realizada correctamente</p>
			</div>
		<?php endif;?>
		<?php if(!$ok):?>
			<div class = "message error">
				<?php echo validation_errors();?>
			</div>
		<?php endif;?>
		<h2>Modificar Tipo Habitacion</h2>
		<?php foreach ($datos as $value):?>
			<input type="hidden" name="id" value="<?php echo $value->id?>"/>

			<label for="categoria">Nombre *</label>
			<input type="text" name="nombre" id="categoria" value="<?php echo $value->nombre?>">

			<label for="descripcion">Descripción</label>
			<textarea rows="7" cols="5" name="descripcion" id="descripcion" ><?php echo $value->descripcion?></textarea>
			<label for="nombre">Cupo maximo *</label>
			<input type="number" name="cupo_maximo" id="cupo" value="<?php echo $value->cupo_maximo?>" min="1" max="10"/>
				<label for="nombre">Cupo maximo *</label>
		<?php endforeach;?>		
		<div class="group_utton">
			
			<button type="button" class="data btn" data-link="<?php echo base_url()?>hospedaje/tipo_habitacion/consultar">
				<span class="glyphicon glyphicon-remove-circle"></span> Cancelar
			</button>

			<button type="submit" class = "btn">
				<span class = "glyphicon glyphicon-floppy-disk"></span> Modificar
			</button>
		</div>
	</form>

</div>