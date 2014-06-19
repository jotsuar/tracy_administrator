<div>
	
	<form method ="post" action="<?php echo base_url()?>novedad/modificar">

		<?php if($ok):?>
			<div class="ok">
				<p>Modificación realizada corrrectamente</p>
			</div>
		<?php endif;?>
		<?php if(!$ok):?>
			<div class="data_error">
				<?php echo validation_errors();?>
			</div>
		<?php endif;?>
		<h2>Modificar Novedad</h2>
		<?php foreach ($datos as $value):?>
			<input type="hidden" name="reservas" value="<?php echo $value->id_reserva?>"/>

			<label for="categoria">Numero Novedad</label>
			<input type="text" name="novedad" id="categoria" value="<?php echo $value->id;?>" readonly="" >

			<label for="descripcion">Descripción</label>
			<textarea rows="7" cols="5" name="descripcion" id="descripcion" ><?php echo $value->descripcion?></textarea>
		<?php endforeach;?>		
		<div class="groupButton">
					<div class="groupButton">
					<button type="button" class="data btn" data-link="<?=base_url()?>novedad/index" >
			<span class=""></span> Cancelar
		</button>
			<button type="submit" class="btn"><span></span>Modificar</button>
		</div>
	</form>

</div>