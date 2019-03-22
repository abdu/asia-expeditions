@extends("layouts.backend")
@section('title')
    {{config('app.name')}}
@endsection
@section('content')
<?php
use \App\components\Shared;
?>
<div id="wrapper">
    @include('include.message')
    @include('admin.include.menu')
    <div id="page-wrapper">
        <div class="row">           
            <div class="page-header">                    
                <div class="col-md-3">
                    <form id="form_sort">
                        <select class="form-control input-sm" name="country_sort" id="country_sort">
                            <option value="">--select--</option>
                            @foreach(\App\Country::where('web',1)->get() as $coun)
                                <?php
                                    if (isset($_GET['country_sort'])) {
                                        $select =  $_GET['country_sort'];
                                    }else{
                                        $select = '';
                                    }
                                ?>
                                <option value="{{$coun->id}}" {{ $select == $coun->id ? 'selected':'' }}>{{$coun->country_name}}</option>
                            @endforeach
                        </select>
                    </form>
                </div>
                <form method="post" action="{{route('sendEmail')}}">
                    {{csrf_field()}}
                    <div class="col-md-7">
                        <input type="hidden" name="country" value="{{$select}}">
                        <div class="row">
                            <div class="input-group" id="addMail" style="border: solid 1px #ccd0d2;border-radius: 5px;">
                                <span class="input-group-addon" id="basic-addon1" style="border: none;"><a href="#">To</a></span>
                                <div class="EM" style="display: none;"></div>
                                <textarea onkeyup="SearchEmailS()" id="VOT" class="VOT" rows="1" style="float: left;"  autofocus></textarea>

                                <input type="hidden" name="email" id="allEmail">
                            <div class="clear"></div>                            
                            </div>                            
                            <div class="list-group" id="list-Down">
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>                    
                    <div class="col-md-2">
                        <button class="btn btn-success btn-sm" id="btnSendEmail">Send</button>                        
                    </div>
                </form>
            <div class="clearfix"></div>
            </div>          
        </div>
        @foreach($tours->chunk(2) as $tour)
            <div class="row" style="margin-top: 28px;">  
            @foreach($tour as $item)
                <?php $con = \App\Country::find($item->tour_country);?>
                <?php $pro = \App\Province::find($item->tour_province);?>
                <div class="col-md-6">
                    <div style="line-height: 1.5em;background: #eee;"> 
                        <div style="overflow: hidden; max-height: 334px;">
                            <a href="{{route('tourDetails', [$item->slug])}}">
                                <img src="{{Shared::getInstance()->urlResourceBig($item->tour_photo, $item->user_id)}}" title="" style="width: 100%;">
                            </a>
                        </div>
                        @if($con)
                        <a href="{{route('tourDetails', [$item->slug])}}">
                            <div style="position: absolute;right:0;bottom:0;padding:0;top: 12px;left: 22px;height: 20%;"> 
                                <span style="display: inline-block;min-width: 10px;padding: 3px 7px;font-size: 12px;color: #fff;vertical-align: middle;background-color: #777;border-radius: 10px; padding-right: 0.6em; padding-left: 0.6em;border-radius: 10rem;color: #fff;background-color: #dc3545;">{{$con->country_name}}</span> 
                            </div>
                        </a>
                        @endif
                        
                        <div class="card-body" style="padding: 12px;">
                            <a href="{{route('tourDetails', [$item->slug])}}">
                                <div class="news-title">
                                    <div style="margin-top: 12px;"><a style="font-size: 21px;font-family: sans-serif;font-weight: 700;" href="#">{{$item->tour_name}}</a></div>
                                </div>
                            </a>
                            @if($pro)
                            <div><small><em>{{$pro->province_name}} <span style="color: #ff8300;">{{ $item->tour_daynight ? '( '.$item->tour_daynight.' )' : ''}}</span></em></small></div>
                            @endif
                        </div>
                    </div>
                </div> 
                @endforeach
            </div>
        @endforeach        
        <div class="clearfix"></div>         
    </div>
</div>
@endsection

