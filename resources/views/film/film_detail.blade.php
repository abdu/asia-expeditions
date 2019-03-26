@extends('layouts.app')
@section('title', $data->slug)
@section('content')
@include("include.menu")
<?php
    $string = rtrim($data['gallery'], '|');
    $img = explode('|', $string);
    use App\components\Shared;
?>

<!-- end modal send email -->
<div class="container">
    <h1 class="product-title" style="background: #227eac;border: solid 1px #9E9E9E;box-shadow: 0px 0px 0px 0px;color: white; padding: 12px 0px 12px 0px;">
        <span>{{{$data->country->country_name or ''}}} film</span> / 
        <span>{{$data->title}}</span>
    </h1>
    <div class="card">
        <div class="container-fliud">
            <div class="wrapper">
     
              <div class=" col-md-12 col-xs-12" style="padding: 12px 0px;">
                <div class="col-md-12" >            
                    <h3 style="margin-bottom: 0px;" class="price"> {{$data->title}}</h3>
                      <small>
                        <i class="glyphicon glyphicon-time"></i> {{date('Y-F-d',strtotime($data['created_at']))}}
                            <br>
                      </small>
                      <div class="panel-body">
                            <div class="row">
                                <p>{!! $data->desc !!}</p>
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