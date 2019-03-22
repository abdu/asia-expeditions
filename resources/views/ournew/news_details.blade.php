@extends('layouts.app')
@section('title')
	{{$news['tour_name']}}
@endsection
<?php use App\components\Shared; ?>
<?php
    $string = rtrim($news['tour_photo'], '|');
    $img = explode('|', $string);
?>
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
                                    <li style="float: left; padding: 0px 12px;">
                                        <div class="fb-share-button" data-href="{{route('DetailNew', $news->slug)}}"  data-size="small" >
                                            <a class="fb-xfbml-parse-ignore" target="_blank" href="http://www.facebook.com/sharer.php?u={{route('DetailNew', $news->slug)}}" title="Share to Facebook">
                                                <i class="fa fa-facebook-square  "></i>
                                            </a>
                                        </div>
                                    </li>
                                    <li style="float: left; padding: 0px 12px; ">
                                        <a class="twitter-share-button" href="http://twitter.com/share?url={{route('DetailNew', $news->slug)}}&amp;text={{$news['tour_name']}}&amp;hover-shadowshtags=AsiaExpeditions&amp;">
                                        <i class="fa fa-twitter-square "></i>
                                        <script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>
                                        </a>
                                    </li>
                                    <li style="float: left; padding: 0px 12px;">
                                        <a title="share on google+" href="https://plus.google.com/share?url={{route('DetailNew', $news->slug)}}" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;">
                                        <img class="lazy" data-src="https://www.gstatic.com/images/icons/gplus-16.png" alt="Share on Google+"/>
                                        </a>
                                    </li>
                                    <div class="clear"></div>
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