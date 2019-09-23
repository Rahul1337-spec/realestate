@extends('layouts.app')

@section('content')
<!-- Styles -->
<main id="page-id-1">
    <div class="container-fluid section__0">
        <div class="row row__0 full-height">
            <div class="round">
                <h2>Real Estate</h2>
            </div>
            {{-- <div class="carousel">
                <div class="carousel-item">
                    <div class="carousel-inner"></div>
                    <div class="carousel-indicators"></div>
                </div>
                <div class="carousel-item">
                    <div class="carousel-inner"></div>
                    <div class="carousel-indicators"></div>
                </div>
            </div> --}}
        </div>
    </div>

    <div class="container-fluid section--1">
        <div class="row row--1 py-5">
            <div class="col-md-12">
                <div class="jumbotron-fluid text-center">
                    <h1>Latest Property On Sale</h1>
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
                    @foreach($property as $prop)
                    <div class="col-md-4 py-2">
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
                    </div>
                    @endforeach
                    {{ $property->links() }}
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