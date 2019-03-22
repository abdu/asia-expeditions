@extends('layouts.app')



@section('title')

	Our News

@endsection



@section('content')

@include('include.menu')
<?php
    use App\components\Shared;
?>
<div class="container">
	<div class="row"> 
		<div class="col-md-12">
			<h1 class="product-title breadcrumb" style="text-transform: uppercase; background: #227eac;border: solid 1px #9E9E9E;box-shadow: 0px 0px 0px 0px;color: white;padding: 12px 0px 12px 12px;">Our News</h1>
		</div>
		
		@foreach($news as $newss)
            <div class="col-xs-12 col-sm-12 col-md-12">	            	
                <div class="list-group">	                
                    <div class="list-group-item">
                    	<div class="col-md-4">
                    		<div class="row">
			                    <div class="row-picture">
				                    <a class="img-card" href="{{route('DetailNew', $newss->slug)}}">
					                    <img class="lazy" data-src="{{Shared::getInstance()->urlResource($newss['tour_photo'], $newss->user_id)}}" class="img-responsive img-box img-thumbnail">
					                </a>
					            </div>
				            </div>
			            </div>	  
                        <div class="col-md-8">
                        	<h3 style="font-size: 18px;"><a href="{{route('DetailNew', $newss->slug)}}">{{$newss['tour_name']}}</a></p></h3>
                            <small>
                                <i class="glyphicon glyphicon-time"></i> {{date('Y-F-d',strtotime($newss['created_at']))}} <span class="twitter"></span>
                                <br>
                            </small>
                            <div>
                            	<p>{!! str_limit(strip_tags($newss['tour_desc']),300) !!}</p>
                            </div>
                        	<div class="pull-right">
                        		<a href="{{route('DetailNew', $newss->slug)}}" class=" w3-btn w3-white w3-border w3-border-green w3-round-xlarge"> Read More >></a>
                        	</div>
                        	<div class="clearfix"></div>
                        </div>
                        <div class="clearfix"></div>

                    </div>

                </div>

            </div> 

	    @endforeach

	    <div class="col-xs-12 col-sm-12 col-md-12">	 

		    <center>

		    	{{$news->links()}}

		    </center>

	    </div>

    </div>

</div>



@endsection