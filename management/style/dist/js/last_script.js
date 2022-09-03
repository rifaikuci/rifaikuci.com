$('.select2').select2()
$('.select2bs4').select2({
    theme: 'bootstrap4'
})

$(function () {
    $("#example1").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,
        "buttons": [ "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');


    $(document).on('click', '[data-toggle="lightbox"]', function(event) {
        event.preventDefault();
        $(this).ekkoLightbox({
            alwaysShowClose: true
        });
    });

    $('.summernote').summernote(
        {
            inheritPlaceholder: true,
            dialogsInBody: true,
            dialogsFade: true,  // Add fade effect on dialogs
            tabDisable: false


        }
    )

});


