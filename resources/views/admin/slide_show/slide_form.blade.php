@extends("layouts.backend")
@section('title', config('app.name'))

<?php 
use App\components\Shared; ?>
@section('content')
<div id="wrapper">
    @include('admin.include.menu')
    <div id="page-wrapper" style="padding: 0 15px;">
    	@include('admin.include.message')
    	<div class="row">    		
	    	<form method="POST" action="{{route('slideCreate')}}" enctype="multipart/form-data">
		    	{{ csrf_field() }}
				<section class="col-md-8 connectedSortable">

					<input type="hidden" name="eid" value="{{{$slide->id or ''}}}">
					<div class="panel"> 
					    <h3>Title</h3>			  
						<div class="row">						    
						    <div class="box-body">
						      	<div class="col-md-12 col-md-12">
			                    	<div class="form-group">
			                            <input type="text" name="title" class="form-control input-md" placeholder="Title" value="{{{$slide->title or ''}}}" required>
			                        </div>		            
			                        <div class="form-group row">
			                        	<div class="col-md-6">
				                        	<label for="country">Country</label>
				                        	<select name="country" class="form-control btnSearch" action-to="province" required="">
				                        		<option value="0">--Home Page--</option>
												@foreach(\App\Country::where(['country_status'=>1, 'web'=>1])->orderBy('country_name', 'ASC')->get() as $con)	
												<option value="{{$con->id}}" {{$con->id == $conId ? 'selected' : ''}}>{{$con->country_name}}</option>
												@endforeach		
				                        	</select>
			                        	</div>
			                        	<div class="col-md-6">
				                        	<label for="province">Province</label>
				                        	<select name="province" class="form-control " id="province" >
				                        		<option value="">--select--</option>
												@foreach(\App\Province::where(['web'=> 1, 'country_id'=> $conId])->orderBy('province_name', 'ASC')->get() as $pro)
												<option value="{{$pro->id}}" {{$pro->id == $proId ? 'selected':''}}>{{$pro->province_name}}</option>
												@endforeach		
				                        	</select>
			                        	</div>                        	
			                        </div>
									<script src="{{asset('backend/lib/tinymce.min.js')}}"></script>
			                      	<div class="form-group row">
		                            	<div class="col-md-12">
		                            		<label for="desc">Descriptions</label>
											<textarea name="tour_desc" class="form-control my-editor" placeholder="Say Something">{!! $slide->intro or '' !!}</textarea>
							            </div>
			                        </div>			                    
			                        <hr class="colorgraph">
				                </div>        
						  	</div>
					  	</div>				  
				  	</div>
				</section>
			
				<section class="col-lg-3 connectedSortable"><br><br>
	                <div class="panel panel-default">
	                  <div class="panel-body">
	                    <div id="wrap-feature-image" style="position:relative;">

	                      <input type="hidden" name="image" id="data-img" value="{{{$slide->photo or ''}}}">
	                      @if(isset($slide->photo) && !empty($slide->photo))
	                      <img id="feature-img" src="{{isset($slide->photo) ? Shared::getInstance()->urlResource($slide->photo, $slide->user_id) : '#' }}" style="width:100%;margin-bottom:12px;" class="btnUploadFiles" data-type="single-img" data-toggle="modal" data-target="#myUpload">
	                      @else
	                      	<img id="feature-img" src="{{isset($slide->photo) ? Shared::getInstance()->urlResource($slide->photo, $slide->user_id) : '#' }}" style="width:100%;display:none;margin-bottom:12px;" class="btnUploadFiles" data-type="single-img" data-toggle="modal" data-target="#myUpload">

	                      @endif
	                      <i id="removeImage" class="fa fa-remove (alias)" title="Remove picture" style="display: none;"></i>
	                    </div>
	                    <a href="#uploadfile" class="btnUploadFiles" data-type="single-img" data-toggle="modal" data-target="#myUpload">Set Feature Image</a>
	                  </div>
	                  <div class="panel-footer">Supplier Logo</div>
	                </div>
	                

	                <div class="form-group"> 
	                  <button type="submit" class="btn btn-success btn-flat btn-sm">Submit</button>&nbsp;&nbsp;
	                  <a href="{{route('tourList')}}" class="btn btn-danger btn-flat btn-sm">Cancel</a>
	                </div>
                
              	</section>
				<div class="clear"></div>  
			</form>
		</div>
    </div>
</div>
@include('admin.include.textEditor')

@include('admin.include.windowUpload')
@endsection

