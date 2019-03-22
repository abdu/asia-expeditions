@extends("layouts.backend")
@section('title', config('app.name'))
<?php 	use App\components\Shared;
?>
@section('content')
<div id="wrapper">
    @include('admin.include.menu')
    <div id="page-wrapper" style="padding: 0 15px;">
    	@include('admin.include.message')
    	<div class="row">    		
	    	<form method="POST" action="{{route('updateClient')}}" enctype="multipart/form-data">
		    	{{ csrf_field() }}
				<section class="col-md-8 connectedSortable">
					<div class="panel"> 
					    <h3 class="border">Add New Client</h3>			  
						<div class="row">						    
						    <div class="box-body">
						      	<div class="col-md-12 col-md-12">
						      		<div class="row">
							      		<div class="col-md-12">
					                    	<div class="form-group">
					                    		<label for="country">Client Name</label>
					                            <input type="text" name="name" class="form-control input-md" placeholder="Client Name" value="{{$client->name}}">
					                      		<input type="hidden" name="eid" value="{{$client->id}}">
					                        </div>		          
				                        </div>  				                      
				                    </div>			                       
			                         <div class="row">
			                        	<div class="col-md-6 col-xs-6 form-group">
				                        	<label for="country">Phone</label>
				                        	<input type="text" name="phone" class="form-control input-md" placeholder="+855 (12) 123 456" value="{{$client->phone}}">
			                        	</div>
			                        	<div class="col-md-6 col-xs-6 col-xs-6 form-group">
				                        	<label for="province">Client From</label>
				                        	<input type="text" name="client_from" class="form-control input-md" placeholder="Client From" value="{{$client->from}}">
			                        	</div>                        	
			                        </div>
			                        <div class="row">
			                        	<div class="col-md-6 col-xs-6 form-group">
				                        	<label for="country">Email</label>
				                        	<input type="text" name="email" class="form-control input-md" placeholder="Enter Email Address" value="{{$client->email}}" readonly>
			                        	</div>
			                        	<div class="col-md-6 col-xs-6 col-xs-6 form-group">
				                        	<label for="province">Password</label>
				                        	<input type="text" name="password" class="form-control input-md" placeholder="Enter Password" value="{{$client->password_text}}" readonly>
			                        	</div>                        	
			                        </div>	                      
			                      	<div class="form-group row">
		                            	<div class="col-md-12">
		                            		<label>Introduction</label>
		                            		<script src="{{asset('backend/lib/tinymce.min.js')}}"></script>
											<textarea name="descs" class="form-control my-editor" placeholder="CLient Introduction">{!! old('descs', $client->descs) !!}</textarea>
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
	                            <div class="panel-heading" role="tab" id="headingTwo">
	                                <h4 class="panel-title">
	                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo"><strong>Profile Photo</strong>
	                                    </a>
	                                </h4>

	                            </div>
	                            <div id="collapseTwo" class="panel-collapse " role="tabpanel" aria-labelledby="headingTwo">
	                                <div class="panel-body">
	                                   	<a id="choosImg" href="javascript:void(0)">Choose Image</a>
							        	<input name="photo" type='file' id="imgInp" style="display: none;"/>
							        	<input type="hidden" name="old_photo" value="{{$client->picture}}">
							        	<center>									    
									    	<?php
							        			$name=($client->picture !=''? Shared::getInstance()->urlResourceBig($client->picture) :'#');
							        			$action = ($client->picture !='' ?'':'none');
							        		?>
										    <img class="img-responsive" id="blah" src="{{$name}}" style="display: {{$action}}; cursor: pointer;"/>
									    </center> 
	                                </div>
	                            </div>
	                            <div class="section-btn">
                                   	<div class="text-right">
										<!-- <input type="submit" name="btnTrash" value="Save Trash" class="btn btn-default btn-sm"> -->
										<input type="submit" name="btnPublish" value="Publish" class="btn btn-success btn-sm btn-flat">
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

