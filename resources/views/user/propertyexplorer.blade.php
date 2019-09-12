@extends('layouts.app')
@section('content')
<header>
    <div class="col-sm-12 jumbotron text-center">
        <h2>Welcome to our Real Estate Finder!</h2>
        <h6>We have the best properties for rent or buy for you. No need to hunt around, we have all in one place</h6>
    </div>
</header>

<!--Carousel Trial-->

<!---->
<section class="container-fluid">
    <div class="col-md-12 col-sm-12">
        <div class="row">
            <div class="container col-md-3">
                <div class="card">
                    <div class="card-header">FEATURED PROPERTIES</div>
                    @foreach ($featuredprop as $key => $properties)
                    <div class="col-md-12 py-3">
                        <div class="thumbnail">
                            <img src="{{ asset('images/'.$properties->featured_img) }}" class="img-responsive" alt="">

                            <div class="caption">
                                <h4>{{ $properties->property_name }}</h4>
                                <h6>{{ $properties->property_type }}</h6>
                                <h5><a href="" class="label label-success">Rs.{{ $properties->property_rate }}</a></h5>
                                <a href="{{ route('user.property.show',$properties->id) }}" class="btn btn-success">See More</a>
                                <!--button type="submit" class="btn btn-primary btn-block">ADD TO CART</button-->
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="col-md-9">
                <div class="row">   
                    <div class="container col-sm-10 col-sm-offset-1">
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
                                        <a href="{{ route('user.property.show',$properties->id) }}" class="btn btn-success">See More</a>
                                        <!--button type="submit" class="btn btn-primary btn-block">ADD TO CART</button-->
                                    </div>
                                </div>
                            </div>

                            @if ($key % 3 == 2)
                        </div>       
                        @endif
                        @endforeach


                    </div>
                </div>
                <div class="row">
                    <div class="container col-md-8 col-sm-10 col-sm-offset-1 page">
                        <div class="col-sm-12">

                          <nav aria-label="Page navigation">
                            {{ $property->links() }}
                        </nav>

                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
@endsection