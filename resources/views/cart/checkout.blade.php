@extends('layouts.app')
@section('title')
CheckOut Page
@endsection
<?php

use App\components\Shared;
?>

@section('content')
@include("include.menu")
<div class="spacing"></div>
<div class="container ">
    <div class="row ">
        @if (session('message'))			
        <div class="col-md-12">
            <div class="alert alert-{{session('icon')}} no-bg" >
                <strong><i class="fa fa-check"></i>
                    {{session('message')}}
                </strong>
            </div>
        </div>
        @else			
            <div class="col-md-12">
                <div class="alert alert-success no-bg" >
                    <strong>
                        Welcome for our Register / Login form
                    </strong>
                </div>
            </div>
        @endif	
        @if (session('loginError'))			
        <div class="col-md-12">
            <div class="alert alert-danger no-bg" >
                <strong><i class="fa fa-check"></i>
                    {{session('loginError')}}
                </strong>
            </div>
        </div>			
        @endif	
        <div class="col-md-12">
            @if (count($errors) > 0)
            <div class="alert alert-danger alert-success" style="background-color: none; ">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
        </div>	
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 col-md-push-8 col-sm-push-8">
            <form  method="post" action="{{route('check.login')}}">
                {{ csrf_field() }}
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" 
                           href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            LOGIN 
                        </a> &nbsp; <small style="font-style: italic;">you have account yet ?</small>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="form-group {{$errors->first('email') ? 'has-error' : ''}}">
                                <div class="col-md-12 "><strong class="control-label" for="inputError">Email*</strong></div>
                                <div class="col-md-12">
                                    <input type="email" class="form-control" name="email_log" value="{{ old('email_log') }}">
                                </div>
                            </div>
                            <div class="form-group {{$errors->first('password_log') ? 'has-error' : ''}}">
                                <div class="col-md-12 w3-margin-top"><strong class="control-label" for="inputError">Password*</strong></div>
                                <div class="col-md-12">
                                    <input type="password" class="form-control" name="password_log" >
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12 w3-margin-top">
                                    <button type="submit" class="w3-btn w3-blue btn-submit-fix">Login </button>
                                    &nbsp;&nbsp;&nbsp;<a href="/forgot_password">Forgot password ?</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 col-md-pull-4 col-sm-pull-4">
            <!--SHIPPING METHOD-->
            <form class="form-horizontal" method="post" action="{{route('registerCustomer')}}">
                {{ csrf_field() }}
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" 
                           href="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                            REGISTER
                        </a>
                    </div>
                    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-6 col-xs-12 ">
                                    <div class="form-group {{$errors->first('first_name') ? 'has-error' : ''}} ">
                                        <div class="col-md-12 col-xs-12">
                                            <strong class="control-label" for="first_name">First Name*</strong>
                                            <input type="text" name="first_name" class="form-control" value="{{ old('first_name') }}" placeholder="First Name" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xs-12 ">
                                    <div class="form-group {{$errors->first('last_name') ? 'has-error' : ''}}">
                                        <div class="col-md-12 col-xs-12 ">
                                            <strong class="control-label" for="last_name">Last Name</strong>
                                            <input type="text" name="last_name" class="form-control" value="{{ old('last_name') }}" placeholder="Last Name" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group {{$errors->first('nation') ? 'has-error' : ''}}">
                                <div class="col-md-12"><strong class="control-label" for="nation">Nationality*</strong></div>
                                <div class="col-md-12">
                                    <select class="form-control" name="nationality">
                                        @foreach(App\Country::orderBy('nationality')->get() as $con)
                                            <option value="{{$con->id}}">{{$con->nationality}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-xs-12 ">
                                    <div class="form-group {{$errors->first('passport_number') ? 'has-error' : ''}}">
                                        <div class="col-md-12 col-xs-12 ">
                                            <strong class="control-label" for="inputError">Passport Number*</strong>
                                            <input onkeyup="checkInp()" type="type" name="passport_number" class="form-control" value="{{ old('passport_number') }}" placeholder="Passport Number" />
                                        </div>
                                    </div>
                                </div>	 
                                <div class="col-md-6 col-xs-12 ">
                                    <div class="form-group {{$errors->first('expiry_date') ? 'has-error' : ''}}">
                                        <div class="col-md-12 col-xs-12 ">
                                            <strong class="control-label" for="inputError">Date Of Expiry *</strong>
                                            <input type="text" name="expiry_date" class="form-control" value="{{ old('expiry_date') }}" id="expiry_date"/ placeholder="Date of Expiry">
                                        </div>
                                    </div>
                                </div>
                            </div>	
                            <div class="form-group {{$errors->first('address_street') ? 'has-error' : ''}}">
                                <div class="col-md-12"><strong class="control-label" for="inputError">Address Street*</strong></div>
                                <div class="col-md-12">
                                    <input type="text" name="address_street" class="form-control" value="{{ old('address_street') }}" placeholder="Address here..." />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-xs-12 ">
                                    <div class="form-group {{$errors->first('town_city') ? 'has-error' : ''}}">
                                        <div class="col-md-12 col-xs-12 ">
                                            <strong class="control-label" for="inputError">Town / City*</strong>
                                            <input type="text" name="town_city" class="form-control" value="{{ old('town_city') }}" placeholder="City/ Town" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xs-12 ">
                                    <div class="form-group {{$errors->first('country_state') ? 'has-error':''}}">
                                        <div class="col-md-12 col-xs-12 ">
                                            <strong class="control-label" for="inputError">Country / State*</strong>
                                            <select class="form-control" name="country_state"> 
                                                @foreach(\App\Country::where("country_status", 1)->orderBy("nationality")->get() as $state)
                                                <option value="{{$state->id}}" {{old('country_state') == $state->id ? 'selected':''}}>{{ $state->country_name }}</option>
                                                @endforeach 
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-xs-12 ">
                                    <div class="form-group">
                                        <div class="col-md-12"><strong > Zip / Postal Code</strong></div>
                                        <div class="col-md-12">
                                            <input type="text" name="zip_code" class="form-control" value="{{ old('zip_code') }}" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xs-12 ">
                                    <div class="form-group {{$errors->first('phone_number') ? 'has-error':''}}">
                                        <div class="col-md-12"><strong class="control-label" for="inputError">Phone Number*</strong></div>
                                        <div class="col-md-12"><input type="text" name="phone_number" class="form-control" value="{{ old('phone_number') }}" placeholder="Phone Number" /></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-xs-12 ">
                                    <div class="form-group {{$errors->first('email') ? 'has-error' : ''}} {{ session('message') ? 'has-error' : ''}}">
                                        <div class="col-md-12"><strong class="control-label" for="inputError">Email Address*</strong></div>
                                        <div class="col-md-12"><input type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="asia-expeditions@gmail.com" /></div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xs-12">
                                    <div class="form-group {{$errors->first('password') ? 'has-error' : ''}}">
                                        <div class="col-md-12"><strong class="control-label" for="inputError">Password*</strong></div>
                                        <div class="col-md-12"><input type="password" name="password" class="form-control" value="{{ old('password') }}" placeholder="Password" /></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group text-center"><br>
                                <div class="col-md-12 col-xs-12">
                                    <button type="submit" class="w3-btn w3-blue btn-submit-fix">Continue </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>	   
            </form>
        </div>
    </div>        
</div>
</div>



<script>
    $(document).ready(function () {
    var formatdate = "yyyy-mm-dd";
    var nowTemp = new Date();
    var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);
    var book_date = $("#expiry_date").datepicker({
        format: formatdate,
        onRender: function(date) {
            // return date.valueOf() < now.valueOf() ? 'disabled' : '';
        }
    }).on('changeDate', function(ev){
        // $(".datepicker", this).hide();
         $(this).datepicker('hide');
    }).data('datepicker');
    });
</script>
<script type="text/javascript">
    function checkInp()
    {
        var x = $(this).value;
        if (isNaN(x))
        {
            return false;
        }
    }
</script>
@endsection

