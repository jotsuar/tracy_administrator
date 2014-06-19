<?php // print_r($datos); exit();?>

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
		th{
			font-size: 18px;
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
			 margin-left:240px;
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

	<h2> Clientes por Reserva</h2>
	<table border="0.3";>
		<thead>

		<?php if($datos):?>
			<tr>
					<th width="50">Identificacion </th>
					<th width="50">Tipo Identificacion </th>
					<th width="50">Nombre</th>
					<th width="100">Numero Reserva</th>
					<th width="50">Servicio Reservado </th>
				


			</tr>
		<?php endif;?>
		</thead>
		<tbody>

			<?php if(!isset($datos)){$datos = array();}?>
			<?php if($datos): ?>
			<?php foreach($datos as $value) { ?>
			<tr>
					<th width="50"><?php echo $value->identificacion?></th>
					<th width="50"><?php echo $value->tipo_documento?></th>
					<th width="50"><?php echo $value->nombres." ".$value->apellidos?></th>
					<th width="100"><?php echo $value->id?>	</th>
					<th width="50"><?php

					if($value->id_paquete!=null)
					{
						echo "Paquete Numero ".$value->id_paquete;
					}elseif($value->id_hospedaje != null)
					{
						echo $value->hospedaje;
					}elseif($value->id_evento!= null)
					{
						echo $value->evento;
					}else if ($value->id_city_tour!=null)
					{
						echo $value->city;
					}


					 ?></th>
					
					
			</tr>
			<?php } ?>
			<?php else:?>
			<tr>
				<td colspan="5">
					<h1>No hay datos</h1>
				</td>
			</tr>
		<?php endif;?>

		</tbody>
	</table>
</body>
