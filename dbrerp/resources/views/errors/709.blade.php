<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link href="{{ csset('/css/icomoon/styles.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ csset('/css/all.min.css?') }}" rel="stylesheet" type="text/css">
    <link href="{{ csset('/css/colors.css?') }}" rel="stylesheet" type="text/css">
</head>
<body>
    <div class="content">
        <div class="content d-flex justify-content-center align-items-center">

            <!-- Container -->
            <div class="flex-fill">

                <!-- Error title -->
                <div class="text-center mb-3 mt-5">
                    <h1 class="error-title">709</h1>
                    <h5>Request Function Not Found in Middleware for //</h5>
                </div>
                <!-- /error title -->


                <!-- Error content -->
                <div class="row">
                    <div class="col-xl-4 offset-xl-4 col-md-8 offset-md-2">

                        <!-- Search -->
                        <form action="#">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control form-control-lg" style="height: calc(1.4667em + 1.125rem + 2px) !important;" placeholder="Search">

                                <div class="input-group-append">
                                    <button type="submit" class="btn bg-slate-600 btn-icon btn-lg text-white"><i class="icon-search4"></i></button>
                                </div>
                            </div>
                        </form>
                        <!-- /search -->


                        <!-- Buttons -->
                        <div class="row">
                            <div class="col-sm-12 mb-2">
                                <button class="btn btn-primary btn-block" onclick="route('/')"><i class="icon-home4 mr-2"></i>Home Page</button>
                            </div>
                            {{--<div class="col-sm-6">
                                <button onclick="route('{{ route('member-login') }}')" class="btn btn-primary btn-block"><i class="icon-home4 mr-2"></i>Member Login</button>
                            </div>--}}
                            <div class="col-sm-12">
                                <button onclick="route('{{ route('user-login') }}')" class="btn btn-primary btn-block"><i class="icon-user mr-2"></i>User Login</button>
                            </div>
                        </div>
                        <!-- /buttons -->

                    </div>
                </div>
                <!-- /error wrapper -->

            </div>
            <!-- /container -->

        </div>
    </div>

</body>
</html>



<script src="{{ csset('/js/api/core.js?') }}"></script>
