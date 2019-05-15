@extends('layouts.app')
@section('title')
	{{$news['tour_name']}}
@endsection
<?php use App\components\Shared; ?>
<?php
    $string = rtrim($news['tour_photo'], '|');
    $img = explode('|', $string);
?>

<meta property="og:url"           content="{{route('DetailNew', $news->slug)}}" />
<meta property="og:title"         content="{{$news['tour_name']}}|Asia Expedition" />
<meta property="og:description"   content="{!! $news->tour_desc !!}" />
<meta property="og:image"         content="{{Shared::getInstance()->urlResourceBig($news['tour_photo'], $news->user_id)}}" />

<meta name="twitter:card"         content="summary">
<meta name="twitter:site"         content="@site_username">
<meta name="twitter:title"        content="{{$news['tour_name']}}">
<meta name="twitter:description"  content="{!! $news->tour_desc !!}">
<meta name="twitter:creator"      content="@creator_username">
<meta name="twitter:image"        content="{{Shared::getInstance()->urlResourceBig($news['tour_photo'], $news->user_id)}}">
<meta name="twitter:domain"       content="https://www.asia-expeditions.com">
@section('content')
@include('include.menu')
<style type="text/css">
	header {
        margin-top: 0;
        overflow: hidden;
        display: block;
        /*border: solid;*/
        height: 435px;
	}
    p img{
        width: auto;
        height: auto;
    }

    #header-image {
        background-color: rgba(0, 0, 0, 0);
        background-repeat: no-repeat;
        background-size: cover;
        /*background-position: left 0px bottom -45px;*/
        background-position: 44% 50%;
        height: 100%;
    }
</style>
<article>
    <header>    
        <div id="header-image" class="lazy" data-src="{{Shared::getInstance()->urlResourceBig($news['tour_photo'], $news->user_id)}}" style="background-image: url({{Shared::getInstance()->urlResourceBig($news['tour_photo'], $news->user_id)}})">                     
        </div>
    </header>
    <section class="container-fluid main-body">
        <section class="row">
            <div class="hidden-xs col-sm-1 col-md-2">
            </div>            
            <div class="col-xs-12 col-sm-10 col-md-8">
                <div class="content-holder">                   
                    <div class="content-description">  
                        <div class="author-name">
                            <h3 style="color: #607D8B;font-size: 28px;font-weight: 700;">{{$news['tour_name']}}</h3>
                        </div>
                        <div class="row blog-info">
                            <div class="col-xs-12 col-sm-6" style="text-align: left;">
                                <span class=" text-muted"><i class="fa fa-clock-o"></i> Published at: {{date('Y-F-d',strtotime($news['updated_at']))}}</span>
                            </div>
                            <div class="col-xs-12 col-sm-6">
                                <ul class="list-unstyled ">
                                    <li style="float: left;">            
                                        <div id="fb-root"></div>
                                            <script>(function(d, s, id) {var js, fjs = d.getElementsByTagName(s)[0];
                                              if (d.getElementById(id)) return;
                                              js = d.createElement(s); js.id = id;
                                              js.src = 'https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.2';
                                              fjs.parentNode.insertBefore(js, fjs);
                                            }(document, 'script', 'facebook-jssdk'));</script>
                                              <!-- Your share button code -->
                                               <div class="fb-share-button" 
                                                data-href="{{route('DetailNew', $news->slug)}}" 
                                                data-layout="button_count" data-size="small">

                                        </div>        
                                    </li>
                                    <li style="float: left;margin: -3px 5px;">                     
                                        <script async src="{{asset('https://platform.twitter.com/widgets.js')}}" charset="utf-8"></script>                      
                                          <a class="twitter-share-button"
                                          href="https://twitter.com/intent/tweet?text={{$news['tour_name']}}&amp;{{route('DetailNew', $news->slug)}}"
                                          data-size="small">Tweet</a>
                                    </li>
                                </ul>                  
                            </div>
                        </div>
                    </div>
                    <div class="content-body" style="padding: 1px 5px; margin-top: -35px;">
                        <p>{!! $news['tour_desc'] !!}</p>
                    </div>
                    @if(count($img) > 1)
                        @foreach ($img as $key => $value) 
                            <div style="padding:15px 0px; margin-top: -20px;">
                                <img src="{{Shared::getInstance()->urlResourceBig($value, $news->user_id) }}" style="width:100%;">
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
            <div class="hidden-xs col-sm-1 col-md-4">
            </div>
        </section>
    </section>
</article>

@endsection