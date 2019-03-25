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
                        	<h3 style="font-size: 18px;"><a href="">{{$getfilm1->title}}</a></h3>
                        
                            <div>
                            	<p>{!! str_limit(strip_tags($getfilm1->desc),300)!!}<a href="{{route('film_detail', $getfilm1->slug)}}" style="padding:3px 8px; border-radius:10px; font-weight: 500;">...Read More</a></p>
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
                    	 <div class="row">			                 
				
				          <iframe width="500" height="100" src="https://www.youtube-nocookie.com/embed/{{$getfilm2->video}}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen  class="img-responsive img-box img-thumbnail"></iframe>	
					                 
					     </div>
			            </div>	  
                        <div class="col-md-6">
                        	<h3 style="font-size: 18px;"><a href="">{{$getfilm2->title}}</a></h3>
                        
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




			                  
				               
					      
@endsection