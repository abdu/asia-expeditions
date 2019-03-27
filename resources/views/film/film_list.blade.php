    @extends('layouts.app')
@section('title', $con->country_name. " Film")
@section('content')
@include("include.menu")
<style type="text/css">
 
  .morecontent span {
    display: none;
  }
.morelink {
    display: block;
    font-weight: 700;
}
</style>

<div class="container">
  <div class="row"> 

    <div class="col-md-12">
      <h1 class="product-title breadcrumb" style="text-transform: uppercase; background: #227eac;border: solid 1px #9E9E9E;box-shadow: 0px 0px 0px 0px;color: white;padding: 12px 0px 12px 12px;">Myanmar Film</h1>
    </div>
    <div class="col-sm-12 col-md-8">
      <div  class="b_item"> 
        <?php $getListText = \App\Film::where(['type'=>0, 'country_id'=> $con->id])->orderBy("id", "ASC")->paginate(6); ?>
        @foreach($getListText as $getfilm1)
          <div class="list-group-item b_list">
              <div class="col-md-12">
                <h3 style="font-size: 16px;"><a target="_blank" href="{{route('film_detail', $getfilm1->slug)}}">{{$getfilm1->title}}</a></h3>
                  <span class="more"  style="font-size: 12px;">
                    {!! str_limit(strip_tags($getfilm1->desc),1000) !!}
                  </span>
              </div>
              <div class="clearfix"></div>
          </div>
        @endforeach
      </div>
      <center>{{$getListText->links()}}</center>
    </div>

 
    <div class="col-sm-12 col-md-4">
      <div class="b_item">
          <div id="ShowVideoModal" class="modal" >
            <div class="animate" style="">
              <span class="closes" title="Close Modal">&times;</span>
              <div class="imgcontainer">
               <iframe class="addsize" style="box-shadow: 0px 2px 10px 0px white;"  height="315" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
              </div>
            </div>
          </div>
          <?php $getVideo = \App\Film::where(['type'=>1, 'country_id'=> $con->id ])->paginate(6); ?>
          @foreach($getVideo as $getfilm2) 
            <div class="list-group-item b_list">
                <div class="col-md-4">
                  <div class="row" style="text-align: center;"   >                       
                    <div class="videoFrame stimg" data-videoid="{{$getfilm2->video}}"></div>
                    <img src="https://img.youtube.com/vi/{{$getfilm2->video}}/0.jpg" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen  class="img-responsive img-box img-thumbnail"> 
                  </div>
                </div>    
                <div class="col-md-8">
                  <h3 class="alink videoFrame"  data-videoid="{{$getfilm2->video}}" style="font-size: 14px; font-weight: 500;">{{$getfilm2->title}}</h3>
                   <!--  <small>
                      <i class="glyphicon glyphicon-time"></i> {{date('Y-F-d',strtotime($getfilm2['created_at']))}}<br>
                    </small> -->
                    <div>
                      <p style="font-size: 12px;">{!! str_limit(strip_tags($getfilm2->desc),55)!!}</p>
                    </div>
                  <div class="clearfix"></div>
                </div>
                <div class="clearfix"></div>
            </div>
          @endforeach
          </div>
          
              <center>
                {{$getVideo->links()}}
              </center>
          
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">

   $(document).ready(function(){  
       // Configure/customize these variables.
    var showChar = 180;  // How many characters are shown by default
    var ellipsestext = "...";
    var moretext = "Show more >>";
    var lesstext = "Show less";
    $('.more').each(function() {
        var content = $(this).html();
        if(content.length > showChar) {
            var c = content.substr(0, showChar);
            var h = content.substr(showChar, content.length - showChar);
            var html = c + '<span class="moreellipses">' + ellipsestext+ '&nbsp;</span><span class="morecontent"><span>' + h + '</span>&nbsp;&nbsp;<a href="" class="morelink">' + moretext + '</a></span>';
            $(this).html(html);
        }
    });
    $(".morelink").click(function(){
        if($(this).hasClass("less")) {
            $(this).removeClass("less");
            $(this).html(moretext);
        } else {
            $(this).addClass("less");
            $(this).html(lesstext);
        }
        $(this).parent().prev().toggle();
        $(this).prev().toggle();
        return false;
    }); 

      $(".closes").click(function(){
        $('#ShowVideoModal').modal('hide');
        var videoEl = $(".imgcontainer").find("iframe");
        videoEl.attr('src', "");
      });

      $(".videoFrame").click(function(){
        var videoID = $(this).data("videoid"); 
        var videoEl = $(".imgcontainer").find("iframe");
        videoEl.attr('src', "https://www.youtube.com/embed/"+videoID);
        $('#ShowVideoModal').modal('show')
      });
   });
</script>  




                                           
                
@endsection