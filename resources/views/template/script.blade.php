{{-- <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script> --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
<script src="{{ asset('template/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('template/datatables/datatables.min.js') }}"></script>
<script src="{{ asset('template/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('template/datatables/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('template/datatables/jszip.min.js') }}"></script>
<script src="{{ asset('template/datatables/pdfmake.min.js') }}"></script>
<script src="{{ asset('template/datatables/vfs_fonts.js') }}"></script>
<script src="{{ asset('template/datatables/buttons.html5.min.js') }}"></script>
<script src="{{ asset('')}}template/summernote/summernote-bs4.js"></script>
<!-- Page Specific JS File -->
<script src="{{ asset('template')}}/js/page/modules-chartjs.js"></script>
<!-- Template JS File -->
<script src="{{ asset('template/js/scripts.js') }}"></script>
<script src="{{ asset('template/js/custom.js') }}"></script>


<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        $(document).on('click', '#btn-delete', function() {
            event.preventDefault();
            const url = $(this).attr("data-url");
            Swal.fire({
                title: 'Are you sure?',
                text: "You are attempting to log out of system",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, log out'
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#logout-form').submit();
                } else {
                    return false;
                }
            })
        });
    });

</script>

<script>
    $(document).ready(function(){
        $('#summernote').summernote({
            height: "200px",
            toolbar:[
                ['basic', ['style', 'fontname','fontsize']],
                ['style', ['bold','italic','underline','clear']],
                ['font', ['strikethough', 'superscript','subscript']],
                ['color', ['forecolor', 'backcolor']],
                ['block', ['ul', 'ol', 'paragraph']],
                ['fontsize', ['fontsize']],
                ['height', ['height', 'codeview', 'fullscreen', 'undo', 'redo']],
            ],
        }); 
        $('#summernote1').summernote({
            height: "150px",
        }); 
    });
  </script>
  
<script>
    

    $(document).ready(function() {
        $('.js-example-basic-multiple').select2();
        $('.js-example-basic-multiple2').select2();
        $('.js-example-basic-multiple3').select2();


        $('.select21').select2({
            placeholder: 'Select an option'
        });

        $('.select22').select2({
            placeholder: 'Select an option'
        });

        $('.select23').select2({
            placeholder: 'Select an option'
        });

        $('.select24').select2({
            placeholder: 'Select an option'
        });

        $('.select25').select2({
            placeholder: 'Select an option'
        });

        $('.select26').select2({
            placeholder: 'Select an option'
        });
    
    });

</script>

<!-- Page Script -->
<script>
  $(document).ready(function() {
    $('.table').DataTable({
      dom: 'lBfrtip',
      
      buttons: [
          'copyHtml5',
          'excelHtml5',
          'csvHtml5',
          'pdfHtml5',
      ],
      "lengthMenu": [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
    });
  });
</script>
