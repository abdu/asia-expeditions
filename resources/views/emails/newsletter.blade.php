<!DOCTYPE html>
<html>
<head>
    <title>{{config('name')}}</title>
    <!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
	<!-- Latest compiled and minified JavaScript -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
<?php
use App\components\Shared;
?>
<style type="text/css">
    #popup-tags {
        z-index: 9999;
        padding-left: 0px;
    }
    #tag_select {
        background: #ffffff;
        width: 100%;
        position: absolute;
        height: auto;
        background-color: #fff;
        border: 1px solid #ccc;
        border: 1px solid rgba(0,0,0,0.15);
        border-radius: 4px;
        -webkit-box-shadow: 0 6px 12px rgba(0,0,0,0.175);
        box-shadow: 0 6px 12px rgba(0,0,0,0.175);
        background-clip: padding-box;
    }
    div#tag_select div {
        padding: 4px 7px;
    }
    div#tag_select div:hover {
        background: -webkit-linear-gradient(top, #ffffff, #dcdcdc);
    }

    #email{
        border: 0;
        /*color: #fff;*/
    }
    *:focus {
        outline: none;
    }

    /*#email:active, #email:focus{
        border: 0;
        color: #fff;
    }*/
</style>
</head>
<body style="background: #eae0b8;">
<div style=" padding-right: 15px; padding-left: 15px; margin-right: auto; margin-left: auto;"><br>
    <a href="https://asia-expeditions.com/"  target="_blank" style="text-decoration: none; cursor: default;">
    <center><img src="{{asset('img/')}}/{{config('app.logo')}}" ></center></a>
    <div style="background:white; float: none; margin: auto; width: 751px;     padding-right: 15px; padding-left: 15px;">
        <div class="row" style="padding-top:25px;">
        <form action="{{url('sentnewsletter')}}" method="post" >
        {{ csrf_field() }}
	       	<div class="col-md-12">
	       		<div style="border-bottom: solid 1px #ddd; border-top: dashed 1px #ddd; padding: 4px;">  
                    <span>where we are </span>
                    <span>where we are </span>
                    <span>where we are </span>
                    <span>where we are </span>
                 
                    <input type="text" name="email" id="email" onkeyup="getEmailNewsletter();" placeholder="Enter email Ex: (one@gmail.com,two@gmail.com,,, )">
                    <div id="popup-tags" class="col-md-6">
                        <div id="tag_select" style="display: none;">

                        </div>
                    </div>
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="submit">
                            Send
                        </button>
                    </span>
			    </div>
            </div>
		</form>
        <?php
        $getPro = \App\Province::where([['web','=', 1],['newsletter','=', 1]])->get();
        ?>
            @foreach($getPro->chunk(4) as $prochunk)
                @foreach($prochunk as $pro)
                <?php
                $count = \App\ProgramTour::Where([['tour_province', '=', $pro['province_id'] ], ['web','=', 1]])->count();
                $country = \App\Country::where([['country_id','=', $pro['province_country']],['country_status','=',1]])->first();
                ?>
                    <div style=" float: left; margin-bottom: 30px; width: 50%; position: relative;min-height: 1px; padding-right: 15px; padding-left: 15px;">
                        <div class="card" style="display: block;margin-bottom: 20px;line-height: 1.42857143;background-color: #fff;border-radius: 2px;box-shadow: 0 2px 5px 0 rgba(0,0,0,0.16),0 2px 10px 0 rgba(0,0,0,0.12);transition: box-shadow .25s;">
                            <a class="img-card" target="_blank" href="{{url('/destination')}}/{{$country->country_name}}/{{ $pro->province_name }}" title="{{$pro->province_name}}" style="width: 100%;height:200px;border-top-left-radius: 2px;border-top-right-radius: 2px;display: block;overflow: hidden;">
                                <img src="{{Shared::getInstance()->urlResource($pro->province_picture)}}" style=" width: 100%;height: 200px; object-fit:cover; transition: all .25s ease;">
                            </a>
                            <br/> 
                            <div class="card-content" style="padding: 15px; text-align: left;">
                                <h5 class="card-title" style="margin-top: 0px; font-weight: 700; font-size: 1.65em;">
                                    <a target="_blank" href="{{url('/destination')}}/{{$country->country_name}}/{{ $pro->province_name }}" title="{{$pro->province_name}}" 
                                        title="{{ $pro->province_name }}" style=" text-decoration: none !important;">
                                        {!! $pro->province_name !!}                                
                                    </a>
                                    <div class="clear"></div>
                                    <div class="pull-left"><a href="{{url('/destination', ['name' => $country->country_name ])}}"><small>{{ $country->country_name }}</small></a></div>
                                    <div class="pull-right"><small>{{ $count }} properties</small></div><br>
                                    <div class="clear"></div>
                                </h5>
                            </div>                   
                        </div>
                        <div class="clear"></div>
                    </div>
                @endforeach

            @endforeach 
        </div>
        <div style="clear: both;"></div>
        <div class="row">            
            <div class="footer" id="footer" style=" background: #EDEFF1; height: auto; padding-bottom: 30px;     height: 122px; position: relative;width: 100%;border-bottom: 1px solid #CCCCCC;border-top: 1px solid #DDDDD;">
                <div  style="min-height: 1px; padding-right: 15px;padding-left: 15px;width: 100%;float: left;">
                    <div  style="min-height: 1px; padding-right: 15px;padding-left: 15px;width: 45%;float: left;">
                        <h3> Follow Us </h3>
                        <ul style="list-style: none; ">
                            <li style="float: left; padding: 6px 8px; width: 48px;"><a href="https://www.facebook.com/AsiaExpeditionsDM/" target="_blank"><img src="https://simplesharebuttons.com/images/somacro/facebook.png" style="width: 40px;"></a></li>
                            <li style="float: left; padding: 6px 8px; width: 48px;"><a href="https://twitter.com/AsiaExpeditions" target="_blank"> <img src="https://simplesharebuttons.com/images/somacro/twitter.png" style="width: 40px;"></a></li>
                            <li style="float: left; padding: 6px 8px; width: 48px;" ><a href="https://plus.google.com/105743914548433123702" target="_blank"><img src="https://simplesharebuttons.com/images/somacro/google.png" style="width: 40px;"></a></li>
                            <div style="clear: both;"></div>  
                        </ul>    
                        <div style="clear: both;"></div>      
                    </div>     
                    <div  style="min-height: 1px;padding-right: 15px;padding-left: 15px;width: 42%;float: left;">
                        <a href="https://asia-expeditions.com/" style="text-decoration: none; cursor: default;">
                            <h3> Find your journey here...!  </h3>
                            <div class="form-group input-group">
                                <input type="text" class="form-control" placeholder="find you deals">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button"><i class="fa fa-search"></i>
                                    Search
                                    </button>
                                </span>
                            </div>
                        </a>
                        <div style="clear: both;"></div>  
                    </div>  
                    <div style="clear: both;"></div>         
                </div>               
                <div style="clear: both;"></div>  
            </div>   
        <div style="clear: both;"></div>           
        </div>
    </div>
    </div>
    <div id="data" data-url="{{ Shared::getInstance()->geturl() }}"></div>
    </body>
</html>

<script type="text/javascript">
    function getEmailNewsletter(){

        var url = $("#data").attr('data-url');  
        var email = $("#email").val();    
        $.ajax({        
            url: url+'/getemailNewsletter',
            method: 'get',
            data:{'email':email},
            dataType: 'text',
            success: function(result){                 
                if (result != "" && email != '') {
                    $("#tag_select").css('display', 'block');
                    $("#tag_select").html(result);
                }else{

                    $("#tag_select").html('<li class="list-group-item">Not found..!</li>');
                }
            }
        });
    }

</script>

<script type="text/javascript">
    $(document).ready(function(){
        $("body").click( function(){
            $("#tag_select").css('display', 'none');
        });
    });
</script>




<!-- 
<script type="text/javascript">
    $(document).ready(function(){
        var url = $("#data").attr('data-url');        
        var email = $("#email").val();        
        $.ajax({        
            url: url+'/getemailNewsletter'
            method: 'get',
            data:{'email':email},
            dataType: 'text',
            success: function(result){

                alert(result);
                // if (result != "" && cityname != '') {
                //     $("#myUL").html(result);
                // }else{
                //     $("#myUL").html('<li class="list-group-item">Not found..!</li>');
                // }
            }
        });
    });
</script>
 -->