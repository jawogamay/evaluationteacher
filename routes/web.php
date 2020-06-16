<?php

use Illuminate\Support\Facades\Route;

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

// Admin
Route::prefix('admin')->group(function() {
    Route::get('/login', 'AdminAuth\LoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'AdminAuth\LoginController@login')->name('admin.login.submit');
});

Route::group(['prefix' => 'admin', 'middleware' => ['auth:web_admin']], function(){

    // HOME
    Route::get('/home', 'AdminController@index')->name('admin.home');
    Route::put('/info', 'AdminController@editInfo');
    Route::put('/username', 'AdminController@changeUsername');
    Route::put('/password', 'AdminController@changePassword');

    // USER
    Route::get('/user', 'AdminController@user')->name('admin.user');
    // STUDENT
    Route::get('/student/view', 'AdminController@studentView');
    Route::post('/student/create', 'AdminController@studentCreate');
    Route::put('/student/update', 'AdminController@studentUpdate');
    Route::post('/student/delete', 'AdminController@studentDelete');

    // FACULTY
    Route::get('/faculty/view', 'AdminController@facultyView');
    Route::post('/faculty/create', 'AdminController@facultyCreate');
    Route::put('/faculty/update', 'AdminController@facultyUpdate');
    Route::post('/faculty/delete', 'AdminController@facultyDelete');

    // SCHOOL
    Route::get('/school', 'AdminController@school')->name('admin.school');
    Route::get('/school/view', 'AdminController@schoolView');
    // DEPARTMENT
    Route::post('/department/create', 'AdminController@departmentCreate');
    Route::put('/department/update', 'AdminController@departmentUpdate');
    Route::post('/department/delete', 'AdminController@departmentDelete');
    // POSITION
    Route::post('/position/create', 'AdminController@positionCreate');
    Route::put('/position/update', 'AdminController@positionUpdate');
    Route::post('/position/delete', 'AdminController@positionDelete');
    // SECTION
    Route::post('/section/create', 'AdminController@sectionCreate');
    Route::put('/section/update', 'AdminController@sectionUpdate');
    Route::post('/section/delete', 'AdminController@sectionDelete');
    // ACADEMIC
    Route::post('/academic/create', 'AdminController@academicCreate');
    Route::put('/academic/update', 'AdminController@academicUpdate');
    Route::post('/academic/delete', 'AdminController@academicDelete');
    // SEMESTER
    Route::post('/semester/create', 'AdminController@semesterCreate');
    Route::put('/semester/update', 'AdminController@semesterUpdate');
    Route::post('/semester/delete', 'AdminController@semesterDelete');

    // EVALAUTION
    Route::get('/evaluation', 'AdminController@evaluation')->name('admin.evaluation');
    Route::get('/evaluation/view', 'AdminController@evaluationView');
    // QUESTION
    Route::post('/question/create', 'AdminController@questionCreate');
    Route::put('/question/update', 'AdminController@questionUpdate');
    Route::post('/question/delete', 'AdminController@questionDelete');
    // EVALUATION FORM
    Route::post('/evaluation/create', 'AdminController@evaluationCreate');
    Route::put('/evaluation/update', 'AdminController@evaluationUpdate');
    Route::post('/evaluation/delete', 'AdminController@evaluationDelete');
    Route::put('/evaluation/set', 'AdminController@setPeriod');
    // QUESTIONFORM
    Route::post('/evaluation/question/create', 'AdminController@questionformCreate');
    Route::post('/evaluation/question/delete', 'AdminController@questionformDelete');
    // EVALUATOR
    Route::post('/evaluator/student/create', 'AdminController@studentEvaluatorCreate');
    Route::post('/evaluator/faculty/create', 'AdminController@facultyEvaluatorCreate');
    Route::post('/evaluator/delete', 'AdminController@evaluatorDelete');

    // LOGOUT
    Route::post('/logout', 'AdminController@logout')->name('logout');
});

// Faculty
Route::prefix('faculty')->group(function() {
    Route::get('/login', 'FacultyAuth\LoginController@showLoginForm')->name('faculty.login');
    Route::post('/login', 'FacultyAuth\LoginController@login')->name('faculty.login.submit');

});

Route::group(['prefix' => 'faculty', 'middleware' => ['auth:web_faculty']], function(){
    Route::get('/home', 'FacultyController@index')->name('faculty.home');
    Route::put('/info', 'FacultyController@editInfo');
    Route::post('/logout', 'FacultyController@logout')->name('logout');
    Route::get('/ratings',function(){
        return view('faculties.rate');
    });
    Route::get('/getTeacherEvaluation','FacultyController@getTeacherEvaluation');
    Route::get('/averageRate/{id}','FacultyController@averageRate');
});

// STUDENT
Route::prefix('student')->group(function() {
    Route::get('/login', 'StudentAuth\LoginController@showLoginForm')->name('student.login');
    Route::post('/login', 'StudentAuth\LoginController@login')->name('student.login.submit');
});

Route::group(['prefix' => 'student', 'middleware' => ['auth:web_student']], function(){
    Route::get('/home', 'StudentController@index')->name('student.home');
    Route::put('/info', 'StudentController@editInfo');

    // EVALUATION
    Route::get('/teachers','StudentEvaluateController@getTeachers');
    Route::get('/evaluation', 'StudentController@evaluation')->name('student.evaluation');
    Route::get('/evaluation/view', 'StudentController@evaluationView');
    Route::apiResources(['evaluationview' => 'StudentEvaluateController']);
    Route::post('/logout', 'StudentController@logout')->name('logout');
});
