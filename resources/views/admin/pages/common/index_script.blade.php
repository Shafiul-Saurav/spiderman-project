{{-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script> --}}
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.6.11/dist/sweetalert2.all.min.js"></script>
<script>
    $(document).ready(function() {
        $('#dataTable').DataTable({
            pagingType: 'first_last_numbers',
        });

        $('.show_confirm').click(function(event){
            let form = $(this).closest('form');

            event.preventDefault();
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#696cff',
                cancelButtonColor: '#ff3e1d',
                confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                    Swal.fire(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                    )
                }
                })
        })
    });
</script>
