<!doctype html>
<html lang="es">
	<head>
		<meta charset="utf-8" />
		<link rel="shortcut icon" href="<?php echo base_url()?>public/img/ico/favicon.ico" type="image/ico"/>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>public/css/tracy.css?<?php echo time()?>"/>
		<title><?php echo $title ?></title>
	</head>
	<body>
		<?php echo $navbar_header?>
		<?php echo $navbar?>

		<section id = "content" class="content">
			<?php echo $content_header?>
			<?php echo $content?>
		</section>
		<script type="text/javascript" src="<?php echo base_url()?>public/js/lib/jquery.js?<?php echo time()?>"></script>
		<script type="text/javascript" src="<?php echo base_url()?>public/js/lib/prefixfree.min.js?<?php echo time()?>"></script>
		<script type="text/javascript" src="<?php echo base_url()?>public/js/navbar.js?<?php echo time()?>"></script>
		<script type="text/javascript" src="<?php echo base_url()?>public/js/app.js?<?php echo time()?>"></script>
		<script type="text/javascript" src="<?php echo base_url()?>public/js/citytour.js?<?php echo time()?>"></script>
		<script type="text/javascript" src="<?php echo base_url()?>public/js/reserva.js?<?php echo time()?>"></script>
	</body>
</html>