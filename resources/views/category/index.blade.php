@extends('layouts.app')
@section('title', $category->business_name.' Cambodia, Laos, Myanmar, Thailand, Vietnam')
@section('keywords', $category->meta_keyword)
@section('description', $category->meta_description)
<?php
	$countryId = '';
  use App\components\Shared;
?>
@section('content')
@include('include.menu')
    <div class="container-fluid" style="background-color:#e8e8e8">
        <div class="container" id="property-listings">
            <div class="col-md-12">
          <h1 class="product-title breadcrumb" style="text-transform: uppercase;background: #227eac;border: solid 1px #9E9E9E;box-shadow: 0px 0px 0px 0px;color: white;padding: 12px 0px 12px 12px;">{{$category['name']}}</h1>
                @if($category->description)
                  <div class="breadcrumb">
                    {!! $category->description !!}
                  </div>
                @endif
            </div>             
            @if($catTour)
             		@foreach( $catTour as $tour )
                    <div class="col-sm-12 btm-mrg-20">
                        <div class="bgc-fff box-shad ">
                            <div class="media ">
                              <div class="col-sm-4">
                                <div class="row">
                                  <a style="padding-left: 0px;" class="img-card" href="{{route('tourDetails', ['url'=> $tour->slug])}}" target="_parent">
                                    <img class="img-responsive lazy" data-src="{{Shared::getInstance()->urlResource($tour->tour_photo, $tour->user_id) }}">
                                  </a>
                                </div>
                              </div>
                              <div class="col-sm-8 pad-10">
                                <h3 class="text-danger" style="margin-top: 0px;">
                                  <span style="color:#fd00ff; "><b>$</b></span><b>{{$tour->tour_price}}</b> <small> Per Person</small>
                                </h3>
                                <div>
                                <a href="javascript:void(0)">
                                    <span style="color: #223da5;"> 
                                      <i style="font-size: 18px;" class="fa fa-clock-o"></i> {{$tour->tour_daynight}} 
                                    </span>
                                </a>
                                </div>
                                <div>
                                <a href="{{route('tourDetails', ['url'=> $tour->slug])}}" target="_parent"><b style="font-size: 1em;">{{$tour->tour_name}}</b></a>
                                </div>
                                <small class="fnt-smaller">{!! str_limit(strip_tags($tour->tour_intro),130) !!}</small>
                              </div>                                
                              <div class="pull-right" style="position: absolute;right: 19px; bottom: 5px;">
                                <a href="{{route('tourDetails', ['url'=> $tour->slug])}}" class=" w3-btn w3-white w3-border w3-border-green w3-round-xlarge">View Detail</a>
                              </div>                                
                            </div>
                        </div>
                    </div>
               	@endforeach

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