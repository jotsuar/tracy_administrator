
	<style type="text/css">
		body {
		 background-color: #fff;
		 margin: 0px;
		 font-family: Lucida Grande, Verdana, Sans-serif;
		 font-size: 14px;
		 color: #4F5155;
		}

		a {
		 color: #003399;
		 background-color: transparent;
		 font-weight: normal;
		}

		h1 {	
		 color: #444;
		 background-color: transparent;
		 border-bottom: 1px solid #D0D0D0;
		 font-size: 16px;
		 font-weight: bold;
		 margin: 24px 0 2px 0;
		 padding: 5px 0 6px 0;
		}

		h2 {
		 color: #444;
		 background-color: transparent;
		 border-bottom: 1px solid #D0D0D0;
		 font-size: 36px;
		 font-weight: bold;
		 margin: 24px 0 2px 0;
		 padding: 5px 0 6px 0;
		 text-align: center;
		}

		table{
			text-align: center;
			 margin-left:80px;
		}

		/* estilos para el footer y el numero de pagina */
		@page { margin: 190px 50px; }
		#header { 
			margin-top: 50px;
			position: fixed; 
			left: 0px;
			 top: -180px; 
			right: 0px; 
			height: 90px; 
			background-color: #3d59ff; 
			color: #fff;
			margin-bottom : 50px;
			text-align: center; 
			text-indent: inherit;
			font-size: 60px;
		}
		#footer { 
			position: fixed; 
			left: 0px; 
			bottom: -180px; 
			right: 0px; 
			height: 150px; 
			background-color: #333; 
			color: #fff;

		}
		#footer .page:after { 
			content: counter(page, upper-roman); 
		}
	</style>
</head>
<body>
	<!--header para cada pagina-->
	<div id="header">
	    TRACY
	</div>
	<!--footer para cada pagina-->
	<div id="footer">
		<!--aqui se muestra el numero de la pagina en numeros romanos-->
	    <p class="page"></p>
	</div>

	<h2> Clientes Activos e Inactivos del Sistema</h2>
	<table border="0.3";>
		<thead>
			<?php if($datos):?>
			<tr>
					<th width="50">Tipo Identificacion</th>
					<th width="50">Identificación</th>
					<th width="100">Nombres</th>
					<th width="50">Apellidos      </th>
					<th width="50">Teléfono</th>
					<th width="50">Celular</th>
					<th width="50">Email</th>
					<th width="50">Fecha Nacimiento</th>
					<th width="80">Tipo</th>
					<th width="50">Usuario</th>
					<th width="50">Contraseña</th>
					<th width="50">Estado</th>

			</tr>
		<?php endif;?>
		<!--<?php if($externo):?>
			<tr>
					<th width="50">Identificacion </th>
					<th width="50">Nombre</th>
					<th width="100">Edad</th>
					<th width="50">Identificacion Titular     </th>
					<th width="50">Nombre Titular</th>


			</tr>
		<?php endif;?>-->
		</thead>
		<tbody>
			<?php if(!isset($datos)){$datos = array();}?>
			<?php if($datos): ?>
			<?php foreach($datos as $value) { ?>
			<tr>
					<th width="50"><?php echo $value->tipo_documento?></th>
					<th width="50"><?php echo $value->identificacion?></th>
					<th width="100"><?php echo $value->nombres?></th>
					<th width="50"><?php echo $value->apellidos?></th>
					<th width="50"><?php echo $value->telefono?></th>
					<th width="50"><?php echo $value->celular?></th>
					<th width="50"><?php echo $value->email?></th>
					<th width="50"><?php echo $value->fecha_nacimiento?></th>
					<th width="50"><?php echo $value->tipo?></th>
					<th width="50"><?php echo $value->usuario?></th>
					<th width="50"><?php echo $value->password?></th>
					<th width="50"><?php echo ($value->estado) ?"Activo":"Inactivo" ?></th>
			</tr>
			<?php } ?>
			<?php else:?>
			<tr>
				<td colspan="12">
					<h1>No hay datos</h1>
				</td>
			</tr>
		<?php endif; ?>

			<?php if(!isset($externo)){$externo = array();}?>
			<?php if($externo): ?>
			<?php foreach($externo as $value) { ?>
			<tr>
					<th width="50"><?php echo $value->identificacion?></th>
					<th width="50"><?php echo $value->nombre?></th>
					<th width="100"><?php echo $value->edad?>	</th>
					<th width="50"><?php echo $value->ident?></th>
					<th width="50"><?php echo $value->nombres." ".$value->apellidos?></th>
					
			</tr>
			<?php } ?>
			<?php elseif(!isset($externo)):?>
			<tr>
				<td colspan="5">
					<h1>No hay datos</h1>
				</td>
			</tr>
		<?php endif;?>

		</tbody>
	</table>
</body>
