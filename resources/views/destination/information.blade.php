@extends('layouts.app')

@section('title')

	GENERAL INFORMATION

@endsection

<?php $countryId  = ''; ?>
<?php use App\components\Shared; ?>

@section('content')

@include('include.menu')

<div class="container">
	<div class="row">
        <div class="col-md-12">
            <!-- Nav tabs -->
            <div class="card">
	            <ul class="nav nav-tabs" role="tablist">
		            @foreach(\App\Country_facts::where('facts_status', 1)->get() as $key =>  $facts)
		            	<?php 
		            		if (isset($_GET['active'])) {
		            			$active = ( $_GET['active'] == $facts->slug ? 'active' : '');
		            		}else{
		            			$active ='';
		            		}
		            	?>
						<li role="presentation" class="{{ $active }}">
							<a href="#{{ $facts['facts_id'] }}" aria-controls="{{$facts['facts_name']}}" role="tab" data-toggle="tab">{{$facts['facts_name']}}</a>
						</li>
					@endforeach			        	
			        	<li role="presentation"><a href="#ourteam" aria-controls="ourteam" role="tab" data-toggle="tab">Our OurTeam</a>	
			        	</li>
	            </ul>

	            <!-- Tab panes -->

	        	<div class="tab-content">

	           		 @foreach(\App\Country_facts::where('facts_status', 1)->get() as $key =>  $facts)
	            	<?php 
	            		if (isset($_GET['active'])) {
	            			$active = ( $_GET['active'] == $facts->slug ? 'active' : '');
	            		}else{
	            			$active ='';
	            		}
	            	?>
					<div role="tabpanel" class="tab-pane {{ $active }}" id="{{ $facts->facts_id }}">

						{!! $facts->facts_details !!}

					</div>

					@endforeach

					<div role="tabpanel" class="tab-pane " id="ourteam">

					@foreach(\App\OurTeam::where('web', 1)->get() as $team)
			        <?php
			          	$dir = 'http://asia-expeditions.com/userfiles/image/avatar';     

			          	$position =($team['position'] == '' ? 'Position ': $team['position']);

			          	$image = ($team['picture'] == '' ? 'https://asia-expeditions.com/userfiles/image/avatar/avatar.png' : $dir.'/'.$team['picture']);
			        ?>

			            <div class="col-md-4 col-ms-4 col-lg-4  col-xs-6 " style="margin-top:25px;">

			                <a href="/ourteam/{{ $team['first'] }}">

			                    <img style="width: 41%; height:140px;"  src="{{Shared::getInstance()->urlResource($team->tour_photo, $team->user_id)}}" class="img-quadrata center-block w3-circle" >
			                </a>
			                <a href="/ourteam/{{ $team['first'] }}">
			                  <h3 class="text-center" >{{ $team['first'] }}  {{ $team['last'] }}<br/><small> {{$position}}</small></h3>
			              	</a>
			            </div>               

			        @endforeach

					</div>

	            </div>

			</div>

        </div>

	</div>

</div>

@endsection