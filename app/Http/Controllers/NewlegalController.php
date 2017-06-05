<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateNewlegalRequest;
use App\Http\Requests\UpdateNewlegalRequest;
use App\Models\Newlegal;
use App\Repositories\NewlegalRepository;
use File;
use Flash;
use Illuminate\Http\Request;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class NewlegalController extends AppBaseController
{
    /** @var  NewlegalRepository */
    private $newlegalRepository;

    public function __construct(NewlegalRepository $newlegalRepo)
    {
        $this->newlegalRepository = $newlegalRepo;
    }

    /**
     * Display a listing of the Newlegal.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->newlegalRepository->pushCriteria(new RequestCriteria($request));
        $newlegals = $this->newlegalRepository->all();

        return view('newlegals.index')
            ->with('newlegals', $newlegals);
    }

    public function getDocuments($id, $ref, $area, $folder)
    {
        $test = Newlegal::searchByProject($id, $ref, $area, $folder)->orderBy('created_at', 'DESC')->orderBy('name', 'ASC')->get();
        return view('newlegals.info')
            ->with('documents', $test)->with('area', $area);
        //return response()->json($test);
    }

    /**
     * Show the form for creating a new Newlegal.
     *
     * @return Response
     */
    public function create()
    {
        return view('newlegals.create');
    }

    /**
     * Store a newly created Newlegal in storage.
     *
     * @param CreateNewlegalRequest $request
     *
     * @return Response
     */
    public function store(CreateNewlegalRequest $request)
    {
        $input = $request->all();
        $document = $this->newlegalRepository->create($input);

        $path = public_path() . '/files/';
        File::makeDirectory($path, $mode = 0777, true, true);

        $path = public_path() . '/files/' . $document->project_id . '/';
        File::makeDirectory($path, $mode = 0777, true, true);

        $path = public_path() . '/files/' . $document->project_id . '/' . $document->folder . '/';
        File::makeDirectory($path, $mode = 0777, true, true);

        $path = public_path() . '/files/' . $document->project_id . '/' . $document->folder . '/' . $document->area . '/';
        File::makeDirectory($path, $mode = 0777, true, true);

        $auxpath = '/files/' . $document->project_id . '/' . $document->folder . '/' . $document->operator_id . '/' . $document->area . '/';
        $files = $request->file('file');
        foreach ($files as $file) {
            $fileName = $file->getClientOriginalName();
            $name = bcrypt($fileName);
            $file->move($path, $name);
            Newlegal::where('id', $document->id)->update(['name' => $fileName, 'path' => $path . $name]);
        }
        if (isset($document->id)) {
            return response()->json(['res' => 'Creado Correctamente', 'type' => 'success']);
        }
        return response()->json(['res' => 'Error,no se pudo crear', 'type' => 'danger']);
    }

    /**
     * Display the specified Newlegal.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $newlegal = $this->newlegalRepository->findWithoutFail($id);

        if (empty($newlegal)) {
            Flash::error('Newlegal not found');

            return redirect(route('newlegals.index'));
        }

        return view('newlegals.show')->with('newlegal', $newlegal);
    }

    /**
     * Show the form for editing the specified Newlegal.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $newlegal = $this->newlegalRepository->findWithoutFail($id);

        if (empty($newlegal)) {
            Flash::error('Newlegal not found');

            return redirect(route('newlegals.index'));
        }

        return view('newlegals.edit')->with('newlegal', $newlegal);
    }

    /**
     * Update the specified Newlegal in storage.
     *
     * @param  int $id
     * @param UpdateNewlegalRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateNewlegalRequest $request)
    {
        $newlegal = $this->newlegalRepository->findWithoutFail($id);

        if (empty($newlegal)) {
            Flash::error('Newlegal not found');

            return redirect(route('newlegals.index'));
        }

        $newlegal = $this->newlegalRepository->update($request->all(), $id);

        Flash::success('Newlegal updated successfully.');

        return redirect(route('newlegals.index'));
    }

    /**
     * Remove the specified Newlegal from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $newlegal = $this->newlegalRepository->findWithoutFail($id);
        $res = "";
        if (empty($newlegal)) {
            $res = 'error';
        }

        $this->newlegalRepository->delete($id);

        $res = 'ok';

        return response()->json(['res' => $res]);
    }
}
