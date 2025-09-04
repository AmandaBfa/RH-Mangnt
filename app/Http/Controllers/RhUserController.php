<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RhUserController extends Controller
{
    public function index()
    {
        Auth::user()->can('admin') ?: abort(403, 'You are not authorized to acess this page'); // erro mensage

        // $colaborators = User::where('role', 'rh')->get();
        $colaborators = User::with('detail')
            ->where('role', 'rh')
            ->get();

        return view('colaborators.rh-users', compact('colaborators'));
    }

    public function newColaborator()
    {
        Auth::user()->can('admin') ?: abort(403, 'You are not authorized to acess this page'); // erro mensage

        // get all departments
        $departments = Department::all();

        return view('colaborators.add-rh-user', compact('departments'));
    }

    public function createRhColaborator(Request $request)
    {
        Auth::user()->can('admin') ?: abort(403, 'You are not authorized to acess this page'); // erro mensage

        // form validation
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'select_department' => 'required|exists:departments,id',
            'address' => 'required|string|max:255',
            'zip_code' => 'required|string|max:10',
            'city' => 'required|string|max:50',
            'phone' => 'required|string|max:50',
            'salary' => 'required|decimal:2',
            'admission_date' => 'required|date_format:Y-m-d',
        ]);

        // check if department id == 2 (rh department)
        if ($request->select_department != 2) {
            return redirect()->route('home');
        }

        // create new rh user
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = 'rh';
        $user->department_id = $request->select_department;
        $user->permissions = '["rh"]';
        $user->save();

        // save user details
        $user->detail()->create([
            'address' => $request->address,
            'zip_code' => $request->zip_code,
            'city' => $request->city,
            'phone' => $request->phone,
            'salary' => $request->salary,
            'admission_date' => $request->admission_date,
        ]);

        return redirect()->route('colaborators.rh-users')->with('success', 'Colaborator created successfully');
    }

    public function editRhColaborator($id)
    {
        Auth::user()->can('admin') ?: abort(403, 'You are not authorized to acess this page'); // erro mensage

        $colaborator = User::with('detail')->where('role', 'rh')->findOrFail($id);

        return view('colaborators.edit-rh-user', compact('colaborator'));
    }

    public function updateRhColaborator(Request $request)
    {
        Auth::user()->can('admin') ?: abort(403, 'You are not authorized to acess this page'); // erro mensage

        // form validation
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'salary' => 'required|decimal:2',
            'admission_date' => 'required|date_format:Y-m-d',

            // 'name' => 'required|string|max:255',
            // 'email' => 'required|email|max:255|unique:users,email,' . $request->id,
            // 'address' => 'required|string|max:255',
            // 'zip_code' => 'required|string|max:10',
            // 'city' => 'required|string|max:50',
            // 'phone' => 'required|string|max:50',

        ]);

        // find colaborator
        $colaborator = User::findOrFail($request->user_id);

        // update user details
        $colaborator->detail->update([
            'salary' => $request->salary,
            'admission_date' => $request->admission_date,
        ]);

        return redirect()->route('colaborators.rh-users')->with('success', 'Colaborator updated successfully');
    }
}
