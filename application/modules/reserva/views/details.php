<h1>Detalles reserva</h1>
<table>
	<thead>
		<tr>
			<th>Numero de reserva</th>
			<th>Fecha reserva</th>
			<th>Fecha Inicio</th>
			<th>Fecha Fin</th>
			<th>Adultos</th>
			<th>Niños</th>
			<th>Estado</th>
			<th>Forma de pago</th>
			<th>Valor reserva</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<?php foreach ($reserva as  $value):?>
				<td><?php echo  $value->id; $id_reserva = $value->id; ?></td>
				<td><?php echo $value->fecha_reserva?></td>
				<td><?php echo $value->fecha_inicio?></td>
				<td><?php echo $value->fecha_fin?></td>
				<td><?php echo $value->cantidad_adultos?></td>
				<td><?php echo $value->cantidad_ninios?></td>
				<td><?php echo $value->estado==0? "Por validar": "Valida"; ?></td>
				<td><?php echo $value->forma_de_pago==0? "Contado" : "Cuotas";?></td>
				<td><?php echo number_format($value->valor_total, 2)?></td>
			<?php endforeach;?>
		</tr>
	</tbody>
</table>
<h1>Servicios reservados</h1>
<?php if($eventos):?>
	<table>
		<thead>
			<tr>
				<th>Nombre evento</th>
				<th>Valor</th>
				<th>Fecha inicio</th>
				<th>Fecha Fin</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<?php foreach ($eventos as $key ):?>
				<td><?php echo $key->nombre?></td>
				<td><?php echo number_format($key->valor_venta, 2)?></td>
				<td><?php echo $key->fecha_inicio?></td>
				<td><?php echo $key->fecha_fin?></td>
				<?php endforeach;?>
			</tr>
		</tbody>
	</table>			
<?php endif;?>
<?php if($citytours):?>
	<table>
		<thead>
			<tr>
				<th>Nombre Citytour</th>
				<th>Valor</th>
				<th>Fecha</th>
				<th>Direccion Salida</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<?php foreach ($citytours as $keys ):?>
				<td><?php echo $keys->nombre?></td>
				<td><?php echo number_format($keys->precio, 2)?></td>
				<td><?php echo $keys->fecha?></td>
				<td><?php echo $keys->direccion_salida?></td>
				<?php endforeach;?>
			</tr>
		</tbody>
	</table>			
<?php endif;?>
<?php if($paquetes):?>
	<table>
		<thead>
			<tr>
				<th>Tipo paquete</th>
				<th>Fecha inicio</th>
				<th>Fecha fin</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<?php foreach ($paquetes as $keyss ):?>
				<td><?php echo $keyss->descripcion?></td>
				<td><?php echo $keys->fecha_inicio?></td>
				<td><?php echo $keys->fecha_fin?></td>
				<?php endforeach;?>
			</tr>
		</tbody>
	</table>			
<?php endif;?>
<?php if($habitaciones):?>
	<table>
		<thead>
			<tr>
				<th>Habitacion</th>
				<th>Valor</th>
				<th>Hotel</th>

			</tr>
		</thead>
		<tbody>
			
				<?php foreach ($habitaciones as $keyss ):?>
				<tr>
					<td><?php echo $keyss->nombre?></td>
					<td><?php echo number_format($keyss->valor, 2)?></td>
					<td><?php echo $keyss->hotel?></td>
				</tr>
				<?php endforeach;?>
			
		</tbody>
	</table>	
		
<?php endif;?>

<button type="button" style="margin-left:850px;" class="data btn" data-link="<?php echo base_url()."reserva/pagos/".$id_reserva;?>">Validar pagos</button>