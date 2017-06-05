<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');


Route::get('generator_builder', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@builder');
Route::get('field_template', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@fieldTemplate');
Route::post('generator_builder/generate', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@generate');

Route::resource('projects', 'ProjectController');
Route::resource('makings', 'MakingController');
Route::get('/home/getMenu', [
    'as' => 'home.getMenu',
    'uses' => 'HomeController@getMenu',
]);
Route::get('/home/getOrgChart', [
    'as' => 'home.getOrgChart',
    'uses' => 'HomeController@getOrgChart',
]);
Route::get('/home/getAreas', [
    'as' => 'home.getAreas',
    'uses' => 'HomeController@getAreas',
]);

Route::post('getTemplate', 'OperatorController@getTemplate')->name('getTemplate');
Route::get('getOperators', 'OperatorController@getData')->name('getOperators');
Route::post('address', 'OperatorController@getAddresses')->name('address');
Route::resource('operators', 'OperatorController');
Route::resource('contacts', 'ContactController');
Route::resource('estimates', 'EstimateController');

Route::get('/documents/getDocuments/{id}', [
    'as' => 'documents.getDocuments',
    'uses' => 'DocumentController@getDocuments',
])->where('id', '[0-9]+');

Route::resource('documents', 'DocumentController');
Route::resource('legals', 'LegalController');

Route::get('/flows/getIngreso', [
    'as' => 'flows.getIngreso',
    'uses' => 'FlowController@getIngreso',
]);
Route::get('/flows/getEgreso', [
    'as' => 'flows.getEgreso',
    'uses' => 'FlowController@getEgreso',
]);
Route::resource('flows', 'FlowController');

Route::get('/newdocuments/getDocuments/{id}/{ref}/{area}', [
    'as' => 'newdocuments.getDocuments',
    'uses' => 'NewdocumentController@getDocuments',
])->where(['id'=> '[0-9]+', 'area' => '[a-z]+','ref'=> '[0-9]+']);

Route::resource('newdocuments', 'NewdocumentController');

Route::get('/newlegals/getDocuments/{id}/{ref}/{area}/{folder}', [
    'as' => 'newlegals.getDocuments',
    'uses' => 'NewlegalController@getDocuments',
])->where(['id'=> '[0-9]+', 'area' => '[a-z]+','ref'=> '[0-9]+', 'folder' => '[a-z]+']);
Route::resource('newlegals', 'NewlegalController');


Route::get('/operations/getDocuments/{id}/{ref}/{folder}/{status}', [
    'as' => 'operations.getDocuments',
    'uses' => 'OperationController@getDocuments',
])->where(['id'=> '[0-9]+','status'=> '[0-9]+','ref'=> '[0-9]+', 'folder' => '[A-Z][a-z]+']);

Route::get('/operations/getAccounts/{id}/{ref}/{folder}', [
    'as' => 'operations.getAccounts',
    'uses' => 'OperationController@getAccounts',
])->where(['id'=> '[0-9]+','ref'=> '[0-9]+', 'folder' => '[A-Z][a-z]+']);
Route::resource('operations', 'OperationController');