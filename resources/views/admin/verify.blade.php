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
                                <div class="card-header">Verify Documents</div>
                                @if(session()->has('success'))
                                <div class="alert alert-danger">
                                    {{ session()->get('success') }}
                                </div>
                                @endif
                                <div class="card-body">
                                    @foreach($property_data as $da)
                                    <div class="container">
                                        <div class="col-md-12 py-2">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <img src="{{ asset('images/'.$da->featured_img) }}">
                                                </div>
                                                <div class="col-md-9">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            {{ $da->property_name }} Listed By {{ $da->property_author }}
                                                        </div>
                                                        <div class="card-body">
                                                            <div class="p-1">
                                                                <h2>Address</h2>
                                                                <hr class="jumbotron-hr">
                                                                <p>{{ $da->property_address }}</p>
                                                                <p>State {{ $da->property_state }}</p>
                                                            </div>
                                                            <div><a href="{{ route('admin.documentverify',$da->id) }}" class="btn btn-info">VERIFY</a></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                    {{ $property_data->links() }}
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