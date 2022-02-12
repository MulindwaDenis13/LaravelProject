<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Company;
use App\Models\Employee;
use App\Models\User;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//add company
Route::post('/company', function(Request $request){

    $this->validate($request,[
        'name' => 'required',
        'email' => 'required',
    ]);

       //handling fileUpload
       if($request->hasFile('logo')){
        $destination_path = 'public/images/company_logos';
        $logo = $request->file('logo');
        $logo_name = $logo->getClientOriginalName();
        $path = $request->file('logo')->storeAs($destination_path,$logo_name);
    }

    return Company::create([
        'name' => $request('name'),
        'email' => $request('email'),
        'website' => $request('website'),
        'logo' => $logo_name
    ]);
});

//update company
Route::put('/company/{company', function(Request $request, $company){

    $this->validate($request,[
        'name' => 'required',
        'email' => 'required',
    ]);

    return $company->update([
        'name' => $request('name'),
        'email' => $request('email'),
        'website' => $request('website'),
    ]);

});

//get companies
Route::get('/companies', function(){
    return Company::all();
});

//get single company
Route::get('/companies/{id}', function(Company $id){
    return Company::find($id);
});

//delete company
Route::delete('/company/{company}', function(Company $company){
    return $company->delete();
});





//add Employee
Route::post('/employee', function(Request $request){

    $this->validate($request,[
        'firstname' => 'required',
        'lastname' => 'required',
    ]);

return Employee::create([
    'firstname' => $request('firstname'),
    'lastname' => $request('lastname'),
    'email' => $request('email'),
    'phone' => $request('phone'),
    'company_id' => $request('company_id')
]);

});

//edit employee
Route::put('/employee/{employee}', function(Request $request, $employee){

    $this->validate($request,[
        'firstname' => 'required',
        'lastname' => 'required',
    ]);

    return $employee->update([
       'firstname' => $request('firstname'),
       'lastname' => $request('lastname'),
       'email' => $request('email'),
       'phone' => $request('phone'),
       'company_id' => $request('company_id')
    ]);

});

//get employees
Route::get('/employees', function(){
    return Employee::all();
});

//get single employee
Route::get('/employees/{id}',function(Employee $id){
   return Employee::find($id);
});

//delete employee
Route::delete('/employee/{employee}', function(Employee $employee){
    return $employee->delete();
});




//new User
Route::post('/user',function(Request $request){

    $this->validate($request,[
        'name' => 'required',
        'email' => 'required',
    ]);

    return User::create([
        'name' => $request('name'),
        'email' => $request('email'),
        'password' => bcrypt($request('password'))
    ]);

});

//edit user
Route::put('/user/{user}', function(Request $request, $user){

    $this->validate($request,[
        'name' => 'required',
        'email' => 'required',
    ]);

   return $user->update([
        'name' => $request('name'),
        'email' => $request('email'),
    ]);

});

//get all users
Route::get('/users',function(){
    return User::all();
});

//get single user
Route::get('/users/{id}', function(User $id){
    return User::find($id);
});

//delete user
Route::delete('/user/{user}', function(User $user){
    return $user->delete();
});
