<button type="button" class = "data btn volver" data-link="<?php echo base_url()?>transporte">
	<span class = "glyphicon glyphicon-chevron-left"></span> Volver
</button>
<form method ="post" id = "form" class="form_consult" action="<?php echo base_url()?>transporte/consultar">

	<h2>Consulta de transporte</h2>
	<label for="nombre">Nombre del transporte *</label>
	<input type="search" name="nombre" id="nombre" value="<?php echo set_value('nombre') ?>">
	<div class="group_button">
		<button type="submit" class="btn_search btn"><span class="glyphicon glyphicon-search"></span></button>
	</div>
</form>

<table>
	<thead>
		<tr>
			<th>Nit</th>
			<th>Nombre</th>
			<th>Dirección</th>
			<th>Teléfono</th>
			<th>Correo</th>
			<th>Seguro transporte</th>
			<th>Estado</th>
			<th>Modificar</th>
			<th>Detalle</th>
		</tr>
	</thead>
	<tbody>
			<?php if($transportes): ?>
				<?php foreach($transportes as $transporte):?>
				<tr>
					<td><?php echo $transporte->nit?></td>
					<td><?php echo $transporte->nombre?></td>
					<td><?php echo $transporte->direccion?></td>
					<td><?php echo $transporte->telefono?></td>
					<td><?php echo $transporte->correo?></td>
					<td><?php echo ($transporte->seguro_transporte) ? "SI" : "NO" ?></td>
					<td><?php echo ($transporte->estado) ? "Activo" : "Inactivo" ?></td>
					<td>
						<a href="<?php base_url()?>buscar/<?php echo $transporte->id?>">
							<span class="glyphicon glyphicon-edit"></span>
						</a>
					</td>
					<td>
						<a href = "#">
							<span class="glyphicon glyphicon-list-alt"></span>
						</a>
					</td>
				</tr>
				<?php endforeach;?>
			<?php else:?>
			<tr>
				<td colspan="9">
					<h1>No hay datos</h1>
				</td>
			</tr>
		<?php endif;?>
	</tbody>
</table>
