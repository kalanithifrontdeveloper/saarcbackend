<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    public function index()
    {
        $students = DB::table('student')
            ->join('department', 'student.Course', '=', 'department.DepartmentID')  
            ->select('student.*', 'department.DepartmentName')  
            ->get();
        return response()->json(['students' => $students]);
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'FirstName' => 'required|string',
            'LastName' => 'required|string',
            'DOB' => 'required|date',
            'Address' => 'required|string|max:255',
            'Course' => 'required|exists:department,DepartmentID'
        ]);
        $students = DB::table('student')->insert([
            'FirstName' => $validatedData['FirstName'],
            'LastName' => $validatedData['LastName'],
            'DOB' => $validatedData['DOB'],
            'Address' => $validatedData['Address'],
            'Course' => $validatedData['Course'],
        ]);

        return response()->json([
            'success' => 'Student created successfully.',
            'students' => $students,
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'FirstName' => 'required|string',
            'LastName' => 'required|string',
            'DOB' => 'required|date',
            'Address' => 'required|string|max:255',
            'Course' => 'required|exists:department,DepartmentID' 
        ]);
        $updated = DB::table('student')
            ->where('id', $id)
            ->update([
                'FirstName' => $validatedData['FirstName'],
                'LastName' => $validatedData['LastName'],
                'DOB' => $validatedData['DOB'],
                'Address' => $validatedData['Address'],
                'Course' => $validatedData['Course'], 
            ]);

        if ($updated) {
            return response()->json([
                'success' => 'Student record updated successfully.',
            ], 200);
        } else {
            return response()->json([
                'error' => 'Student record not found or no changes made.',
            ], 404);
        }
    }

    public function destroy($id)
    {
        $deleted = DB::table('student')->where('id', $id)->delete();
        if ($deleted) {
            return response()->json([
                'success' => 'Student record deleted successfully.'
            ], 200);
        } else {
            return response()->json([
                'error' => 'Student record not found.'
            ], 404);
        }
    }
}
