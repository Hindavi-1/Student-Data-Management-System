<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;


class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
  

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
  

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
  
    
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Employee $employee)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'address' => 'required',
            'date_of_joining' => 'required|date',
            'gender' => 'required',
        ]);
    
        $employee->update($request->all());
    
        return redirect()->route('employees.index')->with('success', 'Employee updated successfully!');
    }
    
    /**
     * Remove the specified resource from storage.
     */
 

    public function index()
    {
        $employees = Employee::all();
        return view('employees.index', compact('employees'));
    }

    public function store(Request $request)
    {
        $filename=$request->file('file')->getClientOriginalName();
        $request->file('file')->storeAs('public/uploads',$filename);
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'address' => 'required',
            'date_of_joining' => 'required|date',
            'gender' => 'required',
            'photo'=>'required',
        ]);

        Employee::create($request->all());
        return redirect()->route('employees.index');
    }


    public function destroy(Employee $employee)
    {
        $employee->delete();
        return redirect()->route('employees.index');
    }
}
