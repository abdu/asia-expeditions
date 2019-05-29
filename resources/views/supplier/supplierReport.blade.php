
@section('title')
{{{ $tour['tour_name'] or ''}}}
@endsection
<link rel="stylesheet" type="text/css" href="{{asset('css/lib/csscompressed.css')}}">
<?php
    use App\components\Shared;
    if ($type == 'hotels') {
		$title = 'hotels';
	}
	if ($priceType == "contract") {
		$reportType = "Information";
	}
?>


<?php  use App\component\Content;?>
<div class="container">
<table class="table">
	<?php $data=\App\Company::where('id',1)->first(); ?>
	<tr>
		<td>{!! $data->address !!}</td>
		<td class="text-right" width="150px">
			<img src="{{ $data->logo > 0 ? Storage::url($data->logo) : Storage::url('/avata/logo.png') }}" style="width: 100%;">
		</td>
	</tr>
</table>
		<h3 class="text-center"><strong class="btborder" style="text-transform: uppercase;">{{$title}} {{$reportType}}</strong></h3>
		<div>
			<div class="pull-left">
				<h4 style="text-transform: capitalize;"><strong>{{{ $supplier->country->country_name or '' }}} <i class="fa fa fa-angle-double-right"></i> {{{$supplier->province->province_name or ''}}} <i class="fa fa fa-angle-double-right"></i>  {{$supplier->supplier_name}} </strong></h4>
			</div>
			@if($priceType != "contract" )
				@if($type == "hotels" )
				<div class="col-md-7 pull-center hidden-print">
					<form action="/{{$currentAction}}?type={{{ $priceType or ''}}}" method="POST">
						{{csrf_field()}}
						<div class="col-md-12" style="padding-right: 0px;">
							<div class="col-md-6">
								<div class="pull-left"><label style="position:relative;top:8px;">Month</label></div>
								<div class="input-group">
									<select class="form-control input-sm" name="fmonth">
								  		<option value="">--Date--</option>
								  		<?php 
								  			$months = ["January","February","March", "April","May","June","July","August", "September","October","November", "December"];
								  		?>
								  		@foreach($months as $key => $m)
								  			<option value="{{$key+1}}" {{(isset($fmonth)?$fmonth:'') == $key+1 ?'selected':''}}>{{$m}}</option>
								  		@endforeach
								  	</select>
								    <span class="input-group-addon">From & To</span>
								    <select class="form-control input-sm" name="tmonth">
								  		<option value="">--Date--</option>
								  		<?php 
								  			$months = ["January","February","March", "April","May","June","July","August", "September","October","November", "December"];
								  		?>
								  		@foreach($months as $key => $m)
								  			<option value="{{$key+1}}" {{(isset($tmonth)?$tmonth:'') == $key+1 ?'selected':''}}>{{$m}}</option>
								  		@endforeach
								  	</select>
								</div>
							</div>
						  	<div class="col-md-3">
							  	<div class="pull-left"><label style="position:relative;top:8px;">Year</label></div>
							  	<div class="pull-right">
								  	<select class="form-control input-sm" name="year">
								  		<?php $plusYear = date('Y', strtotime('+10 years'));  ?>
								  		<option value="">---Years---</option>
								  		@for($y = 2015; $y <= $plusYear; $y++)
								  			<option value="{{$y}}" {{(isset($year)?$year == $y:'') ? 'selected':''}}>{{$y}}</option>
								  		@endfor
								  	</select>
								</div>
								<div class="clearfix"></div>
							</div>	
							<div class="col-md-2" style="padding-left: 0px;">
								<label><br></label>
								<button class=" btn btn-default btn-sm active">Query</button>
							</div>						
						</div>
						
					</form>
				</div>
				@endif		
			@endif	
			<div class="pull-right hidden-print">
				<a class=" btn btn-primary" href="javascript:void(0)" onclick="window.print();"><span class="fa fa-print"></span> Print</a>&nbsp;&nbsp;&nbsp;&nbsp;
			</div>
		</div>

<div class="clearfix"></div>

