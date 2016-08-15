@section('menue')
<div class="span4 navigation">
            <div class="navbar hidden-phone">
            
            <ul class="nav">
           <li class="active"><a href="{{url('/')}}">Home</a></li>
           <li><a href="{{url('about')}}">About</a></li>
           <li><a href="{{url('contact')}}">Contact</a></li>
           @if(!Auth::check())
           <li><a href="{{url('login')}}">Login</a></li>
           @else 
           <li><a href="{{url('customlogout')}}" style="color: red">Log Out</a></li>
           @endif
           <li><a href="{{url('register')}}">Register</a></li>
          
            <!-- 
			//Dropdown menue
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="blog-style1.htm">Blog <b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li><a href="blog-style1.htm">Blog Style 1</a></li>
                    <li><a href="blog-style2.htm">Blog Style 2</a></li>
                    <li><a href="blog-style3.htm">Blog Style 3</a></li>
                    <li><a href="blog-style4.htm">Blog Style 4</a></li>
                    <li><a href="blog-single.htm">Blog Single</a></li>
                </ul>
             </li>-->
           
            </ul>
           
            </div>

            <!-- Mobile Nav
            ================================================== -->
            <form action="#" id="mobile-nav" class="visible-phone">
                <div class="mobile-nav-select">
                <select onchange="window.open(this.options[this.selectedIndex].value,'_top')">
                    <option value="">Navigate...</option>
                    <option value="index.htm">Home</option>
                    <option value="index.htm">About</option>
                    <option value="index.htm">Contact</option>
                    <option value="index.htm">Login</option>
                    
                </select>
                </div>
                </form>

        </div>
@stop