<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default"
    data-assets-path="{{ asset('admin') }}/assets/" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>Dashboard - Admin | @yield('page_title')</title>
    <meta name="description" content="" />

    @include('admin.layouts.inc.style')

</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->
            @include('admin.layouts.inc.menu')
            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->
                @include('admin.layouts.inc.navbar')
                <!-- / Navbar -->

                <!-- Content wrapper -->
                <div class="content-wrapper">

                    <!-- Content -->
                    <div class="container-xxl flex-grow-1 container-p-y">
                        @yield('admin_content')
                    </div>
                    <!-- / Content -->

                    <!-- Footer -->
                    @include('admin.layouts.inc.footer')
                    <!-- / Footer -->

                    <div class="content-backdrop fade"></div>
                </div>
                <!-- Content wrapper -->
            </div>
            <!-- / Layout page -->
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->

    {{-- <div class="buy-now">
        <a href="https://themeselection.com/products/sneat-bootstrap-html-admin-template/" target="_blank"
            class="btn btn-danger btn-buy-now">Upgrade to Pro</a>
    </div> --}}

    @include('admin.layouts.inc.script')

</body>

</html>
