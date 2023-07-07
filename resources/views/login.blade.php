<!DOCTYPE html>
<!--
Author: Keenthemes
Product Name: Ceres 
Product Version: 1.1.3
Purchase: https://keenthemes.com/products/ceres-html-pro
Website: http://www.keenthemes.com
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
License: For each use you must have a valid license purchased only from above link in order to legally use the theme for your project.
-->
<html lang="en">
<!--begin::Head-->

<head>
    <title>APLIKASI UJIAN IAIN KENDARI</title>
    <meta charset="utf-8" />
    <meta name="description" content="Ceres admin dashboard live demo. Check out all the features of the admin panel. A large number of settings, additional services and widgets." />
    <meta name="keywords" content="Ceres theme, bootstrap, bootstrap 5, admin themes, free admin themes, bootstrap admin, bootstrap dashboard" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="Ceres HTML Pro - Bootstrap 5 HTML Multipurpose Admin Dashboard Theme" />
    <meta property="og:url" content="https://keenthemes.com/products/ceres-html-pro" />
    <meta property="og:site_name" content="Keenthemes | Ceres HTML Pro" />
    <link rel="canonical" href="https://preview.keenthemes.com/ceres-html-pro" />
    <!-- <link rel="shortcut icon" href="/ceres-html-pro/assets/media/logos/favicon.ico" /> -->
    <link rel="shortcut icon" href="{{asset('/')}}assets/images/favicon.ico" />

    <!--begin::Fonts(mandatory for all pages)-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" /> <!--end::Fonts-->



    <!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
    <link href="{{asset('/')}}assets/ceres-template/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
    <link href="{{asset('/')}}assets/ceres-template/css/style.bundle.css" rel="stylesheet" type="text/css" />
    <!--end::Global Stylesheets Bundle-->

</head>
<!--end::Head-->

<!--begin::Body-->

<body id="kt_body" class="auth-bg">

    <div class="d-flex flex-column flex-root">
        <!--begin::Authentication - Sign-in -->
        <!--begin::Image placeholder-->
        <style>
            .auth-page-bg {
                background-image: url('{{asset("/")}}assets/ceres-template/media/illustrations/dozzy-1/14.png');
            }

            [data-bs-theme="dark"] .auth-page-bg {
                background-image: url('{{asset("/")}}assets/ceres-template/media/illustrations/dozzy-1/14-dark.png');
            }
        </style>
        <!--end::Image placeholder-->

        <div class="d-flex flex-column flex-column-fluid bgi-position-y-bottom position-x-center bgi-no-repeat bgi-size-contain bgi-attachment-fixed auth-page-bg">
            <!--begin::Content-->
            <div class="d-flex flex-center flex-column flex-column-fluid p-10 pb-lg-20">
                <!--begin::Logo-->
                <img alt="Logo" src="https://sia.iainkendari.ac.id/assets/images/logo.png" class="h-80px theme-light-show" />
                <h1 class="mt-5 fs-20">APLIKASI UJIAN SPMB IAIN KENDARI</h1>
                <h1 class="mb-8">JALUR MANDIRI TAHUN 2023</h1>
                <!--end::Logo-->

                <!--begin::Wrapper-->
                <div class="w-lg-500px bg-body rounded shadow-sm p-10 p-lg-15 mx-auto">
                    <h1 class="d-flex flex-center mb-10">Silahkan Login untuk masuk</h1>
                    <!--begin::Form-->
                    @if(session()->has('fail'))
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <span class="alert-text">{{session('fail')}}</span>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif
                    <form class="form w-100" novalidate="novalidate" id="kt_sign_in_form" action="{{route('login')}}" method="post">
                        @csrf

                        <!--begin::Input group-->
                        <div class="fv-row mb-10">
                            <!--begin::Label-->
                            <label class="form-label fs-6 fw-bold text-dark">Username</label>
                            <!--end::Label-->

                            <!--begin::Input-->
                            <input class="form-control form-control-lg form-control-solid" type="text" name="username" autocomplete="off" />
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->

                        <!--begin::Input group-->
                        <div class="fv-row mb-10">
                            <!--begin::Wrapper-->
                            <div class="d-flex flex-stack mb-2">
                                <!--begin::Label-->
                                <label class="form-label fw-bold text-dark fs-6 mb-0">Password</label>
                                <!--end::Label-->

                            </div>
                            <!--end::Wrapper-->

                            <!--begin::Input-->
                            <input class="form-control form-control-lg form-control-solid" type="password" name="password" autocomplete="off" />
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->
                        <div class="text-center">
                            <!--begin::Submit button-->
                            <button type="submit" id="kt_sign_in_submit" class="btn btn-lg btn-primary w-100 mb-5">
                                <span class="indicator-label">
                                    Login
                                </span>

                            </button>
                        </div>
                    </form>
                    <!--end::Form-->
                </div>
                <!--end::Wrapper-->
            </div>
            <!--end::Content-->


        </div>
        <!--end::Authentication - Sign-in-->
    </div>
    <!--end::Main-->



    <!--begin::Global Javascript Bundle(mandatory for all pages)-->
    <script src="{{asset('/')}}assets/ceres-template/plugins/global/plugins.bundle.js"></script>
    <script src="{{asset('/')}}assets/ceres-template/js/scripts.bundle.js"></script>
    <!--end::Global Javascript Bundle-->


    <!--begin::Custom Javascript(used for this page only)-->
    <script src="{{asset('/')}}assets/ceres-template/js/custom/authentication/sign-in/general.js"></script>
    <!--end::Custom Javascript-->
    <!--end::Javascript-->

</body>
<!--end::Body-->

</html>