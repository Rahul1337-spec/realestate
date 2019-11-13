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
Route::get('search/city/',[
    'as' => 'searchcity',
    'uses' => 'HomeController@searchcity'
]);
Auth::routes();
Auth::routes(['verify' => true]);

// Route::get('/home', 'HomeController@index')->name('home');
Route::group(['middleware' => 'web'], function(){
    Route::get('paymentform',['as'=>'paymentform', 'uses' => 'PaymentController@data']);
    # Call Route
    Route::get('payment', ['as' => 'payment', 'uses' => 'PaymentController@payment']);
# Status Route
    Route::get('payment/status', ['as' => 'payment.status', 'uses' => 'PaymentController@status']);
});

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
    Route::get('type/delete/{id}',[
        'as' => 'deletetype',
        'uses' => 'TypeController@delete'
    ]);
    Route::get('/search',[
        'as' => 'search',
        'uses' => 'AgentController@searchar'
    ]);
    Route::get('/manage/property',[
        'as' => 'property',
        'uses' => 'AdminController@manageproperty'
    ]);
    Route::get('/search/prop',[
        'as' => 'searchprop',
        'uses' => 'AdminController@searchprop'
    ]);
    Route::get('/city/manage',[
        'as' => 'citymanage',
        'uses' => 'CityController@index'
    ]);
    Route::post('/city/add',[
        'as' => 'cityadd',
        'uses' => 'CityController@cityadd'
    ]);
    Route::get('city/delete/{id}',[
        'as' => 'deletecity',
        'uses' => 'CityController@delete'
    ]);
    Route::get('/asset/manage',[
        'as' => 'assetmanage',
        'uses' => 'AssetsController@index'
    ]);
    Route::post('/asset/add',[
        'as' => 'assetadd',
        'uses' => 'AssetsController@assetadd'
    ]);
    Route::get('delete/{id}',[
        'as' => 'deleteasset',
        'uses' => 'AssetsController@delete'
    ]);
    Route::get('Document/manage',[
        'as' => 'documentmanage',
        'uses' => 'DocumentController@index'
    ]);
    Route::post('Documenttype',[
        'as' => 'document',
        'uses' => 'DocumentController@addtype'
    ]);
    Route::get('deletedoc/{id}',[
        'as' => 'deletedoc',
        'uses' => 'DocumentController@delete'
    ]);
    Route::get('docverify',[
        'as' => 'docverify',
        'uses' => 'VerifyController@index'
    ]);
    Route::get('docverify/{id}',[
        'as' => 'documentverify',
        'uses' => 'VerifyController@verifydoc'
    ]); 
    Route::get('download/{filename}',[
        'as' => 'download',
        'uses' => 'VerifyController@download'
    ]);
    Route::get('verified/{id}',[
        'as' => 'verified',
        'uses' => 'VerifyController@verified'
    ]);
});


/*---------------------------------------------------------*/ 
/*--------------User Authentication area-------------------*/
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
    Route::get('Agent/Registeration',[
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
    Route::get('explore/property',[
        'as' => '.properties',
        'uses' => 'UserController@propertypage'
    ]);
    Route::get('search',[
        'as' => '.search',
        'uses' => 'UserController@search'
    ]);
    Route::get('agent/explorer',[
        'as' => '.allagents',
        'uses' => 'UserController@agentlist'
    ]);
    Route::get('/contact-property/{id}',[
        'as' => '.contactprop',
        'uses' => 'ContactController@index'
    ]);
    Route::post('contact',[
        'as' => '.contactinfo',
        'uses' => 'ContactController@contactdata'
    ]);
    Route::get('search/property',[
        'as' => '.propertysearch',
        'uses' => 'UserController@propertysearch'
    ]);
    Route::get('upload',[
        'as' => '.upload.property',
        'uses' => 'PropertyController@index'
    ]);
    Route::post('property/post',[
        'as' => '.property.post',
        'uses' => 'PropertyController@PostProperty'
    ]);
    Route::post('Pay/Property',[
        'as' => 'payment',
        'uses' => 'PaymentController@payment'
    ]);
    Route::get('Success/{data}',[
        'as' => 'payment.status', 
        'uses' => 'PaymentController@status'
    ]);

    Route::get('manage/property',[
        'as' => '.manage',
        'uses' => 'ManageController@manage'
    ]);
    Route::get('clients/{id}',[
        'as' => '.clients',
        'uses' => 'ManageController@clients'
    ]);
    Route::get('delete/{id}',[
        'as' => '.delete',
        'uses' => 'ManageController@delete'
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

    Route::post('Pay/Property',[
        'as' => 'payment',
        'uses' => 'PaymentController@payment'
    ]);
    Route::get('Status/{data}',[
        'as' => 'payment.status', 
        'uses' => 'PaymentController@status'
    ]);
});

/*---------------------------------------------------------*/ 
/*--------------------Guest API area-----------------------*/
/*---------------------------------------------------------*/ 
Route::get('guest/property',[
    'as' => 'guest.property',
    'uses' => 'GuestPropertyController@index'
]);
Route::post('guest/search',[
    'as' => 'guest.search',
    'uses' => 'GuestPropertyController@guestsearch'
]);
/*---------------------------------------------------------*/ 
/*--------------Test Authentication area-------------------*/
/*---------------------------------------------------------*/ 

Route::get('testpage',[
    'as' => 'testpage',
    'uses' => 'TestController@index'
]);
Route::post('testpage',[
    'as' => 'testpage.data',
    'uses' => 'TestController@testdata'
]);
Route::get('/test','TestController@index');