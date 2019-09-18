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
                                <div class="col-md-9">
                                    <div class="card">
                                        <div class="card-header">Add Document Types</div>

                                        <div class="card-body">
                                            <table>
                                                <thead>
                                                    <tr>
                                                        <th>Name</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                   @foreach($property_data as $da)
                                                   <tr>
                                                    <td>{{ $da->name }}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>
                        {{-- <div class="col-md-6">
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
                                                <a href="{{ route('admin.deletedoc',$data->id) }}" class="btn btn-danger">Delete</a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </table>
                                </div>
                            </div>   
                        </div> --}}
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