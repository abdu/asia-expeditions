<div class="clear"></div>
<footer>
  <div class="container-fluid">
      <div class="col-md-3 col-sm-6 col-xs-12  paddingtop-bottom ">
        <div class="col-md-12"><h6 class="heading7">EXPERT KNOWLEDGE</h6></div>
        <div class="col-md-12">
          @widget('Footer', ['f_type' => 1])
        </div>
      </div>
      <div class="col-md-3 col-sm-6 col-xs-12  paddingtop-bottom">
        <div class="row">
          <div class="col-md-12"><h6 class="heading7">UESFUL LINKS</h6></div>
          <div class="col-md-12">
        	@widget('Footer', ['f_type' => 2])
          </div>
        </div>
      </div>
      <div class="col-md-3 col-sm-6 col-xs-12  paddingtop-bottom">
        <div class="row">
          <div class="col-md-12"><h6 class="heading7">FULL PROTECTED</h6> </div>     
          <div class="col-md-12">
            @widget('Footer', ['f_type' => 3])
          </div>
        </div>
      </div> 
      <div class="col-md-3 col-sm-6  col-xs-12  paddingtop-bottom">
        <div class="row">
            <div class="col-sm-12"><h6 class="heading7">ENJOY WITH US</h6></div>     
            <div class="col-sm-12">
              <div class="row">
                <p>Enter your email to get news udpate</p>
                <form action="{{url('/')}}/getSubscrbe" method="post">
                    {{ csrf_field() }}
                    <div class="input-group ">
                        <span class="input-group-addon" id="sizing-addon1"><i class="fa fa-envelope-o"></i></span>
                        <input type="hidden" name="created_at" value="<?php echo date('Y-m-d H:i:s');?>">
                        <input type="hidden" name="updated_at" value="<?php echo date('Y-m-d H:i:s');?>">
                        <input type="email" name="email" class="form-control" placeholder="example@gmail.com" aria-describedby="sizing-addon1" required="required">
                        <span class="input-group-btn">
                           <input type="submit" value="Subscribe Now" class="btn btn-large" />
                        </span>
                    </div>
                </form>
              </div>
            </div>
            <div class="col-sm-12 ">           
              <div class="row">
                <b><h3 style="margin-bottom: 15px; color: #d9d6d6;"><b>Latest Post</b></h3></b>
                <ul class="list-unstyled">
                  @foreach(\App\OurNews::where([['post_type','=',1],['web','=',1]])->orderBy('id', 'DESC')->take(4)->get() as $new)
                    <li style="width: 100%; text-align: left; overflow: hidden !important;" class="btn w3-padding-small"><i class="fa fa-arrow-circle-right"></i><a style="color: orange;" target="_blank" href="/ournews/{{$new->slug}}"> {!! str_limit($new['tour_name'], 42) !!}</a></li>
                  @endforeach                 
                  <li class="btn btn-block"><a target="_blank" class=" w3-btn w3-green w3-border w3-border-green w3-round-xlarge" href="/ournews">View More >></a></li>
                </ul>
              </div>
            </div>    
        </div>
      </div> 
      <div class="clear"></div>    
  </div>   
  <div class="clear"></div>
</footer>
<div class="copyright">
    <div class="container">
        <div class="col-md-6 col-xs-12 ">
          <p>Power By ©<a target="_blank" href="http://jngtravelpro.com">www.jngtravelpro.com</a></p>
        </div>
        <div class="col-md-6 col-xs-12 ">
          <ul class="bottom_ul">
            <li><a href="{{route('sitemap')}}">Site Map</a></li>
            <li><a href="/contactus">Contact Us</a></li>
            <li><a href="/general-information?active=terms-conditions">Terms & Conditions </a></li>
            <li><a href="{{url('/')}}">Privacy Policy</a></li>
          </ul>
        </div>
    </div>
    <div>
      <a id="goTotop" style="position: fixed; right: 19px; display: none; bottom: 25px; font-size: 35px; z-index: 999999999;" href="javascript:void(0)"><span class="fa fa-chevron-circle-up"></span></a>
    </div>
</div>

  <!--Start of Zendesk Chat Script-->
<div>
  <script type="text/javascript">
      window.$zopim||(function(d,s){var z=$zopim=function(c){z._.push(c)},$=z.s=
      d.createElement(s),e=d.getElementsByTagName(s)[0];z.set=function(o){z.set.
      _.push(o)};z._=[];z.set._=[];$.async=!0;$.setAttribute("charset","utf-8");
      $.src="https://v2.zopim.com/?56ris9eOdQGRx07qVOHQnlaz9KUZjo3r";z.t=+new Date;$.
      type="text/javascript";e.parentNode.insertBefore($,e)})(document,"script");
  </script>
</div>
  <!--End of Zendesk Chat Script-->

<script>

  $(window).scroll(function() {
    
    if ($(this).scrollTop() > 90) {
      $('#goTotop').fadeIn('slow');
      $('.wrapper-menu').removeClass('act');

    } else {
      $('#goTotop').fadeOut('slow');
      $('.wrapper-menu').removeClass('act');
    }
  });
  
  $('#goTotop').click(function(){
    $('html, body').animate({scrollTop : 0},1500, 'easeInOutExpo');
    return false;
  }); 


    $(function() {
        $('.lazy').lazy();
    });
</script>