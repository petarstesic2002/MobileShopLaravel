<!DOCTYPE html>
<html lang="en">
@include("admin.components.fixed.head")
<body class="sb-nav-fixed">
    @include("admin.components.fixed.nav")
    @include('admin.components.fixed.sidenav')
    <div id="layoutSidenav">
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid">
                    @yield('content')
                </div>
            </main>
        </div>
    </div>
    @include("admin.components.fixed.footer")
    @include("admin.components.fixed.scripts")
</body>
</html>
