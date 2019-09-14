@extends('layouts.app')
@section('content')
<main id="page-1122">
    <div class="container-fluid">
     <div class="container">
         <div class="row">
            <div class="col-md-12 col-sm-12">
             <div class="card">
                 <div class="card-header"><h2>All Agents</h2></div>
             </div>
         </div>
     </div> 

     @foreach($agent as $key => $da)
     @if($key % 3 == 0)
     <div class="row">
        @endif
        <div class="col-md-3 py-3">
            <div class="card">
                <div class="card-header"><h2>{{ $da->agent_name }}</h2></div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">Locality {{ $da->locality }}</div>
                        <div class="col-md-12">
                            <div class="col-md-12">
                                Total Properties : {{ $da->property_counts }}
                            </div>
                            <div class="col-md-12">
                                Rent : {{ $da->for_rent }}
                                Buy : {{ $da->for_buy }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if($key %3 == 2)
    </div>
    @endif
    @endforeach
</div>
</div>
</main>
@endsection