<!DOCTYPE html>
<html>
<head>
	<title>{{config('name')}}</title>
	<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
 
<!-- Latest compiled and minified JavaScript -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

</head>
<body style="background: #eae0b8;">
<a href="/https://asia-expeditions.com/"  target="_blank" style="text-decoration: none; cursor: default;">
	<center><img src="{{url('img')}}/{{config('app.logo')}}" style="width:40%;"></center></a>
	<table>
		<tr>
			<td>Full Name:</td><td>{{$data['fullname']}}</td>
		</tr>
		<tr>
			<td>Phone Number:</td><td>{{$data['phone']}}</td>
		</tr>
		<tr>
			<td>Email: </td><td>{{$data['email']}}</td>
		</tr>
		<tr>
			<td colspan="2">Message:<hr>	
				{{$data['message']}}			
			</td>
		</tr>
	</table>
</body>
</html>