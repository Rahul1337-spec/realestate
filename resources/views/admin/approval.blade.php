@extends('layouts.app')
@section('content')
@hasrole('admin')
<div class="container-fluid py-5">
    <div class="row">
        {{-- <div class="col-md-3">
            <div class="card">
                <div class="card-header">{{ $user->name }}</div>
                <div class="card-body">
                    <ul class="list-group-item list-unstyled">
                        <a href="{{ route('admin.approval') }}"><li class="nav-item">New Agent Request<span style="color:red">({{ $agents }}) </span></li></a>
                        <li class="nav-item">second</li>
                        <a href="{{ route('home') }}"><li class="nav-item">Home</li></a>
                    </ul>
                </div>
            </div>
        </div> --}}
        @include('layouts.adminside')
        <div class="col-md-9">
            <div class="container">
             <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h2>{{ $user->name }}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">

                <div class="col-md-12 col-sm-12">

                    @if(session()->has('success'))
                    <div class="alert alert-success">
                        {{ session()->get('success') }}
                    </div>
                    @endif
                    @if(session()->has('error'))
                    <div class="alert alert-danger">
                        {{ session()->get('error') }}
                    </div>
                    @endif
                </div>
                <div class="col-md-12 col-sm-12">
                    <div class="row float-right py-2">
                        <form method="get" action="{{ route('admin.search') }}" style="display:flex;" class="navbar-form navbar-left">
                            <div >
                                <input type="text" name="q" class="form-control" placeholder="Search">
                            </div>
                            <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                        </form>
                    </div>
                    <table class="table-striped table">
                        <tr>
                            <th>Agent Name</th>
                            <th>Agent Address</th>
                            <th>Action</th>
                        </tr>

                        @foreach($data as $datas)
                        <tr>
                           <td>{{ $datas->agent_name }}</td>
                           <td>{{ $datas->agent_address }}</td>
                           @if(!$datas->approval == 1)
                           <td><a href="{{ route('admin.approve',$datas->id) }}" class="btn btn-success">Approve</a></td>
                           @else
                           <td><a href="{{ route('admin.unapprove',$datas->id) }}" class="btn btn-danger">UnApprove</a></td>
                           @endif
                       </tr>
                       @endforeach
                       <tr>
                        <td class="table-responsive">
                           {{ $data->links() }}
                       </td>
                   </tr>
               </table>

           </div>
       </div>
   </div>
</div>
</div>
</div>

@endhasrole
@endsection