@extends('layouts.app')
@section('title')
{{{ $tour['tour_name'] or ''}}}
@endsection
<?php
    $string = rtrim($tour['tour_picture'], '|');
    $img = explode('|', $string);
    use App\components\Shared;
?>
<meta property="og:url"           content="{{route('tourDetails', ['url'=> $tour->slug])}}" />
<meta property="og:title"         content="{{$tour->tour_name }} | {{Config('app.name')}}" />
<meta property="og:description"   content="{!! strip_tags($tour->tour_intro) !!}" />
<meta property="og:image"         content="{{Shared::getInstance()->urlResourceBig($tour->tour_photo, $tour->user_id)}}" />


<meta property="twitter:card" content="summary">
<meta property="twitter:site" content="{{route('tourDetails', ['url'=> $tour->slug])}}">
<meta property="twitter:title" content="{{$tour->tour_name }}">
<meta property="twitter:description" content="{!! strip_tags($tour->tour_intro) !!}">
<meta property="twitter:creator" content="{{Config('app.name')}}">
<meta property="twitter:image:src" content="{{Shared::getInstance()->urlResourceBig($tour->tour_photo, $tour->user_id)}}">        
<meta property="twitter:domain" content="https://asia-expeditions.com">

@section('content')
@include("include.menu")

<style type="text/css">
    .amazingslider-box-1{
        margin-left: 0px !important; 
        border-width: 0px !important; 
        border-style: 0px !important; 
    }
    .bor{
        border: 1px solid #cccccc7a;    
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.13)
    }
    .owl-stage{
        transition: .7s !important;
    }
    label{
        float: left;
        font-size: 15px;
        text-shadow: 0 0 black;
    }
    .add_size{
        font-size: 15px;
        height: 30px!important;
        padding: 2px 8px!important;
    }
    .addcol{
        color: red;
    }
   
 
</style>


<!-- modal send email -->


<div class="w3-container">
    <div id="id01" class="w3-modal">        
        <div class="w3-modal-content w3-card-12 w3-animate-zoom " >
            <div class="w3-center w3-col m6" ><br>
                <span onclick="document.getElementById('id01').style.display = 'none'" class="w3-button w3-xmeduim w3-hover-red w3-display-topright" title="Close Modal">&times;</span>
                <div class="preview-pic tab-content">
                    <div class="tab-pane active" id="pic-1"><img class="lazy" data-src="{{Shared::getInstance()->urlResource($tour->tour_photo, $tour->user_id)}}" /></div>                 
                </div>
                <h3 class="product-title" style="text-align: left;padding:10px;">{{htmlentities($tour['tour_name'])}}</h3>  
                <h5 class="price" style="text-align: left;padding:10px;">price: <span data-toggle="popover" data-trigger="hover" data-content="Our Best Price" data-placement="bottom">${{$tour['tour_price']}} </span><small style="text-transform: capitalize">Per Person</small></h5>
            </div>
            <form class="w3-container w3-col m6" action="{{url('/tour/mail/to')}}" method="post">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="id" value="{{ $tour->id }}">
                <input type="hidden" name="tourName" value="{{ $tour->tour_name }}">
                <div class="w3-section">
                    <label><b>Email From</b></label>
                    <input class="w3-input w3-border w3-margin-bottom" type="text" placeholder="Email from" name="emailfrom" required>
                    <label><b>Email to</b></label>
                    <input class="w3-input w3-border w3-margin-bottom" type="text" placeholder="Email To" name="emailto" required>
                    <label><b>Your Name</b></label>
                    <input class="w3-input w3-border w3-margin-bottom" type="text" placeholder=" Your Name" name="tittle" required>   
                    <textarea class="form-control" style="height: 106px;" rows="3" name="message" placeholder="Message here..!" required="required"></textarea>              
                </div>
                <div class="pull-right w3-padding-16">
                    <button  type="submit" class="btn btn-primary">Send</button>
                </div>
            </form>         
            <div class="clear"></div>
        </div>
    </div>
</div>

