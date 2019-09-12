@extends('layouts.app')
@section('content')
<main id="page-id-24">
	<div class="container py-4">
       <div class="row py-1">
          <div class="col-md-12">
             <div class="card">
                <div class="card-header">Manage Properties</div>
                <div class="card-body">
                    <form method="get" action="{{ route('admin.searchprop') }}" style="display:flex;" class="navbar-form navbar-left">
                        <div>
                            <input type="text" name="q" class="form-control" placeholder="Search">
                        </div>
                        <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                    </form>
                </div>
            </div>
        </div>	
    </div>
</div>
<div class="container">
    @foreach($property as $key => $da)
    @if($key % 3 == 0)
    <div class="row py-2">
        @endif
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">{{ $da->property_name }}</div>
                <div class="card-body">
                    <img src="{{ asset('images/'.$da->featured_img) }}">
                </div>
                <div class="card-body">
                    <h3>{{ $da->property_author }}</h3>
                    <a href="#" class="btn btn-danger">Remove</a>
                </div>
            </div>
        </div>
        @if($key % 3 == 2)
    </div>
    @endif
    @endforeach
</div>
</main>
@endsection