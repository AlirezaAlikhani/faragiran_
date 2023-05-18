<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\LessonController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post('/courses/create' , [CourseController::class , 'create']);
Route::put('/courses/update' , [CourseController::class , 'update']);

Route::post('/lessons/create' , [LessonController::class , 'create']);
