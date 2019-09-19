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
                                <div class="container p-2">
                                    <div class="jumbotron-fluid p-2">
                                        <div class="float-left">
                                            <h2>{{ $doc_data[0]->property_name }}</h2>
                                        </div>
                                        <div class="float-right">
                                            <a href="{{ route('admin.verified',$doc_data[0]->property_id) }}" class="btn confirm btn-danger">Mark Verified</a>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                       <table class="table text-center">
                                        <tr class="col-12">
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Action</th>
                                        </tr>
                                        @foreach($doc_data as $da)
                                        <tr>
                                            <td>{{ $da->id }}</td>
                                            <td>{{ $da->name }}</td>
                                            <td>{{-- <a href="{{ asset('documents/'.$da->name) }}">Download</a> --}}
                                                <a href="{{ url('admin/download',$da->name)  }}">Download</a></td>
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