<!-- end modal send email -->

    <div class="container">
        <h3 class="product-title titles">
            <span>{{{$tour->country->country_name or ''}}}</span> / 
            <span>{{$tour->tour_name}}</span>
        </h3>
        <ul class="list-unstyled ">
            <li style="float: left;">            
                <div id="fb-root"></div>
                <script>(function(d, s, id) {var js, fjs = d.getElementsByTagName(s)[0];
                  if (d.getElementById(id)) return;
                  js = d.createElement(s); js.id = id;
                  js.src = 'https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.2';
                  fjs.parentNode.insertBefore(js, fjs);
                }(document, 'script', 'facebook-jssdk'));</script>
                   <div class="fb-share-button" data-href="{{route('tourDetails', ['url'=> $tour->slug])}}" data-layout="button_count" data-size="small">
                </div>        
            </li>
            <li style="float: left;margin: -3px 5px;">
                <a class="twitter-share-button" href="http://twitter.com/share?url={{route('tourDetails', ['url'=> $tour->slug])}}&amp;text={{$tour->tour_name}}&amp; hashtags=Asia Expedition &amp;">
                <script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>
                </a>
            </li>
        </ul>
        <div class="clearfix"></div>
        <div class="card">
            <div class="container-fliud">
                <div class="wrapper">
                    <div class=" col-md-8 col-xs-12 bor" style="padding: 0px;">
                        <div id="amazingslider-wrapper-1" style="display:block;position:relative;max-width:626px;margin:0px auto 95px;margin-left:0px;" >
                            <div id="amazingslider-1" style="display:block;position:relative;margin:0 auto;">
                                <ul class="amazingslider-slides" style="display:none;">
                                    <li><img src="{{Shared::getInstance()->urlResourceBig($tour->tour_photo, $tour->user_id) }}"/>
                                    </li>
                                     @if(count($img) > 1)
                                        @foreach ($img as $key => $value) 
                                        <li><img src="{{ Shared::getInstance()->urlResourceBig(trim($value), $tour->user_id) }}" /></li>
                                        @endforeach
                                    @endif
                                    @if(isset($tour->video)? $tour->video:'' )
                                        <li><img src="https://img.youtube.com/vi/{{isset($tour->video) ? $tour->video:''}}/0.jpg" />
                                        <video preload="none" style="height: 352px !important;" src="https://www.youtube.com/   embed/{{$tour->video}}?v={{$tour->video}}" ></video></li>
                                    @endif
                                </ul>
                                <ul class="amazingslider-thumbnails" style="display:none;">
                                    <li><img src="{{Shared::getInstance()->urlResource($tour->tour_photo, $tour->user_id)}}" /></li>
                                    @if(count($img) > 1)
                                        @foreach ($img as $key => $value) 
                                            <li><img src="{{Shared::getInstance()->urlResource(trim($value), $tour->user_id) }}" /></li>
                                       @endforeach
                                    @endif
                                    @if(isset($tour->video) ? $tour->video:'')
                                       <li><img src="https://img.youtube.com/vi/{{isset($tour->video) ? $tour->video:''}}/0.jpg" /></li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class=" col-md-4 col-xs-12 bor" style="padding: 12px 0px; text-align: center;">
                        <div class="col-md-12"  style="margin-bottom: -10;" >            
                            <h4 style="margin: 4px 0 -8px 0;" class="price"> price: <span style="cursor: pointer;" data-toggle="popover" data-trigger="hover" data-content="Our special price" data-placement="top">${{$tour['tour_price']}}</span> <small style="text-transform: capitalize ">Per Person</small></h4>
                            <hr>                  
                           
                        </div>  
                        <div class="col-md-12">
                            <form action="{{route('get_tour_user')}}" method="post">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="row">
                                        <input type="hidden" name="tour_id" value="{{$tour->id}}">
                                        <input type="hidden" name="slug" value="{{$tour->slug}}">                    
                                        <input type="hidden" name="tour_price" value="{{$tour->tour_price}}">
                                    <div class="form-group col-md-6">
                                        <label for="inputfirst">First Name</label>
                                        <input type="text" class="form-control add_size" id="" placeholder="first name" required="" name="fname">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="inputlast">Last Name</label>
                                        <input type="text" class="form-control add_size" id="" placeholder="last name" required="" name="lname">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="inputfirst">Email</label>
                                        <input type="email" class="form-control add_size" id="eshow" placeholder="Your Email" required="" name="email">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="inputlast">Mobile</label>
                                        <input type="text" class="form-control add_size" id="" placeholder="Your Phone Number"       name="mobile">
                                    </div>
                                       <div class="form-group col-md-6">
                                        <label for="inputfirst">From Date</label>
                                        <input type="date" class="form-control add_size" id="" placeholder="From Date:" required="" name="fdate">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="inputlast">To Date</label>
                                        <input type="date" class="form-control add_size" id="" placeholder="To Date" required="" name="tdate">
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="inputlast">Nationality</label>
                                              <select class="form-control add_size" name="nationality">
                                        @foreach(App\Country::orderBy('nationality')->get() as $con)
                                            <option value="{{$con->id}}">{{$con->nationality}}</option>
                                        @endforeach
                                    </select>                                       
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="inputlast">Additional Requests</label>
                                        <textarea style="resize:vertical; " class="form-control" name="textarea" rows="3" >                                            
                                        </textarea>
                                     
                                    </div>
                                    <div id="notrobot">
                                    <div class="form-group col-md-6">
                                        <label for="inputfirst"></label>
                                        <input type="text" class="form-control add_size" id="gettext" value="" readonly="" name="" 
                                        style="background-color: #00000096;
                                        color: #fff;text-align: center;
                                        font-family: cursive;
                                        font-size: 20;">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="inputlast"></label>
                                        <input type="text" class="form-control add_size " id="myResult" placeholder="Pleace type" required="" name="">
                                    </div>
                                    </div>

                                </div>
                                <div class="col-md-12 col-sm-12">
                                    <div class="row">
                                
                                    <button type="submit" class=" add-to-cart btn btn-primary " id="btn"  style="float: left; width: 50%; padding-left: 14px;"><i class="fa fa-envelope" style="padding: 2px 5px 0px 0px;font-size: 18px;float: left; margin-left: -5px;"></i>SEND INQUIRY</button>                         
                                    <div class="action" style="float: right; width: 50%;padding-right: 2px;">
                                        <a  href="{{route('tour.addTocart', ['id' => $tour->id])}}" class="add-to-cart btn btn-default0 green" style="width: 100%;margin-left: 2px;
                                         padding-left: 22px;" ><i class="fa fa-shopping-cart " style=" padding: 0px 5px 0px 0px;font-size: 20px;float: left; margin-left: -15px;"></i>add to cart</a> 
                                    
                                        
                                    </div>
                                </div>
                                </div>
                             
                            </form>
                        </div>
                    </div>
                </div>
                <div class="clear"></div>
            </div>
        </div>
          <div class="spacing"></div>
        <div class="col-md-8" style="padding: 0px;">
            <div id="" class="bor" style="margin-top:0; background-color: #eeeeee;">
                <ul id="tabs" class="nav nav-tabs" data-tabs="tabs">
                    <li class="active"><a href="#highlights" data-toggle="tab">Highlights</a></li>
                    <li><a href="#details" data-toggle="tab">Program Details</a></li>
                    <li><a href="#service-include" data-toggle="tab">Price & Service Included</a></li>
                    <li><a href="#preferrenced-hotel" data-toggle="tab">Accommodation</a></li>
                </ul>
                <div id="my-tab-content" class="tab-content" style="background: white;">
                    <div class="tab-pane active" id="highlights">
                        <p><?php echo html_entity_decode($tour['tour_intro']) ?></p>
                    </div>
                    <div class="tab-pane " id="details">
                        <p><?php echo html_entity_decode($tour['tour_desc']) ?></p>
                    </div>
                    <div class="tab-pane " id="service-include">
                        <p><?php echo html_entity_decode($tour['tour_remark']) ?></p>
                    </div>
                    <div class="tab-pane" id="preferrenced-hotel">
                       @include('include.hotels')
                    </div>
                </div>
            </div>
        </div>   
        <div class="col-md-4" style="padding: 0px;">
            <div id="" class="bor" style="margin-top:0; background-color: #eeeeee;">
                <?php   $getTour = \App\Tour::getTourByWeek($tour->id);
                        $data    = round($getTour->count()/3); ?>  
                <div class="title text-center">
                    <h4 style="font-weight: 500;margin-bottom: 0px;">RECENT VIEW
                        <div style="border-bottom: 2px solid #ddd;width: 100%;  padding-top: 6px;"></div>
                    
                    </h4>
                </div>  
                    @foreach($getTour->chunk($data) as $get)
                    <section class="wow fadeInUp" >
                        <div class="owl-carousel clients-carousel-1" style="height: auto;">
                            @foreach($get as $tour)
                                <div class="list-group-item b_list">
                                    <div class="col-md-4">
                                      <div class="row" style="text-align: center;padding-top:5px;">
                                         <a href="{{route('tourDetails', ['url'=> $tour->slug])}}">                                 
                                            <img src="{{Shared::getInstance()->urlResource($tour->tour_photo, $tour->user_id)}}" frameborder="0" allow="accelerometer;  ; encrypted-media; gyroscope; picture-in-picture" allowfullscreen  class="img-responsive img-box img-thumbnail" style="padding:0px;"> 
                                         </a>
                                      </div>
                                    </div>    
                                    <div class="col-md-8">
                                        <h3 class="text-danger" style="font-size: 16px; font-weight: 500; margin: 5px 0;"><b> ${{Shared::money($tour->tour_price)}}</b>/<small>Per Person</small>
                                        </h3>                              
                                        <div>
                                            <a href="{{route('tourDetails', ['url'=> $tour->slug])}}" >
                                                <p style="font-size: 12px;">{!! str_limit($tour->tour_name,55) !!}</p>
                                            </a>
                                        </div>
                                        <a style="font-weight:100;" href="{{route('tourDetails', ['url'=> $tour->slug])}}" class="btn btn-primary btn-xs">View Detail</a>
                                            <div class="clearfix"></div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>                                                                                  
                            @endforeach
                        </div>              
                    </section> 
                    @endforeach            
                </div>            
            </div>
        </div>
        <div class="spacing"></div>    

    <div class="container">
        @if($tourLink->count() > 0)
            <div class="title text-left">
                <h2><b>YOU MAY ALSO LIKE</b>
                    <div style="border: double #ddd;width: 100%;"></div>
                </h2>
            </div>        
            @if($tourLink->count() > 3)
            <div class="row">   
                
                    <section class="wow fadeInUp" >                                
                        <div class="owl-carousel clients-carousel" style="height: auto;">
                            @foreach($tourLink->chunk(4) as $key => $chunkTour)                        
                                @foreach($chunkTour as $tour)
                                    @include('include.item')
                                @endforeach                          
                             @endforeach
                        </div>
                    </section>                                 
                
            </div>
            @elseif($tourLink->count() == 2)
            <div class="row">   
                <div class="col-md-12">           
                    <section class="wow fadeInUp">
                        <div class="owl-carousel clients-carousel-2" style="height: auto;">
                            @foreach($tourLink->chunk(4) as $key => $chunkTour)                        
                                @foreach($chunkTour as $tour)
                                    @include('include.item')
                                @endforeach                          
                             @endforeach
                        </div>
                    </section>                                 
                </div>
            </div>
            @elseif($tourLink->count() == 1)
            <div class="row">   
                <section class="wow fadeInUp" >
                    <div class="owl-carousel clients-carousel-1" style="height: auto;">
                        <div class="row">
                        @foreach($tourLink->chunk(4) as $key => $chunkTour)
                            @foreach($chunkTour as $tour)
                            <div class="col-md-4">                                             
                                @include('include.item')
                            </div>
                            @endforeach              
                         @endforeach
                         </div>
                    </div>
                </section>
            </div>
            @endif
        @endif
    </div>
     <script type="text/javascript">
$(document).ready(function(){
    let r = Math.random().toString(36).substring(7);
    $('#gettext').val(r);

  $('#myResult').on('keyup',function(){

    var getdata = $(this).val();    
    
    if (getdata == r) {
      $('#myResult').removeClass('addcol');
         $('#btn').on('click',function(){
         $('#myResult').val(getdata);
    
      });
    }
    else{
       $('#myResult').addClass('addcol');
       $('#myResult').attr('required', true);

       $('#btn').on('click',function(){
         $('#myResult').val('');
    
        });
    }
  });

  $('#notrobot').css({'display':'none'});
  $('#eshow').on('keyup', function(){
      var eshow= $('#eshow').val();
        if (eshow.length>0) {
          $('#notrobot').css({'display':'block'});
    console.log(eshow);
  }
  else{
     $('#notrobot').css({'display':'none'});
  }
  });

});
</script>
@endsection