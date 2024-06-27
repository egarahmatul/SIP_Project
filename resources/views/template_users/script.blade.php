
  <!-- Vendor JS Files -->
  <!-- Vendor JS Files -->
  <script src="{{asset('')}}assets/js/jquery.min.js"></script>
  <!-- Popper js -->
  <script src="{{asset('')}}assets/js/popper.min.js"></script>
  <!-- Bootstrap js -->
  <script src="{{asset('')}}assets/js/bootstrap.min.js"></script>
  <!-- All js -->
  <script src="{{asset('')}}assets/js/dento.bundle.js"></script>
  <!-- Active js -->
  <script src="{{asset('')}}assets/js/default-assets/active.js"></script>
  <script src="{{asset('')}}template/js/plugin/datatables/datatables.min.js"></script>

  
  <script src="{{asset('')}}template/datatables/jquery.dataTables.min.js"></script>
  <script src="{{asset('')}}template/datatables/datatables.min.js"></script>
  <script src="{{asset('')}}template/datatables/dataTables.bootstrap4.min.js"></script>
  <script src="{{asset('')}}template/datatables/dataTables.buttons.min.js"></script>
  <script src="{{asset('')}}template/datatables/jszip.min.js"></script>
  <script src="{{asset('')}}template/datatables/pdfmake.min.js"></script>
  <script src="{{asset('')}}template/datatables/vfs_fonts.js"></script>
  <script src="{{asset('')}}template/datatables/buttons.html5.min.js"></script>
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
    $(document).ready(function() {
      $('.table').DataTable({
        dom: 'lBfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ],
        "lengthMenu": [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
      });
    });
  </script>