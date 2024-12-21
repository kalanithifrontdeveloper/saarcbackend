<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DepartmentController extends Controller
{
    public function index()
    {
        $department = DB::table('department')->get();
        return response()->json(['department' => $department]);
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'DepartmentName' => 'required|string',
            'Course' => 'required|string', 
        ]);
        $department = DB::table('department')->insert([
            'DepartmentName' => $validatedData['DepartmentName'],
            'Course' => $validatedData['Course'],
        ]);
        return response()->json([
            'success' => 'Department created successfully.',
            'department' => $department,
        ], 201);
    }
    public function update(Request $request, $DepartmentID)
    {
        $validatedData = $request->validate([
            'DepartmentName' => 'required|string',
            'Course' => 'required|string',
        ]);
        $updated = DB::table('department')
            ->where('DepartmentID', $DepartmentID)
            ->update([
                'DepartmentName' => $validatedData['DepartmentName'],
                'Course' => $validatedData['Course'],
            ]);
        if ($updated) {
            return response()->json([
                'success' => 'Department record updated successfully.',
            ], 200);
        } else {
            return response()->json([
                'error' => 'Department record not found or no changes made.',
            ], 404);
        }
    }
    public function destroy($DepartmentID)
    {
        $deleted = DB::table('department')->where('DepartmentID', $DepartmentID)->delete();
        if ($deleted) {
            return response()->json([
                'success' => 'Department record deleted successfully.'
            ], 200);
        } else {
            return response()->json([
                'error' => 'Department record not found.'
            ], 404);
        }
    }
}