<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Company;

class CompanyController extends Controller
{
    //get all companies
    public function index()
    {
        $companies = Company::latest()->paginate(10);
        return view('company.index',[
            'companies'=>$companies
        ]);
    }

    //get add company form
    public function create()
    {
        return view('company.create');
    }

    //insert into database
    public function store(Request $request)
    {
       $this->validate($request,[
        'name'=>'required',
        'email'=>'required',
       ]);

         //handling fileUpload
         if($request->hasFile('logo')){
            $destination_path = 'public/images/company_logos';
            $logo = $request->file('logo');
            $logo_name = $logo->getClientOriginalName();
            $path = $request->file('logo')->storeAs($destination_path,$logo_name);
        }
        $company = new Company;
        $company->name = $request->input('name');
        $company->email = $request->input('email');
        $company->website = $request->input('website');
        $company->logo = $logo_name;
        $company->save();

        return redirect('/company')->with('success','Company Added');
    }

    //get a particular company
    public function show($id)
    {
        $company = Company::find($id);
        return view('company.update',[
            'company' => $company
        ]);
    }

    //update
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'name'=>'required',
            'email'=>'required'
        ]);
        
        $company = Company::find($id);
        $company->name = $request->input('name');
        $company->email = $request->input('email');
        $company->website = $request->input('website');
        $company->save();

        return redirect('/company')->with('success','Company Updated');
    }
    
    //delete company
    public function destroy($id)
    {
        $company = Company::find($id);
        Storage::delete('public/images/company_logos/'.$company->logo);
        $company->delete();
        return back();
    }
}
