<?php

namespace App\Http\Controllers;
use App\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {        
         //$this->middleware('permission:employee-list|employee-create|employee-edit|employee-delete', ['only' => ['index','show']]);
         //$this->middleware('permission:employee-create', ['only' => ['create','store']]);
         //$this->middleware('permission:employee-edit', ['only' => ['edit','update']]);
         //$this->middleware('permission:employee-delete', ['only' => ['destroy']]);
    }
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $term = $request->term;

        $employees = Employee::Where('name','LIKE','%'.$term.'%')->orWhere('detail','LIKE','%'.$term.'%')->latest()->paginate(5);
        return view('employees.index',compact('employees'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('employees.create');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'name' => 'required',
            'detail' => 'required',
            'nic' => 'required',
            'basic' => 'required',
            'allowance' => 'required'
        ]);
            //dd($request->basic);
            /*            
            $request->basic;
            $request->allowance;            
            $request->gross = $request->basic + $request->allowance;
            $request->epf = ($request->basic/ 100) * 8 ;*/
            //$net = $request->$gross - $request->$epf;

            $employee = new employee;
            $employee->name = $request->name;
            $employee->detail = $request->detail;
            $employee->nic = $request->nic;
            $employee->basic = $request->basic;
            $employee->allowance = $request->allowance;
            $employee->gross = $request->basic + $request->allowance;
            $employee->epf = ($request->basic /100) * 8;
            $employee->net = ($request->basic + $request->allowance) - ($request->basic /100) * 8;
            $employee->save();
        //Employee::create($request->all());

        return redirect()->route('employees.index')
                        ->with('success','Employee created successfully.');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        return view('employees.show',compact('employee'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        return view('employees.edit',compact('employee'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee)
    {

        //$data = $request->only(['name','detail','nic','basic','allowance']);        
            $employee = Employee::findOrFail($employee->id);
            $employee->name = $request->name;
            $employee->detail = $request->detail;
            $employee->nic = $request->nic;
            $employee->basic = $request->basic;
            $employee->allowance = $request->allowance;
            $employee->gross = $request->basic + $request->allowance;
            $employee->epf = ($request->basic /100) * 8;
            $employee->net = ($request->basic + $request->allowance) - ($request->basic /100) * 8;

            $employee->update();

            return redirect()->route('employees.index')->with('success','Employee Updated Successfully');
            
        //$employee->update($request->only(['name','detail','nic','basic','allowance']));
   
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        $employee->delete();


        return redirect()->route('employees.index')
                        ->with('success','Employee deleted successfully');
    }
}
