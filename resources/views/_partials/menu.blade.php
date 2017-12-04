<nav class="navbar fixed-top navbar-expand-xl navbar-dark bg-dark">
    {{--<div class="container-fluid">--}}
    <a class="navbar-brand" href="{{ url('/') }}">{{ config('app.name', 'Trip Connect') }}</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="app-navbar-collapse">
        <!-- Left Side Of Navbar -->
        <ul class="navbar-nav mr-auto">
            @if (! Auth::guest())

                {{--<li class="nav-item"><a class="nav-link" href="/home">My Trips</a></li>--}}
                {{--<li class="nav-item"><a class="nav-link" href="/overtime">Offered Overtime</a></li>--}}

                @can('view', busRegistration\Child::class)
                    <li class="nav-item"><a class="nav-link" href="{{ route('list_student') }}">Student</a></li>
                @endcan

                @can('update', busRegistration\User::class)
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Users</a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="{{ route('list_users') }}">Users</a>
                            <a class="dropdown-item" href="{{ route('list_role') }}">Roles</a>
                        </div>
                    </li>
                @endcan

                @can('view', busRegistration\School::class)
                    <li class="nav-item"><a class="nav-link" href="{{ route('list_school') }}">Schools</a></li>
                @endcan

                @can('view', busRegistration\Grade::class)
                    <li class="nav-item"><a class="nav-link" href="{{ route('list_grade') }}">Grades</a></li>
                @endcan

            @endif
        </ul>

        <!-- Right Side Of Navbar -->
        <ul class="navbar-nav ml-auto">
            <!-- Authentication Links -->
            @if (Auth::guest())
                <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Register</a></li>
            @else

                <li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                        {{ Auth::user()->first_name . ' ' . Auth::user()->last_name }}</a>

                    <div class="dropdown-menu dropdown-menu-right" role="menu">
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Logout <i class="fa fa-sign-out float-right"></i>

                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </div>
                </li>
            @endif
        </ul>
    </div>
    {{--</div>--}}
</nav>