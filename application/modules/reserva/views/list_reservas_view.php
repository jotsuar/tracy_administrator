<button type="button" class = "data btn volver" data-link="<?php echo base_url()?>citytour">
	<span class = "glyphicon glyphicon-chevron-left"></span> Volver
</button>

<h1>Reservas</h1>

<table id="table-reserva">
	<thead>
		<tr>
			<th>Numero reserva</th>
			<th>Fecha</th>
			<th>Fecha inicio</th>
			<th>Fecha fin</th>
			<th>Usuario</th>
			<th>Forma de pago</th>
			<th>Valor</th>
			<th>Estado</th>
			<th>Detalle</th>
			<th>Novedad</th>
		</tr>
	</thead>
	<tbody>
		<?php if($reservas): ?>
			<?php foreach($reservas as $reserva):?>
				<tr>
					<td><?php echo $reserva->id;?></td>
					<td><?php echo mdate("%d/%m/%Y", strtotime($reserva->fecha_reserva)) ?></td>
					<td><?php echo mdate("%d/%m/%Y", strtotime($reserva->fecha_inicio)) ?></td>
					<td><?php echo mdate("%d/%m/%Y", strtotime($reserva->fecha_fin)) ?></td>
					<td><?php echo $reserva->nombres." ".$reserva->apellidos;?></td>
					<td><?php echo $reserva->forma_de_pago==0? "Contado" : "Cuotas"; ?></td>
					<td><?php echo number_format($reserva->valor_total, 2)?></td>
					<td>
					<?php if($reserva->estado == 0):?>
						<a href="<?php echo site_url('reserva/validar/'.$reserva->id);?>" title="Validar reserva">
							<span class='glyphicon glyphicon-remove-circle status_active'></span>
						</a>
					<?php else:?>
						<a href="<?php echo site_url('reserva/invalidar/'.$reserva->id);?>" title="invalidar reserva">
							<span class='glyphicon glyphicon-ok-circle status_inavtive'></span>
						</a>
					<?php endif;?>
					</td>
					<td>
						<a href = "<?php echo site_url()."reserva/detalle/".$reserva->cod_usuario."/".$reserva->id;?>" class="detail2">
							<span class="glyphicon glyphicon-list-alt"></span>
						</a>
					</td>
					<td>
						<a href = "<?php echo site_url()."novedad/asignar/".$reserva->id;?>">
							<span class="glyphicon glyphicon-pushpin"></span>
						</a>
					</td>
				</tr>
			<?php endforeach;?>
		<?php else:?>
			<tr>
				<td colspan="9"><h1>No hay datos</h1></td>
			</tr>
		<?php endif;?>
	</tbody>
</table>

<!-- Modal -->
<div id="modal2">
	<div class="modal-close2">
		<a href='javascript:void(0);' id='modal-close-button2'>
			<span class="glyphicon glyphicon-remove"></span>
		</a>
		
	</div>
	<div class="modal-body2">
		
	</div>
</div>
<div class="background-modal2"></div>
