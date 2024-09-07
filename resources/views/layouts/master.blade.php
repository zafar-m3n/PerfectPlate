<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>General Dashboard &mdash; Stisla</title>
    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ asset('AdminAsset/assets/modules/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('AdminAsset/assets/modules/fontawesome/css/all.min.css') }}">

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('AdminAsset/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('AdminAsset/assets/css/components.css') }}">
    <link rel="stylesheet" href="{{ asset('AdminAsset/assets/modules/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="//cdn.datatables.net/2.1.3/css/dataTables.dataTables.min.css">
    <link rel="stylesheet" href="{{ asset('AdminAsset/assets/modules/summernote/summernote-bs4.css') }}">
    <!-- Start GA -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-94034622-3');
    </script>
    <!-- /END GA -->
</head>

<body>
    <div id="app">
        <div class="main-wrapper main-wrapper-1">
            @include('layouts.sidebar')

            <!-- Main Content -->
            <div class="main-content">
                @yield('content')
            </div>
            <footer class="main-footer">
                <div class="footer-left">
                    Copyright &copy; 2024 <div class="bullet"></div> Design By <a href="https://nauval.in/">Group 1</a>
                </div>
                <div class="footer-right">

                </div>
            </footer>
        </div>
    </div>

    <!-- General JS Scripts -->
    <script src="{{ asset('AdminAsset/assets/modules/jquery.min.js') }}"></script>
    <script src="{{ asset('AdminAsset/assets/modules/popper.js') }}"></script>
    <script src="{{ asset('AdminAsset/assets/modules/tooltip.js') }}"></script>
    <script src="{{ asset('AdminAsset/assets/modules/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('AdminAsset/assets/modules/nicescroll/jquery.nicescroll.min.js') }}"></script>
    <script src="{{ asset('AdminAsset/assets/js/stisla.js') }}"></script>
    <script src="{{ asset('AdminAsset/assets/modules/upload-preview/assets/js/jquery.uploadPreview.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="//cdn.datatables.net/2.1.3/js/dataTables.min.js"></script>
    <script src="{{ asset('AdminAsset/assets/modules/select2/dist/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('AdminAsset/assets/modules/summernote/summernote-bs4.js') }}"></script>
    <!-- Template JS File -->
    <script src="{{ asset('AdminAsset/assets/js/scripts.js') }}"></script>
    <script src="{{ asset('AdminAsset/assets/js/custom.js') }}"></script>




    <script>
        $(document).ready(function() {
            if (typeof $.uploadPreview === "function") {
                $.uploadPreview({
                    input_field: "#image-upload", // Default: .image-upload
                    preview_box: "#image-preview", // Default: .image-preview
                    label_field: "#image-label", // Default: .image-label
                    label_default: "Choose File", // Default: Choose File
                    label_selected: "Change File", // Default: Change File
                    no_label: false, // Default: false
                    success_callback: null // Default: null
                });
            } else {
                console.error("uploadPreview plugin not loaded.");
            }
        });
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function() {

            $('body').on('click', '.delete-item', function(e) {
                e.preventDefault();
                let url = $(this).attr('href');
                Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!"
                }).then((result) => {
                    if (result.isConfirmed) {

                        $.ajax({
                            method: 'DELETE',
                            url: url,
                            success: function(response) {
                                if (response.status === 'success') {
                                    Swal.fire({
                                        title: "Deleted!",
                                        text: "Your file has been deleted.",
                                        icon: "success"
                                    }).then(() => {
                                        window.location.reload();
                                    });
                                } else if (response.status === 'error') {
                                    Swal.fire({
                                        title: "Error!",
                                        text: "There was a problem deleting your file.",
                                        icon: "error"
                                    });
                                }
                            },
                            error: function(error) {
                                console.error(error);

                            }
                        });

                    }
                });
            });

        });
    </script>

    @stack('scripts')
</body>

</html>
