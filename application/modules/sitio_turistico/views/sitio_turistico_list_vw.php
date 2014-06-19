<button type="button" class = "data btn volver" data-link="<?php echo base_url()?>sitio_turistico">
	<span class = "glyphicon glyphicon-chevron-left"></span> Volver
</button>
<form method ="post" id = "form" class="form_consult" action="<?php echo base_url()?>sitio_turistico/lista">

	<h2>Consulta de sitios turísticos</h2>
	<div class="control-container">
		<input type="search" name="nombre" id="nombre" value="<?php echo set_value('nombre') ?>" placeholder="Nombre del sitio turístico"/>
		<div class="group_button">
			<button type="submit" class="btn_search btn"><span class="glyphicon glyphicon-search"></span></button>
		</div>
	</div>
</form>

<table>
	<thead>
		<tr>
			<th>Nombre</th>
			<th>Ubicación</th>
			<th>Descripción</th>
			<th>Tipo</th>
			<th>Convenio</th>
			<th>Estado</th>
			<th>Modificar</th>
			<th>Detalle</th>
		</tr>
	</thead>
	<tbody>
		<?php if(isset($sitios) && $sitios): ?>
			<?php foreach($sitios as $sitio):?>
				<tr>
					<td><?php echo $sitio->nombre?></td>
					<td><?php echo $sitio->ubicacion?></td>
					<td><?php echo $sitio->descripcion?></td>
					<td><?php echo $sitio->tipo?></td>
					<td><?php echo ($sitio->convenio) ? "SI" : "NO" ?></td>
					<td><?php echo ($sitio->estado) ? "Activo" : "Inactivo" ?></td>
					<td>
						<a href="<?php echo base_url()?>sitio_turistico/modificar/<?php echo $sitio->id?>">
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
				<td colspan="8">
				<h1>No hay datos</h1>
				</td>
			</tr>
		<?php endif;?>
	</tbody>
</table>