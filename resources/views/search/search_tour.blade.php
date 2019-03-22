@extends('layouts.app')
@section('title', 'Search Result'.$result)
@section('keywords', $result)
@section('description', 'Description about'.$result)
@section('content')
<?php
  $countryId = '';
  use App\components\Shared;
?>
@section('content')
@include('include.menu')
    <div class="container-fluid" style="background-color:#e8e8e8">
        <div class="container" id="property-listings">
            <div class="row">
              <div class="col-sm-12"> 
                <h1 class="product-title" style="text-transform: capitalize; background: #227eac;border: solid 1px #9E9E9E;box-shadow: 0px 0px 0px 0px;color: white; padding: 12px 0px 12px 0px;">
                    <span>Result for "{{$result}}"</span>
                </h1>
              </div>
            @if($tours->count() > 0 )	
         		    @foreach($tours as $key => $tour )
                  <div class="col-sm-12">                    
                      <div class="brdr bgc-fff pad-10 box-shad btm-mrg-20 property-listing">
                          <div class="media row">
                            <div class="col-sm-4">
                              <a style="padding-left: 0px;" class="img-card" href="{{route('tourDetails', ['url'=> $tour->slug])}}">
                              	<img class="img-responsive lazy" data-src="{{Shared::getInstance()->urlResource($tour->tour_photo, $tour->user_id)}}">
                              </a>
                            </div>
                            <div class="clearfix visible-sm"></div>
                              <div class="col-md-8 col-sm-12">
                                <h3 class="text-danger">
                                  <span style="color:#fd00ff;"><b>${{$tour['tour_price']}}</b><small> Per Person</small></h3>
                                <a href="javascript:void(0)">
                                  <span style="color: #223da5;"> 
                                    <i style="font-size: 18px; margin-top: 12px;" class="fa fa-clock-o"></i> {{$tour->tour_daynight}} 
                                  </span>
                                </a>
                                <a href="{{route('tourDetails', ['url'=> $tour->slug])}}" ><h4>{{ $tour->tour_name }}</h4></a>
                                  @if($tour->tour_intro)
                                    {!! str_limit(strip_tags($tour->tour_intro),130) !!}
                                  @endif
                              </div>
                              <div class="col-md-8 col-sm-12">
                                <div class="pull-right">
                                	<a href="{{route('tourDetails', ['url'=> $tour->slug])}}" class="w3-btn w3-white w3-border w3-border-green w3-round-xlarge">View Detail</a>
                                </div>
                              </div>
                          </div>
                  	   </div>
                  </div><!-- End Col -->
             	@endforeach
                <div class="col-md-9">
                  <span>{{$tours->links()}}</span>
                </div>
            @else
            <div class="col-md-12">
             	  <div class="alert alert-info" role="alert">
                    <h3>The result has no tour!</h3>
                </div>		
            </div>
        @endif
        </div><!-- End container -->
    </div>
</div>

@endsection