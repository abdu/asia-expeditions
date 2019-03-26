  <div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">
            <li class="sidebar-search">
                <div class="input-group custom-search-form">
                    <input type="text" class="form-control" placeholder="Search..." readonly="">
                    <span class="input-group-btn">
                    <button class="btn btn-default" type="button">
                        <i class="fa fa-search"></i>
                    </button>
                </span>
                </div>
            </li>
           
            @if(Auth::user()->user_type == 1)
            <li>
                <a href="{{route('admin')}}"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
            </li>
            <li class="@yield('email')">
                <a href="javascripe:void(0)"><i class="fa fa-envelope fa-fw"></i> Email Subscribes<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li><a href="{{route('emailList')}}">Email Lists</a></li>                   
                    <li><a href="{{route('sentemailList')}}">Sent Email</a></li>                   
                </ul>
            </li>
          
            <li class="@yield('tour')">
                <a href="javascripe:void(0)"><i class="fa fa-globe fa-fw"></i> Tours<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li><a href="{{route('tourList')}}">Tours List</a></li>                   
                    <!-- <li><a href="{{route('tourForm')}}">Create Tour</a></li>                    -->
                </ul>
            </li>
            <li class="@yield('ournew')">
                <a href="javascripe:void(0)"><i class="fa fa-newspaper-o fa-fw"></i> Our News<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li><a href="{{route('ourNewsList')}}">Our News </a></li>                   
                    <li><a href="{{route('ourNewsForm')}}">Create News</a></li>                   
                </ul>
            </li>
              <li class="@yield('film')">
                <a href="javascripe:void(0)"><i class="fa fa-film fa-fw"></i> Film<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li><a href="{{route('filmList')}}">Film List </a></li>                   
                    <li><a href="{{route('filmForm')}}">Create film</a></li>                   
                </ul>
            </li>
            <li class="@yield('slide')">
                <a href="javascripe:void(0)"><i class="fa fa-sliders fa-fw"></i> Slide Show​ <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li><a href="{{route('slideList')}}">Slide Show</a></li>                   
                    <li><a href="{{route('ourNewsForm')}}">Add Slide Show</a></li>                   
                </ul>
            </li>
            <li class="@yield('hotel')">
                <a href="javascripe:void(0)"><i class="fa fa-hotel (alias) fa-fw"></i> Hotels<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li><a href="#">Hotels List</a></li>                   
                    <li><a href="#">Create Hotel</a></li>                   
                </ul>
            </li>            
            <li class="@yield('email')">
                <a href="javascripe:void(0)"><i class="fa fa-users fa-fw"></i> Users<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li><a href="{{route('getUser')}}">Users Lists</a></li>
                </ul>
            </li>
            @else
            <li>
                <a href="{{route('getClientName', ['clientName' => Auth::user()->name])}}"><i class="fa fa-dashboard fa-fw"></i>Your Account</a>
            </li>        
            @endif
        </ul>
    </div>
</div>