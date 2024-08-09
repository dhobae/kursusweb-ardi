<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- jQuery -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>

    {{-- pusher --}}
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- daterange picker -->
    <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- Bootstrap Color Picker -->
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css') }}">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet"
        href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <!-- Bootstrap4 Duallistbox -->
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css') }}">
    <!-- BS Stepper -->
    <link rel="stylesheet" href="{{ asset('plugins/bs-stepper/css/bs-stepper.min.css') }}">
    <!-- dropzonejs -->
    <link rel="stylesheet" href="{{ asset('plugins/dropzone/min/dropzone.min.css') }}">
    {{-- bs icons --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    <!-- DataTables -->
    {{-- <link rel="stylesheet" href="{{ 'plugins/datatables-bs4/css/dataTables.bootstrap4.min.css' }}">
    <link rel="stylesheet" href="{{ 'plugins/datatables-responsive/css/responsive.bootstrap4.min.css' }}">
    <link rel="stylesheet" href="{{ 'plugins/datatables-buttons/css/buttons.bootstrap4.min.css' }}"> --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.2/css/dataTables.dataTables.min.css">

    <style>
        th {
            position: relative;
        }

        th.sorting:after {
            content: "\f0dc";
            /* FontAwesome icon for 'sort' */
            font-family: "Font Awesome 5 Free";
            font-weight: 900;
            position: absolute;
            right: 10px;
            opacity: 0.5;
        }

        th.sorting_asc:after {
            content: "\f0de";
            /* FontAwesome icon for 'sort-up' */
        }

        th.sorting_desc:after {
            content: "\f0dd";
            /* FontAwesome icon for 'sort-down' */
        }

        th.sorting,
        th.sorting_asc,
        th.sorting_desc {
            padding-right: 20rem;
            /* Adjust padding to make room for the icon */
        }

        .fixed-width {
            width: 60px !important;
        }


        @media screen and (min-width:992px) {
            .table-responsive {
                overflow: auto !important;
            }
        }

        .responsive-iframe {
            width: 100%;
            height: 250px;
            /* Default height for desktop/tablet */
        }

        @media screen and (min-width: 768px) {
            .responsive-iframe {
                height: 450px;
                /* Higher height for larger screens */
            }
        }

        @media screen and (min-width: 1200px) {
            .responsive-iframe {
                height: 550px;
                /* Higher height for very large screens */
            }
        }
    </style>

    {{-- <style>
        th {
            display: flex;
            align-items: center;
            position: relative;
            padding-right: 2rem;
            /* Adjust to make room for the icon */
        }

        th span {
            flex: 1;
        }

        th.sorting {
            justify-content: space-between;
        }

        th.sorting:after {
            content: "\f0dc";
            /* FontAwesome icon for 'sort' */
            font-family: "Font Awesome 5 Free";
            font-weight: 900;
            opacity: 0.5;
        }

        th.sorting_asc:after {
            content: "\f0de";
            /* FontAwesome icon for 'sort-up' */
        }

        th.sorting_desc:after {
            content: "\f0dd";
            /* FontAwesome icon for 'sort-down' */
        }
    </style> --}}

    @yield('style')
</head>

<body class="hold-transition sidebar-mini">
    <div id="alerts">
        @include('admin.partials.notif')
    </div>

    <div class="wrapper">
        <!-- Navbar -->
        @include('admin.partials.navbar')
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        @include('admin.partials.aside')
        {{-- / sidebar --}}

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            {{-- <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Starter Page</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Starter Page</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div> --}}
            <!-- /.content-header -->

            <!-- content -->
            <div class="content" style="margin-top: 2rem">
                <div class="container-fluid pt-5 pb-5">
                    @yield('content')
                </div>
            </div>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Main Footer -->
        @include('admin.partials.footer')
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->


    <!-- Bootstrap 4 -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('dist/js/adminlte.min.js') }}"></script>

    <!-- Select2 -->
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
    <!-- Bootstrap4 Duallistbox -->
    <script src="{{ asset('plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js') }}"></script>
    <!-- InputMask -->
    <script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('plugins/inputmask/jquery.inputmask.min.js') }}"></script>
    <!-- date-range-picker -->
    <script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
    <!-- bootstrap color picker -->
    <script src="{{ asset('plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js') }}"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <!-- Bootstrap Switch -->
    <script src="{{ asset('plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}"></script>
    <!-- BS-Stepper -->
    <script src="{{ asset('plugins/bs-stepper/js/bs-stepper.min.js') }}"></script>
    <!-- dropzonejs -->
    <script src="{{ asset('plugins/dropzone/min/dropzone.min.js') }}"></script>
    <!-- bs-custom-file-input -->
    <script src="{{ asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>

    <!-- Page specific script datepickers -->
    <script>
        // $(function() {
        //     bsCustomFileInput.init();
        //     //Date picker
        //     // Ensure jQuery and datetimepicker are included in your project
        //     $(document).ready(function() {
        //         // Date picker for 'tanggal_lahir'
        //         $('#tanggal_lahir').datetimepicker({
        //             format: 'L',
        //             defaultDate: moment() // Set your desired default date here
        //         });

        //         // Date picker for 'tanggal_masuk'
        //         $('#tanggal_masuk').datetimepicker({
        //             format: 'L',
        //             defaultDate: moment() // Default to today's date
        //         });

        //         // Date picker for 'tanggal_lulus'
        //         $('#tanggal_lulus').datetimepicker({
        //             format: 'L',
        //             defaultDate: moment() // Set your desired default date here
        //         });
        //     });
        // });
    </script>


    <!-- DataTables  & Plugins -->
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('plugins/pdfmake/vfs_fonts.js') }}"></script>

    <script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>

    <script>
        $(function() {
            // any forms
            bsCustomFileInput.init();
            // $(document).ready(function() {
            //     $('').datetimepicker({
            //         format: 'L',
            //         defaultDate: moment() // Default to today's date
            //     });
            // });

            // delete materi
            $('.delete-button-materi').on('click', function(e) {
                e.preventDefault();
                var id = $(this).attr('materi-data-id');
                var token = $('meta[name="csrf-token"]').attr('content');
                var url = "{{ route('materi-destroy', ':id') }}";
                url = url.replace(':id', id);
                // console.log(url);

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
                        $.ajax({
                            url: url,
                            type: 'POST',
                            data: {
                                _token: token,
                                _method: 'DELETE'
                            },
                            success: function(response) {
                                Swal.fire(
                                    'Deleted!',
                                    'The user has been deleted.',
                                    'success'
                                ).then(() => {
                                    // location.reload();
                                    window.location.href =
                                        '{{ route('materi-list') }}';
                                });
                            },
                            error: function(xhr) {
                                Swal.fire(
                                    'Failed!',
                                    'There was an error deleting',
                                    'error'
                                );
                            }
                        });
                    }
                });
            });

        });


        // delete kursus
        $('.delete-button-kursus').on('click', function(e) {
            e.preventDefault();
            var id = $(this).attr('kursus-data-id');
            var token = $('meta[name="csrf-token"]').attr('content');
            var url = "{{ route('kursus-destroy', ':id') }}";
            url = url.replace(':id', id);
            // console.log(url);

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
                    $.ajax({
                        url: url,
                        type: 'POST',
                        data: {
                            _token: token,
                            _method: 'DELETE'
                        },
                        success: function(response) {
                            Swal.fire(
                                'Deleted!',
                                'The user has been deleted.',
                                'success'
                            ).then(() => {
                                // location.reload();
                                window.location.href =
                                    '{{ route('kursus-list') }}';
                            });
                        },
                        error: function(xhr) {
                            Swal.fire(
                                'Failed!',
                                'There was an error deleting.',
                                'error'
                            );
                        }
                    });
                }
            });
        });
    </script>

</body>

</html>
