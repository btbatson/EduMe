<header>
  <nav class="navbar">
    <div class="container">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="{{ route('home') }}">
          Edu<span>me</span>
        </a>
      </div>

      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav left">
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
            <input type="search" class="form-control" name="quary" placeholder="Search">
          </div>
        </form>
        @endif
        <ul class="nav navbar-nav navbar-right">
        @if (Auth::guest())
          <li><a class="sign" data-toggle="modal" data-target=".bs-example-modal-lg" href="#">Sign in</a></li>
        @else
          <li class="dropdown">
            <a href="#" class="notification dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><img src="{{ asset('/') }}images/notification.png" alt=""></a>
            <ul class="dropdown-menu notify">
              <li>
                <a href="#">
                  <div class="media">
                    <div class="media-left">
                      <img class="media-object" src="{{ asset('/') }}images/avatar.png" alt="">
                    </div>
                    <div class="media-body">
                      <h4 class="media-heading">Mohamed Shapan</h4>
                      send friend request to you
                    </div>
                  </div>
                </a>
              </li>
              <li>
                <a href="#">
                  <div class="media">
                    <div class="media-left">
                      <img class="media-object" src="{{ asset('/') }}images/avatar.png" alt="">
                    </div>
                    <div class="media-body">
                      <h4 class="media-heading">Mohamed Shapan</h4>
                      send friend request to you
                    </div>
                  </div>
                </a>
              </li>
              <li>
                <a href="#">
                  <div class="media">
                    <div class="media-left">
                      <img class="media-object" src="{{ asset('/') }}images/avatar.png" alt="">
                    </div>
                    <div class="media-body">
                      <h4 class="media-heading">Mohamed Shapan</h4>
                      send friend request to you
                    </div>
                  </div>
                </a>
              </li>
            </ul>
          </li>

          <li class="dropdown">
            <a href="#" class="message dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><img src="{{ asset('/') }}images/message.png" alt=""></a>
            <ul class="dropdown-menu notify">
              <li>
                <a href="#">
                  <div class="media">
                    <div class="media-left">
                      <img class="media-object" src="{{ asset('/') }}images/avatar.png" alt="">
                    </div>
                    <div class="media-body">
                      <h4 class="media-heading">Mohamed Shapan</h4>
                      send friend request to you
                    </div>
                  </div>
                </a>
              </li>
              <li>
                <a href="#">
                  <div class="media">
                    <div class="media-left">
                      <img class="media-object" src="{{ asset('/') }}images/avatar.png" alt="">
                    </div>
                    <div class="media-body">
                      <h4 class="media-heading">Mohamed Shapan</h4>
                      send friend request to you
                    </div>
                  </div>
                </a>
              </li>
              <li>
                <a href="#">
                  <div class="media">
                    <div class="media-left">
                      <img class="media-object" src="{{ asset('/') }}images/avatar.png" alt="">
                    </div>
                    <div class="media-body">
                      <h4 class="media-heading">Mohamed Shapan</h4>
                      send friend request to you
                    </div>
                  </div>
                </a>
              </li>
            </ul>
          </li>

          <li class="dropdown">
            <a href="#" class="profile dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
              <img src="{{ Auth::user()->profile_pic }}" alt="">
            </a>
            <ul class="dropdown-menu prof">
              <li><a href="{{ route('profile.index', ['username' => Auth::user()->username ? Auth::user()->username : Auth::user()->id ]) }}">My profile</a></li>
              <li><a href="{{ route('profile.edit') }}">Update profile</a></li>
              <li><a href="{{route('course.addCourse')}}">Add course</a></li>
              <li><a href="{{ url('/logout') }}">Log out</a></li>
            </ul>
          </li>
        @endif
        </ul>
      </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
  </nav>

  <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div id="loginOrRegister" class="row">
        <div class="col-sm-6 col-md-6">
            <h1>Sign up for your account</h1>
            <form method="POST" action="{{ url('/register') }}">
                {!! csrf_field() !!}
                <input type="text" placeholder="First name" name="firstname" value="{{ old('firstname') }}">
                @if ($errors->has('firstname'))
                    <span class="help-block">
                        <strong>{{ $errors->first('firstname') }}</strong>
                    </span>
                @endif
                <input type="text" placeholder="Last name" name="lastname" value="{{ old('lastname') }}">
                @if ($errors->has('lastname'))
                    <span class="help-block">
                        <strong>{{ $errors->first('lastname') }}</strong>
                    </span>
                @endif
                <input type="email" placeholder="E-mail" name="email" value="{{ old('email') }}">
                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
                <input type="password" placeholder="Password" name="password">
                @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
                <input type="password" placeholder="Confirm Password" name="password_confirmation">
                @if ($errors->has('password_confirmation'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                    </span>
                @endif
                <input type="submit" value="Sign up">
            </form>
        </div>
        <span class="border-left"></span>
        <div class="col-sm-6 col-md-6">
            <h1>Already a member? Login</h1>
            <form method="POST" action="{{ url('/login') }}">
                {!! csrf_field() !!}
                <input type="email" placeholder="E-mail" name="email" value="{{ old('email') }}">
                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
                <input type="password" placeholder="Password" name="password">
                @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
                <input type="submit" value="Login" class="login">
            </form>
            <!-- <h1>Login with</h1>
            <a href="#">
                <div class="social face">
                    <img src="{{asset('images/Facebook.png')}}">Facebook
                </div>
            </a>
            <a href="#">
                <div class="social linked">
                    <img src="{{ asset('images/Linkedin.png')}}">Linkedin
                </div>
            </a>
            <a href="#">
                <div class="social twitter">
                    <img src="{{asset('images/Twitter.png')}}">Twitter
                </div>
            </a> -->

        </div>
    </div>
      </div>
    </div>
  </div>
</header>