<?php foreach($hospedajes as $hospedaje):?>
	<h1><?php echo $hospedaje->nombre . " - > " .  $hospedaje->direccion ?> </h1>
<?php endforeach;?>

<h1><a href="<?php echo base_url()?>home/hello/saluda"> Ir </a></h1>