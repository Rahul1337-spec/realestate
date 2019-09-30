{{-- {{ dd($property) }} --}}
{{-- {{ dd($property_image) }} --}}
@extends('layouts.app')
@section('content')
<div class="container-fluid" style="position:relative;">
    <img class="img-thumbnail contact__image" src="{{ asset('images/'.$property[0]->uncompress_img) }}">
    <div class="property__content">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-6"><h2>{{ $property[0]->property_name }}</h2></div>
                <div class="col-md-6"><h2>Rs.{{ $property[0]->property_rate }}</h2></div>
            </div>
        </div>
    </div>
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
            {{-- <div class="card">
                <div class="card-header">
                    <h2>{{ $property[0]->property_name }}</h2>
                </div>
                <div class="card-body">
                    <h2>Property Address</h2>
                    {{ $property[0]->property_address }}
                </div>
            </div> --}}
            <div class="container py-3">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card-title">
                            <h3 class="text-info">{{ $property[0]->property_name }}</h3>
                            <hr>
                        </div>
                    </div>
                    <div class="col-md-12 table-responsive">
                        <div class="row">
                            <div class="col-md-4 asset__content">
                                <h3 class="text-info"><i class="fas fa-bed"></i> BHK</h3>
                                <h3 class="text-gray-dark">{{ $property[0]->asset }}</h3>
                            </div>
                            <div class="col-md-4 asset__content">
                                <h3 class="text-info"><i class="fas fa-ruler-combined"></i> Sqft</h3>
                                <h3 class="text-gray-dark">2400</h3>
                            </div>
                            <div class="col-md-4 asset__content">
                                <h3 class="text-info"><i class="fas fa-map-marker-alt"></i> Location</h3>
                                <h3 class="text-gray-dark">{{ $property[0]->property_state }}</h3>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <h3 class="text-info">Property Details</h3>
                                <p>{{ $property[0]->property_address }}</p>
                            </div>
                        </div>
                        <div class="row" style="overflow:hidden">
                            <div class="gallery centerede zoom-gallery">
                                @foreach($property_image as $da)
                                <div class="inner">
                                    <img src="{{ asset('images/'.$da->filename) }}">
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')

{{-- $('.centerede').slick({
dots: true,
infinite: true,
speed: 300,
slidesToShow: 3,
slidesToScroll: 2,
responsive: [
{
  breakpoint: 1024,
  settings: {
  slidesToShow: 3,
  slidesToScroll: 3,
  infinite: true,
  dots: true
}
},
{
  breakpoint: 600,
  settings: {
  slidesToShow: 2,
  slidesToScroll: 2
}
},
{
  breakpoint: 480,
  settings: {
  slidesToShow: 1,
  slidesToScroll: 1
}
}
// You can unslick at a given breakpoint now by adding:
// settings: "unslick"
// instead of a settings object
]
});
--}}


@endsection