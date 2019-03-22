    @extends('layouts.app')
@section('title')
{{{ $tour['tour_name'] or ''}}}
@endsection
@section('content')
@include("include.menu")

<?php
    $string = rtrim($tour['tour_picture'], '|');
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
    @if (session('message'))
        <div class="spacing"></div>
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-success">
                    <strong><i class="fa fa-check"></i>
                        <span class="text-danger">{{$tour['tour_name']}}</span> {{session('message')}}
                    </strong>
                </div>
            </div>
        </div>
    @endif  

    @if (session('message-email'))
        <div class="spacing"></div>
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-success">
                    <strong><i class="fa fa-check"></i>
                        {{session('message-email')}}
                    </strong>
                </div>
            </div>
        </div>
    @endif  

    <h1 class="product-title" style="background: #227eac;border: solid 1px #9E9E9E;box-shadow: 0px 0px 0px 0px;color: white; padding: 12px 0px 12px 0px;">
        <span>{{{$tour->country->country_name or ''}}}</span> / 
        <span>{{$tour->tour_name}}</span>
    </h1>
    <div class="card">
        <div class="container-fliud">
            <div class="wrapper">
                <div class="preview col-md-8 col-xs-12" style="padding: 0px;">
                    <div class=" tab-content" style="background: none; padding:0px;">
                        <div style="padding-top: 0px;" class="tab-pane active" id="pic" style="cursor: pointer;">
                            <img class="lazy" data-src="{{Shared::getInstance()->urlResourceBig($tour->tour_photo, $tour->user_id) }}" /></div>
                        @if(count($img) > 1)
                            @foreach ($img as $key => $value) 
                                <div style="padding-top: 0px;" class="tab-pane" id="{{$key}}" style="cursor: pointer;">
                                    <img class="lazy" 
                                    data-src="{{ Shared::getInstance()->urlResourceBig(trim($value), $tour->user_id) }}" />
                                </div>
                            @endforeach                 
                        @endif
                    </div>
                    <ul class="preview-thumbnail nav nav-tabs">
                        <li class="active">
                            <a data-target="#pic" data-toggle="tab" >
                                <img style="margin-top:6px; height:61px; width: 85px;" class="lazy" data-src="{{Shared::getInstance()->urlResource($tour->tour_photo, $tour->user_id)}}" />
                            </a>
                        </li>
                        <?php
                        if (count($img) > 1) {
                            foreach ($img as $key => $value) {
                                echo'<li>
                                        <a data-target="#' . $key . '" data-toggle="tab">
                                            <img style="margin-top:6px; height:61px; width: 85px;" class="lazy" data-src="' . Shared::getInstance()->urlResource(trim($value), $tour->user_id) . '"/>
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
                        <h3 style="margin-bottom: 0px;" class="price"> price: <span style="cursor: pointer;" data-toggle="popover" data-trigger="hover" data-content="Our special price" data-placement="top">${{$tour['tour_price']}}</span> <small style="text-transform: capitalize ">Per Person</small></h3>
                        <div class="panel-body">
                            <div class="row">
                                <p>Secure Payments : <img class="lazy" data-src="/img/paywith.png" style="height: 25px;"></p>
                            </div>
                        </div>  
                    </div>  
                    <div class="col-md-12">
                        <div class="input-group">
                            <input type="text" class="form-control" name="start"  id="from" placeholder="Start Date" />
                            <span class="input-group-addon">To</span>
                            <input type="text" class="form-control" name="end" id="to" placeholder="End Date" />
                        </div>
                    </div>                  
                    <div class="clear"></div>
                    <div class="spacing"></div>
                    <div class="col-md-12">
                        <div class="action">
                            <a  href="{{route('tour.addTocart', ['id' => $tour->id])}}" class="add-to-cart btn btn-default0 green" >add to cart</a> 
                        </div>
                    </div>
                </div>
            </div>
            <div class="clear"></div>
            <div class="spacing"></div>
            <div id="content" style="margin-top: 24px; background: none;">
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
    </div>  
</div>

<div class="spacing"></div>
<div class="container">
    <div class="col-md-12">
        @if($tourLink->count() > 0)
        <div class="row">
            <div class="title text-left">
                <h2><b>YOU MAY ALSO LIKE</b>
                    <div style="border: double #ddd;width: 100%;"></div>
                </h2>
            </div>        
            @if($tourLink->count() > 3)
            <div class="row">
                <div class="col-md-9">
                </div>
                <div class="col-md-3">
                    <div class="controls pull-right " style="margin-bottom:5px;">
                        <a class="left fa fa-chevron-left btn btn-primary" href="#carousel-example-generic"
                           data-slide="prev"></a>
                        <a  class="right fa fa-chevron-right btn btn-primary" href="#carousel-example-generic"
                            data-slide="next"></a>
                    </div>
                </div>  
            </div> 
            @endif
            <div class="row">   
                <div class="col-md-12">           
                    <div id="carousel-example-generic" class="carousel slide " data-ride="carousel">
                        <div class="carousel-inner">
                            @foreach($tourLink->chunk(4) as $key => $chunkTour)
                            <div class="item  {{$key == 0 ? 'active' : ''}}"> 
                                <div class="row">
                                    @foreach($chunkTour as $tour)
                                        @include('include.item')
                                    @endforeach
                                </div>
                            </div>
                            @endforeach                
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>  
</div>
@endsection