@if (session('success'))
    @if (is_array(session('success')))
        <script>
            Swal.fire({
                position: "center",
                icon: "success",
                title: "{{ session('success')['title'] }}",
                text: "{{ session('success')['message'] }}",
                showConfirmButton: false,
                timer: 3000
            })
        </script>
    @else
        <script>
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: "{{ __('admin/general.success') }}",
                text: "{{ session('success') }}",
                showConfirmButton: false,
                timer: 3000
            })
        </script>
    @endif
@endif
@if (session('error'))
    @if (is_array(session('error')))
        <script>
            Swal.fire({
                position: "center",
                icon: "error",
                title: "{{ session('error')['title'] }}",
                text: "{{ session('error')['message'] }}",
                showConfirmButton: false,
                timer: 3000
            })
        </script>
    @else
        <script>
            Swal.fire({
                position: 'center',
                icon: 'error',
                title: "{{ __('admin/general.error') }}",
                text: "{{ session('error') }}",
                showConfirmButton: false,
                timer: 3000
            })
        </script>
    @endif
@endif
<script>
    $('.confirm-btn').on('click', function() {
        Swal.fire({
            title: "{{ __('admin/general.are_you_sure') }}",
            text: "{{ __('admin/general.this_action_cannot_be_undone') }}",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: "{{ __('admin/general.yes_confirm') }}",
            cancelButtonText: "{{ __('admin/general.cancel') }}",
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
        }).then((result) => {
            if (result.isConfirmed) {
                $(this).closest('form').submit();
            }
        });
    });
    $(".clear-log").on("click", function() {
        Swal.fire({
            title: "{{ __('admin/general.are_you_sure') }}",
            text: "{{ __('admin/general.this_action_cannot_be_undone') }}",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: "{{ __('admin/general.yes_clear_it') }}",
            cancelButtonText: "{{ __('admin/general.cancel') }}",
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = $(this).data("url");
            }
        });
    });
</script>
