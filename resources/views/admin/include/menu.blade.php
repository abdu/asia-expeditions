<?php 
use App\components\Shared;?>
<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="{{route('admin')}}">{{config('app.name')}}</a>
    </div>
    <ul class="nav navbar-top-links navbar-right">
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                @if(Auth::user()->picture)
                    <img width="40px;" height="40px;" style="border-radius: 50%;" src="{{Shared::getInstance()->urlResource(Auth::user()->picture)}}">
                @else
                    <img width="40px;" height="40px;" style="border-radius: 50%;" src="">
                @endif                
            </a>
            <ul class="dropdown-menu dropdown-user">
                <li><a href="#">
                    {{ Auth::user()->name}}</a>
                </li>
                <li class="divider"></li>
                <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('frm-logout').submit();"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                    <form id="frm-logout" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </li>
            </ul>
        </li>
    </ul>
    @include('admin.include.Leftmenu')          
</nav>