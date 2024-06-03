!function ($) {
    "use strict";

    var SweetAlert = function () {
    };

    //examples
    SweetAlert.prototype.init = function () {

        //Warning Message
        $(document).on("click",".deleteBtn", function(){
            let url = $(this).data('url');
            swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                confirmButtonText: 'Yes, delete it!'
            }).then(function (result) {
                if(result.value){
                    
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                        url: url,
                        type: 'DELETE', 
                        success: function(response) {
                            swal(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                            );

                            setTimeout(function() {
                                location.reload();
                            }, 1000);
                        },
                        error: function(xhr, status, error) {
                            swal(
                                'Failed',
                                'Could not proceed now :)',
                                'error'
                            );
                        }
                    });

                    
                }else{
                    swal(
                        'Failed',
                        'Could not proceed now :)',
                        'error'
                    )
                }    
            })
        });

    },
        //init
        $.SweetAlert = new SweetAlert, $.SweetAlert.Constructor = SweetAlert
}(window.jQuery),

//initializing
    function ($) {
        "use strict";
        $.SweetAlert.init()
    }(window.jQuery);