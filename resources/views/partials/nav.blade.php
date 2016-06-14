<nav class="navbar navbar-default navbar-static-top">
    <div class="container">
        <div class="navbar-header">

            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <!-- Branding Image -->
            <a class="navbar-brand" href="{{ url('/') }}">
                <span class="logo edu">Edu</span>
                <span class="logo me">me</span>
            </a>
        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->
            <ul class="nav navbar-nav">
                <li><a href="{{ route('home') }}">Home</a></li>
                @if (!Auth::guest())
                    <li><a href="{{ route('profile.friends') }}">Friends</a></li>
                    <!-- <li><a href="{{ route('profile.cv', ['username' => Auth::user()->username ? Auth::user()->username : Auth::user()->id ]) }}">CV</a></li> -->
                    <li><a href="{{ route('course.index') }}">Courses</a></li>
                @endif
            </ul>
            @if (!Auth::guest())
                <form class="navbar-form navbar-left" role="search" action="{{ route('search.resaults') }}">
                    <div class="form-group">
                        <input type="text" class="form-control" name="quary" placeholder="Search">
                    </div>
                    <button type="submit" class="btn btn-default">Submit</button>
                </form>
            @endif

            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
                <!-- Authentication Links -->
                @if (Auth::guest())
                    <li><a href="{{ url('/login') }}">Login</a></li>
                    <li><a href="{{ url('/register') }}">Register</a></li>
                @else
                    <li><a href="{{ route('profile.index', ['username' => Auth::user()->username ? Auth::user()->username : Auth::user()->id ]) }}">{{ Auth::user()->firstname }}</a></li>
                    <li><a href="{{ route('profile.edit') }}">Update Profile</a></li>
                    <li><a href="{{ url('/logout') }}">Logout</a></li>
                @endif
            </ul>
        </div>
    </div>
</nav>