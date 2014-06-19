<button type="button" class="data btn volver" data-link="<?php echo base_url()?>banco/registrar">
	<span class = "glyphicon glyphicon-chevron-left"></span> Volver
</button>

<div class="message error">
	<?php echo validation_errors();?>
</div>
<h2>Lista de bancos</h2>

<table>
	<thead>
		<tr>
			<th>Nit</th>
			<th>Nombre</th>
			<th>Dirección</th>
			<th>Teléfono</th>
			<th>Número cuenta</th>
			<th>Estado</th>
			<th>Actualizar</th>
		</tr>
	</thead>
	<tbody>

		<?php if(!isset($datos)){$datos = array();}?>
		<?php if($datos): ?>
			<?php foreach($datos as $value):?>
				<tr>
					<td><?php echo $value->nit?></td>
					<td><?php echo $value->nombre?></td>
					<td><?php echo $value->direccion?></td>
					<td><?php echo $value->telefono?></td>
					<td><?php echo $value->numero_cuenta?></td>
					<td><?php echo ($value->estado) ? "Activo":"Inactivo" ?></td>
					<td>
						<a href="<?php base_url()?>buscar/<?php echo $value->id?>">
							<span class="glyphicon glyphicon-edit"></span>
						</a>
					</td>
				</tr>
			<?php endforeach;?>
			<?php else:?>
			<tr>
				<td colspan="7">
					<h1>No hay datos</h1>
				</td>
			</tr>
		<?php endif;?>
	</tbody>
</table>