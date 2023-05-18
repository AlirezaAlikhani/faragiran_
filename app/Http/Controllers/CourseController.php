<?php

namespace App\Http\Controllers;

use App\Http\Requests\CourseRequest;
use App\Models\Course;
use Illuminate\Http\Request;
use Exception;
use Facade\FlareClient\Http\Response;



class CourseController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $request->validate([
            'name'  => 'required|string|min:3|max:255',
            'price' => 'required|numeric',
        ]);

        $inputs = $request->only([
           'name',
           'price'
        ]);

        try {
            $course = Course::create($inputs);
            if ($course){
                return response()->json(['message' => 'Course create successfully'], 201);
            }else
            {
                return response()->json(['message' => 'Course create failed!'], 401);
            }        }catch (Exception $error) {
            return Response()->json($error , 400);
        }

    }

    public function update(Request $request)
    {
        $request->validate([
            'price' => 'required|numeric',
        ]);

        $inputs = $request->only([
            'price'
        ]);

        try {
            $course = Course::where(['id' => $request['id']])->update($inputs);
            if ($course){
                return response()->json(['message' => 'Course update successfully'], 201);
            }else
            {
                return response()->json(['message' => 'Course update failed!'], 401);
            }
        }catch (Exception $error) {
            return Response()->json($error , 400);
        }
    }
}
