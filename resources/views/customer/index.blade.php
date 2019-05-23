@extends('layouts.app')
@section('title')
	
@endsection
<?php use App\components\Shared; ?>

@section('content')

  @include('include.menu')
  <link href="../assets/css/material-dashboard.css?v=2.1.1" rel="stylesheet" />

      <div class="content">
        <div class="container-f">
          <div class="row">

            
            <div class="col-lg-8 col-md-12">
              <div class="card">
                <div class="card-header card-header-tabs card-header-primary">
                  <div class="nav-tabs-navigation">
                    <div class="nav-tabs-wrapper">
                      <span class="nav-tabs-title">Tasks:</span>
                      <ul class="nav nav-tabs" data-tabs="tabs">
                        <li class="nav-item">
                          <a class="nav-link active" href="#profile" data-toggle="tab">
                            <i class="material-icons"></i> Your Account
                            <div class="ripple-container"></div>
                          </a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="#messages" data-toggle="tab">
                            <i class="material-icons"></i> Your Order
                            <div class="ripple-container"></div>
                          </a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="#settings" data-toggle="tab">
                            <i class="material-icons"></i> Change Password
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
                              <form>
                                <div class="row">          
                                  <div class="col-md-6 col-sm-12">
                                    <div class="form-group1">
                                      <label class="bmd-label-floating">Fist Name</label>
                                      <input type="text" class="form-control1" name="first_name">
                                    </div>
                                  </div>
                                  <div class="col-md-6 col-sm-12">
                                    <div class="form-group1">
                                      <label class="bmd-label-floating">Last name</label>
                                      <input type="text" class="form-control1" name="last_name">
                                    </div>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-md-4 col-sm-12">
                                    <div class="form-group1">
                                      <label class="bmd-label-floating">Nationality</label>
                                      <input type="text" class="form-control1" name="nation">
                                    </div>
                                  </div>
                                  <div class="col-md-4 col-sm-12">
                                    <div class="form-group1">
                                      <label class="bmd-label-floating">Passport Number</label>
                                      <input type="text" class="form-control1" name="passport_number">
                                    </div>
                                  </div>                            
                                  <div class="col-md-4">
                                    <div class="form-group1">
                                      <label class="bmd-label-floating">Expiry Date</label>
                                      <input type="text" class="form-control1" name="form-control">
                                    </div>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-md-4 col-sm-12">
                                    <div class="form-group1">
                                      <label class="bmd-label-floating">Address Street</label>
                                      <input type="text" class="form-control1"  name="address_street">
                                    </div>
                                  </div>
                                  <div class="col-md-4 col-sm-12">
                                    <div class="form-group1">
                                      <label class="bmd-label-floating">Town / City</label>
                                      <input type="text" class="form-control1" name="town_city">
                                    </div>
                                  </div>
                                  <div class="col-md-4 col-sm-12">
                                    <div class="form-group1">
                                      <label class="bmd-label-floating">Country / State</label>
                                      <input type="text" class="form-control1" name="country_state">
                                    </div>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-md-4 col-sm-12">
                                    <div class="form-group1">
                                      <label class="bmd-label-floating"> Zip / Postal Code</label>
                                      <input type="text" class="form-control1"  name="zip_code">
                                    </div>
                                  </div>
                                  <div class="col-md-4 col-sm-12">
                                    <div class="form-group1">
                                      <label class="bmd-label-floating">Phone Number</label>
                                      <input type="text" class="form-control1" name="phone_number">
                                    </div>
                                  </div>
                                  <div class="col-md-4 col-sm-12">
                                    <div class="form-group1">
                                      <label class="bmd-label-floating">Email Address</label>
                                      <input type="text" class="form-control1" name="email">
                                    </div>
                                  </div>
                                </div>
                      
                                <button type="submit" class="btn btn-rose pull-right">Update Profile</button>
                                <div class="clearfix"></div>
                              </form>
                            </div>                        
                            
                      </table>
                    </div>
                    <div class="tab-pane" id="messages">
                      <table class="table">
                            
                      </table>
                    </div>
                    <div class="tab-pane" id="settings">
                      <table class="table">
                        <div class="card-body">
                          <form>
                            <div class="row">          
                              <div class="col-md-12 col-sm-12">
                                <div class="form-group1">
                                  <label class="bmd-label-floating">Current Password</label>
                                  <input type="text" class="form-control1">
                                </div>
                              </div>
                              <div class="col-md-12 col-sm-12">
                                <div class="form-group1">
                                  <label class="bmd-label-floating">New Password</label>
                                  <input type="email" class="form-control1">
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-md-12 col-sm-12">
                                <div class="form-group1">
                                  <label class="bmd-label-floating">Re-New Password</label>
                                  <input type="text" class="form-control1">
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
                  <a href="#pablo">
                    <img class="img" src="../assets/img/faces/marc.jpg" />
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

          </div>
        </div>
      </div>
      

@endsection