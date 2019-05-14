@extends('layouts.app')
@section('title', $mice->title)
@section('keywords', $mice->meta_keyword)
@section('description', $mice->meta_description)

<?php 
use App\components\Shared; ?>
@section('content')
@include('include.menu')
<div class="clearfix"></div>
<div class="overflownone">
    <div class="">
        <div id="myCarousel" class="slide carousel-fade" style="height:285px;">
            <div class="carousel-inner" id="carousel-warpper" style="display: block;
    overflow: hidden;
    width: 100%;
    height: 100%;
    max-height: 285px;">
                <div class="item active item-slide lazy" style="background-image: url({{Shared::getInstance()->urlResourceBig($mice->photo)}});height: 285px; background-repeat: no-repeat;">
                </div>  
            </div>    
        </div>
    </div>
    <div class="clearfix"></div>
</div>

<div class="container">
	<div class="row">
        <div class="col-md-12">
            <div class="card">
	            <ul class="nav nav-tabs" role="tablist">
                    @foreach(\App\Setting::where('type', 2)->get() as $key=>$set)
                        <li class="{{$mice->id == $set->id ? 'active': ''}}"><a href="{{route('miceName', ['url'=> $set->slug])}}">{{$set->title}}</a></li>
                    @endforeach

	            </ul>	            
	            <div class="tab-content">
                	<div role="tabpanel" class="tab-pane active">
						{!!$mice->details!!}
					</div>	                
	            </div>
			</div>
        </div>
	</div>
</div>
<!-- <script type="text/javascript">

    $(document).ready(function(){
         var baseUrl=location.protocol+'//'+location.host+"/";
        $(document).on('click','li a',function(){
           
             var id = $(this).data("id");
             var datau=$(this).data('url');              
              $(this).addClass('active');
            console.log(datau);
            window.history.pushState("", "", baseUrl+"mice/"+datau)
            $.ajax({
                method: "GET",
                url:baseUrl+"mice/"+datau,       
                dataType: "json",
           
                success: function(html){  

                },
                error: function(error){
                    alert("Error!");
                    return false;
                },         
             });
        })
    }); 
</script> -->
@endsection