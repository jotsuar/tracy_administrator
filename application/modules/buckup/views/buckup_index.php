
		<form method ="post" action="<?php echo base_url()?>buckup/generar" class="form_consult">

		<?php if(isset($ok) && $ok):?>
		<div class="message success">
			<p>Copia creada correctamente</p>
		</div>
			<?php else :?>
		<div class="message error">
			<?php echo validation_errors();?>
			
		</div>
		<?php endif;?>
				<h2>Generar Copias de Seguridad</h2>
		


					<button class = "btn" type = "submit" name = "btn_save">
		Generar Copia
		</button>
			</div>
		</form>

		<table>
			<thead>
				<tr>
					
					<th>Nombre archivo y ruta</th><th>Numero</th>
					<th>Fecha</th>


				</tr>
			</thead>
			<tbody>

					<?php if(!isset($datos)){$datos = array();}?>
					<?php if($datos): ?>
						<?php foreach($datos as $value):?>
							<tr>
								<td><?php echo $value->ruta?></td>
								<td><?php echo $value->id?></td>
								<td><?php echo $value->fecha?> </td>
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

