@extends('layouts.app')
@section('title', $data->slug)
@section('content')
@include("include.menu")
<?php
    $string = rtrim($data['gallery'], '|');
    $img = explode('|', $string);
    use App\components\Shared;
?>

<!-- modal send email -->
<div class="w3-container">
    <div id="id01" class="w3-modal">        
        <div class="w3-modal-content w3-card-12 w3-animate-zoom " >
            <div class="w3-center w3-col m6" ><br>
                <span onclick="document.getElementById('id01').style.display = 'none'" class="w3-button w3-xmeduim w3-hover-red w3-display-topright" title="Close Modal">&times;</span>
                <div class="preview-pic tab-content">
                    <div class="tab-pane active" id="pic-1"><img class="lazy" data-src="{{Shared::getInstance()->urlResource($data->tour_photo, $data->user_id)}}" /></div>                 
                </div>
                <h3 class="product-title" style="text-align: left;padding:10px;">{{htmlentities($data['title'])}}</h3>  
                <h5 class="price" style="text-align: left;padding:10px;">price: <span data-toggle="popover" data-trigger="hover" data-content="Our Best Price" data-placement="bottom"> </span><small style="text-transform: capitalize">Per Person</small></h5>
            </div>
                  
            <div class="clear"></div>
        </div>
    </div>
</div>

<!-- end modal send email -->
<div class="container">
    <h1 class="product-title" style="background: #227eac;border: solid 1px #9E9E9E;box-shadow: 0px 0px 0px 0px;color: white; padding: 12px 0px 12px 0px;">
        <span>{{{$data->country->country_name or ''}}}</span> / 
        <span>{{$data->title}}</span>
    </h1>
    <div class="card">
        <div class="container-fliud">
            <div class="wrapper">
                <div class="preview col-md-8 col-xs-12" style="padding: 0px;">
                    <div class=" tab-content" style="background: none; padding:0px;">
                        <div style="padding-top: 0px;" class="tab-pane active" id="pic" style="cursor: pointer;">
                            <img class="lazy" data-src="{{Shared::getInstance()->urlResourceBig($data->photo, $data->user_id) }}" /></div>
                        @if(count($img) > 1)
                            @foreach ($img as $key => $value)
                                <div style="padding-top: 0px;" class="tab-pane" id="{{$key}}" style="cursor: pointer;">
                                    <img class="lazy" 
                                    data-src="{{ Shared::getInstance()->urlResourceBig(trim($value), $data->user_id) }}" />
                                </div>
                            @endforeach                 
                        @endif
                    </div>
                    <ul class="preview-thumbnail nav nav-tabs">
                        <li class="active">
                            <a data-target="#pic" data-toggle="tab" >
                                <img style="margin-top:6px; height:61px; width: 85px;" class="lazy" data-src="{{Shared::getInstance()->urlResource($data->photo, $data->user_id)}}" />
                            </a>
                        </li>
                        <?php
                        if (count($img) > 1) {
                            foreach ($img as $key => $value) {
                                echo'<li>
                                        <a data-target="#' . $key . '" data-toggle="tab">
                                            <img style="margin-top:6px; height:61px; width: 85px;" class="lazy" data-src="' . Shared::getInstance()->urlResource(trim($value), $data->user_id) . '"/>
                                        </a>
                                    </li>';
                            }
                        }
                        ?>
                        <div class="clear"></div>
                    </ul>                   
                </div>
                      <div class=" col-md-4 col-xs-12" style="padding: 12px 0px;">
                    <div class="col-md-12" >            
                        <h3 style="margin-bottom: 0px;" class="price"> {{$data->title}}</h3>
                        <div class="panel-body">
                            <div class="row">
                                <p>{{$data->desc}}</p>
                            </div>
                        </div>  
                    </div>  
                      
                    <div class="clear"></div>
                    <div class="spacing"></div>
       
                </div>

         
            </div>
            <div class="clear"></div>
            <div class="spacing"></div>
   
        </div>
    </div>  
</div>




			                  
				               
					      
@endsection