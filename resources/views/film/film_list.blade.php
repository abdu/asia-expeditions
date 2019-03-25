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
                        
                            <div>
                            	<p>{!! str_limit(strip_tags($getfilm1->desc),300) !!}<a href="{{route('film_detail', $getfilm1->slug)}}" style="padding:3px 8px; border-radius:10px; font-weight: 500;">Read More</a></p>
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
            @foreach($data2 as $getfilm2)          	
             

                    <div class="list-group-item b_list">
                    	<div class="col-md-6">
                    	 <div class="row"  >			                 
				       
                      <div style="width: 100%; height: 100%; position: absolute; " onclick="document.getElementById(<?= $getfilm2->id ?>).style.display='block'"  >
                        </div>
                              <iframe width="500" height="100" src="https://www.youtube-nocookie.com/embed/{{$getfilm2->video}}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen  class="img-responsive img-box img-thumbnail"></iframe>    
                      
				      
					          
					     </div>
			            </div>	  
                        <div class="col-md-6">
                        	<h3 class="alink" onclick="document.getElementById('<?= $getfilm2->id ?>').style.display='block'">{{$getfilm2->title}}</h3>
                            <div>
                            	<p>{!! str_limit(strip_tags($getfilm2->desc),100)!!}</p>
                            </div>
                        	<div class="clearfix"></div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                            <div id="{{$getfilm2->id}}" class="modal">
                              <div class="animate" style="">
                            <span id="{{$getfilm2->id}}" onclick="document.getElementById('<?= $getfilm2->id ?>').style.display='none'"  class="closes" title="Close Modal">&times;</span>
                                <div class="imgcontainer">
                                 <iframe id="{{$getfilm2->id}}" style="box-shadow: 0px 2px 10px 0px white;" width="560" height="315" src="https://www.youtube-nocookie.com/embed/{{$getfilm2->video}}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                </div>
                            </div>
                         </div>
                <script>
// Get the modal
var modal = document.getElementById('<?=$getfilm2->id ?>');
// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
    jQuery("#<?= $getfilm2->id ?>").click(function (e) {
      var $videoEl = jQuery(this).closest('#<?= $getfilm2->id ?>').find('iframe');
      $videoEl.attr('src', $videoEl.attr('src'));
});

</script>   

               
                @endforeach
            </div>

  </div>
</div>
</div>


		                  			               
					      
@endsection