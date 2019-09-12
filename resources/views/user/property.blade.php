@extends('layouts.app')
@section('content')
<main>
    <div class="container">
     <div class="row">
      <div class="col-md-12 col-sm-12">
       <div class="card">
        <div class="card-header"><h2>{{ $property_name }}</h2> | {{ $property_state }}</div>
    </div>
</div>
</div>
</div>
<div class="container">
    <div class="row py-5">
        <div class="col-md-4">
            <ul class="list-unstyled property">
                <li><a href="{{ asset('images/'.$featured_img) }}"><img width="200" height="200" src="{{ asset('images/'.$featured_img) }}"></a></li>
                <?php
                $i=0
                ?> 
                @foreach($image_path as $img)
                <li class="pt-2"><a href="{{ asset('images/'.$img) }}"><img width="200" height="200" src="{{ asset('images/'.$img) }}"></a></li>
                <?php $i++ ?>
                @if($i > 0)
                @break
                @endif
                @endforeach
            </ul>
        </div>
        <div class="col-md-8">
            <div><img width="300" height="300" class="img-box" src="{{ asset('images/'.$featured_img) }}">
            </div>
        </div>
    </div>
</div>
<div class="container">
    @foreach($image_path as $key => $img)
    @if ($key % 3 == 0)
    <div class="row py-3" >   
        @endif
        <div class="col-md-3"><img src="{{ asset('images/'.$img) }}"></div>
        @endforeach
        @if($key % 3 == 3)
    </div>
    @endif
</div>
<div class="container">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header"><h2>Property For <span style="color:red">{{ $property_rate }}</span><h2></div>
                <div class="card-body">
                    <h2>Property Location</h2>
                    <h4>{{ $property_address }}</h4>
                </div>
            </div>
        </div>
    </div>
</main>
<script type="text/javascript">
    jQuery(window).load(function(){
        jQuery('ul.property li a').mouseover(function(e){
            e.preventDefault();
            jQuery('img.img-box ').attr('src',$(this).attr("href"));
        });
    });
</script>
@endsection