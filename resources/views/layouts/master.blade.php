@include('sweetalert::alert')

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Aplikasi SPP</title>
        <link rel="stylesheet" href="{{ asset('assets/datatables.min.css') }}">
        <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />
        <link href="{{ asset('js/app.js') }}" rel="stylesheet" />
        <link href="{{ asset('css/sweet.min.css') }}" rel="stylesheet" />
        <script src="{{ asset('js/fontawesome.min.js') }}" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        @include('layouts.nav')

        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                @include('layouts.side')
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4 m-2">
                        <div class="card mt-5">
                            @yield('content')
                        </div>
                    </div>
                </main>
            </div>
        </div>
          
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            
            @csrf
        </form>
        {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script> --}}
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
        <script src="{{ asset('assets/bootstrap.min.js') }}" crossorigin="anonymous"></script>
        <script src="{{ asset('assets/datatables.js') }}" crossorigin="anonymous"></script>
        <script src="{{ asset('js/scripts.js') }}"></script>
        <script src="{{ asset('js/jquery.js') }}"></script>
        <script src="{{ asset('js/sweet.min.js') }}"></script>
        <script>
            $(function () {
                $("#yes").on('click', function () {      
                    event.preventDefault();
                    document.getElementById('logout-form').submit();
                });
            })
        </script>
        @yield('script')
    </body>
</html>
