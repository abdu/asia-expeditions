@extends('layouts.app')
@section('title', 'M.I.C.E')
@section('keywords', 'Meeting, Incentives, Convention, Events, M.I.C.E')
@section('description', 'M.I.C.E, MICE, Cambodia, Laos, Myanmar, Thailand, Vietnam')
@section('content')
<?php 
	$countryId = '';
?>
@include('include.menu')
@include('include.slide')
<div class="container">
	<div class="row">
        <div class="col-md-12">
            <!-- Nav tabs -->
            <div class="card">
	            <ul class="nav nav-tabs" role="tablist">	             
	                @foreach(\App\Setting::where('type', 2)->get() as $key=>$set)
	                	<li class="{{$key == 0 ? 'active': ''}}"><a href="{{route('miceName', ['url'=> $set->slug])}}">{{$set->title}}</a></li>
	                @endforeach
	            </ul>
	            <!-- Tab panes -->
	            <div class="tab-content">
	            	@foreach(\App\Setting::where('type', 2)->get() as $key=> $set)
	                	<div role="tabpanel" class="tab-pane {{$key == 0 ? 'active': ''}}">
							{!! $set->details !!}
						</div>
	                @endforeach
	            </div>
			</div>
        </div>
	</div>
</div>
@endsection