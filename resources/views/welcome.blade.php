@extends('layouts.app')

@section('content')
<!-- Styles -->
<main id="page-id-1">
    <div class="container-fluid section__0">
        {{-- <div class="row row__0 full-height">
            <div class="round">
                <h2>Real Estate</h2>
            </div>
        </div> --}}
        <div class="gallery custom-slider">
            <div class="inner">
                <img src="http://realeastate.devs/storage/1/housecar.jpg">
                <div class="feature-content">
                    <div class="card">
                        <div class="card-header"><h3 class="text-center text-uppercase">Property Name</h3></div>
                        <div class="card-body">
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmodtempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo</p>
                        </div>
                        <div class="card-footer">
                            <h3>For Sale : Rs.99999</h3>
                            <a class="btn btn-success">Contact</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="inner">
                <img src="http://realeastate.devs/storage/1/housecar.jpg">
                <div class="feature-content">
                    <div class="card">
                        <div class="card-header"><h2>Property Name</h2></div>
                        <div class="card-body">
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmodtempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo</p>
                        </div>
                        <div class="card-footer">
                            <h3>For Sale : Rs.99999</h3>
                            <a class="btn btn-success">Contact</a>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="inner">slider 2</div> --}}
        </div>
    </div>

    <div class="container-fluid section--1">
        <div class="row row--0 py-2">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <div class="container">
                            <form method="post" action="{{ route('guest.search') }}" class="milkat--multifilter">
                                @csrf
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-9">
                                            <div class="row py-3">
                                                <div class="col-md-4">
                                                    <select name="type" class="custom-select" required>
                                                        <option value="Rent">Rent</option>
                                                        <option value="Buy">Buy</option>
                                                    </select>
                                                </div>

                                                <div class="col-md-4">
                                                    <select name="city" class="custom-select">
                                                        <option value="Any">Any</option>
                                                        <option value="Vadodara">Vadodara</option>
                                                        <option value="Surat">Surat</option>
                                                        <option value="Ahmedabad">Ahmedabad</option>
                                                    </select>
                                                </div>

                                                <div class="col-md-4">
                                                    <select name="check" class="custom-select">
                                                        <option value="1">Verified</option>
                                                        <option value="0">Unverified</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row py-3">
                                                <div class="col-md-4">
                                                    <select name="min_rate" class="custom-select">
                                                        <option value="">Min Rate</option>
                                                        <option value="1000">1000</option>
                                                        <option value="2000">2000</option>
                                                        <option value="3000">3000</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-4">
                                                    <select name="max_rate" class="custom-select">
                                                        <option value="">Max Rate</option>
                                                        <option value="50000">50000</option>
                                                        <option value="75000">75000</option>
                                                        <option value="100000">1 Lakh</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="row full__height">
                                                <div class="col-md-6">
                                                    <div class="option">More Options</div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="option">
                                                        <input type="submit" name="submit" value="Search">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row more-options">
                                        <div class="col-md-9 more--content">
                                            <ul class="list-inline Filter--control">
                                                <li class="list-inline-item">
                                                    <input type="radio" id="bhk2" name="BHK" value="2 BHK">
                                                    <label for="bhk2">2 BHK</label>
                                                </li>
                                                <li>
                                                    <input type="radio" id="bhk3" name="BHK" value="3 BHK">
                                                    <label for="bhk3">3 BHK</label>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-md-3" style="background-color:white">

                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-2"></div>
                </div>
            </div>
        </div>
        <div class="row row--1 py-5">
            <div class="col-md-12">
                <div class="jumbotron-fluid text-center">
                    @if($property->isEmpty())
                    <h1>Latest Property On Sale at {{ $property_null[0]->name }}</h1>
                    @endif
                    @if(!isset($property_null))
                    <h1>Latest Property On Sale at {{ $property[0]->property_state }}</h1>
                    @endif
                </div>
                <div class="container py-2">
                    <div class="col-md-12">
                        <div class="gallery front_page portfolio_slider">               
                            <div class="col-md-4 text-center p-3 text-info"><i class="fas fa-archive"></i> Properties {{ $prop_total }}</div>
                            <div class="col-md-4 text-center p-3 text-info"><i class="fas fa-archive"></i> Rent Properties {{ $rent }}</div>
                            <div class="col-md-4 text-center p-3 text-info"><i class="fas fa-archive"></i> Buy Properties {{ $buy }}</div>
                            <div class="col-md-4 text-center p-3 text-info"><i class="fas fa-archive"></i> Registered agents 12+</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row row--2 py-2">
                    @if($property->isEmpty())
                    <div class="col-md-12 d-flex justify-content-center">
                        <h2>No Property Found</h2>
                    </div>
                    @endif
                    @foreach($property as $prop)
                    {{-- <div class="col-md-4 py-2">
                        <div class="card">
                            <div class="card-header text-center"><h2>{{ $prop->property_name }}</h2></div>
                            <div class="card-body">
                                @if($prop->doc_verified == 1)
                                <div class="verify">
                                    <h3><i class="fas fa-check-double"></i> Verified property</h3>
                                </div>
                                @else
                                <div class="inverify">
                                    <h3><i style="color:red" class="far fa-times-circle"></i> Yet To verify</h3>
                                </div>
                                @endif
                                <img width="100%" src="{{ asset('images/'.$prop->featured_img) }}">
                                <p>{{ $prop->property_state }}</p>
                                <a href="{{ route('user.property.show',$prop->id) }}" class="btn btn-success">See More</a>
                                <a href="{{ route('user.contactprop',$prop->id) }}" class="btn btn-success">Contact</a>
                            </div>
                        </div>                
                    </div> --}}
                    <div class="col-md-4 py-2">
                        <div class="custom__container">
                            <div class="custom__container--img"><img src="{{ asset('images/'.$prop->featured_img) }}"></div>
                            <div class="custom__container--content">
                                <div class="col-md-12 custom--content">
                                    <div class="row">
                                        <h3>{{ $prop->property_name }}</h3>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4"><p class="card-title">BHK</p><i class="fas fa-bed"> {{ $prop->asset }}</i></div>
                                        <div class="col-md-4"><p class="card-title">Sqft</p><i class="fas fa-ruler-combined"> 2200</i></div>
                                        <div class="col-md-4"><p class="card-title">Location</p><i class="fas fa-map-marker-alt"> {{ $prop->property_state }}</i></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p>For {{ $prop->name }}</p>
                                            <h4>Rs.{{ $prop->property_rate }}</h4>
                                        </div>
                                        <div class="col-md-6 d-flex align-items-center justify-content-end">
                                            <a href="{{ route('user.contactprop',$prop->id) }}" class="btn btn-success">Contact</a>
                                        </div>
                                    </div>  
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach

                    <div class="col-md-12 d-flex justify-content-center align-items-center">{{ $property->links() }}</div>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-4"></div>
                            <div class="col-md-4 d-flex justify-content-center"><a class="btn btn-dark" href="{{ route('user.properties') }}">Show All</a></div>
                            <div class="col-md-4"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid section--4">
            <div class="row row--4">
                <div class="custom--slant">
                    <div class="custom--header"></div>
                    <div class="custom--slant--content">
                        <p>Looking to Buy a new property or Rent an existing one? Realestate provides an awesome solution!</p>
                        <div class="d-flex justify-content-center">
                            <a href="{{ route('user.properties') }}" class="btn btn-light">Look For Property</a>
                        </div>
                    </div>
                    <div class="custom--footer"></div>
                </div>
            </div>
        </div>
        <div class="container-fluid section--5">
            <div class="row row--5">
                <div class="container d-flex justify-content-center">
                    <div class="row">
                        @if($prop_rent->isNotEmpty())
                        <div class="col-md-12 custom--title">
                            <h3>RENT</h3>
                            <h2>Properties for Rent At {{ $prop_rent[0]->name }}</h2>
                        </div>
                        @endif
                        @if($prop_rent->isEmpty())
                        <div class="col-md-12 custom--title">
                            <h3>RENT</h3>
                            <h2>Properties for Rent At {{ $property_null[0]->name }}</h2>
                        </div>
                        <div class="col-md-12 d-flex justify-content-center">
                            <h2>No Property Found</h2>
                        </div>
                        @endif
                    </div>
                </div>
                <div class="container">
                    <div class="col-md-12">
                        <div class="centerer portfolio_slider">  
                            @foreach($prop_rent as $prop)
                            <div class="custom__container">
                                <div class="custom__container--img"><img src="{{ asset('images/'.$prop->featured_img) }}"></div>
                                <div class="custom__container--content">
                                    <div class="col-md-12 custom--content">
                                        <div class="row">
                                            <h3>{{ $prop->property_name }}</h3>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4"><p class="card-title">BHK</p><i class="fas fa-bed"> {{ $prop->asset }}</i></div>
                                            <div class="col-md-4"><p class="card-title">Sqft</p><i class="fas fa-ruler-combined"> 2200</i></div>
                                            <div class="col-md-4"><p class="card-title">Location</p><i class="fas fa-map-marker-alt"> {{ $prop->property_state }}</i></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <p>For Rent</p>
                                                <h4>Rs.{{ $prop->property_rate }}</h4>
                                            </div>
                                            <div class="col-md-6 d-flex align-items-center justify-content-end">
                                                <a href="{{ route('user.contactprop',$prop->id) }}" class="btn btn-success">Contact</a>
                                            </div>
                                        </div>  
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid section--2">
            <div class=" row row--3 py-5">
                <div class="col-md-8">
                    <div class="desc">
                        <h2>HEADLINE HERE</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                            consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                            cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                        proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="contact-wrap">
                        <h2>Contact Us</h2>
                        <form method="POST">
                            <input type="text" name="name" placeholder="NAME" class="form-control">
                            <input type="text" name="email" placeholder="EMAIL" class="form-control">
                            <input type="text" name="phone" placeholder="PHONE" class="form-control">
                            <input type="submit" name="submit" class="form-control">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
    @endsection