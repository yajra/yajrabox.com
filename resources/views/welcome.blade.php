<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('partials.meta')
    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
<nav class="navbar navbar-default navbar-custom navbar-fixed-top">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header page-scroll">
            <button type="button" class="navbar-toggle" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                Menu <i class="fa fa-bars"></i>
            </button>
            <a class="navbar-brand" href="{{url('/')}}">
                <img style="cursor: pointer; position: relative; top: -12px;" src="{{asset('assets/img/yajrabox.png')}}"
                     width="120px" alt="{{ config('app.name') }}">
            </a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>

<div class="font-sans text-gray-900 antialiased">
    <div class="main-content-wrap">
        <div class="container">
            <h1 class="text-center">Open Source Projects</h1>
            <hr/>
            <div class="row">
                @foreach($projects->chunk(3) as $chunks)
                    <ul class="box-list">
                        @foreach($chunks as $project)
                            <li class="col-sm-4" style="min-height: 200px;">
                                <div class="box-whole">
                                    <a class="box-click-content"
                                       href="{{$project['homepage'] ?: $project['html_url']}}">
                                        <div class="main-info">
                                            <h3>{{$project['name']}}</h3>
                                            <p>{{$project['description']}}</p>
                                        </div>
                                        <div class="arrow-wrap">
                                            <i class="material-icons">keyboard_arrow_right</i>
                                        </div>
                                    </a>
                                    <div class="box-footer">
                                        <a href="{{$project['html_url']}}">
                                            <i class="material-icons">star</i> {{$project['stargazers_count']}}
                                        </a>
                                        <a href="{{$project['html_url']}}/issues">
                                            <i class="material-icons">error</i> {{$project['open_issues']}}
                                        </a>
                                        <a href="{{$project['html_url']}}/network">
                                            <i class="material-icons">share</i> {{$project['forks_count']}}
                                        </a>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @endforeach
            </div>
        </div>
    </div>
</div>

<hr>

<!-- Footer -->
<footer>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                <ul class="list-inline text-center">
                    <li>
                        <a href="https://twitter.com/AQAngeles">
                                <span class="fa-stack fa-lg">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <i class="fa fa-twitter fa-stack-1x fa-inverse"></i>
                                </span>
                        </a>
                    </li>
                    <li>
                        <a href="https://www.facebook.com/aqangeles">
                                <span class="fa-stack fa-lg">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <i class="fa fa-facebook fa-stack-1x fa-inverse"></i>
                                </span>
                        </a>
                    </li>
                    <li>
                        <a href="https://github.com/yajra">
                                <span class="fa-stack fa-lg">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <i class="fa fa-github fa-stack-1x fa-inverse"></i>
                                </span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</footer>

</body>
</html>
