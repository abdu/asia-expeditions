@extends('layouts.app')

@section('title')
Error 404
@endsection

@section('content')
@include('include.menu')
<div class="container" style="background-color:#e8e8e8; min-height: 300px;"><br>
    <center> <strong><h1><label><span style="color: #427afd;font-size: 60px;">4</span><span style="color: #9a1818;font-size: 60px;">0</span><span style="color: #189a35;font-size: 60px;">4</span></label></h1></strong> 
        <p>The link is not correct.  <a href="{{url('/')}}">go back home</a></p></center>
</div>
@endsection