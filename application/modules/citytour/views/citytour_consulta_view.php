<button type="button" class = "data btn volver" data-link="<?php echo base_url()?>citytour">
	<span class = "glyphicon glyphicon-chevron-left"></span> Volver
</button>
<form method ="post" id = "form" class="form_consult" action="<?php echo base_url()?>citytour/consulta">

	<h2>Consulta de citytour</h2>
	<div class="control-container">
		<input type="search" name="nombre" id="nombre" class="form-control-medium"
		value="" placeholder="Nombre del citytour" />

		<input type="date" name="fecha" id="fecha" class="form-control-medium" value="" />

		<div class="group_button">
			<button type="submit" class="btn_search btn"><span class="glyphicon glyphicon-search"></span></button>
		</div>
	</div>
</form>

<table id="table-citytours">
	<thead>
		<tr>
			<th>Nombre</th>
			<th>Fecha</th>
			<th>Hora de inicio</th>
			<th>Hora de fin</th>
			<th>Dirección</th>
			<th>Estado</th>
			<th>Modificar</th>
			<th>Detalle</th>
		</tr>
	</thead>
	<tbody>
		<?php if($citytours): ?>
			<?php foreach($citytours as $citytour):?>
				<tr>
					<td><?php echo $citytour->nombre?></td>
					<td><?php echo mdate("%d/%m/%Y",strtotime($citytour->fecha))?></td>
					<td><?php echo mdate("%h:%i:%s %a", strtotime($citytour->hora_inicio))?></td>
					<td><?php echo mdate("%h:%i:%s %a", strtotime($citytour->hora_fin))?></td>
					<td><?php echo $citytour->direccion_salida?></td>
					<td>
						<?php echo ($citytour->estado) ? "<span class='glyphicon glyphicon-ok-circle status_active'></span>" 
						: "<span class='glyphicon glyphicon-remove-circle status_inavtive'></span>" ?>
					</td>
					<td>
						<a href="<?php base_url()?>update/<?php echo $citytour->id?>">
							<span class="glyphicon glyphicon-edit"></span>
						</a>
					</td>
					<td>
						<a href = "<?php echo site_url("$citytour->id");?>" class="detail">
							<span class="glyphicon glyphicon-list-alt"></span>
						</a>
					</td>
				</tr>
			<?php endforeach;?>
		<?php else:?>
			<tr>
				<td colspan="8"><h1>No hay datos</h1></td>
			</tr>
		<?php endif;?>
	</tbody>
</table>

<!-- Modal -->
<div id="modal">
	<div class="modal-close">
		<a href='javascript:void(0);' id='modal-close-button'>
			<span class="glyphicon glyphicon-remove"></span>
		</a>
		<span class="modal-title">Ventana modal</span>
	</div>
	<div class="modal-body">
		<hr>
		<h1>Guias turisticos</h1>
		<table id="table-details-guides">
		</table>

		<hr>
		<h1>Vehículos</h1>
		<table id="table-details-vehicles">
			<thead>
				<tr>
					<th>Placa</th>
					<th>Tipo</th>
					<th>Empresa transporte</th>
				</tr>
			</thead>
			<tbody>
			</tbody>
		</table>

	</div>
</div>
<div class="background-modal"></div>
