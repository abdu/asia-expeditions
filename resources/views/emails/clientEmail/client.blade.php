@extends('layouts.backend')
@section('title', '')
@section('content')
	<div class="container">

		<table class="table">
			<tr>
				<th><img src="{{url('')}}/img/{{config('app.logo')}}"></th>
			</tr>
			<tr>
				<th><h4>Welcome for our me</h4></th>
			</tr>
			<tr>
				<td>Email: </td>
				<th>{{$data['email']}}</th>
			</tr>
			<tr>
				<td>Password: </td>
				<td>{{$data['password']}}</td>
			</tr>			
		</table>
		<div>
			<div>Clink on below link to activate your account with us </div>
			<span>
				<a href="{{url('/')}}/activate_account?aelink={{encrypt($data['email'])}}">Activate your account now </a>
			</span>
		</div>
	</div>
@endsection