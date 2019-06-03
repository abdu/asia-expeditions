@extends('layouts.app')

@section('title')
	Site Map
@endsection
<?php $countryId  = '';
use \App\Country;

?>
@section('content')
@include('include.menu')

<div class="container">
	<div class="row">
		<div class="col-sm-12 col-sm-offset-1">
            <h3>Pages:</h3>
    	    <ul>
                <li><a href="https://asia-expeditions.com/"><strong>Home</strong></a></li>   
                <li><a href="javascript:void(0)"><strong>Destination</strong></a></li>
                	<ul>
                        @foreach(Country::getDestination(1) as $con)
                            <li><a href="{{url('/')}}/destination/{{$con->country_slug}}">{{$con->country_name}}</a></li>    
                        @endforeach
                	
                	</ul>
                <li><a href="https://asia-expeditions.com/general-information"><strong>General Information</strong></a></li>
            	<ul>
            		<li><a href="{{url('/')}}/general-information">Visa Information</a></li>
            		<li><a href="{{url('/')}}/general-information"> About Us</a></li>
            		<li><a href="{{url('/')}}/general-information">Travel Tips</a></li>
            		<li><a href="{{url('/')}}/general-information?active=terms-conditions">Team & Conditions</a></li>
            		<li><a href="{{url('/')}}/general-information">Why Us?</a></li>
            		<li><a href="{{url('/')}}/general-information">Public Holiday</a></li>
            		<li><a href="{{url('/')}}/ourteam">Our Team</a></li>
            	</ul>
                <li><a href="https://asia-expeditions.com/general-information"><strong>Holiday Types</strong></a></li>
            	<ul>
            		<li><a href="https://asia-expeditions.com/mice">M.I.C.E</a></li>
            		@foreach(\App\HolidayType::where('web' , 1)->orderBy('id')->get() as $type)
                        <li><a href="{{url('/')}}/category/{{$type->slug}}">{{$type->name}}</a></li>
                    @endforeach            		
            	</ul>
              	<li><a href="https://asia-expeditions.com/contactus"><strong>Contact Us</strong></a></li>
              	<li><a href="https://asia-expeditions.com/ournews"><strong>Our News</strong></a></li>
              	<li><a href="javascript:void(0)"><strong>Tours </strong></a></li>
              	<ul>
                  	@foreach(App\Tour::where('web', 1)->get() as $tour)
                		<li><a href="{{url('tour',[ 'tour_id' => $tour->tour_slug ])}}">{{$tour['tour_name']}}</a></li>
                	@endforeach
            	</ul>
    	    </ul>   
		</div>
	</div>
</div>

@endsection