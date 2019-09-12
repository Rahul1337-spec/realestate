@extends('layouts.app')
@section('content')
@hasrole('agent')
<div class="container-fluid py-5">
    <div class="row">
     
        @include('layouts.agentside')

        <div class="col-md-9">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="card">
                            <div class="card-header">
                                <h2>Welcome {{ $user->name }}</h2>   
                            </div>
                            <div class="card-body">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                                cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                                proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container py-4">
                <div class="row">
                    <div class="col-md-4">
                        <a href="{{ route('agent.property') }}">
                         <div class="card">
                             <div class="card-header">Post Property</div>
                             <div class="card-body">
                                 Post Property For Buy Or Rent
                             </div>
                         </div>
                     </a>
                 </div>
             </div>
         </div>
     </div>
 </div>
</div>
@endhasrole
@endsection