<!DOCTYPE html>

<html lang="en" ng-app="app">

    <head>
        
        @include('layout.head')

    </head>

    <body style="background: #383e4b;">

        <!-- .container -->
        <div class="container">
            
            <div class="row">
                    
                    <div class="col-md-offset-4 col-md-4">

                        <div class="login-box">

                            @yield ('content')

                    </div>

                </div>

            </div>

        </div>
        <!-- /.container -->

    </body>

</html>