<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function home()
    {
        Auth::user()->can('admin') ?: abort(403, 'You are not authorized to access this page');

        // colleact all information about the organuzation
        $data = [];

        // get total number of colaborators (deleted_at is null) 
        $data['total_colaborators'] = User::whereNull('deleted_at')->count();

        // total colaborators deleted
        $data['total_colaborators_deleted'] = User::onlyTrashed()->count();

        // total salary for all colaborators
        $data['total_salary'] = User::withoutTrashed()
            ->with('detail')
            ->get()
            ->sum(function ($colaborator) {
                return $colaborator->detail->salary;
            });

        // total colaborators by department
        // conjunto de carrys mais eleborada(avançada)
        $data['total_colaborators_per_department'] = User::withoutTrashed()
            ->with('department')
            ->get()
            ->groupBy('department_id')
            ->map(function ($department) {
                return [
                    'department' => $department->first()->department->name ?? 'Without department',
                    'total' => $department->count()
                ];
            });

        // total salary by department
        $data['total_salary_per_department'] = User::withoutTrashed()
            ->with('detail', 'department')
            ->get()
            ->groupBy('department_id')
            ->map(function ($department) {
                return [
                    'department' => $department->first()->department->name ?? 'Without department',
                    'total_salary' => $department->sum(function ($colaborator) {
                        return $colaborator->detail->salary;
                    })
                ];
            });

        dd($data);

        // display admin home page
        return view('home');
    }
}
