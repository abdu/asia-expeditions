<?php
	use App\User;	
	$active = isset($_GET['active']) ? $_GET['active'] : '' ;
	$isActive = isset($_GET['active']) ? '' : 'active' ;
?>

@extends('layouts.app')

@section('title')
	Account 
@endsection

@section('content')
@include('include.menu')

<div class="spacing"></div>
<div class="container">
<div class="row">
	@if (session('message'))			
		<div class="col-md-12">
		    <div class="alert alert-info no-bg" >
				<strong><i class="fa fa-check"></i>
					{{session('message')}}
				</strong>
			</div>
		</div>			
	@endif	

	@if (session('messagep'))			
		<div class="col-md-12">
		    <div class="alert alert-info no-bg" >
				<strong><i class="fa fa-check"></i>
					{{session('messagep')}}
				</strong>
			</div>
		</div>			
	@endif	
	@if (count($errors) > 0)
		<div class="col-md-12">
			<div class="alert alert-info alert-success" style="background-color: none; ">
				<strong>Whoops!</strong> There were some problems with your input.<br><br>
				<ul>
					@foreach ($errors->all() as $error)
						<li>{{ $error }}</li>
					@endforeach
				</ul>
			</div>
		</div>
	@endif
</div>

<div class="row">
    <div class="col-md-12">	
        <div class="col-md-3">
        	<div class="row">
	            <ul class="nav nav-pills nav-stacked ">
				    <li class=" {{ $active == 'profile' ? 'active' : '' }} {{ $isActive }}"><a data-toggle="pill" href="#home"><span class="fa fa-user"></span>  Your Account</a></li>
				    <li class=" {{ $active == 'order' ? 'active' : '' }}"><a data-toggle="pill" href="#menu1"> <span class="fa fa-qrcode"></span>  Your Order</a></li>
				    <li><a data-toggle="pill" href="#menu2"> <span class="fa fa-unlock"></span>  Change Password</a></li>			    
				</ul>
			</div>
        </div>

       <div class="tab-content" >
			<div id="home" class="tab-pane  {{ $active == 'profile' ? 'active' : '' }} {{ $isActive }}" style="padding: 0;" >
				<div class="panel panel-info" >
	                <div class="panel-heading">
	                    <h3 class="panel-title">Profile</h3>
	                </div>
	                <div class="panel-body row">
	                	<div class="row">
		                   	<div class=" col-md-12 ">
			         		    <form class="form-horizontal" method="post" action="{{route('doAccount')}}">
			         				{{ csrf_field() }}
			         				  <input type="hidden" name="id" value="{{ Auth::user()->id }}"  />
					                <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
						                <div class="panel-body">
						                    <div class="row">
						                    	<div class="col-md-4 col-xs-12 ">
							                    	<div class="form-group {{$errors->first('first_name') ? 'has-error' : ''}} ">
							                        	<div class="col-md-12 col-xs-12">
								                            <strong class="control-label" for="first_name">First Name</strong>
								                            <input type="text" name="first_name" class="form-control" value="{{Auth::user()->first_name }}"  />
							                            </div>
							                        </div>
						                        </div>
						                       
						                        <div class="col-md-4 col-xs-12 ">
							                        <div class="form-group {{$errors->first('last_name') ? 'has-error' : ''}}">
							                        	<div class="col-md-12 col-xs-12 ">
								                          	<strong class="control-label" for="last_name">Last Name</strong>
								                            <input type="text" name="last_name" class="form-control" value="{{ Auth::user()->last_name }}" />
							                            </div>
							                        </div>
						                        </div>
						                    </div>
						                    <div class="form-group {{$errors->first('nation') ? 'has-error' : ''}}">
						                        <div class="col-md-12"><strong class="control-label" for="nation">Nationality</strong></div>
						                        <div class="col-md-12">
						                            <input type="text" class="form-control" name="nation" value="{{ Auth::user()->nationality }}" />
						                        </div>
						                    </div>
						                    <div class="row">
						                   		<div class="col-md-6 col-xs-12 ">
							                        <div class="form-group {{$errors->first('passport_number') ? 'has-error' : ''}}">
							                        	<div class="col-md-12 col-xs-12 ">
								                            <strong class="control-label" for="inputError">Passport Number</strong>
								                            <input onkeyup="checkInp()" type="type" name="passport_number" class="form-control" value="{{ Auth::user()->passport }}" />
							                            </div>
							                        </div>
						                        </div>	 
						                        <div class="col-md-6 col-xs-12 ">
							                        <div class="form-group {{$errors->first('expiry_date') ? 'has-error' : ''}}">
							                        	<div class="col-md-12 col-xs-12 ">
								                          	<strong class="control-label" for="inputError">Expiry Date</strong>
								                            <input type="text" name="expiry_date" class="form-control" value="{{ Auth::user()->expiry_date }}" id="expiry_date"/>
							                            </div>
							                        </div>
						                        </div>
						                    </div>	
						                    <div class="form-group {{$errors->first('address_street') ? 'has-error' : ''}}">
						                        <div class="col-md-12"><strong class="control-label" for="inputError">Address Street</strong></div>
						                        <div class="col-md-12">
						                            <input type="text" name="address_street" class="form-control" value="{{ Auth::user()->address }}" />
						                        </div>
						                    </div>
						                    <div class="row">
						                    	<div class="col-md-6 col-xs-12 ">
							                        <div class="form-group {{$errors->first('town_city') ? 'has-error' : ''}}">
							                        	<div class="col-md-12 col-xs-12 ">
								                          	<strong class="control-label" for="inputError">Town / City</strong>
								                            <input type="text" name="town_city" class="form-control" value="{{Auth::user()->province->province_name}}" />
							                            </div>
							                        </div>
						                        </div>
						                        <div class="col-md-6 col-xs-12 ">
							                        <div class="form-group {{$errors->first('country_state') ? 'has-error':''}}">
							                        	<div class="col-md-12 col-xs-12 ">
								                          	<strong class="control-label" for="inputError">Country / State</strong>
								                          	<input type="text" name="country_state" class="form-control" value="{{ User::getUser()->country_state }}" />								                          
								                          	 	<!-- <select class="form-control" name="country_state"> 
									                        	@foreach(\App\Country::all() as $state)
									                        	<option value="{{$state['country_name']}}" >{{ $state['country_name'] }}</option>
									                        	@endforeach 
									                        </select>	 -->
							                            </div>
							                        </div>
						                        </div>
						                    </div>
						                    <div class="form-group">
						                        <div class="col-md-12"><strong > Zip / Postal Code</strong></div>
						                        <div class="col-md-12">
						                            <input type="text" name="zip_code" class="form-control" value="{{ User::getUser()->zip_code }}" />
						                        </div>
						                    </div>
						                    <div class="form-group {{$errors->first('phone_number') ? 'has-error' : ''}}">
						                        <div class="col-md-12"><strong class="control-label" for="inputError">Phone Number</strong></div>
						                        <div class="col-md-12"><input type="text" name="phone_number" class="form-control" value="{{ User::getUser()->phone_number }}" /></div>
						                    </div>
						                    <div class="form-group {{$errors->first('email') ? 'has-error' : ''}} {{ session('message') ? 'has-error' : ''}}">
						                        <div class="col-md-12"><strong class="control-label" for="inputError">Email Address</strong></div>
						                        <div class="col-md-12"><input type="email" name="email" class="form-control" value="{{ User::getUser()->email }}"/></div>
						                    </div>
						                   
						                    <div class="form-group">
						                        <div class="col-md-6 col-sm-6 col-xs-12">
						                            <button type="submit" class="w3-btn w3-blue btn-submit-fix">Change </button>
						                        </div>
						                    </div>
						                </div>
						            </div>
						        </form>
					        </div>
					    </div>
	                </div>
	            </div>
			</div>
			<div id="menu1" class="tab-pane {{ $active == 'order' ? 'active' : '' }}" style="padding: 0;" >
				<div class="panel panel-info" >
		            <div class="panel-heading">
		                <h3 class="panel-title">Your Purchased Invoice</h3>
		            </div>
		            <div class="panel-body row">
		                <div class="w3-container">
		                @if(\App\Invoice::Where('customer_id', User::getUser()->id)->count() > 0)
							<table class="w3-table w3-striped">
							    <tr>
							      <th>Invoice No.</th>
							      <th>Date</th>
							      <th>Total Amount</th>
							    </tr>

							    @foreach(\App\Invoice::Where('customer_id', User::getUser()->id)->get() as $inv)
							    	<tr>
							    		<td><a target="_blank" href="/inovice?inv_id={{ $inv['invoice_number'] }}"># {{ $inv['invoice_number'] }}</a></td>
							    		<td>{{ date('d/m/Y', strtotime($inv['created_at'])) }}</td>
							    		<td>${{ number_format($inv['amount'], 2) }}</td>
							    	</tr>
							    @endforeach						    
							</table>
						@else

							<div class="col-md-12">
								<span> Your Invoice is empty <span class="fa fa-info-circle"></span></span>
							</div>
						@endif
						</div>
		            </div>
		        </div>				
			</div>
			<div id="menu2" class="tab-pane" style="padding: 0;" >
				<form action="{{ route('edit.password') }}" method="post">     
	            	{{ csrf_field() }}  
	            	<input type="hidden" name="email" value="{{ User::getUser()->email }}"  />
	                <div class="panel panel-info" >
	                    <div class="panel-heading">
	                        <h3 class="panel-title">Change Password</h3>
	                    </div>
	                    <div class="panel-body row">
	                    	<div class="col-md-12">
		                        <div class="row">
	                                <div class="col-md-12">
	                                    <div class="form-group">
	                                        <label class="control-label" for="email">Current Password</label>
	                                        <input type="text"  class="form-control input-md" value="{{Auth::user()->password_text}}" readonly="">
	                                    </div>
	                                </div>                               
	                                <div class="col-md-12">
	                                    <div class="form-group">
	                                        <label class="control-label" for="date">New Password</label>
	                                        <input name="new_password" type="password" class="form-control input-md" >
	                                    </div>
	                                </div>

	                                <div class="col-md-12">
	                                    <div class="form-group">
	                                        <label class="control-label" for="date">Re-New Password</label>
	                                        <input name="re_new_password" type="password"  class="form-control input-md" >
	                                    </div>
	                                </div>
	                              
	                                <div class="col-md-12">
	                                    <div class="form-group">
	                                        <button   class="w3-btn w3-blue btn-submit-fix">Change Password</button>
	                                    </div>
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
</div>
<div class="spacing"></div>
<div class="spacing"></div>
<script type="text/javascript">
	$(document).ready(function(){

        var navItems = $('.admin-menu li > a');
        var navListItems = $('.admin-menu li');
        var allWells = $('.admin-content');
        var allWellsExceptFirst = $('.admin-content:not(:first)');
        allWellsExceptFirst.hide();
        navItems.click(function(e)
        {
            e.preventDefault();
            navListItems.removeClass('active');
            $(this).closest('li').addClass('active');
            allWells.hide();
            var target = $(this).attr('data-target-id');
            $('#' + target).show();
        });
    });
</script>


<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>

<script>
	$(document).ready(function(){
		var nowTemp = new Date();
		var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);
		var to = $('#expiry_date').datepicker({
		  onRender: function(date) {
		    return date.valueOf() <= now.date.valueOf() ? 'disabled' : '';
		  }
		}).on('changeDate', function(ev) {
		  to.hide();
		}).data('datepicker');
	});
</script>
@endsection

