<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Lesson;
use Exception;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    public function create(Request $request)
    {

        $request->validate([
            'name'      => 'required|string|min:3|max:255',
            'course_id' => 'required|numeric',
            'price'     => 'required|numeric',
        ]);

        $inputs = $request->only([
            'name',
            'price',
            'course_id'
        ]);

        try {
            $lesson = Lesson::create($inputs);
            if ($lesson){
                return response()->json(['message' => 'Lesson create successfully'], 201);
            }else
            {
                return response()->json(['message' => 'Lesson create failed!'], 401);
            }
        }catch (Exception $error) {
            return Response()->json($error , 400);
        }
    }

    public function stroe(Request $request , Course $course)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'price' => 'required|numeric',
        ]);

        $lesson = new Lesson([
            'name' => $validatedData['name'],
            'price' => $validatedData['price'],
        ]);

        $course->lessons()->save($lesson);

        return response()->json(['message' => 'Lesson created successfully'], 201);
    }
}
