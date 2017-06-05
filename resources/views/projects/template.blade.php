<br>
<?php
$ingresosType = array('Cliente', 'Financiera', 'Socio');
$egresosType = array('Proveedor', 'Contratista', 'Recursoshumanos', 'Derechosimpuestos');
if(in_array($type, $ingresosType)){
?>
<div class="row divIngreso">
    <?php
    $hiddenE = array(
            'Socio' => array('contratocompra', 'eproyecto', 'docproceso'),
            'Financiera' => array('contratocompra', 'recibosdinero', 'docproceso'),
            'Cliente' => array('eproyecto', 'recibosdinero'),
    );
    $ingresos = array(
            'general' => array('title' => 'Generales Contacto', 'source' => 'operators', 'view' => 'show', 'cont' => 'operators'),
            'contratocompra' => array('title' => 'C. Compra Venta', 'source' => 'legals', 'view' => 'create', 'cont' => 'newlegals'),
            'contratos' => array('title' => 'Contrato', 'source' => 'legals', 'view' => 'create', 'cont' => 'newlegals'),
            'spei' => array('title' => 'Transferencias', 'source' => 'flows', 'view' => 'create', 'type' => "1", 'cont' => 'flows'),
            'recibosdinero' => array('title' => 'Recibos de Dinero', 'source' => 'flows', 'view' => 'create', 'type' => "0", 'cont' => 'flows'),
            'pagos' => array('title' => 'E. Cuenta', 'source' => 'operations', 'view' => 'account', 'cont' => 'operations'),
            'eproyecto' => array('title' => 'Expediente de Proyecto', 'source' => 'documents', 'view' => 'create', 'cont' => 'newlegals'),
            'docproceso' => array('title' => 'Doc del Proceso', 'source' => 'documents', 'view' => 'create', 'cont' => 'newlegals')
    );
    $account = 0;
    ?>
    @foreach($ingresos as $key=>$values)
        @foreach($values as $ref=>$value)
            <?php $flag = true;?>
            @if($ref=="title")
                @foreach($hiddenE[$type] as $out)
                    <?php if ($out == $key) $flag = false;?>
                @endforeach
            @endif
            @if($flag && $ref!="source" && $ref!="view" && $ref!="cont" && $ref!="type") <?php $account++;?>
            <div class="form-group col-lg-4 col-md-6 col-xs-12 <?= $account > 3 ? "col-lg-offset-8 col-md-offset-6" : ""?>">
                <div class="box box-primary" id="panel-{{$key}}">
                    <div class="box-header with-border"><b>{{$value}}</b></div>
                    <div class="box-body">
                        <div class="bodyTable-{{$key}}" data-folder="{{$key}}"
                             data-area="{{isset($ingresos[$key]['source'])?$ingresos[$key]['source']:""}}"
                             data-table="{{isset($eegresos[$key]['source'])?$ingresos[$key]['source']:""}}"
                             data-url="{{isset($ingresos[$key]['source'])?$ingresos[$key]['source'].".store":"n"}}"></div>

                        @if(isset($ingresos[$key]['source']) && View::exists($ingresos[$key]['cont'].'.'.$ingresos[$key]['view']))
                            @if(isset($ingresos[$key][$project]))
                                @include($ingresos[$key]['cont'].'.'.$ingresos[$key]['view'],array('operator'=>$id))
                            @else
                                @if(isset($ingresos[$key]['cont']) && $ingresos[$key]['cont']=="newlegals")
                                    @include('newlegals.'.$ingresos[$key]['view'],array('folder'=>$ingresos[$key]['source'],'area'=>str_replace(" ","",strtolower($key)),'ref'=>$id,'project'=>$project))
                                @elseif(isset($ingresos[$key]['cont']) && (($ingresos[$key]['source']=="flows") || ($ingresos[$key]['source']=="operations")))
                                    @include('operations.'.$ingresos[$key]['view'],array('folder'=>'Ingreso','ref'=>$id,'project'=>$project,'status'=>isset($ingresos[$key]['type'])?$ingresos[$key]['type']:''))
                                @else
                                    @include($ingresos[$key]['cont'].'.'.$ingresos[$key]['view'],array('folder'=>$ingresos[$key]['cont'],'area'=>str_replace(" ","",strtolower($key)),'ref'=>$id,'project'=>$project))
                                @endif
                            @endif
                        @else
                            {{$ingresos[$key]['source'].'.'.$ingresos[$key]['view']}}-
                            {{View::exists($egresos[$key]['source'].'.'.$egresos[$key]['view'])}}-
                        @endif
                    </div>
                </div>
            </div>
            @endif
        @endforeach
    @endforeach
</div>
<?php  } else if (in_array($type, $egresosType)) { ?>
<div class="row divEgreso">
    <?php
    $hiddenP = array(
            'Proveedor' => array('contratos', 'recibonomina', 'comprobantepagos', 'ptecnico', 'etecnico', 'presupuestos'),
            'Contratista' => array('recibonomina', 'comprobantepagos', 'pedido', 'etecnico'),
            'Recursoshumanos' => array('facturas', 'comprobantepagos', 'pedido', 'ptecnico', 'etecnico', 'presupuestos'),
            'Derechosimpuestos' => array('contratos', 'general', 'facturas', 'recibonomina', 'pedido', 'ptecnico', 'presupuestos'),
    );
    $egresos = array(
            'general' => array('title' => 'Generales Contacto', 'source' => 'operators', 'view' => 'show', 'cont' => 'operators'),
            'contratos' => array('title' => 'Contrato', 'source' => 'legals', 'view' => 'create', 'cont' => 'newlegals'),
            'presupuestos' => array('title' => 'Presupuestos', 'source' => 'documents', 'view' => 'create', 'cont' => 'newlegals'),
            'spei' => array('title' => 'Transferencias', 'source' => 'flows', 'view' => 'create', 'type' => "1", 'cont' => 'flows'),
            'facturas' => array('title' => 'Facturas', 'source' => 'flows', 'view' => 'create', 'type' => "0", 'cont' => 'flows'),
            'recibonomina' => array('title' => 'Recibos de Nómina', 'source' => 'flows', 'view' => 'create', 'type' => "1", 'cont' => 'flows'),
            'comprobantepagos' => array('title' => 'Comprobantes de Pagos', 'source' => 'documents', 'view' => 'create', 'cont' => 'newlegals'),
            'pagos' => array('title' => 'E. Cuenta', 'source' => 'operations', 'view' => 'account', 'cont' => 'operations'),
            'pedido' => array('title' => 'Pedido/Especifico', 'source' => 'documents', 'view' => 'create', 'cont' => 'newlegals'),
            'ptecnico' => array('title' => 'Proyecto Técnico', 'source' => 'documents', 'view' => 'create', 'cont' => 'newlegals'),
            'etecnico' => array('title' => 'Expediente Técnico', 'source' => 'documents', 'view' => 'create', 'cont' => 'newlegals'),
    );
    $account = 0;
    ?>
    @foreach($egresos as $key=>$values)
        @foreach($values as $ref=>$value)
            <?php $flag = true;?>
            @if($ref=="title")
                @foreach($hiddenP[$type] as $out)
                    <?php if ($out == $key) $flag = false;?>
                @endforeach
            @endif
            @if($flag && $ref!="source" && $ref!="view" && $ref!="cont" && $ref!="type") <?php $account++;?>
            <div class="form-group col-lg-4 col-md-6 col-xs-12 <?= $account > 3 ? "col-lg-offset-8 col-md-offset-6" : ""?>">
                <div class="box box-primary" id="panel-{{$key}}">
                    <div class="box-header with-border"><b>{{$value}}</b></div>
                    <div class="box-body table-responsive" style="padding-left: 10px; padding-right: 10px">
                        <div class="nopadding bodyTable-{{$key}}"
                             data-area="{{isset($egresos[$key]['source'])?$egresos[$key]['source']:""}}"
                             data-folder="{{$key}}"
                             data-table="{{isset($egresos[$key]['source'])?$egresos[$key]['source']:""}}"
                             data-url="{{isset($egresos[$key]['source'])?$egresos[$key]['source'].".store":"n"}}"></div>
                        @if(isset($egresos[$key]['source']) && View::exists($egresos[$key]['cont'].'.'.$egresos[$key]['view']))
                            @if(isset($egresos[$key][$project]))
                                @include($egresos[$key]['cont'].'.'.$egresos[$key]['view'],array('operator'=>$id))
                            @else
                                @if(isset($egresos[$key]['cont']) && $egresos[$key]['cont']=="newlegals")
                                    @include('newlegals.'.$egresos[$key]['view'],array('folder'=>$egresos[$key]['source'],'area'=>str_replace(" ","",strtolower($key)),'ref'=>$id,'project'=>$project))
                                @elseif(isset($egresos[$key]['cont']) && (($egresos[$key]['source']=="flows") || ($egresos[$key]['source']=="operations")))
                                    @include('operations.'.$egresos[$key]['view'],array('folder'=>'Egreso','ref'=>$id,'project'=>$project,'status'=>isset($egresos[$key]['type'])?$egresos[$key]['type']:''))
                                @else
                                    @include($egresos[$key]['cont'].'.'.$egresos[$key]['view'],array('folder'=>$egresos[$key]['cont'],'area'=>str_replace(" ","",strtolower($key)),'ref'=>$id,'project'=>$project))
                                @endif
                            @endif
                        @else
                            {{$egresos[$key]['source'].'.'.$egresos[$key]['view']}}-
                            {{View::exists($egresos[$key]['source'].'.'.$egresos[$key]['view'])}}-
                        @endif
                    </div>
                </div>
            </div>
            @endif
        @endforeach
    @endforeach
</div>
<?php } ?>
