@extends('layouts.app')



@section('title')

  Our Team

@endsection

<?php	$countryId = ''; ?>

@section('content')

@include('include.menu')  

<div class="section">

    <div class="container"><div class="spacing"></div><div class="spacing"></div>

        <div class="row">

            <div class="col-md-12">

                <h1 class="text-center text-primary">Our Team</h1>

                <p class="text-center">The Asia Expeditions vision was first conceived in 2006 by Esther, the owner. The company was co-founded by Win Zaw and commenced operation at Cambodia in April 2006. We established a network with major tourist destinations in Cambodia with offices for inbound tourism. As the handling agent for unique international tour operators, we provide quality destination services to multi-lingual clients at competitive rates.



                In May 2010, we enter Myanmar (Burma) and the company operates under the brand of Asia Expeditions with its head office in Phnom Penh, Cambodia.

                We offer a varied product line covering hotels, private tours, airport transfers, soft adventures, river cruises, biking tours, trekking, home stay, Family holidays, River Expeditions, Meetings & Incentive and golfing as well as cooking classes.</p>

                <div class="spacing"></div>

            </div>

        </div>

        <div class="row">

          @foreach($ourteam as $team)

          <?php
          $position =($team['position'] == '' ? 'Position ': $team['position']);
          ?>

            <div class="col-md-4 col-ms-4 col-lg-4  col-xs-6 " style="margin-top:25px;">

               
                <a href="route('teamDetail', $team->fullname)">

                  <h3 class="text-center" >{{ $team->fullname }}

                  <br/>

                <small> {{$position}}</small></h3></a>

            </div>               

          @endforeach

        </div>

    </div>

</div>

<div class="spacing"> </div>

@endsection