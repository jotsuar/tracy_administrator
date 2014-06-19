<button type="button" class = "data btn volver" data-link="<?php echo base_url()?>hospedaje">
	<span class = "glyphicon glyphicon-chevron-left"></span> Volver
</button>
<form method ="post" id = "form" class="form_consult" action="<?php echo base_url()?>hospedaje/consultar">
	<div class="message error">
		<?php echo validation_errors();?>
	</div>
	<h2>Consulta de hospedaje</h2>
	<label for="nombre">Nombre hospedaje</label>
	<input type="search" name="nombre" id="nombre" value="<?php echo set_value('nombre')?>">

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
			<th>Categoría</th>
			<th>Estado</th>
			<th>Modificar</th>
			<th>Detalle</th>
		</tr>
	</thead>
	
	<tbody>

		<?php if(!isset($hospedaje)){$hospedaje = array();}?>
		<?php if($hospedaje): ?>
				<?php foreach($hospedaje as $value):?>
					<tr>
						<td><?php echo $value->nit?></td>
						<td><?php echo $value->nombre?></td>
						<td><?php echo $value->direccion?></td>
						<td><?php echo $value->telefono?></td>
						<td><?php echo $value->categoria?></td>
						<td><?php echo ($value->estado) ?"Activo":"Inactivo" ?></td>
						<td>
							<a href="<?php echo site_url('hospedaje/detalle/'.$value->id)?>" class="update">
								<span class="glyphicon glyphicon-edit"></span>
							</a>
						</td>
						<td>
							<a href="<?php echo site_url('hospedaje/detalle_servicios_add/'.$value->id)?>" class="consultar">
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

<?php if(isset($detalle)):?>
	<?php if($detalle):?>
		<h1>Servicios adicionales</h1>
		<table>
			<thead>
				<tr>
					<th>ID</th>
					<th>Nombre</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($detalle as $value):?>
					<tr>
						<td><?php echo $value->id?></td>
						<td><?php echo $value->nombre?></td>
					</tr>
				<?php endforeach;?>					
			</tbody>
		</table>
	<?php else:?>
		<h1>No tiene servicios adicionales</h1>
	<?php endif;?>
<?php endif;?>
