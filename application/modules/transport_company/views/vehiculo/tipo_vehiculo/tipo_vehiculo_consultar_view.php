<button type="button" class = "data btn volver" data-link="<?php echo base_url()?>transport_company/tipo_vehiculo">
	<span class = "glyphicon glyphicon-chevron-left"></span> Volver
</button>
<form method ="post" id = "form" class="form_consult">

	<div class="message error">
		<?php echo validation_errors();?>
	</div>
	<h2>Consulta de tipo de vehículo</h2>
</form>

<table>
	<thead>
		<tr>
			<th>Tipo</th>
			<th>Descripción</th>
			<th>Modificar</th>
		</tr>
	</thead>
	<tbody>
		<?php if($tipos): ?>
			<?php foreach($tipos as $value):?>
				<tr>
					<td><?php echo $value->nombre?></td>
					<td><?php echo $value->descripcion?></td>
					<td>
						<a href = "<?php base_url()?>see_tipo_vehiculo/<?php echo $value->id?>">
							<span class="glyphicon glyphicon-edit"></span>
						</a>
					</td>
				</tr>
			<?php endforeach;?>
			<?php else:?>
				<tr>
					<td colspan="3">
						<h1>No hay datos</h1>
					</td>
				</tr>
		<?php endif;?>
	</tbody>
</table>