@extends('layouts.app')
@section('content')
<div class="container-fluid py-5">
    <div class="row">
        <div class="col-md-3">
            <div class="card">
                <div class="card-header"><h2>User Account</h2></div>
                <div class="card-body">
                    <ul class="list-group-item list-unstyled">
                        <a href="{{ route('user.manage') }}"><li class="nav-item">Manage Property</li></a>
                        <a href="{{ route('/') }}"><li class="nav-item">Back</li></a>
                    </ul>
                </div>
            </div>
        </div>
        {{-- @include('layouts.agentside') --}}
        <div class="col-md-9">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">Post Property</div>
                            <div class="card-body">
                                {{-- <form method="post" enctype="multipart/form-data" action="{{ route('user.property.post') }}" class="form-group"> --}}
                                    <form method="post" enctype="multipart/form-data" action="{{ route('userpayment') }}" class="form-group">
                                        @csrf
                                        <div class="col-md-12 col-sm-12">
                                            <div class="row">
                                                <div class="col-md-12 col-sm-12">
                                                    @if(session()->has('message'))
                                                    <div class="alert alert-success">
                                                        {{ session()->get('message') }}
                                                    </div>
                                                    @endif
                                                    @if(session()->has('error'))
                                                    <div class="alert alert-danger">
                                                        {{ session()->get('error') }}
                                                    </div>
                                                    @endif
                                                </div>
                                                <div class="col-md-4 col-sm-12">
                                                    <div class="form-group">
                                                        <label class="form-control-label">Property Name</label>
                                                        <input type="text" name="property_name" class="form-control @error('property_name') is-invalid @enderror " placeholder="Property Name" required autocomplete="property_name" autofocus>
                                                        @error('property_name')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>

                                                </div>
                                                <div class="col-md-4 col-sm-12">
                                                    <div class="form-group">
                                                        <label class="form-control-label">Property Address</label>
                                                        <textarea name="property_address" class="form-control @error('property_address') is-invalid @enderror" placeholder="Property Address" row="6" required autocomplete="property_address" autofocus></textarea>
                                                        @error('property_address')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-sm-12">
                                                    <div class="form-group">
                                                        <label class="form-control-label">OLD<input type="radio" name="property_type" class="form-control" value="old"></label>
                                                        <label class="form-control-label">NEW<input type="radio" name="property_type" class="form-control" value="new"></label>
                                                        @error('property_type')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4 col-sm-12">
                                                    <div class="form-group">
                                                        <label class="form-control-label">Property Rate</label>
                                                        <input type="text" class="form-control @error('property_rate') is-invalid @enderror" name="property_rate" placeholder="Price">
                                                        @error('property_rate')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <input type="hidden" class="form-control" value="{{ $userid }}" name="userid" placeholder="userid">

                                                <div class="col-md-4 col-sm-12">
                                                    <div class="form-group">
                                                       <label class="form-control-label">Featured Image</label>
                                                       <input type="file" name="featured" class="form-control"> 
                                                   </div>
                                               </div>
                                               <div class="col-md-4 col-sm-12">
                                                <div class="form-group">
                                                    <label class="form-control-label">Property Sample Images</label>
                                                    <div class="input-group control-group increment" >
                                                        <input type="file" name="image[]" class="form-control">
                                                        <div class="input-group-btn"> 
                                                            <button class="btn btn-success" type="button"><i class="glyphicon glyphicon-plus"></i>Add</button>
                                                        </div>
                                                    </div>
                                                    <div class="clone invisible">
                                                      <div class="control-group input-group" style="margin-top:10px">
                                                        <input type="file" name="image[]" class="form-control">
                                                        <div class="input-group-btn"> 
                                                          <button class="btn btn-danger" type="button"><i class="glyphicon glyphicon-remove"></i> Remove</button>
                                                      </div>
                                                  </div>
                                              </div>
                                              @error('image')
                                              <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 col-sm-12">
                                        <label class="form-control-label">Property Post Type</label>
                                        <select class="form-control @error('type') is-invalid @enderror" name="type">
                                            <option value="Buy">Buy</option>
                                            <option value="Rent">Rent</option>
                                        </select>
                                        @error('type')
                                        <span class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 col-sm-12">
                                        <label class="form-control-label">Country</label>
                                        <select class="form-control @error('country') is-invalid @enderror" name="country">
                                            <option value="India">India</option>
                                        </select>
                                        @error('country')
                                        <span class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 col-sm-12">
                                        <label class="form-control-label">State</label>
                                        <select class="form-control @error('state') is-invalid @enderror" name="state">
                                            <option value="Vadodara">Vadodara</option>
                                            <option value="Surat">Surat</option>
                                        </select>
                                        @error('state')
                                        <span class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label class="form-control-label">Asset</label>
                                        <select class="form-control @error('asset') is-invalid @enderror" name="asset">
                                            <option value="2 BHK">2 BHK</option>
                                            <option value="3 BHK">3 BHK</option>
                                        </select>
                                        @error('asset')
                                        <span class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-control-label">Upload Document 1</label>
                                        <input type="file" name="document1">
                                        @error('document1')
                                        <span class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-control-label">Upload Document 2</label>
                                        <input type="file" name="document2">
                                        @error('document2')
                                        <span class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">

                                    </div> 
                                    <div class="col-md-4 py-3">
                                        <input type="submit" name="submit" value="submit" class="form-control btn btn-danger">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">

    $(document).ready(function() {

      $(".btn-success").click(function(){ 
          var html = $(".clone").html();
          $(".increment").after(html);
      });

      $("body").on("click",".btn-danger",function(){ 
          $(this).parents(".control-group").remove();
      });
  });

</script>


@endsection