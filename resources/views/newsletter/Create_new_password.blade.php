
<?php
  if(isset($_GET['id'])){
  }else{
      echo header('Location: http://asia-expeditions.com/forgot_password');
  }
  $email = isset($_GET['id']) ? $_GET['id'] : '';
?>
<html>
<head>
  <title>Login As Newsletter</title>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.5/css/materialize.min.css">
  <link rel="shortcut icon" type="image/x-icon" href="/img/{{config('app.icon')}}">
</head>
<body>
  <div class="section"></div>
   <main>
    <center>
        <div  class="z-depth-3 y-depth-3 x-depth-3 grey green-text lighten-4 row" style="display: inline-block; padding: 32px 48px 0px 48px; border: 1px; margin-top: 25px; ">
          <img src="/img/{{config('app.logo') }}">    
          <div class="section "><span>Enter your email address and we will send you a link to reset your password.</span></div>
          <form action="{{url('create_new_password')}}" method="post">
          @if ($errors->any())
              <div class="alert alert-danger red-text">
                  <ul>
                      @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                      @endforeach
                  </ul>
              </div>
          @endif
          {{ csrf_field() }}
              <div class='row'>
                  <div class='input-field col s12'>
                    @if(session('sucess'))
                      <div style="color:#03a1d1; text-align: left;">{{ session('sucess') }}</div>
                    @endif
                    @if(session('warn'))
                      <div style="color:#a94442; text-align: left;">{{ session('warn') }}</div>
                    @endif
                    <input type="hidden" name='email' value="{{ $email }}" />
                    <input class='validate' type="password" name='new_password' id='new_password'  value="{{old('new_password')}}" required />
                    <label for='name'>New Password</label>
                  </div>
              </div>
              <div class='row'>
                  <div class='input-field col s12'>
                    @if(session('sucess'))
                      <div style="color:#03a1d1; text-align: left;">{{ session('sucess') }}</div>
                    @endif
                    @if(session('warn'))
                      <div style="color:#a94442; text-align: left;">{{ session('warn') }}</div>
                    @endif
                    <input class='validate' type="password" name='re_new_password' id='re_new_password' required />
                    <label for='name'>Re-Enter New Password</label>
                  </div>
              </div>
              <br/>
              <center>
                <div class='row'>
                  <center>
                      <button  type='submit' class=' btn btn-detault'>Submit</button>
                  </center>
                </div>
              </center>
            </form>
        </div>
      </center>
      </main>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.5/js/materialize.min.js"></script>
</body>
</html>