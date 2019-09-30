<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'RealEstate') }}</title>

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>

    {{-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script> --}}
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.0/js/bootstrap.min.js" integrity="sha384-7aThvCh9TypR7fIc2HV4O/nFMVCBwyIUKL8XCtKE+8xgCgl/PQGuFsvShjr74PBp" crossorigin="anonymous"></script>

    {{-- <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous"> --}}

    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.0/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-PDle/QlgIONtM1aqA2Qemk5gPOE7wFq8+Em+G/hmo5Iq0CCmYZLv3fVRDJ4MMwEA" crossorigin="anonymous">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-migrate/3.1.0/jquery-migrate.min.js" integrity="sha256-91c9XEM8yFH2Mn9fn8yQaNRvJsEruL7Hctr6JiIY7Uw=" crossorigin="anonymous"></script>

    <!-- Slider dependencies -->
    <script type="text/javascript" src="{{ asset('slick/slick.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js" integrity="sha256-d/edyIFneUo3SvmaFnf96hRcVBcyaOy96iMkPez1kaU=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" integrity="sha256-FdatTf20PQr/rWg+cAKfl6j4/IY3oohFAJ7gVC3M34E=" crossorigin="anonymous" />
    {{-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script> --}}
    <!-- Include the plugin's CSS and JS: -->
    {{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> --}}

    <!-- Latest compiled and minified JavaScript -->
    {{-- <script src="{{ asset('js/app.js') }}" async></script> --}}
    
    <link rel="stylesheet" type="text/css" href="{{ asset('slick/slick.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('slick/slick-theme.css') }}"/>
    <script src="https://cdn.jsdelivr.net/npm/pdfjs-dist@2.1.266/build/pdf.min.js"></script>

    
    {{-- <script src="{{ asset('js/custom.js') }}"></script> --}}
    
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.2/css/all.min.css" integrity="sha256-zmfNZmXoNWBMemUOo1XUGFfc0ihGGLYdgtJS3KCr/l0=" crossorigin="anonymous" />
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    

    {{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"> --}}
    {{-- Symentic ui --}}
   {{--  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/semantic-ui@2.4.2/dist/semantic.min.css">
   <script src="https://cdn.jsdelivr.net/npm/semantic-ui@2.4.2/dist/semantic.min.js"></script> --}}
   
   <!-- Styles -->
   {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}
   <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Real Estate') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->

                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item"> 
                            <form method="get" action="{{ route('user.search') }}" style="display:flex;" class="navbar-form navbar-left">
                                <div >
                                    <input type="text" name="q" class="form-control" placeholder="Search">
                                </div>
                                <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                            </form>
                        </li>
                        {{-- @hasrole('user') --}}
                        <li class="nav-item">
                            <form method="get" action="{{ route('searchcity') }}">
                                <select name="select_city" onchange="this.form.submit()" class="selector form-control">
                                    <option value="">Select City</option>
                                    @foreach($city as $da)
                                    <option value="{{ $da->id }}">{{ $da->name }}</option>
                                    @endforeach
                                </select>
                            </form>    
                        </li>
                        
                        {{-- @endhasrole --}}
                       {{--  <li class="nav-item"> 
                            <a href="#" class="dropdown">
                                <h2 class="menu-title">Select</h2>
                                <ul class="drop-down">
                                    <div class="custom-option">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <ul>
                                                        <li>Option 1</li>
                                                        <li>Option 2</li>
                                                        <li>Option 3</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </ul>
                            </a>
                        </li> --}}
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                        @endif
                        @else
                        @hasrole('admin')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.property') }}">Properties</a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">Blog</a></li>
                            @endhasrole
                            @hasrole('user')
                            @if(Auth::user()->isAgent == 0 && Auth::user()->iso_code != 'IN')
                            <li class="nav-item">
                                @if(Auth::user()->Applied_agent == 1)
                                <a class="nav-link" href="#">In Process Agent</a>
                                @else   
                                <a class="nav-link" href="{{ route('user.agent') }}">Apply For Agent</a>
                                @endif
                                @endif
                            </li>
                            @endhasrole
                            @hasrole('agent')
                            @if(Auth::user()->isAgent == 1)
                            <li class="nav-item">
                               <a class="nav-link" href="{{ route('agent.account') }}">Agent</a>
                           </li>
                           @endif
                           @endhasrole
                           <li class="nav-item dropdown">
                               <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                   {{ Auth::user()->name }} <span class="caret"></span>
                               </a>

                               <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                   <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                   document.getElementById('logout-form').submit();">
                                   {{ __('Logout') }}
                               </a>

                               <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                   @csrf
                               </form>
                           </div>
                       </li>
                       @endguest
                   </ul>
               </div>
           </div>
       </nav>
       @yield('content')

       @include('layouts.footer')
   </div>
   <script type="text/javascript">
    jQuery(window).load(function(){
        $('.gallery-responsive').slick({
            dots: true,
            autoplay:true,
            infinite: true,
            arrow:true,
            speed: 300,
            slidesToShow: 3,
            slidesToScroll: 1,
            responsive: [
            {
              breakpoint: 1024,
              settings: {
                slidesToShow: 2,
                slidesToScroll: 1,
                infinite: true,
                dots: false
            }
        },
        {
          breakpoint: 600,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 1
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
        $('.custom-slider').slick({
            dots: false,
            autoplay:true,
            infinite: true,
            arrow:true,
            speed: 500,
        });
        
        $('.front_page').slick({
            dots: false,
            autoplay:true,
            infinite: true,
            arrow:true,
            speed: 300,
            slidesToShow: 3,
            slidesToScroll: 1,
            responsive: [
            {
              breakpoint: 1024,
              settings: {
                slidesToShow: 2,
                slidesToScroll: 1,
                infinite: true,
                dots: false
            }
        },
        {
          breakpoint: 600,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 1
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
        $(".option").click(function(){
            $(".more-options").slideToggle("slow")
        });

        @yield('script')

        $('.centerer').slick({
          centerMode: true,
          centerPadding: '0px',
          autoplay:'true',
          dots:'true',
          speed:300,
          slidesToShow: 3,
          responsive: [
          {
              breakpoint: 768,
              settings: {
                arrows: false,
                centerMode: true,
                centerPadding: '40px',
                slidesToShow: 3
            }
        },
        {
          breakpoint: 480,
          settings: {
            arrows: false,
            centerMode: true,
            centerPadding: '40px',
            slidesToShow: 1
        }
    }
    ]
});

    });
</script>
<script type="text/javascript">
    var elems = document.getElementsByClassName('confirm');
    var confirmIt = function (e) {
        if (!confirm('Are you sure?')) e.preventDefault();
    };
    for (var i = 0, l = elems.length; i < l; i++) {
        elems[i].addEventListener('click', confirmIt, false);
    }
</script>

{{-- $('.zoom-gallery').magnificPopup({
delegate: 'a',
type: 'image',
closeOnContentClick: false,
closeBtnInside: false,
mainClass: 'mfp-with-zoom mfp-img-mobile',
image: {
verticalFit: true,
titleSrc: function(item) {
return item.el.attr('title') + ' &middot; <a class="image-source-link" href="'+item.el.attr('data-source')+'" target="_blank">image source</a>';
}
},
gallery: {
enabled: true
},
zoom: {
enabled: true,
duration: 300, // don't foget to change the duration also in CSS
opener: function(element) {
return element.find('img');
}
}

}); 
--}}

</body>
</html>
