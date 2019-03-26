@if(Auth::check() == true)
  <script type="text/javascript">
    window.location = "{{url('/')}}/admin";
  </script>
@endif
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
        <div  class="z-depth-3 y-depth-3 x-depth-3 grey lighten-4 row" style="display: inline-block; padding: 32px 48px 0px 48px; border: 1px; margin-top: 25px; ">
          <img src="{{asset('/img/'.config('app.logo')) }}"> 
          <div class="section"></div>          
            <span>welcome for message here</span>
          <form action="{{route('doLogin')}}" method="post">
              {{ csrf_field() }}
              <div class='row'>
                <div class='input-field col s12'>
                  <input class="validate" type="text" name="email" id="email" required />
                  <label for='email'>Email</label>
                </div>
              </div>
              <div class='row'>
                <div class='input-field col m12'>
                  <input class="validate" type="password" name="password" id="password" required />
                  <label for='password'>Password</label>
                </div>
              </div>
              <br/>
              <center>
                <div class='row'>
                  <button style="margin-left:65px;"  type="submit" class="col s6 btn btn-small white black-text waves-effect z-depth-1 y-depth-1">Login</button>
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