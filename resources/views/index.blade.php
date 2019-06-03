@extends('layouts.app')
@section('title')
Asia Expeditions - Destination Management Travel and Tours to Myanmar, Cambodia, Vietnam, Laos & Thailand
@endsection

@section('keywords')
Asia, Asia Expeditions, MICE,
Destination Management Company, DMC, Travel and Tours, Myanmar, Cambodia, Laos, Veitnam, Thailand, Travel Agency, Golf, M.I.C.E, Mice, Cambodia Culinary Tour, Cambodia Water Festival, 
@endsection

@section('description')
Asia Expeditions , Myanmar & Indochina – Destination Management Company is formed in 2006 by Esther and Win Zaw who passionate about traveling, and
@endsection
<?php
	$countryId = 0;
	use App\components\Shared;
	use \App\Country;
	$tourOne = \App\Tour::where('id', 1013)->first();
?>

@section('content')
@include('include.menu')

@include('include.slide')

<!-- <div class="container"> -->
<div class="col-md-12" style="background-color: white;">	
	<div class="container">
		<div class="spacing"></div>
		<div class="col-md-8 col-xs-12">
		<div><b style="font-size: 36px;">WELCOME</b></div>
		<address style="text-align: justify;">
			<h1 style="font-size:15px"><b style="font-size: 35px;">A</b><b>sia Expeditions Destination Management Company, DMC. Travel and Tours, Myanmar, Cambodia, Vietnam, Laos & Thailand.</b></h1>
			<p>Asia Expeditions was formed in 2006 by Esther and Win Zaw who are both passionate about travelling. The company was set up to serve the needs of travel connoisseurs throughout the world and to help these travellers enjoy the best South East Asian holiday experiences.</p>
			<p>Asia Expeditions has a comprehensive selection of holidays on offer, ranging from group tours all the way to individual tailor made packages, golf in Asia, M.I.C.E., Family Holidays, Honeymoons, River Cruises, Golf and more!. All our holidays have one thing in common – they are of the highest quality. Our success is credited to an experienced team of staff dedicated to providing the best service and support to all of our clients, partners, exhibitors, visitors, speakers and delegates. </p>
			<p>We work closely with key government departments, hotels, exhibition venues, embassies, associations and local institutions to ensure that the events and regional visits contribute a positive impact to the related industries and the countries themselves. </p>
			<p>We hope that this gives you an introduction to what Asia Expeditions has to offer. We now have our <a target="_blank" href="{{route('tourDetails', $tourOne->slug)}}">Cambodia Culinary Tour</a> with guaranteed departure in Cambodia. Please visit the rest of our website for more information about your holidays and how to book them. Please email us for more advice about setting up your perfect getaway to Myanmar, Cambodia, Vietnam, Laos and Thailand.</p>
			<p>We wish you were here!</p>
		</address>
		@foreach(Country::getDestination(1) as  $con)
			<a target="_blank" href="{{route('destination', [$con->country_slug,''])}}">{{$con->country_name}}</a> | 	
		@endforeach			
	</div>
		<div class="col-md-4 col-xs-12">
			<br><br><br>
			<b><h3 style="margin-bottom: 6px;"><b>Guaranteed Tours</b></h3></b>
			<ul class="list-unstyled" style="padding-left: 0px;">
				@foreach(\App\Tour::where(['tour_type'=>35, 'web'=>1])->orderBy('id', 'DESC')->take(6)->get() as $new)
					<li style="width: 100%; font-size: 110%;" class=" w3-padding-small">
						<div><i class="fa fa-arrow-circle-right"></i>
						<a target="_blank" href="{{route('tourDetails', ['url'=> $new->slug])}}"> {!! str_limit($new['tour_name'], 37) !!}</a>
						</div>
					</li>
				@endforeach
				<li class="divider"></li>			
			</ul>
			<p>All arrangements and logistics for this BBC program were by Asia Expeditions.</p>
			<div class="add" style="text-align: center;">			
		        <div  class="videoFrame stimg" style="height: 211px;"></div>
		    	<img class="videoFrame " width="360" height="210" src="https://img.youtube.com/vi/A6I5nHqkGiw/maxresdefault.jpg" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen  class="img-responsive img-box img-thumbnail"> 	
		   </div>
		</div>
	</div>
	<div class="spacing"></div>
