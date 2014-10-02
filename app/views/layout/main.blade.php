<!DOCTYPE html>

<html lang="en" ng-app="app">

    <head>
        
        @include('layout.head')

    </head>

    <body>

        <!-- #wrapper -->
        <div id="wrapper">

            @include('layout.widgets.sidebar')

            {{-- @include('layout.widgets.navigation') --}}

            <!-- #page-wrapper -->
            <div id="page-wrapper">

                    <div class="row">

                        <div class="col-lg-12">
                            @yield('content')
                        </div>

                    </div>

                @include('layout.footer')

            </div>
            <!-- /#page-wrapper -->

        </div>
        <!-- /#wrapper -->

    </body>
    
</html>