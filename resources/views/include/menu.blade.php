<?php
	use App\components\Cart;
	use App\User;
	use App\components\Shared;
?>
	@include('include.message')
	<div class="top"></div>
<div class="col-md-12 header_info ">
	<div class="container">
  		<div class="row">
  			<div class="col-md-12">
  			
			  		<div class="pull-left" style="padding:5px 0px;">
			  			<span class="a_hidden">
			  				<b><i class="fa fa-phone"></i></b> +855 (23) 432 007  &nbsp;&nbsp; 
			  				<a href="/contactus" data-toggle="popover" data-trigger="hover" data-content="Feel free to contact us any time " data-placement="bottom">
			  					<i class="fa fa-envelope"></i>&nbsp;&nbsp;<span>Contact Us</span>
			  				</a>
			  			</span>&nbsp;&nbsp;			
			  			<span>
		                  	<a target="_blank" title="Connected us with Facebook" href="https://www.facebook.com/AsiaExpeditionsDM"><i style="font-size: 1.4em" class="fa fa-facebook-square fa-2x social"></i></a>&nbsp;	
		                  	<a target="_blank" title="Follow us on Twitter" href="https://twitter.com/AsiaExpeditions"><i style="font-size: 1.4em" class="fa fa-twitter-square fa-2x social"></i></a>&nbsp;	
		                  	<a target="_blank" title="Connected us with Goolge Plus" href="https://plus.google.com/+AsiaExpeditionsCoLtdPhnomPenh"><i style="font-size: 1.4em" class="fa fa-google-plus-square fa-2x social"></i></a>&nbsp;
		                  	<a target="_blank" title="Follow us on Instagram" href="https://www.instagram.com/asiaexpeditions/"><i style="font-size: 1.4em" class="fa fa-instagram"></i></a> 
		                </span>
			  		</div>
			  		<div class="pull-left hidden-xs" style="width: 50%;">
			  			<script> 
						  (function() {
						    var cx = '009121093742319436829:33bhdaknhnq';
						    var gcse = document.createElement('script');
						    gcse.type = 'text/javascript';
						    gcse.async = true;
						    gcse.src = 'https://cse.google.com/cse.js?cx=' + cx;
						    var s = document.getElementsByTagName('script')[0];
						    s.parentNode.insertBefore(gcse, s);
						  })();
						</script>
						<gcse:search></gcse:search>
			  		</div>	
			  		<div class="pull-right" style="padding:0px 0px;">
			  			<span class="wrap-shopping-cart">
							<ul class="nav navbar-nav navbar-right" style=" margin: 0;">
								<li class="w3-dropdown-hover u" style="padding: 2px 11px; float: left;">
						  			<span class="fa fa-user u " style="background: #fecc24;
									    padding: 5px 8px;
									    border-radius: 50%;
									    color: white; font-size: 19px; transition: .9s">
									</span>
						  			<ul class="w3-dropdown-content w3-bar-block" style="text-transform: capitalize; ">
						  				<div style=" padding: 10px 0px;">
								          	<div class="col-md-12 w3-padding">
								          		@if( Auth::check())
									          		<a href="{{route('account', ['active'=>'profile'])}}"><span class="fa fa-user"></span>&nbsp;
									          		{{Auth::user()->fullname}}
									          		</a>
								          		@else
								          			<a href="{{route('register')}}"><span class="fa fa-user"></span> 
								          			&nbsp; Your Account
									          		</a>
								          		@endif
								          	</div>
								          	<div class="col-md-12 w3-padding">
								          		<a href="{{route('account', ['active'=>'order'])}}"><span class="fa fa-qrcode"></span> &nbsp; Your Order</a>
								          	</div><div class="clearfix"></div>
								          	<hr style="margin-bottom: 6px;">
									        <div class="col-md-12">
										        <div class="row">
											        @if(Auth::check())
											          	<div class="col-md-12  w3-padding">
												          	<i class="glyphicon glyphicon-log-out"></i> &nbsp;
												          	<a href="{{route('logout')}}"> Sign Out</a>
											          	</div>
											        @else
											          	<div class="col-md-6 w3-padding">
												          	<a href="register">Register</a>
											          	</div>
											          	<div class="col-md-6 w3-padding">
												          	<a href="{{route('register')}}">Login</a>
											          	</div>
											        @endif
										        </div>
										    </div> 
								        </div>
						  			</ul>
								</li>
								<li class="w3-dropdown-hover c" style="padding: 2px 11px; float: left;">
									<span class="fa fa-shopping-cart c" style="background: #fecc24; padding: 5px 7px; border-radius: 50%; font-size: 19px; color: white;transition: .9s">
									</span>
									<ul class="w3-dropdown-content w3-bar-block" role="menu" style="width: 272px; text-transform: capitalize;">
						  			@if(Cart::totalCartQty() > 0)
							        	@foreach(Session::get('cart')->items as $cart)
								          	<div class="row" style=" padding: 8px 0px;">
									          	<div class="col-md-12 w3-padding">
										          	<a href="{{route('tourDetails', $cart['item']['slug'])}}">
										          		<div class="col-xs-3">
										          			<img class="img-responsive" src="{{Shared::getInstance()->urlResource($cart['item']['tour_photo'], $cart['item']['slug'])}}" style="margin-bottom: 0px;">
										          		</div>
										          		<div class="col-xs-5" style="padding-right: 0; padding-left: 0;">
										          			<span style="font-size: 12px;">
											          			{{str_limit($cart['item']['tour_name'],17)}}
										          			</span>
										          		</div>
										          		<div class="col-xs-4" style="text-align: right;">
										          			<span style="background-color: #fecc24;" class="badge">{{$cart['qty']}}</span>
										          		</div>
										          	</a>
									          	</div>
									        </div>
								        @endforeach
								        <hr>
								        <div class="col-md-12">
									        <div class="row">
									          	<div class="col-md-6 col-md-6">
									          		<a href="{{url('shopping-cart')}}" class="btn btn-primary btn-block btn-sm w3-margin-bottom">View Cart</a>
									          	</div>
									          	<div class="col-md-6 col-md-6">
													<a class="btn btn-danger btn-sm btn-block" href="{{url('payment')}}">CHECKOUT</a>
									          	</div>
									        </div>
									    </div>
							        @else
							        	<div class="col-md-12">
									        <div class="row">
									          	<div class="col-md-12 w3-padding-large">
									          		<span> Your Cart empty <span class="fa fa-info-circle"></span></span>
									          	</div>
									        </div>
									    </div>
							        @endif
							        </ul>
						        </li>
					        </ul>
					    </span>
			  		</div> 
			  		<div class="clearfix"></div>
		  	</div>
	  	</div>
  	</div>
