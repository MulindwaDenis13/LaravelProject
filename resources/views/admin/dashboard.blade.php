@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Admin Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <ul class="list-inline">
                        <li class="list-inline-item">
                            <a href="/employee"><button class="btn btn-sm btn-success">Employees</button></a>
                        </li>
                        <li class="list-inline-item">
                            <a href="/company"><button class="btn btn-sm btn-primary">Companies</button></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection