@section('slider')
     	<!-- Slider Carousel
        ================================================== -->
        <style type="text/css">
        .slides li a img{
          height: 350px!important;
        }
        </style>
        <div class="span8">
            <div class="flexslider">
              <ul class="slides">
              @foreach($slider as $img)
                <li><a href="#"><img  src="{{asset('public/uploads/'.$img->calling_id)}}" alt="slider" /></a></li>
              @endforeach
               
              </ul>
            </div>
        </div>
@stop