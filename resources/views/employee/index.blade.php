@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <ul class="list-inline">
                        <li class="list-inline-item">{{ __('Employees') }}</li>
                        <li class="list-inline-item">
                            <a href="/addEmployee"><button class="btn btn-sm btn-primary">Add</button></a>
                        </li>
                    </ul>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if (count($employees) > 0)
                    <table class="table table-bordered border-primary">
                        <thead>
                            <tr>
                              <th scope="col">Firstname</th>
                              <th scope="col">Lastname</th>
                              <th scope="col">Email</th>
                              <th scope="col">Phone</th>
                              <th scope="col">Company</th>
                              <th scope="col"></th>
                            </tr>
                          </thead>
                          <tbody>
                              @foreach ($employees as $employee)
                                  <tr>
                                      <th scope="row">{{$employee->firstname}}</th>
                                      <td>{{$employee->lastname}}</td>
                                      <td>{{$employee->email}}</td>
                                      <td>{{$employee->phone}}</td>
                                      <td>{{$employee->company->name}}</td>
                                      <td>
                                          <a href="/editEmployee/{{$employee->id}}">
                                            <button class="btn btn-sm btn-primary">Edit</button>
                                          </a>
                                      </td>
                                      <td>
                                          <form action="{{route('employee.delete',['id'=>$employee->id])}}" method="post">
                                            @csrf
                                            <input type="hidden" name="_method" value="DELETE">
                                            <button class="btn btn-sm btn-danger">Delete</button>
                                          </form>
                                      </td>
                                  </tr>
                              @endforeach
                          </tbody>
                      </table>
                        {{$employees->links()}}
                    @else
                        <p>No Employee Found</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection