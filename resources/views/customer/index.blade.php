@extends('layouts.app')
@section('title')
	
@endsection
<?php use App\components\Shared; ?>

@section('content')
<link href="{{asset('/css/material-dashboard.css')}}" rel="stylesheet" /> 

  @include('include.menu')    
      <div class="content">
        <div class="container-f">
          <div class="row">            
            <div class="col-lg-8 col-md-12">
              <div class="card">
                <div class="card-header card-header-tabs card-header-primary">
                  <div class="nav-tabs-navigation">
                    <div class="nav-tabs-wrapper">
                      <!-- <span class="nav-tabs-title">Tasks:</span> -->
                      <ul class="nav nav-tabs" data-tabs="tabs">
                        <li class="nav-item active">
                          <a class="nav-link active" href="#profile" data-toggle="tab">
                            <i class="fa fa-user"></i> Your Account
                            <div class="ripple-container"></div>
                          </a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="#messages" data-toggle="tab">
                            <i class="fa fa-envelope "></i> Your Send Inquiry
                            <div class="ripple-container"></div>
                          </a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="#settings" data-toggle="tab">
                            <i class="fa fa-unlock"></i> Change Password
                            <div class="ripple-container"></div>
                          </a>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
                <div class="card-body">
                  <div class="tab-content">
                    <div class="tab-pane active" id="profile">
                      <table class="table">                    
                        <div class="card-body">
                          <?php $data=\App\User::where('id',Auth::user()->id)->first(); ?>
                          <form action="{{route('doAccount')}}" method="post">
                            {{ csrf_field() }}
                            <input type="hidden"  name="id" value="{{$data->id}}">
                            <div class="row">          
                              <div class="col-md-6 col-sm-12">
                                <div class="form-group1">
                                  <label class="bmd-label-floating">Fist Name</label>
                                  <input type="text" class="form-control1" name="first_name" value="{{$data->name}}" required="">
                                </div>
                              </div>
                              <div class="col-md-6 col-sm-12">
                                <div class="form-group1">
                                  <label class="bmd-label-floating">Last name</label>
                                  <input type="text" class="form-control1" name="last_name" value="{{$data->last}}" required="">
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-md-4 col-sm-12">
                                <div class="form-group1">
                                  <label class="bmd-label-floating">Nationality</label>                                
                                  <select class="form-control1" name="nation">
                                    @foreach(App\Country::orderBy('nationality')->get() as $con)
                                      <option value="{{$con->id}}" {{ $data->nationality== $con->id ? 'selected':''}}>{{$con->nationality}}</option>
                                    @endforeach
                                  </select>
                                </div>
                              </div>
                              <div class="col-md-4 col-sm-12">
                                <div class="form-group1">
                                  <label class="bmd-label-floating">Passport Number</label>
                                  <input type="text" class="form-control1" name="passport_number" value="{{isset($data->passport)? $data->passport: ''}}" required="">
                                </div>
                              </div>                            
                              <div class="col-md-4 col-sm-12">
                                <div class="form-group1">
                                  <label class="bmd-label-floating">Expiry Date</label>
                                  <input type="tett" class="form-control1" name="expiry_date" value="{{$data->expiry_date}}" id="expiry_date" required="">
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-md-4 col-sm-12">
                                <div class="form-group1">
                                  <label class="bmd-label-floating">Address Street</label>
                                  <input type="text" class="form-control1"  name="address_street" value="{{$data->address}}" required="">
                                </div>
                              </div>
                              <div class="col-md-4 col-sm-12">
                                <div class="form-group1">
                                  <label class="bmd-label-floating">Town / City</label>                                        
                                  <select class="form-control1" name="town_city">
                                    @foreach(App\Province::orderBy('id')->get() as $pro)
                                      <option value="{{$pro->id}}" {{  $data->province_id== $pro->id ? 'selected':''}}>{{$pro->province_name}}</option>
                                    @endforeach
                                  </select>
                                </div>
                              </div>
                              <div class="col-md-4 col-sm-12">
                                <div class="form-group1">
                                  <label class="bmd-label-floating">Country / State</label>                                         
                                  <select class="form-control1" name="country_state">
                                    @foreach(App\Country::orderBy('id')->get() as $con)
                                      <option value="{{$con->id}}" {{  $data->country_id== $con->id ? 'selected':''}}>{{$con->country_name}}</option>
                                    @endforeach
                                  </select>
                                </div>
                              </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 col-sm-12">
                                  <div class="form-group1">
                                    <label class="bmd-label-floating"> Zip / Postal Code</label>
                                    <input type="text" class="form-control1"  name="zip_code" value="{{$data->postal}}" required="">
                                  </div>
                                </div>
                                <div class="col-md-4 col-sm-12">
                                  <div class="form-group1">
                                    <label class="bmd-label-floating">Phone Number</label>
                                    <input type="text" class="form-control1" name="phone_number" value="{{$data->phone}}" required="">
                                  </div>
                                </div>
                                <div class="col-md-4 col-sm-12">
                                  <div class="form-group1">
                                    <label class="bmd-label-floating">Email Address</label>
                                    <input type="text" class="form-control1" name="email" value="{{$data->email}}" required="">
                                  </div>
                                </div>
                            </div>                          
                            <button type="submit" class="btn btn-rose pull-right">Update Profile</button><div class="clearfix"></div>
                          </form>
                        </div>                            
                      </table>
                    </div>
                    <div class="tab-pane" id="messages">
                      <div class="table-responsive">
                        <table class="table">
                          <div class="col-md-12"><?php $getdata=\App\ItemOrder::where('customer_id', Auth::id())->get(); $n=1; ?>
                            @if($getdata->count()>0)                              
                              <thead class="text-primary">
                                <tr> 
                                  <th width="15">No</th>
                                  <th>Tour Name</th>
                                  <th>From Date</th>
                                  <th>To Date</th>                                  
                                  <th>Additional Requests</th>                                
                                </tr>
                              </thead>
                              @foreach($getdata as $item)                            
                                <tbody>
                                  <tr>
                                    <td>{{$n++}}</td>
                                    <td>{{$item->tour->tour_name}}</td>
                                    <td>{{$item->fdate}}</td>
                                    <td>{{$item->tdate}}</td>
                                    <td>{{str_limit($item->a_requests,120)}}</td>
                                  </tr>
                                </tbody>                     
                              @endforeach                                                         
                            @else
                                <span> Your Tour Details is empty  <span class="fa fa-info-circle"></span></span>
                            @endif                                                      
                          </div>
                        </table>
                      </div>
                    </div>
                    <div class="tab-pane" id="settings">
                      <table class="table">
                        <div class="card-body">
                          <form action="{{route('edit.password')}}" method="post">
                            {{ csrf_field() }}
                            <input type="hidden" name="email" value="{{$data->email}}">
                            <div class="row">          
                              <div class="col-md-12 col-sm-12">
                                <div class="form-group1">
                                  <label class="bmd-label-floating">Current Password</label>
                                  <input type="text" class="form-control1" value="{{$data->password_text}}" readonly="">
                                </div>
                              </div>
                              <div class="col-md-12 col-sm-12">
                                <div class="form-group1">
                                  <label class="bmd-label-floating">New Password</label>
                                  <input type="password" class="form-control1" name="new_password" required="">
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-md-12 col-sm-12">
                                <div class="form-group1">
                                  <label class="bmd-label-floating">Re-New Password</label>
                                  <input type="password" class="form-control1" name="re_new_password" required="">
                                </div>
                              </div>                      
                            </div>             
                            <button type="submit" class="btn btn-rose pull-right">Update Profile</button>
                            <div class="clearfix"></div>
                          </form>
                        </div> 
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-4 col-sm-12">
              <div class="card card-profile">
                <div class="card-avatar">
                  <div class="changep btnUploadFiles"data-type="single-img" data-toggle="modal" data-target="#myUpload"></div>
                  <a href="#uploadfile" >
                    @if(isset($data->picture) && !empty($data->picture))
                      <img id="feature-img" src="{{isset($data->picture) ? Shared::getInstance()->urlResource($data->picture, Auth::user()->id) : '#' }}" style="width:100%;margin-bottom:12px;" class="btnUploadFiles" data-type="single-img" data-toggle="modal" data-target="#myUpload">
                    @else
                      <img id="feature-img" src="{{isset($data->picture) ? Shared::getInstance()->urlResource($data->picture, Auth::user()->id) : '#' }}" style="width:100%;display:none;margin-bottom:12px;" class="btnUploadFiles" data-type="single-img" data-toggle="modal" data-target="#myUpload">
                    @endif
                  </a>
                </div>
                <div class="card-body">
                  <h6 class="card-category text-gray">CEO / Co-Founder</h6>
                  <h4 class="card-title">Alec Thompson</h4>
                  <p class="card-description">
                    Don't be scared of the truth because we need to restart the human foundation in truth And I love you like Kanye loves Kanye I love Rick Owens’ bed design but the back is...
                  </p>
                  <a href="#pablo" class="btn btn-primary btn-round">Follow</a>
                </div>
              </div>
            </div>

            <div class=" col-md-12 col-sm-12" >               
                  <?php $getself = \App\Tour::getTourByUser();?>
              <div class="col-md-12 col-sm-12"style="border:0;box-shadow: 0 1px 4px 0 rgba(0, 0, 0, 0.14);">
                <h4 style="padding: 0px 0px 30px 0px;font-weight: 600!important;">RECENT VIEW</h4>
                  @foreach($getself as $datas)           
                    <div class="col-lg-3 col-md-3">
                      <div class="card card-product" style="margin-top: 10px;">
                        <div class="card-image" data-header-animation="">
                          <a href="{{route('tourDetails', ['url'=> $datas->slug])}}">                                        
                            <img class="img lazy" data-src="{{Shared::getInstance()->urlResource($datas->tour_photo, $datas->user_id)}}" style="width: 100%;" /></a>
                        </div>
                        <div class="stats text-center">
                          <p class="category"><i class="fa fa-map-marker"></i> Barcelona, Spain</p>
                        </div>
                        <div class="card-content" style="padding: 0px 15px 0px 15px;">                
                            <h3 class="card-title" style="height: 50px;">
                              <a href="{{route('tourDetails', ['url'=> $datas->slug])}}">{!! str_limit($datas->tour_name,120) !!}</a>
                            </h3>
                            <div class="card-description">                                  
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class=" price text-center">
                                <h3 style="margin:margin: 9px 0 9px;"> <b>${{Shared::money($datas->tour_price)}}</b> <small>Per Person</small></h3>
                            </div>                                
                            
                        </div>
                        <div class="text-center" style="margin: -30px 0px 0px -15px;padding-bottom: 10px;">
                            <a href="{{route('tourDetails', ['url'=> $datas->slug])}}">
                                <button class="btn btn-rose " >View More</button></a>
                        </div>
                      </div>
                    </div> 
                  @endforeach                     
              </div>                     
            </div>                                          
          </div> 
          <div class="text-center" > {{ $getself->links() }} </div> 
        </div>
      </div>
<script>
  $(document).ready(function () {
    var formatdate = "yyyy-mm-dd";
    var nowTemp = new Date();
    var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);
    var book_date = $("#expiry_date").datepicker({
      format: formatdate,
      onReder: function(date) {}
      }).on('changeDate', function(ev){       
           $(this).datepicker('hide');
      }).data('datepicker');
  });
</script>

       @include('include.user_upload')

@endsection