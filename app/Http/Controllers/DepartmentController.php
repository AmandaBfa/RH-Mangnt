<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DepartmentController extends Controller
{
    public function index()
    {
        Auth::user()->can('admin') ?: abort(403, 'You are not authorized to acess this page'); // erro mensage

        $departments = Department::all(); // will look for all deparments that is authorizate

        return view('department.departments', compact('departments')); // will return to the page 'departments'
    }
}
