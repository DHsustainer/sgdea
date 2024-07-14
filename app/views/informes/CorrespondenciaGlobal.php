<form id='formgestion' method='POST' action="/informes/getcorrespondenciaglobal/" target="_blank"> 
    <div class="row m-t-20">
        <div class="col-md-3">
            <h4>Seccional</h4>
        </div>
        <div class="col-md-6">
            <h4>Fechas de Consulta</h4>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <select  placeholder="seccional"  name="seccional" id="seccional" class='form-control'>
                <option value="V">Seleccione una Seccional(Todos)</option>
                <?
                    $qvs = $con->Query("select * from seccional");
                    while ($row = $con->FetchAssoc($qvs)) {
                        echo "<option value='".$row['id']."'>".$row['nombre']."</option>";
                    }
                ?>
            </select>
        </div>
        <div class="col-md-3">
            <input  class="form-control important" type='date' name='f_inicio' id='f_inicio' placeholder="Fecha de Inicio:" maxlength=''/>
        </div>
        <div class="col-md-3">
            <input class="form-control important" type='date' name='f_corte' id='f_corte' placeholder="Fecha de Corte:" maxlength='' />
        </div>
        <div class="col-md-3">
            <input type='submit' class="btn btn-primary" value='Generar Informe'/>
        </div>
        
    </div>
</form>