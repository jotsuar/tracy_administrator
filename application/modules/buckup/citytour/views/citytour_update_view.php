<form method ="post" class="form form-with-columns" id = "form" action="<?php echo base_url()?>citytour/update">
    <?php if($this->session->flashdata('success')):?>
        <div class = "message success">
            <p>Modificación realizada correctamente</p>
        </div>
    <?php else:?>
        <div class="message error">
            <?php echo validation_errors();?>
        </div>
    <?php endif;?>

    <h2>Modificación de City tour</h2>
    <div class="form-column" id="guias-turisticos">
        <input type="hidden" name="id" 
        value="<?php echo $citytour[0]->id?>" />

        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" id="nombre"
        value="<?php echo $citytour[0]->nombre ?>" />

        <label for="fecha">Fecha *</label>
        <input type="date" name="fecha" id="fecha"
        value="<?php echo (isset($success) && $success) ? set_value('fecha') : $citytour[0]->fecha ?>" />

        <label for="hora_inicio">Hora inicio *</label>
        <input type="time" name="hora_inicio" id="hora_inicio" value="<?php echo $citytour[0]->hora_inicio?>"/>

        <label for="hora_final">Hora final *</label>
        <input type="time" name="hora_final" id="hora_final" value="<?php echo $citytour[0]->hora_fin?>"/>

        <label for="direccion">Dirección de salida*</label>
        <input type="text" name="direccion" id="direccion" value="<?php echo $citytour[0]->direccion_salida?>"/>

        <label>Reservas</label>
        <input type="text" name="reservas" value="<?php echo $reservas?>" readonly="readonly">

        <label for="cupos">Cupos</label>
        <input type="number" name="cupos" id="cupos" value="<?php echo $citytour[0]->cupos?>"/>

        <fieldset>
            <legend>Sitios turísticos</legend>
            <?php foreach($sitios_turisticos as $sitio_turistico):?>
                <?php if(array_search($sitio_turistico->id, $sitios_turisticos_detalle) === FALSE):?>
                    <label for="<?php echo strtolower("check_" . str_replace(' ', '_', $sitio_turistico->nombre))?>">
                        <input type="checkbox" name ="sitios_turisticos[]" 
                        id="<?php echo strtolower("check_" . str_replace(' ', '_', $sitio_turistico->nombre))?>" 
                        value="<?php echo $sitio_turistico->id?>" id ="restaurante">
                        <?php echo ucwords(strtolower($sitio_turistico->nombre));?>
                    </label>  
                <?php else:?>
                    <label for="<?php echo strtolower("check_" . str_replace(' ', '_', $sitio_turistico->nombre))?>">
                        <input type="checkbox" checked="checked" name ="sitios_turisticos[]" 
                        id="<?php echo strtolower("check_" . str_replace(' ', '_', $sitio_turistico->nombre))?>" 
                        value="<?php echo $sitio_turistico->id?>" id ="restaurante">
                        <?php echo ucwords(strtolower($sitio_turistico->nombre));?>
                    </label>  
                <?php endif;?>
            <?php endforeach;?>
        </fieldset>

        <fieldset class="container-guias">
            <legend>Guia turístico <a href="javascript:void(0);"><span class="glyphicon glyphicon-plus-sign"></span></a></legend>
            <div>
                <select name="guias_turisticos[]" data-url="<?php echo base_url()?>guia/get_languages">
                    <option value="0">-- GUIA TURÍSTICO --</option>
                    <?php foreach($guias_turisticos as $guia_turistico):?>
                        <option value="<?php echo $guia_turistico->id?>">
                            <?php echo strtoupper($guia_turistico->nombre . ' ' . $guia_turistico->apellido)?>
                        </option>
                    <?php endforeach?>
                </select>
                <label></label>
            </div>
        </fieldset>

    </div>
    <div id="container_company">
    
        <label for="precio">Precio*</label>
        <input type="text" name="precio" id="precio" value="<?php echo $citytour[0]->precio?>" readonly="readonly">

        <label for="direccion">Estado*</label>
        <select name="estado" id="estado">
        <?php if($citytour[0]->estado):?>
            <option value="1" selected="selected">Activo</option>
            <option value="0">Inactivo</option>
        <?php else:?>
            <option value="0" selected="selected">Inactivo</option>
            <option value="1">Activo</option>
        <?php endif;?>
        </select>

        <div class="form-column" data-url="<?php echo base_url()?>">
            <fieldset class="container-vehicles">
                <legend>Selección de vehiculo(s)
                    <a href="javascript:void(0);"><span class="glyphicon glyphicon-plus-sign"></span></a>
                </legend>
                <div>
                    <label for="vehiculo">Empresa transporte*</label>
                    <select class="company" data-url="<?php echo base_url()?>transport_company/vehicle/consult_with_ajax">
                        <option value="0">--SELECCIONE EMPRESA--</option>
                        <?php foreach($empresas as $empresa):?>
                            <option value="<?php echo $empresa->id?>"><?php echo $empresa->nombre?></option>
                        <?php endforeach;?>
                    </select>

                    <label>Vehículo placa*</label>
                    <select name="vehicles[]" class="vehicle" data-url="<?php echo base_url()?>"> 
                        <option value="0">--SELECCIONE VEHÍCULO--</option>
                    </select>
                    <label>Cupos : </label>
                    <input type="text" name="cupos_vehiculo[]" value="0" readonly="readonly"/>
                </div>
            </fieldset>
        </div>
    </div>

    <div class = "group-button">
        <button type="button" class="data btn" data-link= "<?php echo base_url()?>citytour/consulta">
            <span class="glyphicon glyphicon-remove-circle"></span> Cancelar
        </button>
        <button class = "btn" type = "submit" name = "btn_save">
            <span class = "glyphicon glyphicon-floppy-disk"></span> Guardar
        </button>
    </div>
</form>