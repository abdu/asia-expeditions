@extends('layouts.app')
@section('title', "Shopping Cart")
	
<?php use App\components\Shared; ?>
@section('content')
	@include("include.menu")
	<div class="container"><br><br>
		@include('include.message')
		@if( isset($tours_cart) && !empty($tours_cart))
		<div class="row">
			<div class="col-md-12"><h3>Shopping Cart</h3><br> </div>
			<div class="col-md-9">		
				<div class="panel panel-info">
					<table class="table">
						<thead>
							<tr style="color: #31708f; background-color: #d9edf7;border-color: #bce8f1;">
								<th style="border-bottom: none; padding: 12px;">DESCRIPTIONS </th>
								<th style="border-bottom: none;" class="text-center">Amount</th>
								<th style="border-bottom: none;" class="text-center">Pax Number</th>
							</tr>
						</thead>
					</table>
					<?php
						$getTotal = 0;
					?>
					<table class="table">
						<tbody>
						@foreach($tours_cart as $tour)	
							<tr>
								<td width="116px">
									<a href="{{route('tourDetails', $tour['item']['slug'])}}">
										<img width="100" height="65" class="lazy" data-src="{{Shared::getInstance()->urlResource($tour['item']['tour_photo'], $tour['item']['user_id'])}}">
									</a>
								</td>
								<td><a href="{{route('tourDetails', $tour['item']['slug'])}}">{{$tour['item']['tour_name']}}</a>
									<div><a onclick="return confirm('Are your sure you want delete {{$tour['item']['tour_name']}} ?');" href="{{url('remove-cart', ['id' => $tour['item']['id']])}}" class="text-danger">Delete</a></div>
								</td>
								<td><strong class="price"><span class="text-muted">${{number_format($tour['item']['tour_price'],2)}}</span></strong> <small> Per Person</small></td>
								<td class="text-center">
									<form method="post" action="{{route('tour.editCart',[ 'id' => $tour['item']['id'] ])}}">
										 {{ csrf_field() }}
										<input style="width: 57%; margin: 0 auto;" min="1" type="number" name="txtqty_{{$tour['item']['id']}}" class="form-control input-sm text-center" value="{{$tour['qty']}}">
										<button type="submit" class="btn btn-warning btn-xs w3-tiny">Update</button>
									</form>
								</td>
							</tr>
							<?php
								$totalPrice = ($tour['item']['tour_price'] * $tour['qty']);
								$getTotal = $getTotal + $totalPrice; 
							?>
						@endforeach
						</tbody>
					</table>
				</div>
			</div>

			<div class="col-md-3">
				<div class="panel panel-info">
					<div class="panel-heading">
						<div class="panel-title">
							<div class="row">
								<div class="col-xs-12">
									<strong> CART TOTALS</strong>
								</div>	
							</div>
						</div>
					</div>
					<div class="panel-body">
						<div class="row">
							<table class="table">
								<tr>
									<td>SUBTOTAL</td><td>${{ number_format($getTotal,2) }} </td>
								</tr>
								<tr>
									<th>TOTAL</th><th>${{ number_format($getTotal,2) }} </th>
								</tr>
							</table>
						</div>
						<div class="row">
							<div class="col-md-12">
								@if(Auth::check())
									<a class="btn btn-danger btn-block" href="{{route('payment')}}">PROCESS PAYMENT</a>
								@else
									<a class="btn btn-danger btn-block" href="{{route('checkout')}}">PROCESS CHECKOUT</a>
								@endif
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		@else
			<div class="col-md-5 col-md-offset-4" style="text-align: center;">
				<div class="alert alert-danger">
					<h3><strong><i class="fa fa-shopping-cart"></i> YOUR CART IS EMPTY</strong></h3>
				</div>
			</div>
			<div class="col-md-12">
				<div class="alert alert-success"> YOUR CART IS EMPTY...! 
					<strong ><a class="btn btn-link" href="{{url('')}}">COMTINOUSE SHOPPING</a></strong>
				</div>
			</div>
		@endif	
	</div>
@endsection