
<!DOCTYPE html>
<html lang="{{ app()->getLocale() == 'ar' ? 'ar' : 'en' }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
    @include('layouts.admin.header')
    <body class=" {{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}  ">
        <!-- Begin page -->
        <div class="wrapper">

            <!-- ========== Topbar Start ========== -->
         @include('layouts.admin.nav_bar')
            <!-- ========== Topbar End ========== -->


            <!-- ========== Left Sidebar Start ========== -->
            @include('layouts.admin.siedbar')
            <!-- ========== Left Sidebar End ========== -->

            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->

            <div class="content-page">
                <div class="content">

                    <!-- Start Content-->
                    <div class="container-fluid">

                        <!-- start page title -->
                        @yield('content')

                        <!-- end page title -->

                    </div> <!-- container -->

                </div> <!-- content -->

                <!-- Footer Start -->
              @include('layouts.admin.footer')
                <!-- end Footer -->

            </div>

            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->

        </div>


        @include('layouts.admin.script')

    </body>
</html>
