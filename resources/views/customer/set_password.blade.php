@extends('layouts.app')

<style type="text/css">
  .z-depth-3 {
      box-shadow: 0 12px 15px 0 rgba(0,0,0,0.24), 0 17px 50px 0 rgba(0,0,0,0.19);
      background-color: #f5f5f5 !important;
  }
  label{
    float: left;
  }
</style>
@section('content')
  <br><br><br>
   <main>
    <div class="container">
      <div class="row">
        <center>
            <div  class="z-depth-3 y-depth-3 x-depth-3 grey lighten-4 row" style="display: inline-block; padding: 32px 48px 0px 48px; border: 1px; margin-top: 25px; ">
              
              <div class="section"></div>          
                <span style="font-weight: 600; font-size: 20px;">Welcome For New User </span>  
                  
                  <form action="{{route('do_set_login')}}" method="post">
                    {{ csrf_field() }}
                    <div class='row'>
                      <div class='input-field col s12'>
                        <label for='email'>Email</label>
                        <input class="form-control" type="text" name="email" id="email" value="{{decrypt($get)}}" readonly="" />
                      </div>
                    </div>
                    <div class='row'>
                      <div class='input-field col m12 password'>
                        <label for='inputError'>Set Your Password</label>
                        <input class="form-control" type="password" name="new_password" id="password" value="{{old('new_password')}}" required />
                      </div>  
                      <div class='input-field col m12 repassword'>
                        <label for='inputError'>confirm Password</label>
                        <input class="form-control" type="password" name="re_password" id="repassword" value="{{old('re_password')}}" required />
                      </div>
                    </div>
                    <br/>
                    <center>
                        <button type="submit" class="col s6 btn btn-small white black-text waves-effect z-depth-1 y-depth-1">SET AND LOGIN</button>                  
                    </center>
                  </form>
           
            </div>
          </center>
        </div>
      </div>
      </main>
      <br><br><br>
      <br><br><br>
@endsection