
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

<!-- @if(session('message'))
	<div class="row">
		<div class="col-md-12">
		    <div class="alert alert-success">
		    	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<strong><i class="fa fa-check-circle" style="font-size: 22px;position: relative;top: 4px;"></i> {{session('message')}}</strong>
			</div>

		</div>
	</div>
@endif -->

<script type="text/javascript">
	$(function(){
	   function show_popup(){
	      $(".swal-overlay").hide();
	   };
	   window.setTimeout( show_popup, 4000 ); // 5 seconds
	});
</script>
