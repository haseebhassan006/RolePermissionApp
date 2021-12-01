<!DOCTYPE html>
<html lang="en" class="light">
    @include('layouts.backend.component.head')
    <body class="main">
        <div id="app">
            <div class="flex" >
                @include('layouts.backend.component.sidebar')
                <div class="content">
                    @include('layouts.backend.component.topbar')

                        @yield('content')

                </div>
            </div>
        </div>

        @include('layouts.backend.component.footer')
    </body>
</html>
