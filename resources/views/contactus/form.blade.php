@extends('layouts.app')
@section('title')
	Contact Us
@endsection

@section('content')
@include('include.menu')
<br>
<div class="container">
	<div class="col-md-6 ">
	    <div style="height: 270px; overflow: hidden;">
			<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3908.3974072667675!2d104.93038543263252!3d11.594990399639244!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x310953fc0f50e811%3A0x40fbe806faaeb1e8!2sAsia+Expeditions+Co.%2C+Ltd+(Destination+Management+Company)!5e0!3m2!1sen!2skh!4v1494380956642" width="100%" height="250" frameborder="0" style="border:0" allowfullscreen></iframe> 	
        </div>
    </div>
    <div class="col-md-6 ">
	    <div style="height: 270px; overflow: hidden;">
			<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7640.028049427388!2d96.17003873627696!3d16.775977839369798!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x290f313eb6d438d8!2sAsia+Expeditions!5e0!3m2!1sen!2skh!4v1495440787846" width="100%" height="250" frameborder="0" style="border:0" allowfullscreen></iframe> 
        </div>
    </div>
    <div class="clear"></div>
    @if(session('message'))
	<div class="alert alert-warning alert-dismissible fade show" role="alert">
	  	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
	    	<span aria-hidden="true">&times;</span>
	  	</button>
	  	<strong>Welcome!</strong> {{session('message')}}
	</div>
	@endif
    <div class="alert alert-info" role="alert">	 
        <h3><strong>Contact us <span>Feel free to contact us</span></strong></h3>
	</div>  
    <div class="col-md-8">
    	<div class="row">
            <div class="well well-sm">
                <form action="{{url('/contactus')}}" method="post">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
	                <div class="row">
	                    <div class="col-md-6">
	                        <div class="form-group">
	                            <label for="name">Full Name</label>
	                            <div class="input-group">
		                            <span class="input-group-addon">
		                             	<span class="fa fa-user "></span>
		                             </span>
		                            <input type="text" name="fullname" class="form-control" id="name" placeholder="Full name" required="required" />
		                        </div>
	                        </div>
	                        <div class="form-group">
	                            <label for="phone">Phone Number</label>
	                            <div class="input-group">
	                            	<span class="input-group-addon"><span class="fa fa-phone "></span>
	                                </span>
	                            <input type="text" name="phone" class="form-control" id="phone" placeholder="Phone Number" required="required" />
	                            </div>
	                        </div>
	                        <div class="form-group">
	                            <label for="email">
	                                Email Address</label>
	                            <div class="input-group">
	                                <span class="input-group-addon"><span class="fa fa-envelope-o"></span>
	                                </span>
	                                <input type="email" name="email" class="form-control" id="email" placeholder="Email address" required="required" />
	                            </div>
	                        </div>		                       
	                    </div>
	                    <div class="col-md-6">
	                        <div class="form-group">
	                            <label for="message">
	                                Message</label>
	                            <textarea name="message" class="form-control" rows="8" placeholder="Type your message here ...!"></textarea>
	                        </div>
	                    </div>
	                    <div class="col-md-12">
	                        <button type="submit" class="btn btn-primary pull-right" id="btnContactUs">
	                            Send Message</button>
	                    </div>
	                </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-4">
    	<div class="col-md-12">
            <form method="post" action="/contactus/">
	            <legend><span class="glyphicon glyphicon-globe"></span> Our office</legend>
	            <address>
	                <strong>Cambodia:</strong><br>
	               SH-01 Galaxy Residence National <br>Road # 6A, Sangkat Chroy Changvar Chroy Changvar District, 12110 Phnom Penh,, Phnom Penh 12000<br>		                
	                <abbr title="Phone">
	                <i class="fa fa-phone-square"></i>&nbsp;+855 (23) 432 007<br> 
	                <abbr title="Phone">Hotline:
	                <i class="fa fa-phone-square"></i>&nbsp;+855 (12) 732 236<br>	
	            </address>
	            <address>
	                <strong>Myanmar (Burma):</strong><br>
	               E6, No 4, Anawrahtar Road, Pazundaung Township, Yangon 11171, Myanmar (Burma)<br>		                
	                <abbr title="Phone">
	                <i class="fa fa-phone-square"></i>&nbsp;+95 (1) 200 401<br>	
	                 <abbr title="Phone">Hotline:
	                <i class="fa fa-phone-square"></i>&nbsp;+95 (9) 506 2644<br>
	                
	                <abbr title="Phone">
	                <i class="fa fa-envelope-o"></i>&nbsp;enquiry [at] asia-expeditions.com<br>
	                <i class="fa fa-skype" style="font-size: 21px;"></i>&nbsp;<a href="skype:+85512732236?call">Call Now</a> 
	            </address>
            </form>
        </div>
    </div>    	
	<div class="spacing"></div>
</div> <!-- /container -->  

@endsection