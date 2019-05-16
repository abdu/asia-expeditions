
@if(session('message'))
	<script type="text/javascript">
		$(function(){
			let timerInterval
				Swal.fire({
					title: '{{ session("message") }}',
					text: 'welcome for message here !',			 
					timer: 3000,			
					type:'{{ session("get") }}',				
				})
		});
	</script>
@endif
@if(session('show_delete'))

@endif

