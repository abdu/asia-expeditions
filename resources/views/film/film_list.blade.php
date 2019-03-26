    @extends('layouts.app')
@section('title', $con->country_name. " Film")
@section('content')
@include("include.menu")

<?php $data1=$data->where('type',0); ?>
<?php $data2=$data->where('type',1); ?>
<div class="container">
	<div class="row"> 
		<div class="col-md-12">
			<h1 class="product-title breadcrumb" style="text-transform: uppercase; background: #227eac;border: solid 1px #9E9E9E;box-shadow: 0px 0px 0px 0px;color: white;padding: 12px 0px 12px 12px;">Myanmar Film</h1>
		</div>
		
			<div class="col-sm-12 col-md-7">
			 <div  class="b_item">	
         @foreach($data1 as $getfilm1)
                    <div class="list-group-item b_list">
                	  
                        <div class="col-md-12">
                        	<h3 style="font-size: 18px;"><a href="{{route('film_detail', $getfilm1->slug)}}">{{$getfilm1->title}}</a></h3>
                              <small>
                                <i class="glyphicon glyphicon-time"></i> {{date('Y-F-d',strtotime($getfilm1->created_at))}} <span class="twitter"></span>
                                <br>
                            </small>
                        
                            <div>
                            	<p>{!! str_limit(strip_tags($getfilm1->desc),170) !!}<a href="{{route('film_detail', $getfilm1->slug)}}" style="padding:3px 8px; border-radius:10px; font-weight: 500;">Read More</a></p>
                            </div>
                        	<div class="clearfix"></div>
                        </div>
                        <div class="clearfix"></div>

                    </div>
            @endforeach
            </div>
			</div>
      <div class="col-sm-12 col-md-5">
        <div  class="b_item">
                <div id="ShowVideoModal" class="modal">
                  <div class="animate" style="">
                    <span class="closes" title="Close Modal">&times;</span>
                    <div class="imgcontainer">
                     <iframe style="box-shadow: 0px 2px 10px 0px white;" width="560" height="315" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>
                  </div>
                </div>
                @foreach($data2 as $getfilm2) 
                    <div class="list-group-item b_list">
                      	<div class="col-md-6">
                        	  <div class="row" style="text-align: center;"  >			                 
                              <div style="width: 100%; height: 100%; position: absolute; " class="videoFrame"  data-videoid="{{$getfilm2->video}}" >
                              </div>
                              <iframe width="500" height="100" src="https://www.youtube.com/embed/{{$getfilm2->video}}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen  class="img-responsive img-box img-thumbnail"></iframe>    
            					      </div>
    			               </div>	  
                        <div class="col-md-6">
                        	<h3 class="alink {{$getfilm2->id}}" >{{$getfilm2->title}}</h3>
                             <small>
                                <i class="glyphicon glyphicon-time"></i> {{date('Y-F-d',strtotime($getfilm2['created_at']))}}<br>
                            </small>
                            <div>
                            	<p>{!! str_limit(strip_tags($getfilm2->desc),100)!!}</p>
                            </div>
                        	<div class="clearfix"></div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                @endforeach
        </div>
      </div>
</div>
</div>




<!-- <script>
    jQuery(".videoFrame").click(function (e) {
        var videoID = $(this).data("videoid"); 
        alert(videoID);

        // var videoEl = jQuery(this).closest("#"+videoID).find('iframe');
        var Iframe = $(".imgcontainer").find("iframe");
        videoEl.attr('src', "https://www.youtube.com/embed/"+videoID);


    });
</script>  -->

 <script type="text/javascript">
     $(document).ready(function(){
        $(".closes").click(function(){
            $('#ShowVideoModal').modal('hide');
            var videoEl = $(".imgcontainer").find("iframe");
            videoEl.attr('src', "");
        });

        $(".videoFrame").click(function(){
            var videoID = $(this).data("videoid"); 

            // var videoEl = jQuery(this).closest("#"+videoID).find('iframe');
            var videoEl = $(".imgcontainer").find("iframe");
            videoEl.attr('src', "https://www.youtube.com/embed/"+videoID);
            
            $('#ShowVideoModal').modal('show')
        });

     });
 </script>  




		                  			               
					      
@endsection