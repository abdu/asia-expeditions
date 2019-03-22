@extends("layouts.backend")
@section('title', config('app.name'))
<?php 	
use App\components\Shared;
?>
@section('content')
<div id="wrapper">
    @include('admin.include.menu')
    <div id="page-wrapper" style="padding: 0 15px;">
    	@include('admin.include.message')
    	<div class="row">    		
	    	<form method="POST" action="{{route('getUpdate')}}" enctype="multipart/form-data">
		    	{{ csrf_field() }}
				<section class="col-md-8 connectedSortable">
					<div class="panel"> 
					    <h3>Tour Name</h3>			  
						<div class="row">						    
						    <div class="box-body">
						      	<div class="col-md-12 col-md-12">
			                    	<div class="form-group">
			                            <input type="text" name="title" class="form-control input-md" placeholder="Tour Name" required value="{{$tour->tour_name}}">
			                            <input type="hidden" id="tour_id" name="tour_id" value="{{$tour->tour_id}}">
			                        </div>		            
			                        <div class="form-group row">
			                        	<div class="col-md-6">
				                        	<label for="country">Country</label>
				                        	<select name="country" class="form-control btnSearch" action-to="province" required="">
				                        		<option value="">--select--</option>
												@foreach(\App\Country::where(['country_status'=>1])->orderBy('country_name', 'ASC')->get() as $con)	
												<option value="{{$con->id}}" {{$tour->country_id == $con->id ? 'selected':''}}>{{$con->country_name}}</option>
												@endforeach		
				                        	</select>
			                        	</div>
			                        	<div class="col-md-6">
				                        	<label for="province">Province</label>
				                        	<select name="province" class="form-control" id="province" required="">
				                        		<option value="">--select--</option>
												@foreach(\App\Province::where(['web'=>1, 'country_id' => $tour->country_id])->orderBy('province_name', 'ASC')->get() as $pro)
												<option value="{{$pro->province_id}}" {{$pro->province_id == $tour->tour_province ? 'selected' : ''}}>{{$pro->province_name}}</option>
												@endforeach		
				                        	</select>
			                        	</div>                        	
			                        </div>
			                        <div class="form-group row">
			                        	<div class="col-md-12">
				                        	<label for="destination">Destinations</label>
				                        	<input type="text" name="destination" class="form-control" placeholder="Destinations" value="{{$tour->tour_dest}}">
			                        	</div>       	
			                        </div>
			                        <div class="form-group row">
			                        	<div class="col-md-6">
				                        	<label for="daynight">Days/Nights</label>
				                        	<input type="text" name="daynight" class="form-control" placeholder="Days & Nights" value="{{$tour->tour_daynight}}">
			                        	</div>     
			                        	<div class="col-md-6">
				                        	<label for="price">Price(USD)</label>
				                        	<input type="text" name="price" class="form-control" placeholder="Price(USD)" value="{{$tour->tour_price}}">
			                        	</div>                   	
			                        </div>
			                        <div class="form-group row">
		                            	<div class="col-md-12">
		                            		<label for="desc">Service included/excluded</label>
							                <script src="{{asset('backend/lib/tinymce.min.js')}}"></script>
											<textarea name="include" class="form-control my-editor">{!! old('include', $tour->tour_remark) !!}</textarea>
							            </div>
			                        </div>	
			                        <div class="form-group row">
		                            	<div class="col-md-12">
		                            		<label for="desc">Highlight</label>
											<textarea name="hightlight" class="form-control my-editor">{!! old('hightlight', $tour->tour_intro) !!}</textarea>
							            </div>
			                        </div>	
			                      	<div class="form-group row">
		                            	<div class="col-md-12">
		                            		<label for="desc">Descriptions</label>
											<textarea name="desc" class="form-control my-editor" placeholder="Say Something">{!! old('desc', $tour->tour_desc) !!}</textarea>
							            </div>
			                        </div>			                    
			                        <hr class="colorgraph">
				                </div>        
						  	</div>
					  	</div>				  
				  	</div>
				</section>
				<section class="col-md-4 connectedSortable"><br><br>
					<div class="fancy-collapse-panel">
	                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
	                        <div class="panel panel-default">
	                            <div class="panel-heading" role="tab" id="headingOne">
	                                <h4 class="panel-title">
	                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne"><strong>Choose Hotels</strong>
	                                    </a>
	                                </h4>
	                            </div>
	                            <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
	                                <div class="panel-body">
	                                	<div class="wrapperHotel" style="overflow: auto; max-height: 270px;">
										@foreach(\App\Suppliers::where(['business_id'=> 1, 'country_id' => $tour->country_id])->orderBy('supplier_name', 'ASC')->get() as $key => $sup)
											<div>
												<label style="font-weight: 400;">
												<input action="hotel" type="checkbox" class="checkData" name="hotel[]" value="{{$sup->id}}" {{in_array($sup->id, explode(',', $tour->suppplier_id)) ? 'checked':''}}> {{$sup->supplier_name}}</label>
											</div>
										@endforeach                              
										</div>
	                                </div>
	                                <div class="section-btn">
	                                   	<div class="text-right">
											<input type="submit" name="btnTrash" value="Save Trash" class="btn btn-default btn-sm">
											<input type="submit" name="btnPublish" value="Publish" class="btn btn-success btn-sm btn-flat">
										</div> 
									</div>
									<div class="clearfix"></div>
	                            </div>
	                        </div>
	                         <div class="panel panel-default">
	                            <div class="panel-heading" role="tab" id="headingOne">
	                                <h4 class="panel-title">
	                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne"><strong>Categories</strong>
	                                    </a>
	                                </h4>
	                            </div>
	                            <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
	                                <div class="panel-body">
	                                	<div style="overflow: auto; max-height: 270px;">
	                                	@foreach(\App\Category::where(['web'=> 1])->orderBy('name', 'ASC')->get() as $bus)
											<div><label style="font-weight: 400;">
												<input class="checkData" action="category" type="checkbox" name="cat[]" value="{{$bus->id}}" {{in_array($bus->id, explode(',', $tour->category)) ? 'checked':''}}> {{$bus->name}}</label></div>
										@endforeach                              
										</div>
	                                </div>	                               
									<div class="clearfix"></div>
	                            </div>
	                        </div>
	                         <div class="panel panel-default">
	                            <div class="panel-heading" role="tab" id="headingTwo">
	                                <h4 class="panel-title">
	                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo"><strong>Image Feature</strong>
	                                    </a>
	                                </h4>
	                            </div>
	                            <div id="collapseTwo" class="panel-collapse " role="tabpanel" aria-labelledby="headingTwo">
	                                <div class="panel-body">
	                                   	<a id="choosImg" href="javascript:void(0)">Choose Image</a>
							        	<input name="image" type='file' id="imgInp" style="display: none;" />
							        	<input type="hidden" name="old_photo" value="{{$tour->tour_picture}}">
							        	<center>							        		
									    	<?php
							        			$name=($tour->tour_picture !=''? Shared::getInstance()->urlResource($tour->tour_picture) :'#');
							        			$action = ($tour->tour_picture !='' ?'':'none');
							        		?>
										    <img class="img-responsive" id="blah" src="{{$name}}" style="display: {{$action}}; cursor: pointer;"/>
									    </center> 
	                                </div>
	                            </div>	                            
	                        </div>
                         	<div class="panel panel-default">
	                            <div class="panel-heading" role="tab" id="headingThree">
	                                <h4 class="panel-title">
	                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="true" aria-controls="collapseThree"><strong>Image Gallery</strong>
	                                    </a>
	                                </h4>
	                            </div>
	                            <div id="collapseThree" class="panel-collapse " role="tabpanel" aria-labelledby="headingThree">
	                                <div class="panel-body">
	                                   	<a id="choosGallery" href="javascript:void(0)">Choose Image</a>
							        	<input name="gallery[]" type='file' id="gallery" style="display: none;" multiple="" />
							        	<input type="hidden" name="old_gallery" value="{{$tour->tour_photo}}">
							        	<center>
										    <img class="img-responsive" id="blah" src="#" style="display: none; cursor: pointer;"/>
									    </center>
									    <div class="placeImage">
										    <?php $gallery =  explode('|', rtrim($tour->tour_photo,'|'));?>
									    	@if($gallery[0])
										    	@foreach($gallery as $img)
										    		<img class="item_Image" src="{{Shared::getInstance()->urlResource($img)}}">
										    	@endforeach
										    @endif
									    </div> 
	                                </div>
	                            </div>	                            
	                        </div>
	                    </div>
	                </div>
				</section>   
				<div class="clear"></div>  
			</form>
		</div>
    </div>
</div>
@include('admin.include.textEditor')
@endsection

