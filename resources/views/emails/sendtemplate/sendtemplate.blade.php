
<?php
use \App\components\Shared;
use \App\Tour;
    if ($country != '') {
        $tours = Tour::where(['country_id'=>$country, 'tour_status'=>1, 'web'=>1])->get();
    }else{
        $tours = Tour::where(['tour_status'=>1, 'web'=>1])->get();
    }    
?>
<!DOCTYPE html> 
<html>
<head>
    <title></title>
</head>
<body style="font-family: "Open Sans",Arial,sans-serif">
    <div id="wrapper" style="width: 1024px;margin: 0 auto; border: solid 1px #ddd;">
        <div id="page-wrapper" style="position: inherit;border-left: 1px solid #e7e7e7;">
            <div>
                <center>
                    <img src="{{url('/')}}/img/{{config('app.logo')}}" width="450">
                </center>
            </div>
            @foreach($tours->chunk(2) as $tour)
                <div class="row" style="margin-top: 28px; margin-left: -15px; margin-right: -15px;">  
                @foreach($tour as $item)
                    <?php $con = \App\Country::where('id',$country)->first();?>
                    <?php $pro = \App\Province::where('id',$item->tour_province)->first();?>
                    <div class="col-md-6" style="float: left; width: 47%; position: relative;min-height: 1px;padding-left: 15px;padding-right: 15px;">
                        <div style="line-height: 1.5em;background: #eee;"> 
                            <div style="overflow: hidden; max-height: 334px;">
                                <img src="{{Shared::getInstance()->urlResourceBig($item->tour_picture)}}" title="" style="width: 100%;">
                            </div>
                            <a href="{{url('/')}}/destination/{{$con->country_slug}}">
                                <span style="position: absolute;right:0;bottom:0;padding:0;top: 12px;left: 22px;height: 20%;"> 
                                    <span style="display: inline-block;min-width: 10px;padding: 3px 7px;font-size: 12px;color: #fff;vertical-align: middle;background-color: #777;border-radius: 10px; padding-right: 0.6em; padding-left: 0.6em;border-radius: 10rem;color: #fff;background-color: #dc3545;">{{$con->country_name}}</span> 
                                </span>
                            </a>
                            <div class="card-body" style="padding: 12px;">
                                @if($con)
                                <div class="news-title">
                                    <a href="{{url('/')}}/tour/{{$item->tour_slug}}">
                                        <div style="margin-top: 12px;">
                                            <span style="font-size: 21px;font-family: sans-serif;font-weight: 700;" href="#">{{str_limit($item->tour_name, 40)}}</span>
                                        </div>
                                    </a>
                                </div>
                                @endif
                                @if($pro)
                                    <small><em>{{$pro->province_name}} <span style="color: #ff8300;">{{ $item->tour_daynight ? '( '.$item->tour_daynight.' )' : ''}}</span></em></small>
                                @endif
                            </div>
                        </div>
                    </div> 
                    @endforeach                
                </div>
                <div style="clear: both;"></div>
            @endforeach                               
        </div>
        <div style="clear: both;"></div>
        <div style="padding:21px;border-top: solid 1px #ddd;margin-top: 41px;">
            <center>
                <table>
                    <tbody>
                        <tr>
                            <td><a href="https://www.facebook.com/AsiaExpeditionsDM/"><img src="{{url('/')}}/img/facebook.png"></a></td>
                            <td><a href="https://twitter.com/AsiaExpeditions"><img src="{{url('/')}}/img/twitter.png"></a></td>
                            <td><a hre="#"><img src="{{url('/')}}/img/pinterest.png"></a></td>
                            <td><a href="#"><img src="{{url('/')}}/img/instagram.png"></a></td>
                        </tr>
                    </tbody>
                </table>
            </center>
        </div>                      
    </div>
</body>
</html>