<table class="table table-bordered" id="roomrate">
	@if($priceType  == "contract" )
		<tr>
			<tr>
				<td colspan="2">
					<address>
						<p><b>Hotel Name :</b> {{$supplier->supplier_name}}<br>
						<b>P/H :</b> {{ $supplier->supplier_phone}}/{{$supplier->supplier_phone2}}<br>
						<b>Email :</b> {{$supplier->supplier_email}}<br>
						<b>Address :</b> {{$supplier->supplier_address}}<br>
						<b>Website :</b> {{$supplier->supplier_website}}</p>
					</address>
					{!! $supplier->supplier_intro !!}</td>
			</tr>
			<td style="width: 50%; vertical-align:top;">
				<strong>Hotel Facilities</strong>
				<ul style="padding-left: 20px;">
					@if($supplier->hotel_facility->where('company_id', 1 ))
						@foreach($supplier->hotel_facility->where('company_id', 1) as $key => $hf)
						<li>{{$hf->name}}</li> 
						@endforeach
					@endif
				</ul>
			</td> 
			<td style="width: 50%; vertical-align:top;">
				<strong>Hotel Info</strong>
				<ul style="padding-left: 20px;">
					@if($supplier->hotel_category->where('company_id', 1 ))
						@foreach($supplier->hotel_category->where('company_id', 1) as $key => $hf)
						<li>{{$hf->name}}</li>
						@endforeach
					@endif
				</ul>
			</td>	
			@if($supplier->supplier_pgroup)
			<tr>
				<td colspan="2">
					<strong>Group Policy</strong>
					{!! $supplier->supplier_pgroup !!}</td>
			</tr>
			@endif
			@if($supplier->supplier_pchild)
			<tr>
				<td colspan="2">
					<strong>Child Policy</strong>
					{!! $supplier->supplier_pchild !!}</td>
			</tr>
			@endif
			@if($supplier->supplier_pcancelation)
			<tr>
				<td colspan="2">
					<strong>Canceltion Policy</strong>
					{!! $supplier->supplier_pcancelation !!}</td>
			</tr>
			@endif
			@if($supplier->supplier_ppayment)
			<tr>
				<td colspan="2">
					<strong>Payment Policy</strong>
					{!! $supplier->supplier_ppayment !!}</td>
			</tr>
			@endif
			<tr>
				<td>
					<div><strong>Hotel Contract</strong></div>
					<?php 
					$pdfPolicies = explode('/', rtrim($supplier->supplier_contract, "/"));
					?>
					@if($supplier->supplier_contract)
					<ul>
						@foreach($pdfPolicies as $key => $pdf)
						<li><a target="_blank" href="https://system.asia-expeditions.com/storage/contract/hotels/{{$pdf}}">{{$pdf}}</a></li>
						@endforeach
					</ul>
					@endif
				</td>
			</tr>

			<tr>
				<td colspan="2"> <strong>Remarks:</strong>{!! $supplier->remak !!} </td>
			</tr>
		</tr>
	@else
		<tr style="background-color: rgb(245, 245, 245);">
			<th style="padding:2px;"><span>RoomType</span></td>
			<th style="padding:2px;"><span>From Date</span>  <span class="fa fa-long-arrow-right" style="top: 1px; position: relative;"></span> <span>To Date</span></th>
			@if($priceType != "selling")
				@foreach(\App\RoomCategory::where(['status'=>1])->orderBy('name','ASC')->get() as $cat)
				<th title="{{$cat->name}}" style="padding: 2px;" class="text-right"><span>{{$cat->name}}</span></th>
				@endforeach
			@else
				@foreach(\App\RoomCategory::where(['status'=>1])->take(5)->orderBy('name','ASC')->get() as $cat)
				<th title="{{$cat->name}}" style="padding: 2px;" class="text-right"><span>{{$cat->name}}</span></th>
				@endforeach
			@endif
		</tr>			 
		@foreach($supplier->room as $room)
			@if(isset($fmonth) != "" && isset($tmonth) != "" && isset($year) != "")
				<?php
				$getRate = App\RoomRate::where(['supplier_id'=>$supplier->id, 'room_id'=>$room->id, 'company_id'=> 1])
									->whereMonth('start_date', '>=', $fmonth)
									->whereMonth('start_date', '<=', $tmonth)
									->whereYear('start_date', $year)
									->orderBy('start_date','ASC')->get();
				?>
			@else
				<?php
				$getRate = App\RoomRate::where(['supplier_id'=>$supplier->id, 'room_id'=>$room->id, 'company_id'=>1 ])->orderBy('start_date','ASC')->get();
				?>
			@endif
			<tr>
				<td style="vertical-align: middle;" colspan="{{$getRate->count()== 0? '12':''}}" rowspan="{{$getRate->count() +1}}"><b>{{$room->name}}</b></td>
			</tr>
			@foreach($getRate as $rate)
			<tr>
				<td style="font-size:12px;" class="date-font">{{Content::dateformat($rate->start_date)}} <i class="pcolor">-></i> {{Content::dateformat($rate->end_date)}}</td>
				<td class="text-right">{{Content::money($rate->ssingle)}} <small class="pcolor">{{$rate->ssingle>0?Content::currency():''}}</small></td>
				<td class="text-right">{{Content::money($rate->stwin)}} <small class="pcolor">{{$rate->stwin>0?Content::currency():''}}</small></td>
				<td class="text-right">{{Content::money($rate->sdbl_price)}} <small class="pcolor">{{$rate->sdbl_price>0?Content::currency():''}}</small></td>
				<td class="text-right">{{Content::money($rate->sextra)}} <small class="pcolor">{{$rate->sextra>0?Content::currency():''}}</small></td>
				<td class="text-right">{{Content::money($rate->schexbed)}} <small class="pcolor">{{$rate->schexbed>0?Content::currency():''}}</small></td>
				@if($priceType != "selling" )
					<td class="text-right">{{Content::money($rate->nsingle)}} <small class="pcolor">{{$rate->nsingle>0?Content::currency():''}}</small></td>
					<td class="text-right">{{Content::money($rate->ntwin)}} <small class="pcolor">{{$rate->ntwin>0?Content::currency():''}}</small></td>
					<td class="text-right">{{Content::money($rate->ndbl_price)}} <small class="pcolor">{{$rate->ndbl_price>0?Content::currency():''}}</small></td>
					<td class="text-right">{{Content::money($rate->nextra)}} <small class="pcolor">{{$rate->nextra>0?Content::currency():''}}</small></td>
					<td class="text-right">{{Content::money($rate->nchexbed)}} <small class="pcolor">{{$rate->nchexbed>0?Content::currency():''}}</small></td>
				@endif
			</tr>
			@endforeach				
		@endforeach

	@endif
	
</table>
</div>

