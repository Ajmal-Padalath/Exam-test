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
Route::get('/questions', function () {
    return view('questions');
});
Route::get('/start-exam', 'Exam@startExam');
Route::post('/add-questions', 'Exam@submitQuestions');
Route::post('/check-email', 'Exam@checkEmail');
Route::post('/submit-answer', 'Exam@submitAnswer');
Route::get('/list-students', 'Exam@listStudents');
