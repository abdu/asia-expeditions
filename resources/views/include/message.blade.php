@if(session('submessage'))
	<div class="alert-warning alert-dismissible " role="alert" id="message">
		<div class="container">
			<script type="text/javascript">
				$(function(){
				 swal({title:"{{ session('submessage') }}",text: "welcome for message here !", icon:"{{ session('get') }}",buttons:false});
				});
			</script>	
		</div>
	</div>
@endif

<script type="text/javascript">
	$(function(){
	   function show_popup(){
	      $(".swal-overlay").hide();
	   };
	   window.setTimeout( show_popup, 4000 ); // 5 seconds
	});
</script>
