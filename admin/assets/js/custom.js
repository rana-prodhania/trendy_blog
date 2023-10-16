<script>
<script src="https://cdn.datatables.net/v/bs5/dt-1.13.6/r-2.5.0/datatables.min.js"></script>
  <script src="
https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.all.min.js
"></script>
  <script>$(document).ready(function () {
      $('#example').DataTable({ responsive: true });
      $('#btn-delete').on('click', function (e) {
        e.preventDefault();
        const href = $(this).attr('href');
        Swal.fire({
          title: 'Are you sure?',
          text: "You won't be able to revert this!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
          if (result.isConfirmed) {
            Swal.fire(
              'Deleted!',
              'Your file has been deleted.',
              'success'
            ).then((result) => {
              if (result.isConfirmed) {
                document.location.href = href
              }
            })

          }
        })
      })
    });</script>
</script>