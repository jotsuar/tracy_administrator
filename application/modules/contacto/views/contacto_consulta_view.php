<button type="button" class="data btn volver" data-link="<?php echo base_url()?>contacto/registro_contacto_evento">
	<span class = "glyphicon glyphicon-chevron-left"></span> Volver
</button>
<h2>Consulta de contacto</h2>
<table>
	<thead>
		<tr>
			<th><?php echo $palabra?></th>
			<th>Identificacion</th>
			<th>Nombre</th>
			<th>Apellido</th>
			<th>Celular</th>
			<th>Email</th>
			<th>Estado</th>
			<th>Modificar</th>
		</tr>
	</thead>
	<tbody>
		<?php if(!isset($data)){$date = array();}?>
		<?php if($data): ?>
		
		<?php foreach($data as $value):?>
			<tr>
				<td><?php echo $value->nombre_empresa?></td>
				<td><?php echo $value->identificacion?></td>
				<td><?php echo $value->nombres?></td>
				<td><?php echo $value->apellidos?></td>
				<td><?php echo $value->celular?></td>
				<td><?php echo $value->email?></td>
				<td><?php echo ($value->estado) ? "Activo":"Inactivo" ?></td>
				<td>
					<a href="<?php echo base_url()?>contacto/buscar_contacto/<?php echo $value->codigo."/".$tipo_empresa ?>">
						<span class="glyphicon glyphicon-list-alt"></span>
					</a>
				</td>
			</tr>
		<?php endforeach;?>
		<?php else:?>
		<tr>
			<td colspan="8">
				<h1>No hay datos</h1>
			</td>
		</tr>
	<?php endif;?>
	</tbody>
</table>