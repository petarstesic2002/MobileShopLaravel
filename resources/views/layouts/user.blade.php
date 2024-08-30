<!DOCTYPE html>
<html lang="en">
@include("user.components.fixed.head")
<body>
@include("user.components.fixed.nav")
@yield('content')
@include('user.components.fixed.follow')
@include("user.components.fixed.footer")
@include("user.components.fixed.scripts")
</body>
</html>
