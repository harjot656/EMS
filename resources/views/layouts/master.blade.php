<!DOCTYPE hmtl>
<html>
    @include('layouts.header_sidebar')
    @yield('content')
    @include('layouts.script')
    @yield('script')
    @yield('local_script')
</body>
</html>