</div>
<div style="height: 110px;"></div>
<div class="wrapper-menu">
	<div class="container set_width">
	  	<nav class="navbar navbar">		  	
		    <div class="navbar-header">
		    	<button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".js-navbar-collapse">
					<i class="fa fa-navicon menu-hidden-small"></i>
				</button>
				<a class="navbar-brand" href="{{url('/')}}">
					<img class="img-responsive" src="/img/{{config('app.logo')}}" alt="Asia Expeditions-Myanmar& Indochina" title="Destination Management" width="300px">
				</a>				
			</div>
			<div class="collapse navbar-collapse js-navbar-collapse">
				<ul class="nav navbar-nav navbar-right" style="margin: 17px -19px; padding-left: auto;">
					<!-- <li><a href="/contactus">Contact Us</a></li> -->
					
					<li class="dropdown">
			          	<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Destinations <span class="caret"></span></a>
				           @widget('DestinationMenu')
			        </li>		
			        <li><a href="/general-information?active=visa-information">General Information</a></li>
			        <li class="dropdown">
			          	<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Holiday Types <span class="caret"></span></a>
			          	@widget('HolidayType', ['web' => 1])
			        </li>
		            <li><a href="{{route('getFilm', 'myanmar')}}">Myanmar Film</a></li>
		            <li><a href="/ournews">Our News</a></li>		            
		            <li style="padding: 0 5px;">
		            	<span style="padding-top: 14px; padding-bottom: 14px;" class="action-search"> 
		            		<span class="fa fa-search search-show" style="font-size: 19px; padding-top: 14px; padding-bottom: 14px; cursor: pointer;"> </span>
		            		<span class="glyphicon glyphicon-remove search-hide" style="font-size: 17.6px; display: none;padding-top: 14px; padding-bottom: 14px; cursor: pointer;"> </span>
		            	</span>
		            </li>
				</ul>

				<div class="search-form col-md-6 col-xs-10">
					<form class="form" action="/searchtour" >					
						<div class="form-group input-group">
	                        <input type="text" id="name_of_tour" class="form-control" name="tour_name" placeholder="Search Destination Name ...">
	                        <span class="input-group-btn">
	                            <button class="btn btn-default " type="submit">
	                            	<i style="font-size: 19px;" class="fa fa-search "></i>
	                            </button>
	                        </span>
	                    </div>
                    </form>
				</div>
			</div>
	  	</nav>
	</div>
</div>



