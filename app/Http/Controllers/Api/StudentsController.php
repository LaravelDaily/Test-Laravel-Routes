<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StudentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $students = Student::all();
        return response()->json([
            'status'=>200,
            'message'=>'Hello World',
            'list'=> $students
        ],200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validator = Validator::make($request->all(),[
            'name'=>'required|string|max:100',
            'age'=>'required|integer'
        ]);
        if ($validator->fails()){
            return response()->json([
                'status'=>422,
                'errors'=>$validator->messages()
            ],422);
        }
        else{
            $student = Student::create([
                'name'=>$request->name,
                'age'=>$request->age,
            ]);
            if ($student){
                return response()->json([
                    'status'=>200,
                    'message'=>'student was added successfully'
                ],200);
            }else{
                return response()->json([
                    'status'=>500,
                    'message'=>'Error occurred while adding the student '
                ],500);
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $student = Student::find($id);
        if($student){
            return response()->json([
                'status'=>200,
                'list'=>$student
            ],200);
        }else{
            return response()->json([
                'status'=>500,
                'message'=>'No record was found'
            ],500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
