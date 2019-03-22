@extends('layouts.app')
@section('title')
	Shopping Cart
@endsection
<?php
use App\components\Shared;
?>
@section('content')

@include("include.menu")
<div class="container">
	<div class="row">
		<div class="col-md-12">
			@if (session('message'))
			    <div class="alert alert-success">
					<strong><i class="fa fa-check"></i> {{session('message')}}</strong>
				</div>
			@endif	
		</div>
	</div>
	@if( isset($tours_cart) )

	<div class="row">
		<div class="col-md-9">					
			<div class="panel panel-info">
				<div class="panel-heading">
					<div class="panel-title">
						<div class="row">
							<div class="col-md-5 col-xs-5">
								<strong> DESCRIPTIONS </strong>
							</div>							
							<div class="col-md-3 col-xs-3" style="text-align: right;">
								<strong> Amount </strong>&nbsp;&nbsp;
							</div>		
							<div class="col-md-4 col-xs-4 text-center">
								<strong> Pax Number </strong>
							</div>							
						</div>
					</div>
				</div>
				<div class="panel-body">
					<?php
						$getTotal = 0;
					?>
					@foreach($tours_cart as $tour)					
					<div class="row">
						<div class="col-xs-2">
							<div style="overflow: hidden;">
								<a onclick="return confirm('Are your sure you want delete {{$tour['item']['tour_name']}} ?');" href="{{url('remove-cart', ['id' => $tour['item']['id']])}}" class="btn btn-danger btn-xs" >
									<span class="glyphicon glyphicon-remove"></span>
								</a>					

								<a href="{{route('tourDetails', $tour['item']['slug'])}}">
									<img style="width: 70%;" class="lazy" data-src="{{Shared::getInstance()->urlResource($tour['item']['tour_photo'], $tour['item']['user_id'])}}">

								</a>
							</div>
						</div>
 
						<div class="col-xs-4"> 
							<div class="row">
								<a href="{{route('tourDetails', $tour['item']['slug'])}}">
									<strong>{{$tour['item']['tour_name']}}</strong>
								</a>
							</div>
						</div>
						<div class="col-xs-6">
							<div class="col-xs-5 text-center">
								<h6 >
									<strong class="price"><span class="text-muted">${{number_format($tour['item']['tour_price'],2)}}</span></strong> <small> Per Person</small>
								</h6>
							</div>
							<div class="col-md-7 text-center">
								<div class="col-md-12 ">
									<form method="post" action="{{route('tour.editCart',[ 'id' => $tour['item']['id'] ])}}">
										 {{ csrf_field() }}
										<div class="col-md-12">
											<input style="width: 57%; margin: 0 auto;" min="1" type="number" name="txtqty_{{$tour['item']['id']}}" class="form-control input-sm text-center" value="{{$tour['qty']}}">
											<button type="submit" class="btn btn-warning btn-xs w3-tiny">Update</button>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
					<?php
						$totalPrice = ($tour['item']['tour_price'] * $tour['qty']);
						$getTotal = $getTotal + $totalPrice; 
					?>
					<hr>
					@endforeach
				</div>

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

						@if(!isset($_SESSION['email']))

							<a class="btn btn-danger btn-block" href="/checkout">PROCESS CHECKOUT</a>

						@else

							<a class="btn btn-danger btn-block" href="/payment">PROCESS CHECKOUT</a>

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

				<strong >

					<a class="btn btn-link" href="/">COMTINOUSE SHOPPING CART</a>

				</strong>

			</div>

		</div>

	@endif	

</div>

	



@endsection