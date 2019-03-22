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
          <form action="{{url('forgotPassword')}}" method="post">
              {{ csrf_field() }}
              <div class='row'>
                  @if(session('sucess'))
                  <div style="color:#03a1d1; text-align: left;">{{ session('sucess') }}</div>
                  @endif
                  @if(session('warn'))
                    <div style="color:#a94442; text-align: left;">{{ session('warn') }}</div>
                  @endif
                  <div class='input-field col s12'>
                    <input class='validate' type="email" name='email' id='name' required />
                    <label for='name'>Email</label>
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