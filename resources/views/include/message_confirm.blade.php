<style type="text/css">
	.btn{
		margin: 0 0.5rem !important;
	}
	.get_delete{
		color: #bf5329;
		font-weight: 600;
	}
	.get_delete:hover{color: #af3404;}
</style>
<script type="text/javascript">		
	$('.get_delete').on('click',function(){
     var data_id = $(this).data('id');
     console.log(data_id)
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
		  	window.location.href= data_id;
		    swalWithBootstrapButtons.fire({ 
			    title:'Deleted!',
			    text:'Your file has been deleted.',
			    type:'success',
			    showConfirmButton: false,} )

		  }
		})
	});
</script>
