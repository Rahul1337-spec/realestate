@extends('layouts.app')
@section('content')
<!-- Modal -->

<div id="mymodal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Modal Header</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
    </div>
    <div class="modal-body">
        <p>Some text in the modal.</p>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    </div>
</div>

</div>
</div>
<div class="container-fluid py-5">
    <div class="row">
        {{-- @include('layouts.agentside') --}}
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
        <div class="col-md-9">
            <div class="container col-sm-10 col-sm-offset-1">
                @if(!$property->isEmpty())
                @foreach ($property as $key => $properties)
                @if ($key % 3 == 0)
                <div class="row py-3" >   
                    @endif
                    <div class="col-sm-4">
                        <div class="thumbnail">
                            <img src="{{ asset('images/'.$properties->featured_img) }}" class="img-responsive" alt="">
                            <div class="caption">
                                <h4>{{ $properties->property_name }}</h4>
                                <h6>{{ $properties->property_type }}</h6>
                                <h5><a href="" class="label label-success">Rs.{{ $properties->property_rate }}</a></h5>
                                <a href="{{ route('user.clients',$properties->id) }}" class="btn btn-success">CLIENTS ({{ $properties->enquiry_count }})</a>
                                <a href="{{ route('user.delete',$properties->id) }}" class="btn btn-danger">REMOVE</a>
                                {{-- <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#mymodal">Open Modal</button> --}}
                                <!--button type="submit" class="btn btn-primary btn-block">ADD TO CART</button-->
                            </div>
                        </div>
                    </div>
                    @if ($key % 3 == 2)
                </div>       
                @endif
                @endforeach
                @else
                <div class="row py-3" >
                    <div class="card">
                        <div class="card-header">Yet To Post Property</div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection