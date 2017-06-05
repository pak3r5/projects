<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateOperationRequest;
use App\Http\Requests\UpdateOperationRequest;
use App\Models\Operation;
use App\Repositories\OperationRepository;
use File;
use Flash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class OperationController extends AppBaseController
{
    /** @var  OperationRepository */
    private $operationRepository;

    public function __construct(OperationRepository $operationRepo)
    {
        $this->operationRepository = $operationRepo;
    }

    /**
     * Display a listing of the Operation.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->operationRepository->pushCriteria(new RequestCriteria($request));
        $operations = $this->operationRepository->all();

        return view('operations.index')
            ->with('operations', $operations);
    }

    /**
     * Show the form for creating a new Operation.
     *
     * @return Response
     */
    public function create()
    {
        return view('operations.create');
    }

    public function getDocuments($id, $ref, $folder, $status)
    {
        $test = Operation::searchByProject($id, $ref, $folder, $status)->orderBy('date', 'DESC')->orderBy('name', 'ASC')->get();
        return view('operations.info')
            ->with('documents', $test);
        //return response()->json($test);
    }

    public function getAccounts($id, $ref, $folder)
    {
        $toPay = Operation::searchByProject($id, $ref, $folder, 0)->select(DB::raw('SUM(amount) as toPay'))->get();
        $paid = Operation::searchByProject($id, $ref, $folder, 1)->select(DB::raw('SUM(amount) as paid'))->get();
        $total = number_format(number_format($paid[0]->paid, 2, ".", "") - number_format($toPay[0]->toPay, 2, ".", ""), 2, ".", ",");

        $moves = Operation::getMove($id, $ref, $folder)->select('date', 'id', DB::raw('FORMAT(amount,2) as amount'), 'type', 'status')->orderBy('date', 'DESC')->get();
        //return view('operations.account')
        //->with('total', $total)->with('toPay', $toPay)->with('paid', $paid)->with('moves',$moves);
        return response()->json(['total' => $total, 'topay' => $toPay, 'paid' => $paid, 'moves' => $moves]);
    }

    /**
     * Store a newly created Operation in storage.
     *
     * @param CreateOperationRequest $request
     *
     * @return Response
     */
    public function store(CreateOperationRequest $request)
    {
        $input = $request->all();

        $operation = $this->operationRepository->create($input);

        $path = public_path() . '/files/';
        File::makeDirectory($path, $mode = 0777, true, true);

        $path = public_path() . '/files/' . $operation->project_id . '/';
        File::makeDirectory($path, $mode = 0777, true, true);

        $path = public_path() . '/files/' . $operation->project_id . '/' . $operation->type . '/';
        File::makeDirectory($path, $mode = 0777, true, true);

        $auxpath = '/files/' . $operation->project_id . '/' . $operation->type . '/';
        $files = $request->file('file');
        foreach ($files as $file) {
            $fileName = $file->getClientOriginalName();
            $name = bcrypt($fileName);
            $file->move($path, $name);
            Operation::where('id', $operation->id)->update(['name' => $fileName, 'path' => $path . $name]);
        }
        if (isset($operation->id)) {
            return response()->json(['res' => 'Creado Correctamente', 'type' => 'success']);
        }
        return response()->json(['res' => 'Error,no se pudo crear', 'type' => 'danger']);
    }

    /**
     * Display the specified Operation.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $operation = $this->operationRepository->findWithoutFail($id);

        if (empty($operation)) {
            Flash::error('Operation not found');

            return redirect(route('operations.index'));
        }

        return view('operations.show')->with('operation', $operation);
    }

    /**
     * Show the form for editing the specified Operation.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $operation = $this->operationRepository->findWithoutFail($id);

        if (empty($operation)) {
            Flash::error('Operation not found');

            return redirect(route('operations.index'));
        }

        return view('operations.edit')->with('operation', $operation);
    }

    /**
     * Update the specified Operation in storage.
     *
     * @param  int $id
     * @param UpdateOperationRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateOperationRequest $request)
    {
        $operation = $this->operationRepository->findWithoutFail($id);

        if (empty($operation)) {
            Flash::error('Operation not found');

            return redirect(route('operations.index'));
        }

        $operation = $this->operationRepository->update($request->all(), $id);

        Flash::success('Operation updated successfully.');

        return redirect(route('operations.index'));
    }

    /**
     * Remove the specified Operation from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $operation = $this->operationRepository->findWithoutFail($id);
        $res = "";
        if (empty($operation)) {
            $res = "error";
        }

        $this->operationRepository->delete($id);
        $res = 'ok';
        return response()->json(['res' => $res]);
    }
}
