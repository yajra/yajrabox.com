<li class="nav-yajrabox"><a href="/">YajraBox</a></li>
<li class="nav-laravel"><a href="https://laravel.com/">Laravel</a></li>

@foreach(config("docs.links.{$package}") as $link)
    <li class="{{$link['icon']}}"><a href="{{$link['url']}}">{{$link['title']}}</a></li>
@endforeach

<li class="dropdown community-dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Community <span class="caret"></span></a>
    <ul class="dropdown-menu" role="menu">
        <li class="nav-github"><a href="https://github.com/yajra/{{$package}}">GitHub</a></li>
        <li class="divider"></li>
        <li class="nav-github"><a href="https://github.com/yajra/{{$package}}/issues">Issues</a></li>
        <li class="nav-github"><a href="https://github.com/yajra/{{$package}}/pulls">Pull Requests</a></li>
        <li class="divider"></li>
        <li class="nav-patreon"><a href="https://www.patreon.com/bePatron?u=4521203">Become a Patreon</a></li>
    </ul>
</li>
