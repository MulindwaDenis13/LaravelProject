@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <ul class="list-inline">
                        <li class="list-inline-item">{{ __('Companies') }}</li>
                        <li class="list-inline-item">
                            <a href="/addCompany"><button class="btn btn-sm btn-primary">Add</button></a>
                        </li>
                    </ul>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if (count($companies) > 0)
                    <table class="table table-bordered border-primary">
                        <thead>
                            <tr>
                              <th scope="col">Name</th>
                              <th scope="col">Email</th>
                              <th scope="col">Website</th>
                              <th scope="col"></th>
                            </tr>
                          </thead>
                          <tbody>
                              @foreach ($companies as $company)
                                  <tr>
                                      <th scope="row">{{$company->name}}</th>
                                      <td>{{$company->email}}</td>
                                      <td>{{$company->website}}</td>
                                      <td>
                                         <a href="/editCompany/{{$company->id}}">
                                            <button class="btn btn-sm btn-primary">Edit</button>
                                         </a>   
                                      </td>
                                      <td>
                                          <form action="{{route('company.delete',['id'=>$company->id])}}" method="post">
                                              @csrf
                                              <input type="hidden" name="_method" value="DELETE">
                                              <button class="btn btn-sm btn-danger">Delete</button>
                                          </form>
                                      </td>
                                  </tr>
                              @endforeach
                          </tbody>
                      </table>
                        {{$companies->links()}}
                    @else
                        <p>No Company Found</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection