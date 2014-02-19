<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            @if (Auth::check())
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#nav-menu">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            @endif
            <a class="navbar-brand" href="/">
                {{ HTML::image('img/logo_small.png', 'Sparrow') }}
            </a>
        </div>
        @if (Auth::check())
            <div class="collapse navbar-collapse" id="nav-menu">
                <ul class="nav navbar-nav pull-right">
                    <li>
                        {{ HTML::link(URL::route('signOut'), 'Sign out') }}
                    </li>
                </ul>
            </div>
        @endif
    </div>
</nav>