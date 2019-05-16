<style type="text/css">
	.btn{
		margin: 0 0.5rem !important;
	}
</style>
<script type="text/javascript">		
	$('.get_delete').click(function(){
		const swalWithBootstrapButtons = Swal.mixin({
			customClass: {
			    confirmButton: 'btn btn-success',
			    cancelButton: 'btn btn-danger'
			},
			  	buttonsStyling: false,
		})

		swalWithBootstrapButtons.fire({
		  	title: 'Are you sure?',
		  	text: "You won't be able to revert this!",
		  	type: 'warning',
		  	showCancelButton: true,
		  	confirmButtonText: 'Yes, delete it!',
		  	cancelButtonText: 'No, cancel!',
		  	reverseButtons: true
		}).then((result) => {
		  if (result.value) {
		  	window.location.href="{{url('remove-cart', ['id' => $tour['item']['id']])}}";
		    swalWithBootstrapButtons.fire(
			    'Deleted!',
			    'Your file has been deleted.',
			    'success'
		    )

		  } else if (result.dismiss === Swal.DismissReason.cancel) {
		    swalWithBootstrapButtons.fire(
			    'Cancelled',
			    'Your imaginary file is safe :)',
			    'error'
		    )
		  }
		})
	});
</script>
