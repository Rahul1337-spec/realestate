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

Route::get('/',[
    'as' => '/',
    'uses' => 'HomeController@callback'
]);

Auth::routes();
Auth::routes(['verify' => true]);

// Route::get('/home', 'HomeController@index')->name('home');

/*---------------------------------------------------------*/ 
/*------------------File Management area-------------------*/
/*---------------------------------------------------------*/ 

Route::group(['middleware' => 'auth'], function () {
    Route::get('/laravel-filemanager', '\UniSharp\LaravelFilemanager\Controllers\LfmController@show');
    Route::post('/laravel-filemanager/upload', '\UniSharp\LaravelFilemanager\Controllers\UploadController@upload');
    // list all lfm routes here...
});
/*---------------------------------------------------------*/ 
/*-------------Admin Authentication area-------------------*/
/*---------------------------------------------------------*/ 
Route::namespace('admin')->prefix('admin')->middleware(['auth','auth.admin'])->name('admin.')->group(function(){
    Route::get('account',[
        'as' => 'account',
        'uses' => 'AdminController@index'
    ]);
    Route::get('/approval',[
        'as' => 'approval',
        'uses' => 'AgentController@index'
    ]);
    Route::get('/approve/{id}',[
        'as' => 'approve',
        'uses' => 'AgentController@approvalvalid'
    ]);
    Route::get('/unapprove/{id}',[
        'as' => 'unapprove',
        'uses' => 'AgentController@unapprovevalid'
    ]);
    Route::get('/revoke',[
        'as' => 'revoke',
        'uses' => 'AgentController@unapprove'
    ]);
    Route::post('/typeinsert',[
        'as' => 'create.type',
        'uses' => 'TypeController@typeinsert'
    ]);
    Route::get('/type',[
        'as' => 'type',
        'uses' => 'TypeController@index'
    ]);
    Route::get('delete/{id}',[
        'as' => 'delete',
        'uses' => 'TypeController@delete'
    ]);
    Route::get('/search',[
        'as' => 'search',
        'uses' => 'AgentController@searchar'
    ]);
    Route::get('/manageproperty',[
        'as' => 'property',
        'uses' => 'AdminController@manageproperty'
    ]);
    Route::get('/searchprop',[
        'as' => 'searchprop',
        'uses' => 'AdminController@searchprop'
    ]);
});


/*---------------------------------------------------------*/ 
/*-------------User Authentication area-------------------*/
/*---------------------------------------------------------*/ 
Route::namespace('user')->prefix('user')->middleware(['auth','auth.user'])->name('user')->group(function(){
    Route::get('property',[
        'as' => '.property',
        'uses' => 'UserPropertyController@index'
    ]);
    Route::get('account',[
        'as' => '.account',
        'uses' => 'UserController@index'
    ]);
    Route::get('form',[
        'as' => '.form',
        'uses' => 'form\FormController@index'
    ]);
    Route::post('form/{id}',[
        'as' => '.form.save',
        'uses' => 'form\FormController@ContactSaveData'
    ]);
    Route::get('/AgentRegisteration',[
        'as' => '.agent',
        'uses' => 'AgentController@regpage'
    ]);
    Route::POST('/reg',[
        'as' => '.regagent',
        'uses' => 'AgentController@register'
    ]);
    Route::get('property/{id}',[
        'as' => '.property.show',
        'uses' => 'UserPropertyController@propertyshow'
    ]);
    Route::get('propertypage',[
        'as' => '.properties',
        'uses' => 'UserController@propertypage'
    ]);
    Route::get('search',[
        'as' => '.search',
        'uses' => 'UserController@search'
    ]);
    Route::get('agentexplorer',[
        'as' => '.allagents',
        'uses' => 'UserController@agentlist'
    ]);
    Route::get('contactproperty/{id}',[
        'as' => '.contactprop',
        'uses' => 'ContactController@index'
    ]);
    Route::post('contact',[
        'as' => '.contactinfo',
        'uses' => 'ContactController@contactdata'
    ]);
});


/*---------------------------------------------------------*/ 
/*-------------Agent Authentication area-------------------*/
/*---------------------------------------------------------*/ 

Route::namespace('agent')->prefix('agent')->middleware(['auth','auth.agent'])->name('agent.')->group(function(){
    Route::get('account',[
        'as' => 'account',
        'uses' => 'AgentController@index'
    ]);
    Route::get('property',[
        'as' => 'property',
        'uses' => 'PropertyController@index'
    ]);
    Route::post('property/post',[
        'as' => 'property.post',
        'uses' => 'PropertyController@PostProperty'
    ]);
    Route::get('manage',[
        'as' => 'manage',
        'uses' => 'AgentController@manage'
    ]);
    Route::get('delete/{id}',[
        'as' => 'delete',
        'uses' => 'AgentController@delete'
    ]);
    Route::get('clients/{id}',[
        'as' => 'clients',
        'uses' => 'AgentController@clients'
    ]);
});


/*---------------------------------------------------------*/ 
/*--------------Test Authentication area-------------------*/
/*---------------------------------------------------------*/ 

// Route::get('testpage',[
//     'as' => 'testpage',
//     'uses' => 'TestController@index'
// ]);
// Route::post('testpage',[
//     'as' => 'testpage.show',
//     'uses' => 'TestController@imagegal'
// ]);
Route::get('/test','TestController@index');