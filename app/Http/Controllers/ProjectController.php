<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Repositories\ProjectRepository;
use Flash;
use Illuminate\Http\Request;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class ProjectController extends AppBaseController
{
    /** @var  ProjectRepository */
    private $projectRepository;

    public function __construct(ProjectRepository $projectRepo)
    {
        $this->projectRepository = $projectRepo;
    }

    /**
     * Display a listing of the Project.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->projectRepository->pushCriteria(new RequestCriteria($request));
        $projects = $this->projectRepository->all();
        return view('projects.index')
            ->with('projects', $projects);
    }

    /**
     * Show the form for creating a new Project.
     *
     * @return Response
     */
    public function create()
    {
        return view('projects.create');
    }

    /**
     * Store a newly created Project in storage.
     *
     * @param CreateProjectRequest $request
     *
     * @return Response
     */
    public function store(CreateProjectRequest $request)
    {
        $input = $request->all();
        if ($this->projectRepository->create($input))
            return response()->json(['res' => "Registrado Correctamente", 'type' => 'success']);
        else
            return response()->json(['res' => "Error, no se pudo generar el proyecto", 'type' => 'danger']);
    }

    /**
     * Display the specified Project.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $project = $this->projectRepository->findWithoutFail($id);
        $tree = array(
            'name' => $project->name,
            'title' => 'Proyecto',
            'className'=>'NameProject',
            'children' => array(
                array('name' => 'Administración', 'title' => 'Area','className'=>'AreaProject', 'children' => array(
                    array('name' => 'Presupuestos y Cotizaciones','title'=>'Operación', 'titleAux' => 'Agregar Cotización o presupuesto','url'=>route('estimates.create'),'className'=>'SubAreaProject showModalsProject', 'children' => array(
                        array('name' => 'Contratistas', 'title' => 'Operación', 'titleAux' => 'Agregar Socio,Cliente,Contratista,Proveedor','url'=>route('operators.create'),'className'=>'OperatorAreaProject showModalsOperator'),
                        array('name' => 'Proveedores', 'title' => 'Operación', 'titleAux' => 'Agregar Socio,Cliente,Contratista,Proveedor','url'=>route('operators.create'),'className'=>'OperatorAreaProject showModalsOperator'),
                    )),
                    array('name' => 'Contabilidad', 'title' => 'SubArea','className'=>'SubAreaProject', 'children' => array(
                        array('name' => 'Ingreso', 'title' => 'Tipo', 'titleAux' => 'Agregar Operación','url'=>route('flows.create'),'className'=>'FlowProject showModalsProject', 'children' => array(
                            array('name' => 'Aportaciones', 'title' => 'Clasificación', 'children' => array(
                                array('name' => 'Socio/Inversionista', 'title' => 'Operación', 'titleAux' => 'Agregar Socio,Cliente,Contratista,Proveedor','url'=>route('operators.create'),'className'=>'OperatorAreaProject showModalsOperator'),
                                array('name' => 'Financieras', 'title' => 'Operación'),
                            )),
                            array('name' => 'Ventas', 'title' => 'Clasificación', 'children' => array(
                                array('name' => 'Clientes', 'title' => 'Operación', 'titleAux' => 'Agregar Socio,Cliente,Contratista,Proveedor','url'=>route('operators.create'),'className'=>'OperatorAreaProject showModalsOperator'),
                            )),
                        )),
                        array('name' => 'Egreso', 'title' => 'Tipo', 'titleAux' => 'Agregar Operación','url'=>route('flows.create'),'className'=>'FlowProject showModalsProject', 'children' => array(
                            array('name' => 'Compras y Gastos', 'title' => 'Clasificación', 'children' => array(
                                array('name' => 'Proveedores', 'title' => 'Operación', 'titleAux' => 'Agregar Socio,Cliente,Contratista,Proveedor','url'=>route('operators.create'),'className'=>'OperatorAreaProject showModalsOperator'),
                                array('name' => 'Contratistas', 'title' => 'Operación', 'titleAux' => 'Agregar Socio,Cliente,Contratista,Proveedor','url'=>route('operators.create'),'className'=>'OperatorAreaProject showModalsOperator'),
                                array('name' => 'Recursos Humanos', 'title' => 'Operación'),
                                array('name' => 'Derechos/Impuestos', 'title' => 'Operación'),
                            )),
                            array('name' => 'Pagos', 'title' => 'Clasificación', 'children' => array(
                                array('name' => 'Bancos', 'title' => 'Operación'),
                                array('name' => 'Efectivo', 'title' => 'Operación'),
                            )),

                        )),
                    )),
                )),
                array('name' => 'Proyectos', 'title' => 'Area','className'=>'AreaProject', 'children' => array(
                    array('name' => 'Generales', 'title' => 'SubArea','className'=>'SubAreaProject', 'children' => array(
                        array('name' => 'Ubicación', 'title' => 'Destino','ref'=>'documentos','parent'=>'generales','route'=>'ubicacion','files'=>true, 'titleAux' => 'Agregar Archivo a Ubicación al Projecto','url'=>route('documents.create'), 'className' => 'showModalsProject fileUbicacion'),
                        array('name' => 'Brief y Textos', 'title' => 'Destino','ref'=>'documentos','parent'=>'generales','route'=>'briefYTextos','files'=>true, 'titleAux' => 'Agregar Archivo de Brief y Textos al Projecto','url'=>route('documents.create'), 'className' => 'showModalsProject fileBriefTextos'),
                        array('name' => 'Memoria Descriptiva', 'title' => 'Destino','ref'=>'documentos','parent'=>'generales','route'=>'memoriaDescriptiva','files'=>true, 'titleAux' => 'Agregar Archivo a Memoria Descriptiva al Projecto','url'=>route('documents.create'), 'className' => 'showModalsProject fileMemoriaDescriptiva'),
                        array('name' => 'Fotografía de Sitio', 'title' => 'Destino','ref'=>'documentos','parent'=>'generales','route'=>'fotografiaDeSitio','files'=>true, 'titleAux' => 'Agregar Archivo de Fotografía de Sitio al Projecto','url'=>route('documents.create'), 'className' => 'showModalsProject fileFotogradia'),
                        array('name' => 'Programa Arq.', 'title' => 'Destino','ref'=>'documentos','parent'=>'generales','route'=>'ProgramaArq','files'=>true, 'titleAux' => 'Agregar Archivo de Programa Arq. al Projecto','url'=>route('documents.create'), 'className' => 'showModalsProject fileProgramaArq'),
                        array('name' => 'Listado de Planos', 'title' => 'Destino','ref'=>'documentos','parent'=>'generales','route'=>'ListadoDePlanos','files'=>true, 'titleAux' => 'Agregar Archivo de Listado de Planos al Projecto','url'=>route('documents.create'), 'className' => 'showModalsProject fileListadoPlanos'),
                        array('name' => 'Presentación', 'title' => 'Destino','ref'=>'documentos','parent'=>'generales','route'=>'presentacion','files'=>true, 'titleAux' => 'Agregar Archivo Presentación al Projecto','url'=>route('documents.create'), 'className' => 'showModalsProject filePresentacion'),
                        array('name' => 'Investigación', 'title' => 'Destino','ref'=>'documentos','parent'=>'generales','route'=>'investigacion','files'=>true, 'titleAux' => 'Agregar Archivo Investigación al Projecto','url'=>route('documents.create'), 'className' => 'showModalsProject fileInvestigacion'),
                        array('name' => 'Doc. Recibida', 'title' => 'Destino','ref'=>'documentos','parent'=>'generales','route'=>'docRecibida','files'=>true, 'titleAux' => 'Agregar Archivo Doc. Recibida al Projecto','url'=>route('documents.create'), 'className' => 'showModalsProject fileDocRecibida'),
                    )),
                    array('name' => 'Taller de Diseño', 'title' => 'SubArea','className'=>'SubAreaProject', 'children' => array(
                        array('name' => 'Bocetos', 'title' => 'Destino','ref'=>'documentos','parent'=>'tallerDeDiseno','route'=>'bocetos','files'=>true, 'titleAux' => 'Agregar Bocetos al Projecto','url'=>route('documents.create'), 'className' => 'showModalsProject fileBocetos'),
                        array('name' => 'Ideas', 'title' => 'Destino','ref'=>'documentos','parent'=>'tallerDeDiseno','route'=>'ideas','files'=>true, 'titleAux' => 'Agregar Ideas al Projecto','url'=>route('documents.create'), 'className' => 'showModalsProject fileIdeas'),
                        array('name' => 'Modelos', 'title' => 'Destino','ref'=>'documentos','parent'=>'tallerDeDiseno','route'=>'modelos','files'=>true, 'titleAux' => 'Agregar Modelos al Projecto','url'=>route('documents.create'), 'className' => 'showModalsProject fileModelos'),
                        array('name' => 'Referencias', 'title' => 'Destino','ref'=>'documentos','parent'=>'tallerDeDiseno','route'=>'referencias','files'=>true, 'titleAux' => 'Agregar Referencias al Projecto','url'=>route('documents.create'), 'className' => 'showModalsProject fileReferencias'),
                        array('name' => 'Sustentabilidad', 'title' => 'Destino','ref'=>'documentos','parent'=>'tallerDeDiseno','route'=>'sustentabilidad','files'=>true, 'titleAux' => 'Agregar Sustentabilidad al Projecto','url'=>route('documents.create'), 'className' => 'showModalsProject fileSustentabilidad'),
                        array('name' => 'Imágenes', 'title' => 'Destino','ref'=>'documentos','parent'=>'tallerDeDiseno','route'=>'imagenes','files'=>true, 'titleAux' => 'Agregar Imágenes al Projecto','url'=>route('documents.create'), 'className' => 'showModalsProject fileImágenes'),
                    )),
                    array('name' => 'Taller de Ejecución', 'title' => 'SubArea','className'=>'SubAreaProject', 'children' => array(
                        array('name' => 'Est. Preliminares', 'title' => 'Destino','ref'=>'documentos','parent'=>'tallerDeEjecucion','route'=>'estPreliminares','files'=>true, 'titleAux' => 'Agregar Est. Preliminares al Projecto','url'=>route('documents.create'), 'className' => 'showModalsProject filePreliminares'),
                        array('name' => 'Arquitectura', 'title' => 'Destino','ref'=>'documentos','parent'=>'tallerDeEjecucion','route'=>'arquitectura','files'=>true, 'titleAux' => 'Agregar Arquitectura al Projecto','url'=>route('documents.create'), 'className' => 'showModalsProject fileArquitectura'),
                        array('name' => 'Estructura', 'title' => 'Destino','ref'=>'documentos','parent'=>'tallerDeEjecucion','route'=>'estructura','files'=>true, 'titleAux' => 'Agregar Estructura al Projecto','url'=>route('documents.create'), 'className' => 'showModalsProject fileEstructura'),
                        array('name' => 'Instalaciones', 'title' => 'Destino','ref'=>'documentos','parent'=>'tallerDeEjecucion','route'=>'instalaciones','files'=>true, 'titleAux' => 'Agregar Instalaciones al Projecto','url'=>route('documents.create'), 'className' => 'showModalsProject fileInstalaciones'),
                        array('name' => 'Acabados', 'title' => 'Destino','ref'=>'documentos','parent'=>'tallerDeEjecucion','route'=>'acabados','files'=>true, 'titleAux' => 'Agregar Acabados al Projecto','url'=>route('documents.create'), 'className' => 'showModalsProject fileAcabados'),
                    )),
                )),
                array('name' => 'Legal', 'title' => 'Area','className'=>'AreaProject', 'children' => array(
                    array('name' => 'Contratos', 'title' => 'Destino', 'ref' => 'legal', 'route' => 'contratos', 'files' => true, 'titleAux' => 'Agregar Contratos Legales','url'=>route('legals.create'),'className'=>'SubAreaProject showModalsProject'),
                    array('name' => 'Permisos', 'title' => 'Destino','ref'=>'legal','route'=>'permisos','files'=>true, 'titleAux' => 'Agregar Permisos Legales','url'=>route('legals.create'),'className'=>'SubAreaProject showModalsProject'),
                    array('name' => 'Escritura Terreno', 'title' => 'Destino','ref'=>'legal','route'=>'escrituraTerreno','files'=>true, 'titleAux' => 'Agregar Escrituras de Terreno Legales','url'=>route('legals.create'),'className'=>'SubAreaProject showModalsProject'),
                    array('name' => 'Escritura casas en venta', 'title' => 'Destino','ref'=>'legal','route'=>'escrituraCasasEnVenta','files'=>true, 'titleAux' => 'Agregar Escritura de Casas en Venta Legales','url'=>route('legals.create'),'className'=>'SubAreaProject showModalsProject'),
                    array('name' => 'Fideicomiso', 'title' => 'Destino','ref'=>'legal','route'=>'fideicomiso','files'=>true, 'titleAux' => 'Agregar Fideicomiso Legales','url'=>route('legals.create'),'className'=>'SubAreaProject showModalsProject'),
                    array('name' => 'Otros', 'title' => 'Destino','ref'=>'legal','route'=>'Otros','files'=>true, 'titleAux' => 'Agregar Otros Legales','url'=>route('legals.create'),'className'=>'SubAreaProject showModalsProject'),
                )),
            )
        );


        if (empty($project)) {
            Flash::error('Project not found');

            return redirect(route('projects.index'));
        }

        return view('projects.show')->with('project', $project)->with('tree', json_encode($tree));
    }

    /**
     * Show the form for editing the specified Project.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $project = $this->projectRepository->findWithoutFail($id);
        if (empty($project)) {
            return response()->json(['res' => "Proyecto no encontrado", 'type' => 'warning']);
        }
        return view('projects.edit')->with('project', $project);
    }

    /**
     * Update the specified Project in storage.
     *
     * @param  int $id
     * @param UpdateProjectRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateProjectRequest $request)
    {
        $project = $this->projectRepository->findWithoutFail($id);
        if (empty($project)) {
            return response()->json("Proyecto no encontrado");
        }
        if ($this->projectRepository->update($request->all(), $id))
            return response()->json(['res' => "Proyecto editado Correctamente", 'type' => 'success','name'=>$request->only('name')['name']]);
        else
            return response()->json(['res' => "Error, no e pudo cambiar el nombre del proyecto", 'type' => 'danger']);
    }

    /**
     * Remove the specified Project from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $project = $this->projectRepository->findWithoutFail($id);
        if (empty($project)) {
            return response()->json("Proyecto no encontrado");
        }
        if ($this->projectRepository->delete($id)) {
            Flash::success('Proyecto eliminado correctamente.');
            return redirect('/home');
        } else
            return response()->json(['res' => "Error, no se pudo eliminar el Proyecto", 'type' => 'danger']);
    }
}
