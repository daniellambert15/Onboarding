<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/


Auth::routes();

Route::get('/home', 'HomeController@index');
Route::get('/', 'HomeController@index');
Route::get('/faq', 'FaqController@index');

//Route::get('/makeAdmin/{id}', function($id){
//    $user = App\Models\User::find($id);
//    $user->is_admin = 1;
//    $user->save();
//    return redirect('/');
//});

// Stage 1
Route::group(['middleware' => 'stage1'], function () {
    Route::get('/files', 'FilesController@displayFiles');
    Route::post('/postFiles', 'FilesController@postFiles');
});

//Stage 2
Route::group(['middleware' => 'stage2'], function () {
    Route::get('/quizes', 'QuizController@index');
    Route::get('/quiz/{id}', 'QuizController@show');
    Route::post('/postQuiz', 'QuizController@store');
    Route::post('/postUpdateQuiz', 'QuizController@update');
    Route::get('/completedQuizes', 'QuizController@userQuizList');
    Route::get('/userEditQuiz/{id}', 'QuizController@edit');
});

////Stage 3
//Route::group(['middleware' => 'stage3'], function () {
//    Route::get('/user', 'UserController@showUser');
//    Route::get('/monthActivities/{month}', 'ActivityController@monthActivities');
//    Route::get('/getMonths', 'ActivityController@getMonths');
//    Route::get('/calendar', 'ActivityController@calendar');
//    Route::get('/completedTasks', 'ActivityController@completedTasks');
//    Route::get('/activity/{id}', 'ActivityController@displayActivity');
//    Route::post('/submitUserAnswer', 'ActivityController@saveUserActivity');
//    Route::get('/editActivity/{id}', 'ActivityController@editActivity');
//    Route::post('/updateActivity', 'ActivityController@updateActivity');
//});


//Stage 3
Route::group(['middleware' => 'stage3'], function () {
    Route::get('/module', 'ModuleController@index');
    Route::get('/moduleQuestion/{id}', 'ModuleController@show');
    Route::post('/submitModuleAnswer', 'ModuleController@store');
    Route::get('/completedModules', 'ModuleController@completedModules');
    Route::post('/updateUserAnswer', 'ModuleController@update');
    Route::get('/updateUserAnswer/{id}', 'ModuleController@edit');
});

Route::group(['middleware' => 'is_admin'], function () {

    // User
    Route::get('/users', 'UserController@showUsers');
    Route::get('/userList', 'UserController@userList');
    Route::get('/viewUser/{id}', 'UserController@displayUser');
    Route::get('/editUser/{id}', 'UserController@displayEditUser');
    Route::post('/postEditUser', 'UserController@postEditUser');
    Route::get('/pauseUser/{id}', 'UserController@pause');
    Route::get('/unpauseUser/{id}', 'UserController@unpause');

    // Approvals
    Route::get('/file/approve/{user_id}/{file_id}', 'FilesController@approveFile');
    Route::get('/file/unapprove/{user_id}/{file_id}', 'FilesController@unapproveFile');

    Route::get('/quiz/approve/{user_id}/{quiz_id}', 'Admin\QuizController@approveQuiz');
    Route::get('/quiz/unapprove/{user_id}/{quiz_id}', 'Admin\QuizController@unapproveQuiz');


    // Admin - Files
    Route::get('/adminFiles','Admin\FilesController@index');
    Route::get('/addFiles', 'Admin\FilesController@create');
    Route::post('/postAdminFile', 'Admin\FilesController@store');
    Route::get('/removeAdminFile/{id}', 'Admin\FilesController@destroy');

    //Admin - quizzes
    Route::get('/adminQuizzes', 'Admin\QuizController@index');
    Route::get('/adminQuiz/{id}', 'Admin\QuizController@edit');
    Route::get('/adminAddQuiz', 'Admin\QuizController@create');
    Route::post('/adminQuiz', 'Admin\QuizController@store');
    Route::post('/adminUpdateQuiz', 'Admin\QuizController@update');
    Route::post('/adminAddQuizQuestion', 'Admin\QuizController@adminAddQuizQuestion');
    Route::get('/removeAdminQuiz/{id}', 'Admin\QuizController@destroy');
    Route::get('/updateQuizQuestion/{id}/{qId}', 'Admin\QuizController@updateQuizQuestion');
    Route::post('/adminUpdateQuizQuestion', 'Admin\QuizController@adminUpdateQuizQuestion');
    Route::get('/destroyQuestion/{id}/{qId}', 'Admin\QuizController@destroyQuestion');

    Route::get('/quizUser/{id}','Admin\QuizController@quizUser');
    Route::get('/sendQuizUser/{id}/{qId}','Admin\QuizController@sendQuizUser');


    //Admin - Activities
//    Route::get('/adminActivities', 'Admin\ActivityController@index');
//    Route::get('/addActivity', 'Admin\ActivityController@create');
//    Route::post('/postAdminActivity', 'Admin\ActivityController@store');
//    Route::get('/editAdminActivity/{id}', 'Admin\ActivityController@edit');
//    Route::post('/postUpdateAdminActivity', 'Admin\ActivityController@update');
//    Route::get('/removeAdminActivity/{id}', 'Admin\ActivityController@destroy');

    //Admin - Modules
    Route::get('/adminModules', 'Admin\ModuleController@index');
    Route::get('/admin/removeModuleQuestion/{id}', 'Admin\ModuleController@destroy');
    Route::get('/admin/deleteModule/{id}', 'Admin\ModuleController@destroyModule');
    Route::get('/admin/addModuleQuestion/{id}','Admin\ModuleController@addModuleQuestion');
    Route::get('/admin/editModuleQuestion/{id}', 'Admin\ModuleController@edit');
    Route::post('/editModuleQuestion', 'Admin\ModuleController@update');
    Route::get('/admin/addModule','Admin\ModuleController@addModule');
    Route::post('/addModuleQuestion','Admin\ModuleController@postAddModuleQuestion');
    Route::post('/addModule','Admin\ModuleController@postAddModule');
    Route::post('/editModule','Admin\ModuleController@postEditModule');
    Route::get('/admin/editModule/{id}','Admin\ModuleController@editModule');

    //Admin - FAQS
    Route::get('/adminFAQS', 'Admin\FaqController@index');
    Route::get('/addFAQ', 'Admin\FaqController@create');
    Route::post('/postAdminFAQ', 'Admin\FaqController@store');
    Route::get('/editAdminFAQ/{id}', 'Admin\FaqController@edit');
    Route::post('/postUpdateAdminFAQ', 'Admin\FaqController@update');
    Route::get('/removeAdminFAQ/{id}', 'Admin\FaqController@destroy');

});
