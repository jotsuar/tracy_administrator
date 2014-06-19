<div>
	<form method ="post" id = "form" action="<?php echo base_url()?>hospedaje/habitacion/modificar">
		<?php if($ok):?>
			<div class="message success">
				<p>Modificación realizada corrrectamente</p>
			</div>
		<?php endif;?>
		<?php if(!$ok):?>
			<div class="message error">
				<?php echo validation_errors();?>
			</div>
		<?php endif;?>
		<h2>Modificar habitación</h2>
		<?php foreach ($datos as $value):?>
			<input type="hidden" name="id" value="<?php echo $value->id?>"/>
		
		<label for="Hospedaje">Hospedaje</label>
		<select name="hospedaje" >
					<option value="<?php echo $value->id_h?>" selected=""><?php echo $value->Hotel?></option>
					<?php foreach ($hospedaje as $valueh):?>
					<?php if ($valueh->id!=$value->id):?>
					<option value="<?php echo $valueh->id?>"><?php echo $valueh->nombre?></option>
					<?php endif;?>
					<?php endforeach;?>	
		</select>
		<label for="tipoh">Tipo Habitacion</label>
		<select name="tipo" >
					<option value="<?php echo $value->id_t?>" selected=""><?php echo $value->nombre?></option>
					<?php foreach ($tipo as $valuet):?>
					<?php if ($valuet->id!=$value->id_t):?>
					<option value="<?php echo $valuet->id?>"><?php echo $valuet->nombre?></option>
					<?php endif;?>
					<?php endforeach;?>	
		</select>

			<label for="descripcion">Comodidad</label>
			<textarea rows="7" cols="5" name="comodidad"><?php echo $value->comodidades?></textarea>

		<label for="Cantidad">Cantidad</label>
		<input type="text" name="cantidad" value="<?php echo $value->cantidad?>" placeholder="1">	

		<label for="Cantidad">Valor $</label>
	<input type="text" name="valor" value="<?php echo $value->valor?>" placeholder="200000">	
		<?php endforeach;?>		
		<div class="group_button">
			<button type="button" class="data btn" data-link="<?php echo base_url()?>hospedaje/habitacion/consultar">
				<span class="glyphicon glyphicon-remove-circle"></span> Cancelar
			</button>

			<button type = "submit" class = "btn">
				<span class="glyphicon glyphicon-edit"></span> Modificar
			</button>
		</div>
	</form>
</div>