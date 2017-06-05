<?php

namespace App\Http\Controllers;

use App\Addres;
use App\Http\Requests\CreateOperatorRequest;
use App\Http\Requests\UpdateOperatorRequest;
use App\Models\Operator;
use App\Repositories\OperatorRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class OperatorController extends AppBaseController
{
    /** @var  OperatorRepository */
    private $operatorRepository;

    public function __construct(OperatorRepository $operatorRepo)
    {
        $this->operatorRepository = $operatorRepo;
    }

    public function getData(Request $request)
    {
        $this->operatorRepository->pushCriteria(new RequestCriteria($request));
        $operators = $this->operatorRepository->all();

        return response()->json([$operators]);
    }

    public function getTemplate(Request $request)
    {
        $type=ucwords($request->only('type')['type']);
        $id=$request->only('ref')['ref'];
        $project=$request->only('project')['project'];

        return view('projects.template')->with('type',$type)->with('id',$id)->with('project',$project);
    }

    /**
     * Display a listing of the Operator.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->operatorRepository->pushCriteria(new RequestCriteria($request));
        $operators = $this->operatorRepository->all();
        $test= Operator::search($request->only('name')['name'])->orderBy('type', 'ASC')->orderBy('name', 'ASC')->get();
        return response()->json($test);
    }

    /**
     * Show the form for creating a new Operator.
     *
     * @return Response
     */
    public function create()
    {
        return view('operators.create');
    }

    /**
     * Store a newly created Operator in storage.
     *
     * @param CreateOperatorRequest $request
     *
     * @return Response
     */
    public function store(CreateOperatorRequest $request)
    {
        $input = $request->all();

        $operator = $this->operatorRepository->create($input);
        if(isset($operator->id)){
            return response()->json(['res'=>'Creado Correctamente','type'=>'success','id'=>$operator->id,'ref'=>$operator->type]);
        }
        return response()->json(['res'=>'Error,no se pudo crear','type'=>'danger']);
    }

    /**
     * Display the specified Operator.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $operator = $this->operatorRepository->findWithoutFail($id);

        if (empty($operator)) {
            Flash::error('Operator not found');

            //return redirect(route('operators.index'));
        }

        return response()->json(['operator' =>$operator]);
    }

    /**
     * Show the form for editing the specified Operator.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $operator = $this->operatorRepository->findWithoutFail($id);

        if (empty($operator)) {
            Flash::error('Operator not found');

            return redirect(route('operators.index'));
        }

        return view('operators.edit')->with('operator', $operator);
    }

    /**
     * Update the specified Operator in storage.
     *
     * @param  int              $id
     * @param UpdateOperatorRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateOperatorRequest $request)
    {
        $operator = $this->operatorRepository->findWithoutFail($id);

        if (empty($operator)) {
            Flash::error('Operator not found');

            return redirect(route('operators.index'));
        }

        $operator = $this->operatorRepository->update($request->all(), $id);

        Flash::success('Operator updated successfully.');

        return redirect(route('operators.index'));
    }

    /**
     * Remove the specified Operator from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $operator = $this->operatorRepository->findWithoutFail($id);

        if (empty($operator)) {
            Flash::error('Operator not found');

            return redirect(route('operators.index'));
        }

        $this->operatorRepository->delete($id);

        Flash::success('Operator deleted successfully.');

        return redirect(route('operators.index'));
    }

    public function getAddresses(Request $request){
        $input = $request->all();
        $answer=['state'=>'','city'=>'','mun'=>'','col'=>array()];
        $col= Addres::getCol($request->only('cp'));
        $data= Addres::getGeneralInformation($request->only('cp'));
        $answer['city']=$data[0]['city'];
        $answer['mun']=$data[0]['mun'];
        $answer['state']=$data[0]['state'];
        $answer['col']=$col;
        if($request->ajax()){
            return response()->json($answer);
        }
    }
}
