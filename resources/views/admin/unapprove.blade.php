@extends('layouts.app')
@section('content')
@hasrole('admin')
<div class="container-fluid py-5">
    <div class="row">
        {{-- <div class="col-md-3">
            <div class="card">
                <div class="card-header">{{ $user->name }}</div>
                <ul class="list-group">
                    <a href="{{ route('home') }}"><li class="list-group-item">Dashboard</li></a>
                </ul>
            </div>
        </div> --}}
        @include('layouts.adminside')
        <div class="col-md-9">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                      <div class="card">
                          <div class="card-header">
                            <h2>Revoke Agent Approval</h2>
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
                <div class="card-body">
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