<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateFlowRequest;
use App\Http\Requests\UpdateFlowRequest;
use App\Repositories\FlowRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class FlowController extends AppBaseController
{
    /** @var  FlowRepository */
    private $flowRepository;

    public function __construct(FlowRepository $flowRepo)
    {
        $this->flowRepository = $flowRepo;
    }

    /**
     * Display a listing of the Flow.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->flowRepository->pushCriteria(new RequestCriteria($request));
        $flows = $this->flowRepository->all();

        return view('flows.index')
            ->with('flows', $flows);
    }

    /**
     * Show the form for creating a new Flow.
     *
     * @return Response
     */
    public function create()
    {
        return view('flows.create');
    }

    /**
     * Store a newly created Flow in storage.
     *
     * @param CreateFlowRequest $request
     *
     * @return Response
     */
    public function store(CreateFlowRequest $request)
    {
        $input = $request->all();

        $flow = $this->flowRepository->create($input);

        if(isset($flow->id)){
            return response()->json(['res'=>'Creado Correctamente','type'=>'success']);
        }
        return response()->json(['res'=>'Error,no se pudo crear','type'=>'danger']);
    }

    /**
     * Display the specified Flow.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $flow = $this->flowRepository->findWithoutFail($id);

        if (empty($flow)) {
            Flash::error('Flow not found');

            return redirect(route('flows.index'));
        }

        return view('flows.show')->with('flow', $flow);
    }

    /**
     * Show the form for editing the specified Flow.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $flow = $this->flowRepository->findWithoutFail($id);

        if (empty($flow)) {
            Flash::error('Flow not found');

            return redirect(route('flows.index'));
        }

        return view('flows.edit')->with('flow', $flow);
    }

    /**
     * Update the specified Flow in storage.
     *
     * @param  int              $id
     * @param UpdateFlowRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateFlowRequest $request)
    {
        $flow = $this->flowRepository->findWithoutFail($id);

        if (empty($flow)) {
            Flash::error('Flow not found');

            return redirect(route('flows.index'));
        }

        $flow = $this->flowRepository->update($request->all(), $id);

        Flash::success('Flow updated successfully.');

        return redirect(route('flows.index'));
    }

    /**
     * Remove the specified Flow from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $flow = $this->flowRepository->findWithoutFail($id);

        if (empty($flow)) {
            Flash::error('Flow not found');

            return redirect(route('flows.index'));
        }

        $this->flowRepository->delete($id);

        Flash::success('Flow deleted successfully.');

        return redirect(route('flows.index'));
    }

    public function getIngreso()
    {
        return response()->json(['Casas','Departamentos','Lofts']);
    }

    public function getEgreso()
    {
        return response()->json(['Terreno','Condominios a entregar','Edificación casas','Espacio común','Demoliciones','Proyecto','Licencias','Factibilidad de agua','Ventas','Jurídico','Fideicomiso','Publicidad','Imprevistos','Developer Fee','Administración','Intereses crédito p']);
    }
}
