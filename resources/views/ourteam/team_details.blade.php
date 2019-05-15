@extends('layouts.app')
@section('title', $team['fullname'])
<?php
	$countryId = '';
	$position =($team['position'] == '' ? 'Position ': $team['position']);
    $cover =  $team->cover > 0 ? "https://system.asia-expeditions.com/storage/avata/thumbnail/".$team->cover: "";
?>
@section('content')
@include('include.menu')

<div class="fb-profile">
	<div style="height: 350px; overflow: hidden;">
        <img class="fb-image-lg" src="https://media-cdn.tripadvisor.com/media/photo-c/2560x500/17/85/a7/09/caption.jpg" alt="{{$team->fullname}}"/>
    </div>
    <div class="container">
        <img align="left" style="position: relative; z-index: 0;" class="fb-image-profile thumbnail" src="https://system.asia-expeditions.com/storage/avata/{{$team->picture}}" alt="{{$team->fullname}}"/>
        <div class="fb-profile-text">
            <h1>{{ $team->fullname }}</h1>
            <p>{{$team['position']}}</p>
            <p>{!! $team['descs'] !!}</p>
        </div>
    </div>
</div>
@endsection