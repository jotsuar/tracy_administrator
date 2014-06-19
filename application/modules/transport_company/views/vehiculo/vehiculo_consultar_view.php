<button type="button" class="data btn volver" data-link="<?php echo base_url()?>transport_company/vehiculo">
	<span class = "glyphicon glyphicon-chevron-left"></span> Volver
</button>
<form method ="post" id = "form" class="form_consult" action="<?php echo base_url()?>transport_company/vehiculo/consultar">
	<h2>Consulta de vehículos</h2>
	<label for="placa">Placa *</label>
	<input type="search" name="placa" id="placa" value="<?php echo set_value('placa')?>">

	<div class="group_button">
		<button type="submit" class="btn btn_search"><span class="glyphicon glyphicon-search"></span></button>
	</div>

</form>

<table>
	<thead>
		<tr>
			<th>Empresa</th>
			<th>Placa</th>
			<th>Tipo</th>
			<th>Descripción</th>
			<th>Cupos</th>
			<th>Estado</th>
			<th>Modificar</th>
		</tr>
	</thead>
	<tbody>
			<?php if(isset($vehiculos)):?>
			<?php foreach($vehiculos as $vehiculo):?>
					<tr>
						<td><?php echo $vehiculo->empresa?></td>
						<td><?php echo $vehiculo->placa?></td>
						<td><?php echo $vehiculo->tipo?></td>
						<td><?php echo $vehiculo->descripcion?></td>
						<td><?php echo $vehiculo->cupo_maximo?></td>
						<td><?php echo ($vehiculo->estado) ? "Activo":"Inactivo" ?></td>
						<td>
							<a href="<?php base_url()?>buscar/<?php echo $vehiculo->id?>" class="update">
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