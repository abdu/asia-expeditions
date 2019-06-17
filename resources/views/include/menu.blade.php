<?php
	use App\Cart;
	use App\User;
	use App\components\Shared;
?>
	
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
								@if(Auth::check())
								<li class="w3-dropdown-hover h" style="padding: 8px 3px; float: left; width: 36px;">
									<img style="position: relative;top: -2px;" width="29px" height="29px" src="{{Shared::getInstance()->urlResource(Auth::user()->picture, Auth::user()->id)}}" class="img-circle">
								@else
								<li class="w3-dropdown-hover" style="padding: 6px 12px; float: left;">
						  			<span style="background: #fecc24;padding: 3px 7px;border-radius: 50%;color: white; font-size: 19px;">
						  				<a style="color: #ffff;" href="{{route('register')}}"><i class="fa fa-user" ></i></a>
						  			</span>	
						  			@endif
						  			@if(Auth::check())
							  			<ul class="w3-dropdown-content w3-bar-block" style=" transition:1s;text-transform: capitalize; padding-top: 25px; top: 42px; margin-right: -1000px;">
											<li class="list-unstyled"><a class="col-md-12  w3-padding" href="{{route('account')}}">Account Info</a></li>
											<li class="list-unstyled"><a class="col-md-12  w3-padding" href="{{route('logout')}}">Bookings</a></li>
											<div class="clearfix"></div>
											<hr style="margin-bottom: 6px;">
											<li class="list-unstyled"><a class="col-md-12  w3-padding" href="{{route('logout')}}">Sign out</a></li>
							  			</ul>
						  			@endif
								</li>

								<li class="w3-dropdown-hover" style="padding: 2px 11px; float: left;">
									<span>
										<a href="{{route('getCart')}}">
										<span class="fa fa-shopping-cart " style="padding: 5px 7px; border-radius: 50%; font-size: 28px; color: #fecc24;"></span>
										<span style="position: absolute;top: 3px;color: white;background: #c71313;border-radius: 50%;padding: 0px 6px;right: 7px;font-size: 11px;font-weight: 700;box-shadow: 0 0 2px 0px #000;">{{Cart::totalCartQty()}}</span>
										</a>
									</span>
						        </li>
					        </ul>
					    </span>
			  		</div> 
			  		<div class="clearfix"></div>
		  	</div>
	  	</div>
  	</div>
</div>
<div style="height: 127px;"></div>
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
					
					<li class="dropdown des">
			          	<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Destinations <span class="caret"></span></a>
				           @widget('DestinationMenu')
			        </li>		
			        <li><a href="/general-information?active=visa-information">General Information</a></li>
			        <li class="dropdown hol">
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


