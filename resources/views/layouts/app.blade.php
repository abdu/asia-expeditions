<!DOCTYPE html>
<html lang=en>
<head>
<link rel="shortcut icon" type="image/x-icon" href="/img/<?php echo config('app.icon');?>"/>
<meta charset=utf-8>
<meta http-equiv=Content-Type content="text/html; charset=utf-8">
<meta name=viewport content="width=device-width, initial-scale=1">
<meta http-equiv=X-UA-Compatible content="IE=edge">
<meta name=keywords itemprop=keywords content="@yield('keywords')">
<meta name=description content="@yield('description')">

<link rel=stylesheet type=text/css href=/css/lib/csscompressed.css>
<link rel="stylesheet" type="text/css" href="/css/style.css"> 
<script type="text/javascript" src="/js/compressed.js"></script>
<script type="text/javascript" src="/js/jquery.lazy.min.js"></script>
<title>@yield('title') | {{config('app.name')}}</title>
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-26752748-1"></script>
<script>window.dataLayer=window.dataLayer||[];function gtag(){dataLayer.push(arguments)}gtag("js",new Date());gtag("config","UA-26752748-1");</script>


<style type="text/css">
	form.gsc-search-box{
		margin-bottom: -1px !important;
	}
	.cse .gsc-control-cse, .gsc-control-cse{
		padding: 0px !important;
	}
	table.gsc-search-box{
		margin-bottom: 0px !important;
	}
</style>
</head>
<body>

	@yield('content')
	@include('include.footer')
</body>
</html>