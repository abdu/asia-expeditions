@extends('layouts.app')



@section('title')

{{ $team['first'] }}  {{ $team['last'] }}

@endsection

<?php



	$countryId = '';



	$dir = 'http://tourwriter.asia-expeditions.com/userfiles/image/avatar';       

	

	$position =($team['position'] == '' ? 'Position ': $team['position']);

	$cover = ($team['cover_photo'] == '' ? 'http://tourwriter.asia-expeditions.com/userfiles/image/avatar/cover.jpg' : $dir.'/'.$team['cover_photo']);

	$image = ($team['picture'] == '' ? 'http://tourwriter.asia-expeditions.com/userfiles/image/avatar/avatar.png' : $dir.'/'.$team['picture']);

?>





@section('content')

@include('include.menu')



<div class="container">

    <div class="fb-profile">

    	<div style="height: 190px; overflow: hidden;">

        	<img align="left" class="fb-image-lg" src="{{$cover}}" alt="Profile image example"/>

        </div>

        <img align="left" class="fb-image-profile thumbnail" src="{{$image}}" alt="Profile image example"/>

        <div class="fb-profile-text">

            <h1>{{ $team['first'] }}  {{ $team['last'] }}</h1>

            <p>{{$team['position']}}</p>

            <p>{{$team['descs']}}</p>

        </div>

    </div>

</div> <!-- /container -->  



<div class="spacing"></div>

<div class="spacing"></div>

<div class="spacing"></div>

@endsection