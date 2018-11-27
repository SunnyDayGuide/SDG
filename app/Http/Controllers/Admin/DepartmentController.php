<?php

namespace App\Http\Controllers\Admin;

use App\Department;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $departments = Department::all();

        return view('admin.departments.index', compact('departments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $employees = User::all();

        return view('admin.departments.create', compact('employees'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(['name' => 'required']);

        $department = Department::create(request(['name', 'manager_id']));

        return redirect()->route('admin.departments.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  Department $department
     * @return \Illuminate\Http\Response
     */
    public function show(Department $department)
    {
        $employees = $department->users;

        return view('admin.departments.show', compact('department', 'employees'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Department $department
     * @return \Illuminate\Http\Response
     */
    public function edit(Department $department)
    {
        $employees = User::all();

        return view('admin.departments.edit', compact('department', 'employees'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Department $department
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Department $department)
    {
        request()->validate(['name' => 'required']);

        $department->update(request(['name', 'manager_id']));

        return redirect()->route('admin.departments.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Department $department)
    {
        $department->users()->detach();
        $department->delete();

        return redirect()->route('admin.departments.index');
    }
}
