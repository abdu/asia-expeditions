@if(session('submessage'))
	<div class="alert-warning alert-dismissible " role="alert" id="message">
		<div class="container">
			<center>{{ session('submessage') }} welcome for message here !</center>
		</div>
	</div>
@endif

<script type="text/javascript">
	$(function(){
	   function show_popup(){
	      $("#message").hide();
	   };
	   window.setTimeout( show_popup, 4000 ); // 5 seconds
	});
</script>
