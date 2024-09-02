@push('script')
    <script src="{{ themeAsset('common', 'js/sweetalert.js') }}"></script>
    @if (session('success'))
        @if (is_array(session('success')))
            <script>
                Swal.fire({
                    position: "top-end",
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
                    position: 'top-end',
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
                    position: "top-end",
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
                    position: 'top-end',
                    icon: 'error',
                    title: "{{ __('admin/general.error') }}",
                    text: "{{ session('error') }}",
                    showConfirmButton: false,
                    timer: 100000
                })
            </script>
        @endif
    @endif
@endpush
