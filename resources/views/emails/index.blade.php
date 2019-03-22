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

<?php


use App\components\Shared;
?>

</head>


<body style="background: #eae0b8;">
	<a href="https://asia-expeditions.com/"  target="_blank" style="text-decoration: none; cursor: default;">
	<center><img src="{{url('img')}}/{{config('app.logo')}}" style="width:40%;"></center>
	</a>
	<table>
		<tr>
			<td width="370">
				<a href="{{url('/')}}/tour/{{encrypt($tour['tour_id'])}}"  target="_blank" style="text-decoration: none; cursor: default;">
					<img src="{{Shared::getInstance()->urlResource($tour['tour_picture'])}}" style="width: 100%">
				</a>
			</td>
			<td style="vertical-align: top;">
				<a href="{{url('/')}}/tour/{{encrypt($tour['tour_id'])}}"  target="_blank" style="text-decoration: none; cursor: default;">
					<h2 style="font-weight: bold;color: #227eac;font-size: 21px;">{{$tour->tour_name}}</h2>
				</a>
				<p><?php echo str_limit($tour->tour_desc, 120);?>!</p>

				</p>
				<a href="{{url('/')}}/tour/{{encrypt($tour['tour_id'])}}"  target="_blank" style="text-decoration: none; cursor: default;">
					<h2><b style="font-size: 20px; color:#ff9f1a;">Price: {{$tour->tour_price}} USD</b></h2>
				</a>
			</td>
		</tr>
	</table>
</body>
</html>