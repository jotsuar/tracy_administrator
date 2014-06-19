<div style="padding: 29px 0 0 200px;">
	<div>
			<?php echo validation_errors();?>
	<?php 
			if(isset($mensaje))
				echo $mensaje;
			else
				echo "";

	?>	
	<a href="<?php echo base_url()?>" style="margin-left:265px; margin-top:-600px;">Volver</a>
	<h1>Reestablecer Contraseña</h1>
	<form action="<?php echo base_url()?>home/reestablecer" class="form" method="post">
	<b><label for="">Contraseña Actual</label></b>
	<input type="password" name="pass_viejo">
	<b><label for="">Contraseña Nueva</label></b>
	<input type="password" name="pass_nuevo">
	<b><label for="">Confirmar Contraseña</label></b>
	<input type="password" name="pass_nuevo2">

	<input type="submit" class="btn-enviar" value="Cambiar">	
		</form>
	

</div>
</div>
