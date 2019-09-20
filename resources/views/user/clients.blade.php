@extends('layouts.app')
@section('content')
<main id="page-id-27">
    <div class="container">
        <div class="jumbotron">
            <h2 class="jumbotron-hr">Clients Interested in this Property</h2>
        </div>
    </div>
    <div class="container">
        @if(!$clients->isEmpty())
        @foreach($clients as $key => $da)
        <div class="row">
            @if($key % 1 == 0)
            <div class="col-md-12 py-3">
                @endif
                <div class="card">
                    <div class="card-header"><h2>{{ $da->name }}</h2></div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">Email : <a href="mailto:{{ $da->email }}">{{ $da->email }}</a></div>
                            <div class="col-md-12">Phone : <a href="tel:{{ $da->phone }}">{{ $da->phone }}</a></div>
                            <div class="col-md-12">
                                <div class="col-md-12">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>  
                @if($key %1 == 1)
            </div>
            @endif
            @endforeach
            @else
            <div class="card">
             <div class="card-header">No client yet filed any request</div>
         </div>
         @endif
     </div>
 </div>
</main>
@endsection