<?php use App\components\Shared; ?>

@if($tourLink->count() > 3)
	<div class="row">                 
	    <section class="wow fadeInUp" >
	    	<div class="container">                          
		        <div class="owl-carousel clients-carousel" style="height: auto;">
		            @foreach($tourLink as  $tour)
						<div class="col-sm-12">
						    <span class="thumbnail text-center">
						        <a class="img-card" href="{{route('tourDetails', ['url'=> $tour->slug])}}">
						           <img class="lazy" data-src="{{Shared::getInstance()->urlResource($tour->tour_photo, $tour->user_id)}}"/>
						        </a>
						        <a href="javascript:void(0)">
						        	<span style="color: #223da5;"> 
						        		<i style="font-size: 18px; margin-top: 12px;" class="fa fa-clock-o"></i> {{$tour->tour_daynight}} 
						        	</span>
						        </a>
						        <h3 class="text-danger"> <b>${{Shared::money($tour->tour_price)}}</b> <small>Per Person</small></h3>
						        <a href="{{route('tourDetails', ['url'=> $tour->slug])}}" >
						            <p><b>{!! str_limit($tour->tour_name,120) !!}</b></p>
						        </a>						        
						        <hr class="line">
						        <div class="row">
						            <div class="col-md-12 col-sm-12">
						                <a style="font-weight:100;" href="{{route('tourDetails', ['url'=> $tour->slug])}}" class="w3-btn w3-white w3-border w3-border-green w3-round-xlarge">View Detail</a>
						            </div>                                          
						        </div>
						    </span>
						</div>	           		                      
		        	@endforeach
		    	</div>
	    	</div>
		</section>               
	</div>
@else
	<div class="row">
	    @foreach($tourLink as  $tour)
			<div class="col-sm-4">
			    <span class="thumbnail text-center">
			        <a class="img-card" href="{{route('tourDetails', ['url'=> $tour->slug])}}">
			           <img class="lazy" data-src="{{Shared::getInstance()->urlResource($tour->tour_photo, $tour->user_id)}}"/>
			        </a>
			        <a href="javascript:void(0)">
			        	<span style="color: #223da5;"> 
			        		<i style="font-size: 18px; margin-top: 12px;" class="fa fa-clock-o"></i> {{$tour->tour_daynight}} 
			        	</span>
			        </a>
			        <h3 class="text-danger"> <b>${{Shared::money($tour->tour_price)}}</b> <small>Per Person</small></h3>
			        <a href="{{route('tourDetails', ['url'=> $tour->slug])}}" >
			            <p><b>{!! str_limit($tour->tour_name,120) !!}</b></p>
			        </a>
			        
			        <hr class="line">
			        <div class="row">
			            <div class="col-md-12 col-sm-12">
			                <a style="font-weight:100;" href="{{route('tourDetails', ['url'=> $tour->slug])}}" class="w3-btn w3-white w3-border w3-border-green w3-round-xlarge">View Detail</a>
			            </div>                                          
			        </div>
			    </span>
			</div>
	   	@endforeach           
	</div>
@endif
