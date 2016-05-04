@if (Session::has('sweet_alert.alert'))
    <script>
        swal({
            text: "{!! Session::get('sweet_alert.text') !!}",
            title: "{!! Session::get('sweet_alert.title') !!}",
            timer: "{!! Session::get('sweet_alert.timer') !!}",
            type: "{!! Session::get('sweet_alert.type') !!}",
            showConfirmButton: "{!! Session::get('sweet_alert.showConfirmButton') !!}",
            confirmButtonText: "{!! Session::get('sweet_alert.confirmButtonText') !!}",
            confirmButtonColor: "#AEDEF4"
            // more options
        });
    </script>
{{--     <script>
	swal({   
		text: "{!! Session::get('sweet_alert.text') !!}",
        title: "{!! Session::get('sweet_alert.title') !!}",  
		type: "{!! Session::get('sweet_alert.type') !!}", 
		showCancelButton: true,   
		confirmButtonColor: "#DD6B55",   
		confirmButtonText: "Yes, delete it!",   
		cancelButtonText: "No, cancel plx!",   
		closeOnConfirm: false,   
		closeOnCancel: false
	}, 
	function(isConfirm){   
		if (isConfirm) {    
		 swal("Deleted!", "Your imaginary file has been deleted.", "success");   
		} else {    
		 swal("Cancelled", "Your imaginary file is safe :)", "error");   
		}
	});   	
    </script> --}}
@endif