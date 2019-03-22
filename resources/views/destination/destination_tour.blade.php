@extends('layouts.app')
@section('title')
	{{$pro->province_name}} Destination 
@endsection
@section('description')
	{!! $pro->province_intro !!}
@endsection
@section('content')
<?php $countryId = $count['country_id']; ?>
@include('include.menu')
@include('include.slide')
<div class="container" >
	
	<div class="col-md-6" >
		<div class="spacing"></div>
		<b><h2 align="center"><b>Welcome to {{$pro['province_name']}}</b></h2></b>
		<p style="text-align: justify;"> <?php echo html_entity_decode($pro['province_intro']); ?></p>
	</div>
	<div class="clear"></div>
	<div class="spacing"></div>
	<div class="col-md-12">
		<div class="title text-center"><h2 style="text-transform: uppercase;"><b>POPULAR PLACES IN {{$pro['province_name']}}</b></h2></div>
            
		      <div class="row">   
                <div class="col-md-12">            
                    <div id="carousel-example" class="carousel slide " data-ride="carousel">
                        <div class="carousel-inner">
                        @foreach($getTourByProvince->chunk(3) as $key => $getTourChunk)
                            <div class="item  {{$key == 0 ? 'active' : ''}}"> 
                                <div class="row">
                                @foreach($getTourChunk as $tour)
                                    @include('include.item')
                                @endforeach
                                </div>
                            </div>  
                        @endforeach                
                        </div>
                    </div>
                </div>
            </div>
    	</div>
	</div>
	<div class="clear"></div>
	<div class="spacing"></div><div class="spacing"></div>
	<div class="clear"></div>
</div>
</div>
</div>



@endsection