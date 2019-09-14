@extends('layouts.app')

@section('content')
{{-- For Admin Users --}}
@hasrole('admin')
<div class="container-fluid py-5">
    <div class="row">
        {{-- <div class="col-md-3 main-sidebar">
            <div class="card">
                <div class="card-header">
                    {{ $user->name }}
                </div>
                <div class="card-body">
                    <ul class="list-group-item list-unstyled">
                        <a href="{{ route('admin.approval') }}"><li class="nav-item">New Agent Request <span style="color:red">({{ $agents }})</span></li></a>
                        <li class="nav-item">Second</li>
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
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">Total Agents</div>
                            <div class="card-body">{{ $revoke }}</div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <a href="{{ route('admin.type') }}">
                            <div class="card">
                                <div class="card-header">Manage Types</div>
                                <div class="card-body">Manage All Property Types</div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-4">
                        <a href="{{ route('admin.property') }}">
                            <div class="card">
                                <div class="card-header">Total Properties</div>
                                <div class="card-body">{{ $property_count }}</div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="row py-2">
                    <div class="col-md-4">
                        <a href="{{ route('admin.approval') }}">
                            <div class="card">
                                <div class="card-header">Approve new Agents</div>
                                <div class="card-body"><span>{{ $agents }}</span></div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-4">
                        <a href="{{ route('admin.revoke') }}">
                            <div class="card">
                                <div class="card-header">Revoke Agent Authorities</div>
                                <div class="card-body">{{ $revoke }}</div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">Total Properties for Sale/Buy</div>
                            <div class="card-body">{{ $for_buy }}</div>
                        </div>
                    </div>
                </div>
                <div class="row py-2">
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">Total Properties for Rent</div>
                            <div class="card-body">{{ $for_rent }}</div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <a href="{{ route('admin.citymanage') }}">
                            <div class="card">
                                <div class="card-header">Manage City</div>
                                <div class="card-body">Add Or Delete Cities</div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                <div class="card-header">Welcome {{ $user->name }}</div>
                
                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    You are logged in!
                </div>
                
            </div>
        </div>
    </div> --}}
</div>
@endhasrole

@hasrole('user')
{{-- For Normal Users --}}
{{-- {{ dd($user) }} --}}
@if($user->isAgent == 1)
<section class="section__1 py-5">
    <div class="container">
        <div class="row flex-row">
            <div class="col-md-4 col-sm-12">
               <a href="{{ route('agent.property') }}">
                <div class="card-header text-center">
                    <h2>Post Property</h2>
                    <div class="card-body">
                        Post Property for Buy Or Rent
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-4 col-sm-12">
            <a href="{{ route('user.properties') }}">
                <div class="card-header text-center">
                    <h2>Search Properties</h2>
                    <div class="card-body">
                        Find propperties 
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-4 col-sm-12">
            <a href="{{ route('user.allagents') }}">
                <div class="card-header text-center">
                    <h2>Contact Property Agent</h2>
                    <div class="card-body">
                        Get in contact with Agent
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>
</section>
<section class="section__1 py-5">
    <div class="container">
        <div class="col-md-12">
            <div class="row"> 
                <div class="gallery gallery-responsive portfolio_slider">  
                    @foreach($property_slide as $prop)
                    <div class="inner">
                        <div class="card">
                            <div class="card-header"><h2>{{ $prop['property_name'] }}</h2></div>
                            <div class="card-body">
                                <img src="{{ asset('images/'.$prop['featured_img']) }}">
                                <p>{{ $prop['property_state'] }}</p>
                                <a href="{{ route('user.property.show',$prop['id']) }}" class="btn btn-success">See More</a>
                                <a href="{{ route('user.contactprop',$prop['id']) }}" class="btn btn-success">Contact</a>
                            </div>
                        </div>                
                    </div>
                    @endforeach
                </div>
                <a class="btn btn-info" href="{{ route('user.properties') }}">Show All</a>
            </div>
        </div>
    </div>

</section>
@elseif($user->Applied_agent == 1 && $user->isAgent == 0)
<section class="section__0 section__0--user centered">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="card-header">
                    <h2>Welcome {{ $user->name }}</h2>
                </div>
                <div class="card-body">
                    Thank you for applying as a agent.
                </div>
            </div>
        </div>
    </div>
</section>
<section class="section__1 py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-sm-12">
               <a href="{{ route('user.agent') }}">
                <div class="card-header text-center">
                    <h2>Apply For agent</h2>
                    <div class="card-body">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                        consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                        cillum dolore eu fugiat nulla pariatur.
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-4 col-sm-12">
            <div class="card-header text-center">
                <h2>Buy Property</h2>
                <div class="card-body">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                    consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                    cillum dolore eu fugiat nulla pariatur.
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-12">
            <div class="card-header text-center">
                <h2>Rent Property</h2>
                <div class="card-body">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                    consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                    cillum dolore eu fugiat nulla pariatur.
                </div>
            </div>
        </div>
    </div>
</div>
</section>
<section class="section__1 py-5">
    <div class="container">
        <div class="col-md-12">
            <div class="row slicker">                
               @foreach($property as $prop)
               <div class="col-md-4 pb-4">
                <div class="card">
                    <div class="card-header"><h2>{{ $prop->property_name }}</h2></div>
                    <div class="card-body">
                        <img src="{{ asset('images/'.$prop->featured_img) }}">
                        <p>{{ $prop->property_state }}</p>
                        <a href="{{ route('user.property.show',$prop->id) }}" class="btn btn-success">See More</a>
                        <a href="{{ route('user.contactprop',$prop->id) }}" class="btn btn-success">Contact</a>
                    </div>
                </div>                
            </div>
            @endforeach
        </div>
    </div>
</div>
</section>
@elseif($user->Applied_agent == 0 && $user->isAgent == 0)
<section class="section__0 section__0--user centered full-height">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12">
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
</section>
<section class="section__1 py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-sm-12">
               <a href="{{ route('user.agent') }}">
                <div class="card-header text-center">
                    <h2>Apply For agent</h2>
                    <div class="card-body">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                        consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                        cillum dolore eu fugiat nulla pariatur.
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-4 col-sm-12">
            <div class="card-header text-center">
                <h2>Buy Property</h2>
                <div class="card-body">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                    consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                    cillum dolore eu fugiat nulla pariatur.
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-12">
            <div class="card-header text-center">
                <h2>Rent Property</h2>
                <div class="card-body">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                    consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                    cillum dolore eu fugiat nulla pariatur.
                </div>
            </div>
        </div>
    </div>
</div>
</section>
<section class="section__1 py-5">
    <div class="container">
        <div class="col-md-12">
            <div class="row slicker">                
                @foreach($property as $prop)
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header"><h2>{{ $prop->property_name }}</h2></div>
                        <div class="card-body">
                            <img src="{{ asset('images/'.$prop->featured_img) }}">
                            <p>{{ $prop->property_state }}</p>
                            <a href="{{ route('user.property.show',$prop->id) }}" class="btn btn-success">See More</a>
                            <a href="{{ route('user.contactprop',$prop->id) }}" class="btn btn-success">Contact</a>
                        </div>
                    </div>                
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
@endif

@endhasrole

@endsection
@section('script')




@endsection