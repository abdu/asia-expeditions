@extends('layouts.app')
@section('title')
	{{$pro->province_name}} Destination 
@endsection
@section('description')
	{!! strip_tags($pro->province_intro) !!}
@endsection
@section('content')
<?php $countryId = $count['id']; ?>
@include('include.menu')
@include('include.slide')
<?php $tourLink = $getTourByProvince; ?>
<div class="container" >
	
	<div class="col-md-12" >
		<div class="spacing"></div>
		<b><h2 align="center"><b>Welcome to {{$pro['province_name']}}</b></h2></b>
		<p style="text-align: justify;"> <?php echo html_entity_decode($pro['province_intro']); ?></p>
	</div>
	<div class="clear"></div>
	<div class="spacing"></div>
		<div class="col-md-12">
		@if($getTourByProvince->count() >0)
		<div class="title text-center"><h2 style="text-transform: uppercase;"><b>POPULAR PLACES IN {{$pro->province_name}}</b></h2>
		</div>            
	
            @include('include.item_slide')
            
        @endif
    	</div>
	</div>
	<div class="clear"></div>
	<div class="spacing"></div><div class="spacing"></div>
	<div class="clear"></div>
</div>
</div>
</div>



@endsection