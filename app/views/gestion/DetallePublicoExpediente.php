
<div class="row b-b p-10 <?= M_CAMPORADEXTERNO ?>">
    <div class="col-md-4"><strong><?= CAMPORADEXTERNO ?>:</strong></div>
    <div class="col-md-8">
        <?= "<span>".$object->GetRadicado()."</span>" ?>
    </div>
</div>    
<div class="row  b-b p-10 <?= M_CAMPORADRAPIDO ?>">
    <div class="col-md-4"><strong><?= CAMPORADRAPIDO ?>:</strong></div>
    <div class="col-md-8">
        <?= "<span>".$object->GetMin_rad()."</span>" ?>
    </div>
</div>
<div class="row b-b p-10 <?= M_ASUNTO ?>">
    <div class="col-md-4">
        <strong> <?= ASUNTO ?>:</strong>
    </div>
    <div class="col-md-8">
         <? echo "<span>".$object -> Getobservacion()."</span>"; ?>  
    </div>
</div>
<?php if (CAMPOT1 != ""): ?>
    <div class="row b-b p-10">
        <div class="col-md-4"><strong><?= CAMPOT1 ?>:</strong></div>
        <div class="col-md-8">
            <?= "<span>".$object->GetCampot1()."</span>" ?>
        </div>
    </div>
<?php endif ?>
<?php if (CAMPOT2 != ""): ?>
    <div class="row b-b p-10">
        <div class="col-md-4"><strong><?= CAMPOT2 ?>:</strong></div>
        <div class="col-md-8">
            <?= "<span>".$object->GetCampot2()."</span>" ?>
        </div>
    </div>
<?php endif ?>
<?php if (CAMPOT3 != ""): ?>
    <div class="row b-b p-10">
        <div class="col-md-4"><strong><?= CAMPOT3 ?>:</strong></div>
        <div class="col-md-8">
            <?= "<span>".$object->GetCampot3()."</span>" ?>
        </div>
    </div>
<?php endif ?>
<?php if (CAMPOT4 != ""): ?>
    <div class="row b-b p-10">
        <div class="col-md-4"><strong><?= CAMPOT4 ?>:</strong></div>
        <div class="col-md-8">
            <?= "<span>".$object->GetCampot4()."</span>" ?>
        </div>
    </div>
<?php endif ?>
<?php if (CAMPOT5 != ""): ?>
    <div class="row b-b p-10">
        <div class="col-md-4"><strong><?= CAMPOT5 ?>:</strong></div>
        <div class="col-md-8">
            <?= "<span>".$object->GetCampot5()."</span>" ?>
        </div>
    </div>
<?php endif ?>    
 <?php if (CAMPOT6 != ""): ?>
    <div class="row b-b p-10">
        <div class="col-md-4"><strong><?= CAMPOT6 ?>:</strong></div>
        <div class="col-md-8">
            <?= "<span>".$object->GetCampot6()."</span>" ?>
        </div>
    </div>
<?php endif ?>
<?php if (CAMPOT7 != ""): ?>
    <div class="row b-b p-10">
        <div class="col-md-4"><strong><?= CAMPOT7 ?>:</strong></div>
        <div class="col-md-8">
            <?= "<span>".$object->GetCampot7()."</span>" ?>
        </div>
    </div>
<?php endif ?>
<?php if (CAMPOT8 != ""): ?>
    <div class="row b-b p-10">
        <div class="col-md-4"><strong><?= CAMPOT8 ?>:</strong></div>
        <div class="col-md-8">
            <?= "<span>".$object->GetCampot8()."</span>" ?>
        </div>
    </div>
<?php endif ?>
<?php if (CAMPOT9 != ""): ?>
    <div class="row b-b p-10">
        <div class="col-md-4"><strong><?= CAMPOT9 ?>:</strong></div>
        <div class="col-md-8">
            <?= "<span>".$object->GetCampot9()."</span>" ?>
        </div>
    </div>
<?php endif ?>
<?php if (CAMPOT10 != ""): ?>
    <div class="row b-b p-10">
        <div class="col-md-4"><strong><?= CAMPOT10 ?>:</strong></div>
        <div class="col-md-8">
            <?= "<span>".$object->GetCampot10()."</span>" ?>
        </div>
    </div>
<?php endif ?>    
 <?php if (CAMPOT11 != ""): ?>
    <div class="row b-b p-10">
        <div class="col-md-4"><strong><?= CAMPOT11 ?>:</strong></div>
        <div class="col-md-8">
            <?= "<span>".$object->GetCampot11()."</span>" ?>
        </div>
    </div>
<?php endif ?>
<?php if (CAMPOT12 != ""): ?>
    <div class="row b-b p-10">
        <div class="col-md-4"><strong><?= CAMPOT12 ?>:</strong></div>
        <div class="col-md-8">
            <?= "<span>".$object->GetCampot12()."</span>" ?>
        </div>
    </div>
<?php endif ?>
<?php if (CAMPOT13 != ""): ?>
    <div class="row b-b p-10">
        <div class="col-md-4"><strong><?= CAMPOT13 ?>:</strong></div>
        <div class="col-md-8">
            <?= "<span>".$object->GetCampot13()."</span>" ?>
        </div>
    </div>
<?php endif ?>
<?php if (CAMPOT14 != ""): ?>
    <div class="row b-b p-10">
        <div class="col-md-4"><strong><?= CAMPOT14 ?>:</strong></div>
        <div class="col-md-8">
            <?= "<span>".$object->GetCampot14()."</span>" ?>
        </div>
    </div>
