    <!--begin::Javascript-->
    <!--begin::Global Javascript Bundle(used by all pages)-->

    <script src="{{asset('/')}}assets/ceres-template/plugins/global/plugins.bundle.js"></script>
    <script src="{{asset('/')}}assets/ceres-template/js/scripts.bundle.js"></script>
    <!--end::Global Javascript Bundle-->
    <!--begin::Page Vendors Javascript(used by this page)-->
    <script src="{{asset('/')}}assets/ceres-template/plugins/custom/fullcalendar/fullcalendar.bundle.js"></script>
    <!--end::Page Vendors Javascript-->
    <!--begin::Page Custom Javascript(used by this page)-->
    <script src="{{asset('/')}}assets/ceres-template/js/custom/widgets.js"></script>
    <!--end::Page Custom Javascript-->
    <!--end::Javascript-->

    @yield('script')