@extends('layouts.app')

@section('content')
@hasrole('admin')
<div class="container-fluid">

   <div class="col-md-12 col-sm-12">    
    <div class="row">
       {{--  <div class="col-md-3">
            <div class="container">
                <ul class="list-unstyled list-group"> 
                    <li class="list-group-item">Manage Media</li>
                    <li class="list-group-item">Blog</li>
                    <li class="list-group-item">Property Request</li>
                </ul>
            </div>
        </div> --}}
        
        <div class="col-md-9">
            <div class="container">
             <div class="row">
                <div class="jumbotron-fluid">
                   <div class="card-header">
                    <h2>Welcome {{ $user->name }}</h2>
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