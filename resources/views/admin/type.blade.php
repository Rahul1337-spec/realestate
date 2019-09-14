@extends('layouts.app')
@section('content')
@hasrole('admin')
<div class="container-fluid py-5">
    <div class="row">
       {{--  <div class="col-md-3 main-sidebar">
            <div class="card">
                <div class="card-header">
                    {{ $user->name }}
                </div>
                <div class="card-body">
                    <ul class="list-group-item list-unstyled">
                        <a href="{{ route('admin.approval') }}"><li class="nav-item">New Agent Request <span style="color:red">({{ $agents }})</span></li></a>
                        <li class="nav-item">second</li>
                        <a href="{{ route('home') }}"><li class="nav-item">Home</li></a>
                    </ul>
                </div>
            </div>
        </div> --}}
        @include('layouts.adminside')
        <div class="col-md-9 main-content">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="card">
                            <div class="card-header">Admin Dashboard</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row py-5">
                    <div class="col-md-12 col-sm-12">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-header">Add Types</div>
                                        <form method="post" action="{{ route('admin.create.type') }}">
                                           @csrf
                                           <div class="card-body">
                                             @if(session()->has('message'))
                                             <div class="alert alert-success">
                                                {{ session()->get('message') }}
                                            </div>
                                            @endif
                                            <input id="type" type="text" class="form-control @error('type') is-invalid @enderror" name="type" placeholder="Type Name" value="{{ old('type') }}" required autocomplete="name" autofocus>
                                            @error('type')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="card-body">
                                            <button type="submit" class="btn btn-primary">
                                                {{ __('Add') }}
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header">
                                        Manage Types
                                    </div>
                                    <div class="card-body">
                                        <table class="table">
                                            <tr>
                                                <th>ID</th>
                                                <th>Type</th>
                                                <th>Action</th>
                                            </tr>
                                            @foreach($typedata as $data)
                                            <tr>
                                                <td>{{ $data->id }}</td>
                                                <td>{{ $data->name }}</td>
                                                <td ><a href="#" class="btn btn-primary">Edit</a>
                                                    <a href="{{ route('admin.delete',$data->id) }}" class="btn btn-danger">Delete</a>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </table>
                                    </div>
                                </div>   
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endhasrole
@endsection