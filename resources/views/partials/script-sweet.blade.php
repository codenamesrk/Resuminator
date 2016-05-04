    <script> 
    $('form.param').submit(function(e) {       
        e.preventDefault();
        var formId = $(this).attr("id"); 
        swal({
                title: "Are you sure?",
                text: "You will not be able to recover this imaginary file!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, Cancel",
                closeOnConfirm: false,
                closeOnCancel: false 
            },
            function(isConfirm) {
                if (isConfirm) {          
                    document.getElementById(formId).submit();
                } else {
                    swal("Cancelled", "Parameter Undeleted :)", "error");
                }
            }
        );       
    });
    </script>
