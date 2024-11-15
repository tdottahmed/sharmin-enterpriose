@push('scripts')
    <!-- Sweet Alerts js -->
    <script>
        @if (session('success'))
            document.addEventListener("DOMContentLoaded", function() {
                Swal.fire({
                    title: "Success!",
                    text: "{{ session('success') }}",
                    icon: "success",
                    timer: 3000,
                    customClass: {
                        confirmButton: "btn btn-primary w-xs mt-2",
                        cancelButton: "btn btn-danger w-xs mt-2",
                    },
                    buttonsStyling: !1,
                    showCloseButton: !0,
                });
            });
        @endif

        @if (session('error'))
            document.addEventListener("DOMContentLoaded", function() {
                Swal.fire({
                    title: "Error!",
                    text: "{{ session('error') }}",
                    icon: "error",
                    timer: 3000,
                    customClass: {
                        confirmButton: "btn btn-primary w-xs mt-2",
                        cancelButton: "btn btn-danger w-xs mt-2",
                    },
                    buttonsStyling: !1,
                    showCloseButton: !0,
                });
            });
        @endif
    </script>
@endpush
