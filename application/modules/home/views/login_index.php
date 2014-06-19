<div style="padding: 29px 0 0 200px;">
<form class="form" action="<?php echo base_url()?>home/crear" method="post">
	
	<div id="login-box">
	<?php echo validation_errors();?>
	<?php 
			if(isset($mensaje))
				echo $mensaje;
			else
				echo "";

	?>		
	<label><h1>Inicio de Sesion</H1></label> 

	<label for=""><h3><strong>Usuario:</strong> </h3> </label>
	<input type="text" name="usuario" title="Username" value="<?php echo set_value("usuario")?>" size="30" maxlength="40" />

	<label for=""> <strong>Contraseña:</strong> </label>
	<input name="pass" type="password" class="" title="Password" value="<?php echo set_value("pass")?>" size="30" maxlength="40" />
	<input type="submit" value="Entrar" class="btn-enviar">
	<span><b><a href="<?php echo base_url()?>home/reestablecer" type="button">Reestablecer Contraseña</a></b></span>
	
	

</form>
</div>

</div>
