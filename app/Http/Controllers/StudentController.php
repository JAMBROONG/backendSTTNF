<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class StudentController extends Controller
{
    function index (){
        $data = Student::all();
        return response()->json($data, 200);
    }

    function show ($id){
        $data = Student::find($id);
        return response()->json($data, 200);
    }

    function create (Request $request){

        $validator = Validator::make($request->all(), [
            "nama" => ['required'],
            "nim" => ['required', 'unique:students'],
            "email" => ['required', 'unique:students'],
            "jurusan" => ['required']
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        try {
            $nama = $request->nama;
            $nim = $request->nim;
            $email = $request->email;
            $jurusan = $request->jurusan;

            $student = Student::create([
                "nama" => $nama,
                "nim" => $nim,
                "email" => $email,
                "jurusan" => $jurusan
            ]);
            $data = [
                "message" => 'Student created successfully',
                "data" => $student
            ];

            return response()->json($data, Response::HTTP_CREATED);

        } catch (QueryException $e) {
            return response()->json([
                "message" => "Failed" . $e->errorInfo
            ]);
        }
    
    }

    function update (Request $request, $id) {
        $student = Student::find($id);
        $student->nama = $request->nama;
        $student->nim = $request->nim;
        $student->email = $request->email;
        $student->jurusan = $request->jurusan;
        $student->save();

        $data = [
            "message" => "Student updated successfully from id $id",
            "data" => $student
        ];

        return response()->json($data, 200);
    }

    function destroy (Request $request, $id) {
        $student = Student::find($id);
        $student->delete(); 

        $data = [
            "message" => "Student deleted successfully from id $id"
        ];

        return response()->json($data, 200);
    }
}
