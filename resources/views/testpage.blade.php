<!DOCTYPE html>
<html>
<head>
    {{-- <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> --}}

    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-lightbox/0.7.0/bootstrap-lightbox.min.css"> --}}

    {{-- <script type="text/javascript" src="http://code.jquery.com/jquery-1.11.0.min.js"></script> --}}
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>

    <script type="text/javascript" src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script type="text/javascript" src="{{ asset('slick/slick.min.js')}}"></script>


    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-lightbox/0.7.0/bootstrap-lightbox.min.js"></script>
    
    <link rel="stylesheet" type="text/css" href="{{ asset('slick/slick.css') }}"/>
    // Add the new slick-theme.css if you want the default styling
    <link rel="stylesheet" type="text/css" href="{{ asset('slick/slick-theme.css') }}"/>
    <title>RealEstate</title>
    <style type="text/css">
        .lightbox{
            z-index: 1041;
        }
        .small-img{
          width: 100px;height: 100px;
      }
  </style>
</head>
<body>
    <div class="container">
        <div class="col-md-12">
            <div class="row py-4">
                {{-- <div class="col-md-4">
                    <ul>
                        @foreach($image_path as $image)
                        <li class="list-group-item"><a href="{{ asset('images/'.$image) }}" target="img-box"><img class="img-thumbnail" height="200"; width="200"; src="{{ asset('images/'.$image)}}"></a></li>
                        @endforeach
                    </ul>
                </div>
                <div class="col-md-8">
                    <img class="img-box" src="{{ asset('images/'.$image) }}" width="300"; height="300";>
                </div> --}}
               {{--  <form method="post" action="{{ route('testpage.show') }}">
                    @csrf
                    <select name="data[]" multiple="multiple">
                        <option value="first">First</option>
                        <option value="second">second</option>
                        <option value="third">third</option>
                    </select>
                    <button name="submit" class="btn">Submit</button>
                </form> --}}
                <div class="your-class">
                  <div>your content</div>
                  <div>your content</div>
                  <div>your content</div>
              </div>
          </div>
      </div>
  </div>

  <script type="text/javascript">
    jQuery('.list-group-item a').mouseover(function(e){
        e.preventDefault();
        jQuery('img.img-box ').attr('src',$(this).attr("href"));
    });
    $(document).ready(function(){
      $('.your-class').slick({

      });
  });

</script>
</body>
</html>
