<!DOCTYPE html>
<!--
Author: Keenthemes
Product Name: Ceres HTML Free  - Bootstrap 5 HTML Multipurpose Admin Dashboard Theme
Upgrade to Pro: https://keenthemes.com/products/ceres-html-pro
Website: http://www.keenthemes.com
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
License: For each use you must have a valid license purchased only from above link in order to legally use the theme for your project.
-->
<html lang="en">
<!--begin::Head-->

@include("template-parts/head")

<!--begin::Body-->

<body id="kt_body" style="background-image: url('/assets/ceres-template/media/patterns/header-bg.png')" class="header-fixed header-tablet-and-mobile-fixed toolbar-enabled">
    <!--begin::Main-->
    <!--begin::Root-->
    <div class="d-flex flex-column flex-root">
        <!--begin::Page-->
        <div class="page d-flex flex-row flex-column-fluid">
            <!--begin::Wrapper-->
            <div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
                <!--begin::Header-->
                <div id="kt_header" class="header align-items-stretch" data-kt-sticky="true" data-kt-sticky-name="header" data-kt-sticky-offset="{default: '200px', lg: '300px'}">
                    <!--begin::Container-->
                    <div class="container-xxl d-flex align-items-center">
                        <!--begin::Heaeder menu toggle-->
                        <div class="d-flex align-items-center d-lg-none ms-n2 me-3" title="Show aside menu">
                            <div class="btn btn-icon btn-custom w-30px h-30px w-md-40px h-md-40px" id="kt_header_menu_mobile_toggle">
                                <!--begin::Svg Icon | path: icons/duotune/abstract/abs015.svg-->
                                <span class="svg-icon svg-icon-2x">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <path d="M21 7H3C2.4 7 2 6.6 2 6V4C2 3.4 2.4 3 3 3H21C21.6 3 22 3.4 22 4V6C22 6.6 21.6 7 21 7Z" fill="black" />
                                        <path opacity="0.3" d="M21 14H3C2.4 14 2 13.6 2 13V11C2 10.4 2.4 10 3 10H21C21.6 10 22 10.4 22 11V13C22 13.6 21.6 14 21 14ZM22 20V18C22 17.4 21.6 17 21 17H3C2.4 17 2 17.4 2 18V20C2 20.6 2.4 21 3 21H21C21.6 21 22 20.6 22 20Z" fill="black" />
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                            </div>
                        </div>
                        <!--end::Heaeder menu toggle-->
                        <!--begin::Header Logo-->
                        <div class="header-logo me-5 me-md-10 flex-grow-1 flex-lg-grow-0">
                            <a href="">

                                <img alt="Logo" src="{{asset('/')}}favicon.ico" class="h-15px h-lg-20px" />

                                <span class=" text-white fw-bold h-15px h-lg-20px logo-default">SPMB IAIN KENDARI</span>
                                <span class="text-black fw-bold h-15px h-lg-20px logo-sticky">SPMB IAIN KENDARI</span>
                            </a>
                        </div>
                        <!--end::Header Logo-->
                        <!--begin::Wrapper-->
                        <div class="d-flex align-items-stretch justify-content-between flex-lg-grow-1">
                            <!--begin::Navbar-->
                            <div class="d-flex align-items-stretch" id="kt_header_nav">



                                @include("template-parts/menu")

                            </div>
                            <!--end::Navbar-->
                            <!--begin::Topbar-->
                            <div class="d-flex align-items-stretch flex-shrink-0">
                                <!--begin::Toolbar wrapper-->
                                <div class="topbar d-flex align-items-stretch flex-shrink-0">
                                    <!--begin::User-->
                                    <div class="d-flex align-items-center ms-1 ms-lg-3">
                                        <!--begin::Menu wrapper-->
                                        <div class="header-menu align-items-stretch">
                                            <!--begin::Menu-->
                                            <div class="menu menu-lg-rounded menu-column menu-lg-row menu-state-bg menu-title-gray-700 menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-400 fw-bold my-5 my-lg-0">
                                                <div data-kt-menu-trigger="{default: 'click', lg: 'hover'}" class="menu-item menu-lg-down-accordion me-lg-1"> <span class="menu-link py-3">
                                                        @if(Auth::user()->userRole->nama_role == "peserta")
                                                        <span class="menu-title">{{Auth::user()->userPeserta->ujianSesiPeserta->dataDiri->nama_lengkap}}</span>
                                                        @else
                                                        <span class="menu-title">{{Auth::user()->userPengawas->ujianSesiRuangan->nama_pengawas}}</span>
                                                        @endif
                                                    </span>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="cursor-pointer symbol symbol-30px symbol-md-40px mx-3" data-kt-menu-trigger="click" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
                                            @if(Auth::user()->userRole->nama_role == "peserta")

                                            <img id="foto-profil" alt="Pic" src="{{Auth::user()->userPeserta->ujianSesiPeserta->dataDiri->foto}}" />
                                            @else
                                            <img id="foto-profil" alt="Pic" src="https://sia.iainkendari.ac.id/assets/template/admincore/assets/images/user_bg.png" />
                                            @endif
                                            <!-- <img id="foto-profil" alt="Pic" src="{{asset('/')}}assets/ceres-template/media/avatars/150-26.jpg" /> -->
                                        </div>
                                        <!--begin::Menu-->
                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-primary fw-bold py-4 fs-6 w-275px" data-kt-menu="true">
                                            <!--begin::Menu item-->

                                            <!--end::Menu item-->
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-5">
                                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="mx-3">
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger px-5">Logout</button>
                                                </form>
                                                <!-- <a href="">Sign Out</a> -->
                                            </div>
                                            <!--end::Menu item-->

                                        </div>
                                        <!--end::Menu-->
                                        <!--end::Menu wrapper-->
                                    </div>
                                    <!--end::User -->
                                    <!--begin::Aside mobile toggle-->
                                    <!--end::Aside mobile toggle-->
                                </div>
                                <!--end::Toolbar wrapper-->
                            </div>
                            <!--end::Topbar-->
                        </div>
                        <!--end::Wrapper-->
                    </div>
                    <!--end::Container-->
                </div>
                <!--end::Header-->
                <!--begin::Toolbar-->
                <div class="toolbar py-5 py-lg-5" id="kt_toolbar">
                    <!--begin::Container-->
                    <div id="kt_toolbar_container" class="container-xxl d-flex flex-stack flex-wrap">
                        <!--begin::Title-->
                        <div class="page-title d-flex flex-column">
                            <h3 class="text-white fw-bolder fs-2qx me-5">{{$title}}</h3>
                            <!--begin::Title-->
                            <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-1">
                                <!--begin::Item-->
                                <li class="breadcrumb-item text-white opacity-75">
                                    <a href="https://sia.iainkendari.ac.id/verifikator/list" class="text-white text-hover-primary">
                                        {{$title}} </a>
                                </li>
                                <!--end::Item-->


                            </ul>
                        </div>
                    </div>
                    <!--end::Container-->
                </div>
                <!--end::Toolbar-->
                <!--begin::Container-->
                <div id="kt_content_container" class="d-flex flex-column-fluid align-items-start container-xxl ">

                    <!-- <div id="kt_content_container" class="d-flex flex-column-fluid align-items-start container-fluid "> -->
                    <!--begin::Post-->
                    <div class="content flex-row-fluid" id="kt_content">

                        @yield('content')
                    </div>
                    <!--end::Post-->
                </div>
                <!--end::Container-->
                <!--begin::Footer-->
                <div class="footer py-4 d-flex flex-lg-column" id="kt_footer">
                    <!--begin::Container-->
                    <div class="container-xxl d-flex flex-column flex-md-row align-items-center justify-content-between">
                        <!--begin::Copyright-->
                        <div class="text-dark order-2 order-md-1">
                            <span class="text-muted fw-bold me-1">2021©</span>
                            <a href="https://keenthemes.com" target="_blank" class="text-gray-800 text-hover-primary">Keenthemes</a>
                        </div>
                        <!--end::Copyright-->
                        <!--begin::Menu-->
                        <ul class="menu menu-gray-600 menu-hover-primary fw-bold order-1">
                            <li class="menu-item">
                                <a href="https://keenthemes.com" target="_blank" class="menu-link px-2">About</a>
                            </li>
                            <li class="menu-item">
                                <a href="https://keenthemes.com/support" target="_blank" class="menu-link px-2">Support</a>
                            </li>
                            <li class="menu-item">
                                <a href="https://keenthemes.com/products/ceres-html-pro" target="_blank" class="menu-link px-2">Purchase</a>
                            </li>
                        </ul>
                        <!--end::Menu-->
                    </div>
                    <!--end::Container-->
                </div>
                <!--end::Footer-->
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Page-->
    </div>
    <!--end::Root-->

    <!--end::Main-->

    @include("template-parts/footer")

</body>
<!--end::Body-->

</html>