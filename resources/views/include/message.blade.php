@if(session('message'))
	<div class="row">
		<div class="col-md-12">
		    <div class="alert alert-success">
		    	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
  <span aria-hidden="true">&times;</span>
</button>
				<strong><i class="fa fa-check-circle" style="font-size: 22px;position: relative;top: 4px;"></i> {{session('message')}}</strong>
			</div>
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
