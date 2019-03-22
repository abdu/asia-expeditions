<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="shortcut icon" type="image/x-icon" href="/img/<?php echo config('app.icon');?>" />
        <meta charset="utf-8">  
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="/backend/style.css">
        <link rel="stylesheet" type="text/css" href="/backend/css/upload.css">
        <link rel="stylesheet" type="text/css" href="/css/datepicker.css"> 
        <link rel="stylesheet" type="text/css" href="/css/lib/app.css">    
        <link rel="stylesheet" type="text/css" href="/backend/lib/css/metisMenu.min.css">  
        <link rel="stylesheet" type="text/css" href="/backend/lib/css/sb-admin-2.min.css">  
        <link rel="stylesheet" type="text/css" href="/backend/lib/css/morris.css"> 

        <link rel="stylesheet" type="text/css" href="/backend/lib/css/dataTables.bootstrap.min.css">  
        <link rel="stylesheet" type="text/css" href="/backend/lib/css/jquery.dataTables.min.css">

        <script  type="text/javascript" src="/js/lib/jquery.min.js" ></script>
        <script  type="text/javascript" src="/js/lib/app.js" ></script>
        <script  type="text/javascript" src="/backend/lib/js/metisMenu.min.js" ></script>
        <script  type="text/javascript" src="/backend/lib/js/raphael.min.js" ></script>
       
        <script  type="text/javascript" src="/backend/lib/js/sb-admin-2.min.js" ></script>
        <script  type="text/javascript" src="/backend/js/script.js" ></script>
        <script  type="text/javascript" src="/backend/js/uploadfile.js" ></script>
        <title>@yield('title')</title>

        <style type="text/css">
            .text-vertical td{
                vertical-align: middle !important;
            }
            .border{
                border-bottom: solid #00BCD4 1px;
                padding-bottom: 8px;
            }
            .item-pdf:hover .item-show{
                display: block;
            }
            .item-show{
                position: absolute;
                right: 3px;text-align: left;
                padding: 5px;
                display: none;
                border: solid 1px;
                z-index: 22;
                background-color: #fff;
                border-radius: 6px;
                border: solid 2px #ddd;
            }
        </style>

    </head>
    <body>
    	@yield('content')
        @include('admin.include.footer')
    </body>
</html>