</div>
<div class="container">		
	<div class="col-md-12">	
		<?php  $tourLink = \App\Tour::getTourBycount();  ?>
	        @if($tourLink->count() > 0)
	      		<div class="title text-center"><h2><b>POPULETION TOURS</b></h2></div>
					@include('include.item_slide')
			@endif
	</div>
	<div class="clearfix"></div>
	<div class="spacing"></div>
	<div class="col-md-12">	
		<?php $tourLink = \App\Tour::where([['post_type','=', 0],['tour_type','=', 35 ], ['web','=', 1]])
									->orderBy('id', 'desc')->take(30)->get(); ?>
			@if($tourLink->count() > 0)
		      	<div class="title text-center"><h2><b>DISCOVER OUR UNIQUE EXPERIENCES</b></h2></div>								    	
				@include('include.item_slide')						
			@endif
	</div>
	<div class="clearfix"></div>
	<div class="spacing"></div>
	<div class="col-md-12">	
		<?php  $tourLink = \App\Tour::where([['post_type','=', 0],['tour_type','=', 26 ], ['web','=', 1]])->orderBy('id', 'desc')->take(30)->get(); ?>
	        @if($tourLink->count() > 0)
	      	<div class="title text-center"><h2><b>TAKE A LOOK AT OUR EXCURSION</b></h2></div>
				@include('include.item_slide')
		
			@endif
	</div>
	<div class="clearfix"></div>
	<div class="spacing"></div>
</div>
	<div class="col-md-12" style="background-color: white;">
		<div class="container">
			<div class="row">
				<p><h2><b>WHY CHOOSE US?</b></h2></p>
				<div class="col-md-4 col-xs-12">
					<div class="path_icon pull-left">
						<i class="glyphicon glyphicon-usd icon-shap"></i>
					</div>
					<div class="path_text pull-left" style="width: 75%;">
						<h4 style="font-weight: 500;">Value for Money</h4>
						<p style="text-align: justify;">Our unique experiences are available for fantastic value.</p>
					</div>
				</div>
				<div class="col-md-4 col-xs-12">
					<div class="path_icon pull-left">				
						<i class="fa fa-ticket icon-shap"></i>
					</div>
					<div class="path_text pull-left" style="width: 75%;">
						<h4 style="font-weight: 500;">Authentic and Unique Experiences</h4>
						<p style="text-align: justify;">Designed by our experts to showcase the best of a destination.</p>
					</div>
				</div>
				<div class="col-md-4 col-xs-12">
					<div class="path_icon pull-left">
						<i class="fa fa-sitemap icon-shap"></i>
					</div>
					<div class="path_text pull-left" style="width: 75%;">
						<h4 style="font-weight: 500;"> Working Relationships</h4>
						<p style="text-align: justify;">We have long-standing relationships with regional airlines, hotels and experience local tour guides.</p>
					</div>
				</div>
				<div class="col-md-4 col-xs-12">
					<div class="path_icon pull-left">
						<i class="glyphicon glyphicon-globe icon-shap"></i>
					</div>
					<div class="path_text pull-left" style="width: 75%;">
						<h4 style="font-weight: 500;">Asia Expeditions provides a personalized service</h4>
						<p style="text-align: justify;">We are a full service Destination Management Company with personalize services that covers all tours, events planning and management. Locally owned and managed in each destination we operate in.</p>
					</div>	
				</div>
				<div class="col-md-4 col-xs-12">
					<div class="path_icon pull-left">
						<i class="glyphicon glyphicon-lock icon-shap" ></i>
					</div>
					<div class="path_text pull-left" style="width: 75%;">
						<h4 style="font-weight: 500;">Full Protected</h4>
						<p style="text-align: justify;">	
						Full Protected
						Asia Expeditions is fully licensed under the Ministry of Tourism. Also a member of Cambodia Association of Travel Agents and Union of Myanmar Travel Association that brings us to a status of trusted experienced company with approved level of service.</p>
					</div>
				</div>
				<div class="col-md-4 col-xs-12">
					<div class="path_icon pull-left">
						<i class="fa fa-comments icon-shap"></i>
					</div>
					<div class="path_text pull-left" style="width: 75%;">
						<h4 style="font-weight: 500;">A responsible Tourism</h4>
						<p style="text-align: justify;">As a locally owned and operated company we are aiming at support for the countries economics and guiding tourists to put their attention on opportunities, problems and different ways to help them in their developments.</p>
					</div>
				</div>
			</div>
		</div>
		<div class="clear"></div>
		<div class="spacing"></div>	
</div>
<script type="text/javascript">
	$(document).ready(function(){  
        $(".videoFrame").click(function(){
	      	$(".videoFrame").remove();
	        $('.add').append('<iframe  width="360" height="210" src="https://www.youtube.com/embed/A6I5nHqkGiw?start=11&controls=0&autoplay=1"></iframe>');
        });
    });
</script>


@endsection
