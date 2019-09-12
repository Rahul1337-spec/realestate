@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <img class="img-thumbnail contact__image" src="{{ asset('images/'.$property[0]->featured_img) }}">
</div>
<div class="container">
    <div class="row py-3">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header"><h2>Contact Agent</h2></div>
                <div class="card-body">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    @if(session()->has('success'))
                    <div class="alert alert-success">
                        {{ session()->get('success') }}
                    </div>
                    @endif

                    @if($check->isEmpty())
                    <form method="post" action="{{ route('user.contactinfo') }}">
                        @csrf
                        <div class="form-group">
                            <label class="form-control-label">Name</label>
                            <input type="text" name="Name" class="form-control @error('Name') is-invalid @enderror " placeholder="Name" required autocomplete="Name" autofocus>
                            @error('Name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="form-control-label">Email</label>
                            <input type="text" name="Email" class="form-control @error('Email') is-invalid @enderror " placeholder="Email" required autocomplete="Email" autofocus>
                            @error('Email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="form-control-label">Phone</label>
                            <input type="text" name="Phone" class="form-control @error('Phone') is-invalid @enderror " placeholder="Phone" required autocomplete="Phone" autofocus>
                            @error('Phone')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <input type="hidden" name="property_id" value="{{ $property[0]->id }}">
                        <input type="hidden" name="user_id" value="{{ $user->id }}">
                        <input type="submit" name="submit" class="btn btn-dark">
                    </form>
                    @else
                    <span class="feedback">
                        <strong>Already contacted</strong>
                    </span>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h2>{{ $property[0]->property_name }}</h2>
                </div>
                <div class="card-body">
                    <h2>Property Address</h2>
                    {{ $property[0]->property_address }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection