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

Route::get('/', 'QuizsController@index');
Route::resource('users', 'UsersController');
Route::resource('groups', 'GroupsController');
Route::resource('question-types', 'QuestionTypesController');
Route::resource('choice-lists', 'ChoiceListsController');
Route::resource( 'quiz-sub-details', 'QuizSubDetailsController');

Route::match(['get', 'post'], 'quizs/list', 'QuizsController@index');
Route::get('quizs/create/{questionType}', 'QuizsController@create');
Route::post('quizs/store/{questionType}', 'QuizsController@store');
Route::get('quizs/view/{id}', 'QuizsController@view');
Route::get('quizs/edit/{id}', 'QuizsController@edit');
Route::post('quizs/update/{id}', 'QuizsController@update');
Route::get('quizs/status/{id}/{status}', 'QuizsController@changestatus');
Route::get('quizs/qrcode/{id}', 'QuizsController@qrcode');

Route::get('tests/runtest/{id}', 'TestsController@runtest');
Route::post('tests/store/{id}', 'TestsController@store');
Route::get('tests/edit/{id}', 'TestsController@edit');
Route::post('tests/update/{id}', 'TestsController@update');
Route::get('tests/confirm/{id}', 'TestsController@confirm');
Route::get('tests/delivery/{id}', 'TestsController@delivery');
Route::get('tests/view/{id}', 'TestsController@view');
Route::get('tests/delete/{id}', 'TestsController@delete');
Route::get('tests/addsalecomment/{id}', 'TestsController@addsalecomment');
Route::post('tests/addsalecommentAction/{id}', 'TestsController@addsalecommentAction');
Route::get('tests/statusused/{id}', 'TestsController@statusused');
Route::get('tests/summaryview/{id}', 'TestsController@summaryview');
Route::get('results/editcomment/{id}', 'ResultsController@editcomment');
Route::post('results/editcommentAction/{id}', 'ResultsController@editcommentAction');
Route::get('results/summarydata/{id}', 'ResultsController@summarydata');


Route::get( 'results/summary/{quizMId}', 'ResultsController@summary');
Route::get('results/detailsExcel/{id}', 'ResultsController@detailsExcel');
Route::get( 'results/details/{id}', 'ResultsController@details');

Auth::routes();

