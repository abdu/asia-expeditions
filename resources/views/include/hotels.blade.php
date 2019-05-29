<?php 
use App\components\Shared;

?>
@if($getHotel->count() > 0)
    @foreach($getHotel as $hotel)
    
    <div class="col-xs-6 col-sm-12 col-md-12">
        <div class="list-group">
            <div class="list-group-item" style="padding: 0;">
                <div class="col-md-5">
                    <div class="row">
                        <div class="row-picture" >
                             <a target="_blank" href="{{route('supplierReport' ,['reportId' => $hotel->id,'type'=>'hotels'])}}?type=contract">
                            <img style="margin:0px;" data-src="{{Shared::getInstance()->urlResourceBig($hotel->supplier_photo, $hotel->user_id)}}" class="img-responsive lazy"></a>
                        </div>
                    </div>
                </div>    
                <div class="col-md-7">
                    <h3 style="font-size: 18px;">
            <a target="_blank" href="{{route('supplierReport' ,['reportId' => $hotel->id,'type'=>'hotels'])}}?type=contract">{{$hotel->supplier_name}}</a>
                    <p></p></h3>
                    <p>{!! str_limit(strip_tags( $hotel->supplier_intro), 200) !!}</p>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    @endforeach
@else
    <div class="alert alert-info"><i class="fa fa-info-circle"></i><span> No hotels have been selected</span></div>
@endif
