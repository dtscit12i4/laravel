<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>

    <title>Web Admin</title>

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport'/>
    <meta name="viewport" content="width=device-width"/>

    <link href="{{ url('assets/css/bootstrap.min.css') }}" rel="stylesheet"/>

    <link href="{{ url('assets/css/animate.min.css') }}" rel="stylesheet"/>

    <link href="{{ url('assets/css/paper-dashboard.css') }}" rel="stylesheet"/>

    <link href="{{ url('http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css') }}" rel="stylesheet">

    <link href='{{ url('https://fonts.googleapis.com/css?family=Muli:400,300') }}' rel='stylesheet' type='text/css'>

    <link href="{{ url('assets/css/themify-icons.css') }}" rel="stylesheet"/>

    <link href="{{ url('assets/css/style.css') }}" rel="stylesheet"/>

    <script type="text/javascript" src="{{ url('assets/js/jquery.1.10.2.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('assets/js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('assets/js/script.js') }}"></script>
    <script type="text/javascript">
        var token = "{{ csrf_token() }}";
    </script>
</head>
<body>

<div class="wrapper">
@include('layouts.sidebar')
    <div class="main-panel">
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar bar1"></span>
                        <span class="icon-bar bar2"></span>
                        <span class="icon-bar bar3"></span>
                    </button>
                    <a class="navbar-brand" href="#">@yield('page')</a>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="ti-settings"></i>
                                <b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="#">Profile</a></li>
                                <li><a href="{{ url('/admin/logout') }}">Logout</a></li>
                            </ul>
                        </li>
                    </ul>

                </div>
            </div>
        </nav>

        <div class="content">
            <div class="container-fluid">
                @yield('content')

            </div>
        </div>
        <footer class="footer">
            <div class="container-fluid">
                <nav class="pull-left">
                    <ul>

                        <li>
                            <a href="">
                                Contact
                            </a>
                        </li>
                        <li>
                            <a href="">
                                Blog
                            </a>
                        </li>
                        <li>
                            <a href="">
                                Licenses
                            </a>
                        </li>
                    </ul>
                </nav>
                <div class="copyright pull-right">
                    &copy;
                    <script>document.write(new Date().getFullYear())</script>
                    , made with <i class="fa fa-heart heart"></i> by <a href="">Son</a>
                </div>
            </div>
        </footer>

    </div>
</div>

</body>

@yield('script')
</html>
