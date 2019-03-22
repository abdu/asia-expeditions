@extends('layouts.app')
<?php 
  if (isset($_GET['email'])) {
    $email = $_GET['email'];
    $password = $_GET['password'];
  }else{
    $email = '';
    $password = '';
  }    
?>
<style type="text/css">
  .z-depth-3 {
      box-shadow: 0 12px 15px 0 rgba(0,0,0,0.24), 0 17px 50px 0 rgba(0,0,0,0.19);
      background-color: #f5f5f5 !important;
  }
</style>
@section('content')
  <br><br><br>
   <main>
    <center>
        <div  class="z-depth-3 y-depth-3 x-depth-3 grey lighten-4 row" style="display: inline-block; padding: 32px 48px 0px 48px; border: 1px; margin-top: 25px; ">
          <img src="/img/{{config('app.logo') }}"> 
          <div class="section"></div>          
            <span>Welcome For New member</span>
            @if(isset($_GET['message']))
              <div class="alert alert-waring"></div>
              <div class="alert alert-warning alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <strong>Warning!</strong> {{$_GET['message']}}
              </div>
              <a class="btn btn-default btn-sm" href="{{route('getClientLogin')}}">Go To Login</a>
            @else
              <form action="{{route('doLogin')}}" method="post">
                {{ csrf_field() }}
                <div class='row'>
                  <div class='input-field col s12'>
                    <label for='email'>Email</label>
                    <input class="form-control" type="text" name="email" id="email" value="{{$email}}" required />
                  </div>
                </div>
                <div class='row'>
                  <div class='input-field col m12'>
                    <label for='password'>Password</label>
                    <input class="form-control" type="password" name="password" id="password" value="{{$password}}" required />
                  </div>
                </div>
                <br/>
                <center>
                    <button type="submit" class="col s6 btn btn-small white black-text waves-effect z-depth-1 y-depth-1">Login</button>                  
                </center>
              </form>
            @endif
        </div>
      </center>
      </main>
      <br><br><br>
      <br><br><br>
@endsection