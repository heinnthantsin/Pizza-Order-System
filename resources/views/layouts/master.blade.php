<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title> @yield('title')  </title>

    <!-- Fontfaces CSS-->
    <link href=" {{ asset('admin/css/font-face.css') }} " rel="stylesheet" media="all">
    <link href=" {{ asset('admin/vendor/font-awesome-4.7/css/font-awesome.min.css') }} " rel="stylesheet" media="all">
    <link href=" {{ asset('admin/vendor/font-awesome-5/css/fontawesome-all.min.css') }}  " rel="stylesheet" media="all">
    <link href=" {{ asset('admin/vendor/mdi-font/css/material-design-iconic-font.min.css') }} " rel="stylesheet" media="all">

    {{-- bootstrap css  --}}
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
        integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Vendor CSS-->
    <link href=" {{ asset('admin/vendor/animsition/animsition.min.css') }} " rel="stylesheet" media="all">
    <link href=" {{ asset('admin/vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css') }} " rel="stylesheet" media="all">
    <link href=" {{ asset('admin/vendor/wow/animate.css') }} " rel="stylesheet" media="all">
    <link href=" {{ asset('admin/vendor/css-hamburgers/hamburgers.min.css') }} " rel="stylesheet" media="all">
    <link href=" {{ asset('admin/vendor/slick/slick.css') }} " rel="stylesheet" media="all">
    <link href=" {{ asset('admin/vendor/select2/select2.min.css') }} " rel="stylesheet" media="all">
    <link href=" {{ asset('admin/vendor/perfect-scrollbar/perfect-scrollbar.css') }} " rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href=" {{ asset('admin/css/theme.css') }} " rel="stylesheet" media="all">

</head>

<body class="animsition">
    <div class="page-wrapper">
        <div class="page-content--bge5">
            <div class="container">
                <div class="login-wrap">
                    <div class="login-content" style="width:700px;">
                        <div class="login-logo">
                            <a href=" {{ url()->current() }} ">
                                <img src=" {{ asset('admin/images/icon/logo.png') }} " alt="CoolAdmin">
                            </a>
                        </div>
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"
        integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>

    <!-- Vendor JS       -->
    <script src=" {{ asset('admin/vendor/slick/slick.min.js') }} ">
    </script>
    <script src=" {{ asset('admin/vendor/wow/wow.min.js') }} "></script>
    <script src=" {{ asset('admin/vendor/animsition/animsition.min.js') }} "></script>
    <script src=" {{ asset('admin/vendor/bootstrap-progressbar/bootstrap-progressbar.min.js') }} ">
    </script>
    <script src=" {{ asset('admin/vendor/counter-up/jquery.waypoints.min.js') }} "></script>
    <script src=" {{ asset('admin/vendor/counter-up/jquery.counterup.min.js') }} ">
    </script>
    <script src=" {{ asset('admin/vendor/circle-progress/circle-progress.min.js') }} "></script>
    <script src=" {{ asset('admin/vendor/perfect-scrollbar/perfect-scrollbar.js') }} "></script>
    <script src=" {{ asset('admin/vendor/chartjs/Chart.bundle.min.js') }} "></script>
    <script src=" {{ asset('admin/vendor/select2/select2.min.js') }} ">
    </script>


    <!-- Main JS-->
    <script src=" {{ asset('admin/js/main.js') }} "></script>

</body>
@yield('scriptSection')

</html>
<!-- end document-->