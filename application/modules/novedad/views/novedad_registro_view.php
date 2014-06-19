<div class="frm">
	
	<form method ="post" action="<?php echo base_url()."novedad/asignar/".$id?>">

	<?php if(isset($ok) && $ok):?>
		<div class="message success">
			<p>Registro realizado correctamente</p>
		</div>
	<?php else:?>
		<div class="message error">
			<?php echo validation_errors();?>
		</div>
	<?php endif;?>
		<h2>Asignar novedad a la reserva: <?php echo " ".$id;?></h2>
			<label for="descripcion">Descripción</label>
			<textarea rows="7" cols="5" name="descripcion" id="descripcion" ></textarea>	
		<div class="groupButton">
					<button type="button" class="data btn" data-link="<?=base_url()?>novedad/index" >
			<span class="glyphicon glyphicon-remove-circle"></span> Cancelar
		</button>
			<button type="submit" class="btn"><span></span>Guardar</button>
		</div>
	</form>

</div>