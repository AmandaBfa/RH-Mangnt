<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DepartmentController extends Controller
{
    public function index()
    {
        Auth::user()->can('admin') ?: abort(403, 'You are not authorized to acess this page'); // erro mensage

        $departments = Department::all(); // will look for all deparments that is authorizate

        return view('department.departments', compact('departments')); // will return to the page 'departments'
    }

    public function newDepartment(): View
    {
        Auth::user()->can('admin') ?: abort(403, 'You are not authorized to acess this page'); // erro mensage

        return view('department.add-department');
    }

    public function createDepartment(Request $request)
    {
        Auth::user()->can('admin') ?: abort(403, 'You are not authorized to acess this page'); // erro mensage

        // forma validation
        $request->validate([
            'name' => 'required|string|max:50|unique:departments'
        ]);

        Department::create([
            'name' => $request->name
        ]);

        return redirect()->route('departments');
    }

    public function editDepartment($id)
    {
        Auth::user()->can('admin') ?: abort(403, 'You are not authorized to acess this page'); // erro mensage

        if ($this->isDepartmentBlocked($id)) {
            return redirect()->route('departments');
        }

        $department = Department::findOrFail($id);

        return view('department.edit-department', compact('department'));
    }

    public function updateDepartment(Request $request)
    {
        Auth::user()->can('admin') ?: abort(403, 'You are not authorized to acess this page'); // erro mensage

        $id = $request->id;

        // validação para que o departamento nã se repita, ex.: se admin tem o id = 1 , então outro departamento não pode se igual (tanto no nome quando no id)
        $request->validate([
            'id' => 'required',
            'name' => 'required|string|min:3|max:50|unique:departments,name,' . $id
        ]);

        if ($this->isDepartmentBlocked($id)) {
            return redirect()->route('departments');
        }

        $department = Department::findOrFail($id);

        $department->update([
            'name' => $request->name
        ]);

        return redirect()->route('departments');
    }

    public function deleteDepartment($id)
    {
        Auth::user()->can('admin') ?: abort(403, 'You are not authorized to acess this page'); // erro mensage

        if ($this->isDepartmentBlocked($id)) {
            // intval é uma função (do php) que transforma um valor em inteiro
            return redirect()->route('departments');
        }

        $department = Department::findOrFail($id);

        // display page for confirmation
        return view('department.delete-department-confirm', compact('department'));
    }

    public function deleteDepartmentConfirm($id)
    {
        Auth::user()->can('admin') ?: abort(403, 'You are not authorized to acess this page'); // erro mensage

        if ($this->isDepartmentBlocked($id)) {
            return redirect()->route('departments');
        }

        $department = Department::findOrFail($id);

        $department->delete();

        return redirect()->route('departments');
    }

    public function isDepartmentBlocked($id)
    {

        return in_array(intval($id), [1, 2]);
    }
}
