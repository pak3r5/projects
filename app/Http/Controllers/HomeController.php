<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function getMenu()
    {
        $projects = Project::orderBy('name', 'DESC')->get();
        return response()->json($projects);
    }

    public function getAreas(Request $request)
    {
        return view('home.areas');
    }

    public function getOrgChart(Request $request)
    {
        $level = $request->only('level');
        $datascource = array();

        array_push($datascource, array('id' => '1',
            'name' => 'Lao Lao',
            'title' => 'general manager',
            'children' => array(
                array('id' => '2', 'name' => 'Bo Miao', 'title' => 'department manager'),
                array('id' => '3', 'name' => 'Su Miao', 'title' => 'department manager'),
                'children' => array(
                    array(
                        'id' => '4', 'name' => 'Tie Hua', 'title' => 'senior engineer'),
                    array(
                        'id' => '5', 'name' => 'Hei Hei', 'title' => 'senior engineer'),
                    'children' => array(
                        array(
                            'id' => '6', 'name' => 'Pang Pang', 'title' => 'engineer'),
                        array(
                            'id' => '7', 'name' => 'Xiang Xiang', 'title' => 'UE engineer')
                    )
                )
            )));
        array_push($datascource, array(
            'id' => '8', 'name' => 'Yu Jie', 'title' => 'department manager'));
        array_push($datascource, array(
            'id' => '9', 'name' => 'Yu Li', 'title' => 'department manager'));
        array_push($datascource, array(
            'id' => '10', 'name' => 'Hong Miao', 'title' => 'department manager'));
        array_push($datascource, array(
            'id' => '11', 'name' => 'Yu Wei', 'title' => 'department manager'));
        array_push($datascource, array(
            'id' => '12', 'name' => 'Chun Miao', 'title' => 'department manager'));
        array_push($datascource, array(
                'id' => '13', 'name' => 'Yu Tie', 'title' => 'department manager')
        );
        $chart = ['root' => [
            [
                'title' => 'Proyectos'],
            [
                'title' => 'Administración'],
            [
                'title' => 'Legal'],
            [
                'title' => 'Proyectos']
        ]
        ];

        $aux=array();
        array_push($aux,array('id' => '8', 'name' => 'Yu Jie', 'title' => 'department manager'));
        array_push($aux,array('id' => '9', 'name' => 'Yu Jie', 'title' => 'department manager'));

        return response()->json(['res'=>$aux]);
    }
}
