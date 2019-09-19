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
                    <div class="container">
                        <div class="col-md-12">     
                            <div class="jumbotron-fluid pt-3 text-info"><h2>FILTER</h2></div>
                            <hr class="jumbotron-hr">
                            <div class="row">
                                <form class="form-group py-2" method="get" action="{{ route('user.propertysearch') }}">
                                    @csrf
                                    <div class="col-md-12">
                                        <div class="row">
                                            <label class="rounder"><h3>CITY</h3></label>
                                            <input class="form-control" type="text" name="city" placeholder="CITY">
                                        </div>
                                    </div>
                                    <div class="col-md-12 py-2">
                                        <div class="row align-middle">
                                            <ul class="Filter--control">
                                                <label class="rounder"><h3>PROPERTY TYPE</h3></label>
                                                <li>
                                                    <input id="rent" class="btn" type="radio" name="type" value="Rent">
                                                    <label for="rent"><i class="fas fa-person-booth"></i> RENT</label>
                                                </li>
                                                <li>
                                                    <input id="buy" class="btn" type="radio" name="type" value="Buy">
                                                    <label for="buy"><i class="fas fa-home"></i> BUY</label>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-md-12 pt-2">
                                        <div class="row">
                                            <label class="rounder"><h3>PRICE RANGE</h3></label>
                                            <input class="form-control pt-2" type="text" value="{{ old('min_price') }}" name="min_price" placeholder="MIN PRICE">
                                            <hr class="py-2">
                                            <input class="form-control pt-2" type="text" value="{{ old('max_price') }}" name="max_price" placeholder="MAX PRICE">
                                        </div>
                                    </div>
                                    <div class="col-md-12 pt-2">
                                        <div class="row">
                                            <ul class="Filter--control">
                                                <label class="rounder"><h3>ASSET</h3></label>  
                                                <li>
                                                    <input type="checkbox" id="2bhk" name="2 BHK" value="2 BHK">
                                                    <label for="2bhk"><i class="fas fa-bed"></i> 2 BHK</label>
                                                </li>
                                                <li>
                                                    <input type="checkbox" id="3bhk" name="3 BHK" value="3 BHK">
                                                    <label for="3bhk"><i class="fas fa-bed"></i> 3 BHK</label>
                                                </li>
                                            </ul>
                                        </div>
                                    </div> 
                                    <div class="col-md-12 pt-2">
                                        <input type="submit" name="submit" class="btn btn-success">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="card-header">FEATURED PROPERTIES</div>
                    @foreach ($featuredprop as $key => $properties)
                    <div class="col-md-12 py-3">
                        @if($properties->doc_verified == 1)
                        <div class="verify">
                            <h3><i class="fas fa-check-double"></i> Verified property</h3>
                        </div>
                        @else
                        <div class="inverify">
                            <h3><i style="color:red" class="far fa-times-circle"></i> Yet To verify</h3>
                        </div>
                        @endif
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
                                @if($properties->doc_verified == 1)
                                <div class="verify">
                                    <h3><i class="fas fa-check-double"></i> Verified property</h3>
                                </div>
                                @else
                                <div class="inverify">
                                    <h3><i style="color:red" class="far fa-times-circle"></i> Yet To verify</h3>
                                </div>
                                @endif
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