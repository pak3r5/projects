@extends('layouts.bootstrap')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <section class="content-header">
                    <h1>
                        {!! Form::open(['route' => ['projects.destroy', $project->id], 'method' => 'delete','class'=>'form-inline']) !!}
                        <span class="projectName">{!! $project->name !!}</span>
                        <div class='btn-group'>
                            <a href="#" data-href="{!! route('projects.edit', [$project->id]) !!}"
                               class='btn btn-default btn-xs addProject' data-title="Editar proyecto"
                               data-toggle="modal"
                               data-target="#newProyect"><span class="glyphicon glyphicon-edit"></span></a>
                            {!! Form::button('<span class="glyphicon glyphicon-trash"></span>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Estas seguro de eliminar el proyecto?')"]) !!}
                        </div>
                        {!! Form::close() !!}
                    </h1>
                </section>
            </div>
            <div class="col-sm-6 valign">
                <br>
                <div class="input-group pull-right ">
                    <input type="text" class="form-control valSearch" placeholder="Buscar...">
                    <span class="input-group-btn">
                        <button class="btn btn-default btnSearch" type="button"><span class="glyphicon glyphicon-search"
                                                                                      aria-hidden="true"></span>
                        </button>
                    </span>
                </div>
            </div>
        </div>

        <div class="modal fade" data-keyboard="false" id="modalForm" role="dialog"
             aria-labelledby="modalFormLabel">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header ">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel"></h4>
                    </div>
                    <div class="modal-body">
                        ...
                    </div>

                </div>
            </div>
        </div>
        <div class="modal fade" data-keyboard="false" id="modalFormOperator" role="dialog"
             aria-labelledby="modalFormOperatorLabel">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header ">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="modalFormOperatorMyLabel"></h4>
                    </div>
                    <div class="modal-body">
                        ...
                    </div>

                </div>
            </div>
        </div>
        <!--      <div class="row divOrgChart hide">
                  <center>
                      <div id="chart-container"></div>
                  </center>
              </div>-->
        <br>
        <div class="row divSearcher">
        </div>

        <div class="row divCompleteTemplate">
        </div>
    </div>
@endsection

@if(Auth::user()->role=="user")
@section('extraStyle')
    <link href="{{asset('/plugins/orgchart/dist/css/jquery.orgchart.css')}}" rel="stylesheet">
    <link href="{{asset('/plugins/dropzone/dist/min/basic.min.css')}}" rel="stylesheet">
    <link href="{{asset('/plugins/dropzone/dist/min/dropzone.min.css')}}" rel="stylesheet">
    <link href="{{asset('/plugins/datepicker/datepicker.css')}}" rel="stylesheet">
    <link href="{{asset('/plugins/inputmask/css/inputmask.css')}}" rel="stylesheet">
    <link href="{{asset('/plugins/select2/select2.min.css')}}" rel="stylesheet">
    <style>

        .nopadding {
            padding: 0 !important;
            margin: 0 !important;
        }

        .select2 {
            width: 100% !important;
        }

        .vcenter {
            display: inline-block;
            vertical-align: middle;
            float: none;
        }

        .orgchart .bottom-level .title {
            background-color: #993366;
        }

        .orgchart .bottom-level .content {
            border-color: #993366;
        }

        .tableMoves {
            font-size: 10px !important;
        }

        .dragandrophandler {
            border: 2px dotted #0B85A1;
            width: 80%;
            color: #92AAB0;
            text-align: left;
            vertical-align: middle;
            padding: 10px 10px 10px 10px;
            margin-bottom: 10px;
            font-size: 200%;
        }

        .dragandrophandlear, .dropzone {
            width: 100% !important;
            font-size: 10px !important;
            text-align: center;
            padding: 0px 0px !important;
            margin: 0px !important;;
            border-style: hidden;
        }

        #chart-container {
            position: relative;
            display: inline-block;
            top: 10px;
            left: 10px;
            height: 800px;
            width: calc(100% - 24px);
            border: 2px dashed #aaa;
            border-radius: 5px;
            overflow: auto;
            text-align: left;
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
            font-size: 14px;
        }

    </style>
