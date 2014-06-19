<div>
	
	<form method ="post" action="<?php echo base_url()?>tipo_turismo/modificar_tipo">
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
		<h2>Modificar Tipo Turismo</h2>
		<?php foreach ($datos as $value):?>
			<input type="hidden" name="id" value="<?php echo $value->id?>"/>

			<label for="categoria">Nombre *</label>
			<input type="text" name="categoria" id="categoria" value="<?php echo $value->nombre?>">

			<label for="descripcion">Descripción</label>
			<textarea rows="7" cols="5" name="descripcion" id="descripcion" ><?php echo $value->descripcion?></textarea>
		<?php endforeach;?>		
		<div class="groupButton">
			<button type="button" class="consultar" data-link="<?php echo base_url()?>hospedaje/consultar_categoria"><span></span>Consultar</button>
			<button type="submit"><span></span>Modificar</button>
		</div>
	</form>

</div>