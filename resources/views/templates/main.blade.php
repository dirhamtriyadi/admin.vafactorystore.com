<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Vafactory - Spesialis Pembuatan Jersey, Kerudung, dan Maklun. Pesan produk berkualitas tinggi sesuai kebutuhan Anda.">
    <meta name="keywords" content="Vafactory, jersey, kerudung, maklun, pembuatan jersey, pesan jersey, desain jersey, pesan kerudung, desain kerudung, pesan maklun, desain maklun">
    <meta name="author" content="Vafactory Admin">
    <meta name="robots" content="index, follow">
    <meta property="og:title" content="Vafactory - Pembuatan Jersey, Kerudung, dan Maklun">
    <meta property="og:description" content="Spesialis pembuatan jersey, kerudung, dan maklun dengan kualitas terbaik. Pesan produk sesuai kebutuhan Anda.">
    <meta property="og:image" content="https://admin.vafactorystore.com/favicon.ico"> <!-- Ganti dengan URL gambar thumbnail yang sesuai -->
    <meta property="og:url" content="https://admin.vafactorystore.com/"> <!-- Ganti dengan URL website yang sesuai -->
    <meta property="og:type" content="website">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@vafactory">
    <meta name="twitter:title" content="Vafactory - Pembuatan Jersey, Kerudung, dan Maklun">
    <meta name="twitter:description" content="Spesialis pembuatan jersey, kerudung, dan maklun dengan kualitas terbaik. Pesan produk sesuai kebutuhan Anda.">
    <meta name="twitter:image" content="https://admin.vafactorystore.com/favicon.ico"> <!-- Ganti dengan URL gambar thumbnail yang sesuai -->
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>{{ config('app.name') }}</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('adminlte') }}/plugins/fontawesome-free/css/all.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('adminlte') }}/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('adminlte') }}/plugins/select2/css/select2.min.css">
    <!-- SwetAlert -->
    <link rel="stylesheet" href="{{ asset('adminlte') }}/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset('adminlte') }}/plugins/toastr/toastr.min.css">
    <!-- Tempus Dominus -->
    <link rel="stylesheet" href="{{ asset('adminlte') }}/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('adminlte') }}/dist/css/adminlte.min.css">
    @stack('styles')
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <!-- Site wrapper -->
    <div class="wrapper">
        <!-- Navbar -->
        @include('templates.partials.navbar')
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        @include('templates.partials.sidebar')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            @yield('content-header')

            <!-- Main content -->
            @yield('main-content')
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        @include('templates.partials.footer')

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="{{ asset('adminlte') }}/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('adminlte') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Select2 -->
    <script src="{{ asset('adminlte') }}/plugins/select2/js/select2.full.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="{{ asset('adminlte') }}/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- SwetAlert -->
    <script src="{{ asset('adminlte') }}/plugins/sweetalert2/sweetalert2.min.js"></script>
    <!-- Toastr -->
    <script src="{{ asset('adminlte') }}/plugins/toastr/toastr.min.js"></script>
    <!-- moment -->
    <script src="{{ asset('adminlte') }}/plugins/moment/moment.min.js"></script>
    <!-- input mask -->
    <script src="{{ asset('adminlte') }}/plugins/inputmask/jquery.inputmask.min.js"></script>
    <!-- mask money -->
    <script src="{{ asset('adminlte') }}/plugins/jquery-maskmoney/jquery.maskMoney.min.js"></script>
    <!-- Tempus Dominus -->
    <script src="{{ asset('adminlte') }}/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <!-- Custom File Input -->
    <script src="{{ asset('adminlte') }}/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('adminlte') }}/dist/js/adminlte.min.js"></script>
    <script>
        $(function() {
            $('.select2').select2();

            $('.mask-money').inputmask({
                alias: 'currency',
                prefix: 'Rp ',
                rightAlign: false,
                digits: 0,
                groupSeparator: '.',
                radixPoint: ',',
                autoGroup: true,
                autoUnmask: true,
                removeMaskOnSubmit: true,
                unmaskAsNumber: true
            });

            bsCustomFileInput.init();

            var Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: '5000',
                timerProgressBar: true,
                didOpen: function(toast) {
                    $(toast.el).addClass('bg-success')
                },
                didClose: function(toast, reason) {
                    if (reason === 'timer') {
                        $(toast.el).removeClass('bg-success')
                    }
                }
            })

            $('#reservationdate').datetimepicker({
                format: 'YYYY-MM-DD'
            })

            $('#reservationdatetime').datetimepicker({
                icons: {
                    time: 'far fa-clock'
                }
            })

            $('.select2').select2({
                placeholder: 'select..'
            })

            @if (session()->has('success'))
                Toast.fire({
                    icon: 'success',
                    title: '{{ session()->get('success') }}'
                })
                // toastr.success('{{ session()->get('success') }}')
            @elseif(session()->has('error'))
                console.log('{{ session()->get('error') }}');
                Toast.fire({
                    icon: 'error',
                    title: '{{ session()->get('error') }}'
                })
                // toastr.error('{{ session()->get('error') }}')
            @endif

            @if ($errors->any())
                Toast.fire({
                    icon: 'error',
                    title: 'Whoops! Something went wrong!'
                })
                // toastr.error('Whoops! Something went wrong!')
            @endif
        })
    </script>
    @stack('scripts')
</body>

</html>
