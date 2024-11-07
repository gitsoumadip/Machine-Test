<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="light-style layout-navbar-fixed layout-menu-fixed layout-compact" dir="ltr" data-theme="theme-default" data-assets-path="./assets/" data-template="vertical-menu-template">
@include('layouts.partials.header')
<body>
    <section class="dashboard_sec">
        <div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">
            <div class="app-main">
                <!-- dashboard side bar -->
                @include('layouts.flash')
                <!-- dashboard main body -->
                <div class="app-main__outer">
                    <!-- dahboard top bar -->
                    <div class="app-main__inner card">
                        <!-- dashboard biome -->
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
    </section>
    @yield('modal')
    <!-- preloader -->
    @include('layouts.partials.footer')
    @include('layouts.partials._footer')
</body>
</html>