<?php endif ?>
<?php if (CAMPOT15 != ""): ?>
    <div class="row b-b p-10">
        <div class="col-md-4"><strong><?= CAMPOT15 ?>:</strong></div>
        <div class="col-md-8">
            <?= "<span>".$object->GetCampot15()."</span>" ?>
        </div>
    </div>
<?php endif ?>    
<div class="row  b-b p-10 <?= M_FECHA_APERTURA ?>">
    <div class="col-md-4">
        <strong>
            <?= FECHA_APERTURA ?>:
        </strong>
    </div>
    <div class="col-md-8">
        <? echo "<span>".$object -> Getf_recibido()."</span>"; ?>
    </div>
</div>
<div class="row  b-b p-10 <?= M_TIPO_DOCUMENTO ?>">
    <div class="col-md-4">
        <strong><?= TIPO_DOCUMENTO ?>:</strong>
    </div>
    <div class="col-md-8">
        <? echo "<span>";
        if($object -> GetDocumento_salida() == 'S'){
            echo "Salida";
        } else {
            echo "Entrada";
        }                            
        echo "</span>"; ?>
    </div>
</div>
<div class="row  b-b p-10 <?= M_ESTADO ?>">
    <div class="col-md-4">
        <strong><?= ESTADO ?>:</strong>
    </div>
    <div class="col-md-8">
        <? echo "<span>".$object -> Getestado_respuesta()."</span>"; ?>
    </div>
</div>
<div class="row  b-b p-10 <?= M_FOLIOS ?>">
    <div class="col-md-4">
        <strong><?= FOLIOS ?>:</strong>
    </div>
    <div class="col-md-8">
        <? echo $object -> Getfolio(); ?>
    </div>
</div>
<div class="row  b-b p-10 <?= M_DEPARTAMENTO ?>">
    <div class="col-md-4">
        <strong><?= DEPARTAMENTO ?>:</strong>
    </div>
    <div class="col-md-8">
        <? 
            $city = new MCity;
            $city->CreateCity("code", $object->GetCiudad());
            $dp = new MProvince;
            $dp->CreateProvince("code", $city->GetProvince());
            $province = $dp->GetName();
            echo "<span>".$province."</span>";
        ?>
    </div>
</div>
<div class="row  b-b p-10 <?= M_CIUDAD ?>">
    <div class="col-md-4">
        <strong><?= CIUDAD ?>:</strong>
    </div>
    <div class="col-md-8">
        <? 
            echo "<span>".$city->GetName()."</span>";
        ?>
    </div>
</div>
<div class="row  b-b p-10 <?= M_OFICINA ?>">
    <div class="col-md-4">
        <strong><?= OFICINA ?>:</strong>
    </div>
    <div class="col-md-8">
        <? 
            $of = new MSeccional;
            $of->CreateSeccional("id", $object->GetOficina());
            $oficina = $of->GetNombre();
            echo "<span>".$oficina."</span>";
        ?>
    </div>
</div>
<div class="row  b-b p-10 <?= M_CAMPOAREADETRABAJO ?>">
    <div class="col-md-4">
        <strong><?= CAMPOAREADETRABAJO ?>:</strong>
    </div>
    <div class="col-md-8">
        <? 
            $area = new MAreas;
            $area->CreateAreas("id", $object->GetDependencia_destino());
            $narea = $area->GetNombre();
            echo "<span>".$narea."</span>";
        ?>
    </div>
</div>
<div class="row  b-b p-10 <?= M_RESPONSABLE ?>">
    <div class="col-md-4">
        <strong><?= RESPONSABLE ?>:</strong>
    </div>
    <div class="col-md-8">
        <? 
            $u = new MUsuarios;
            $u->CreateUsuarios("a_i", $object -> Getnombre_destino());
            $nombreresponsable = $u->GetP_nombre()." ".$u->GetP_apellido();
            echo "<span>".$nombreresponsable."</span>";
        ?>
    </div>
</div>
<div class="row  b-b p-10 <?= M_SUB_SERIE ?>">
    <div class="col-md-4">
        <strong> <?= SUB_SERIE ?>:</strong>
    </div>
    <div class="col-md-8">
        <? 
            $d = new MDependencias();
            $d->CreateDependencias("id", $object -> Gettipo_documento());
            echo "  <span>".$d->GetNombre()."</span>";
        ?>
    </div>
</div>
<div class="row  b-b p-10 <?= M_OBSERVACION ?>">
    <div class="col-md-4">
        <strong><?= OBSERVACION ?>:</strong>
    </div>
    <div class="col-md-8">
         <? echo "<span>".$object -> Getobservacion2()."</span>"; ?>
    </div>
</div>
<div class="row  b-b p-10 <?= M_UBICACION ?>">
    <div class="col-md-4">
        <strong><?= UBICACION ?>:</strong>
    </div>
    <div class="col-md-8">
    <? 
        $estado_archivo = $con->Query("select nombre from estadosx where valor = '".$object->GetEstado_archivo()."' and tipo = 'estado_archivo'");
        $estado_archivo = $con->Result($estado_archivo, 0, 'nombre');

        echo "<span class='tempspace tempspace2'>".$estado_archivo."</span>";                 
    ?>
    </div>
</div>
<div class="row  b-b p-10 <?= M_URI ?>">
    <div class="col-md-4">
        <strong><?= URI ?>:</strong>
    </div>
    <div class="col-md-8">
        <?php 
            $codeText = HOMEDIR.DS.'s/'.$object->GetUri().'/'; 
            echo "<a href='".$codeText."' target='_blank'>".$codeText."</a>";
        ?>
    </div>
</div>