@endsection
@section('extraScript')
    <script src="{{asset('/plugins/orgchart/dist/js/jquery.orgchart.js')}}" type="text/javascript"></script>
    <script src="{{asset('/plugins/dropzone/dist/min/dropzone.min.js')}}"></script>
    <script src="{{asset('/plugins/inputmask/dist/min/jquery.inputmask.bundle.min.js')}}"></script>
    <script src="{{asset('/plugins/inputmask/js/bindings/inputmask.binding.js')}}"></script>
    <script src="{{asset('/plugins/datepicker/datepicker.js')}}"></script>
    <script src="{{asset('/plugins/datepicker/datepicker.es.js')}}"></script>
    <script src="{{asset('/plugins/select2/select2.full.min.js')}}"></script>
    <script src="{{asset('/plugins/select2/es.js')}}"></script>
    <script type="text/javascript">
        var project = '{{$project->id}}';
        /*$('#chart-container').orgchart({
         'data': JSON.parse('{!! $tree !!}'),
         'nodeContent': 'title',
         'direction': 'l2r',
         'pan': false,
         'zoom': false,
         'className': 'ref',
         'createNode': function ($node, data) {
         if (data.files) {
         $node.addClass("addFiles2Project");
         $node.attr("data-" + data.ref, data.route);
         $node.attr("data-" + data.ref, data.route);
         }

         if (data.titleAux) {
         $node.attr("data-title", data.titleAux);
         }

         if (data.url) {
         $node.attr("data-url", data.url);
         }

         if (data.parent) {
         $node.attr("data-folder", data.parent);
         }

         if (data.route) {
         $node.attr("data-route", data.route);
         }
         },
         });*/

        $(document).on("click", ".editProject", function (e) {
            e.preventDefault();
            var body = $(".modal-body");
            $.get($(this).data("href"), function (data) {
                body.html(data);
            });
        });
        var title = $("#modalForm .modal-title");
        var body = $("#modalForm .modal-body");
        $(document).on("click", ".showModalsProject", function (e) {
            title.html($(this).data('title'));
            var area = $(this).data('route');
            var folder = $(this).data('parent');
            $.get($(this).data('url'), function (data) {
                body.html(data);
                body.find("#area").val(area).end();
                body.find("#subarea").val(folder).end();
                body.find("#project_id").val(project).end();

                $.getJSON("{{route('getOperators')}}", function (data) {
                    var items = [];
                    $.each(data[0], function (key, val) {
                        items.push("<option value='" + val.id + "'>" + val.name + "</option>");
                    });
                    $("#operator_id").html(items);
                });

                $("#modalForm").modal('show', {
                    backdrop: true,
                    keyboard: false,
                });

            });
        });


        $(document).on("click", ".showModalsOperator", function (e) {
            var titleF = $("#modalFormOperator .modal-title");
            var bodyF = $("#modalFormOperator .modal-body");
            titleF.html($(this).data('title'));
            var folder = $(this).data('parent');
            $.get($(this).data('url'), function (data) {
                bodyF.html(data);
                bodyF.find("#project_id").val(project).end();
                $("#modalFormOperator").modal('show', {
                    backdrop: true,
                    keyboard: false,
                });
            });
        });

        $(document).on("hide.bs.modal", "#modalFormOperator", function () {
            var titleF = $("#modalFormOperator .modal-title");
            var bodyF = $("#modalFormOperator .modal-body");
            titleF.html("");
            bodyF.html("");
        });

        $(document).on("keyup", ".valSearch", function () {
            $(".divCompleteTemplate").html("");
            var searchValue = $(this).val();
            if (searchValue != "") {
                //$(".divOrgChart").fadeOut();
                $.getJSON("{{route('operators.index')}}", {'name': searchValue}, function (data) {
                    $(".divSearcher").html("");
                    if (data.length > 0) {
                        var items = "";
                        $type = "";
                        $.each(data, function (key, val) {
                            if ($type != val.type) {
                                if (items != "") {
                                    items += "</div></div></div>";
                                }
                                $type = val.type;
                                items += ("<div class='col-lg-3 col-md-6 '><div class='box box-solid'><div class='box-header with-border'><h3 class='box-title'>" + val.type + "</h3></div><div class='box-body'>");
                            }
                            items += ("<a href='#' data-id='" + val.id + "' data-type='" + val.type + "' class='btnGetTemplate'>" + val.name + "</a><br>");
                        });
                        if (items != "") {
                            items += "</div></div></div>";
                        }
                    }else{
                        var items='<center><button class="btn btn-sm btn-success OperatorAreaProject showModalsOperator" data-title ="Agregar Socio,Cliente,Contratista,Proveedor" data-url="{{route('operators.create')}}" type="button">Agregar</button></center>';
                    }
                    $(".divSearcher").append(items);
                });
            } else {
                $(".divSearcher").html("");
                //$(".divOrgChart").fadeIn();
            }
        });


        $(document).on("click", ".btnGetTemplate", function () {
            getTemplateData($(this).data('type'),$(this).data('id'));
        });

        function getTemplateData(type,ref){
            $.post('{{route('getTemplate')}}', {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        type: type,
                        ref: ref,
                        project: '{{$project->id}}'
                    })
                    .done(function (data) {
                        $(".divSearcher").html("");
                        $(".divCompleteTemplate").html(data);
                    });
        }

    </script>
@endsection
@endif