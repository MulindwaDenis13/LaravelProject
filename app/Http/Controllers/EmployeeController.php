<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Employee;

class EmployeeController extends Controller
{
    //get all employees
    public function index()
    {
      
       $employees = Employee::latest()->with('company')->paginate(10);
       return view('employee.index',[
           'employees'=>$employees
       ]);
    }

    //get add employee form
    public function create()
    {
        $companies = Company::all();
        return view('employee.create')->with('companies',$companies);
    }

    //insert into database
    public function store(Request $_request)
    {
        $this->validate($_request,[
            'firstname'=>'required',
            'lastname'=>'required',
        ]);

        $employee = new Employee;
        $employee->firstname = $_request->input('firstname');
        $employee->lastname = $_request->input('lastname');
        $employee->email = $_request->input('email');
        $employee->phone = $_request->input('phone');
        $employee->company_id = $_request->input('company_id');
        $employee->save();

        return redirect('/employee')->with('success','Employee Added');
    }

      //get a particular employee
      public function show($id)
      {
          $companies = Company::all();
          $employee = Employee::find($id);
          return view('employee.update',[
              'employee' => $employee,
              'companies' => $companies
          ]);
      }

        //update employee
        public function update(Request $request, $id)
        {
            $this->validate($request,[
                'firstname'=>'required',
                'lastname'=>'required'
            ]);
            
            $employee = Employee::find($id);
            $employee->firstname = $request->input('firstname');
            $employee->lastname = $request->input('lastname');
            $employee->email = $request->input('email');
            $employee->phone = $request->input('phone');
            $employee->company_id = $request->input('company_id');
            $employee->save();
    
            return redirect('/employee')->with('success','Employee Updated');
        }
      
      
    //delete employee
    public function destroy($id)
    {
        $employee = Employee::find($id);
        $employee->delete();
        return back();
    }
}
