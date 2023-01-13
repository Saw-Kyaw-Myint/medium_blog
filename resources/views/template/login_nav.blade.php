<header>
    <p class="btn-gnavi">
        <span></span>
        <span></span>
        <span></span>
    </p>
    <div class="login-header">
        <div class="lright-menu">
            <div class="login-hright">
                <h1>
                        @if (Auth::user())
                            <a href="{{ route('post.index') }}"><img src="{{ asset('storage/' . Auth::user()->profile) }}" alt=""> </a>
                        @else
                        <a href="{{ route('home.index') }}"> <img src="{{ asset('storage/people.png') }}" alt=""></a>
                        @endif

                    </a></h1>
                <div class="input-group">
                    <i class="fa-sharp fa-solid fa-magnifyping-glass"></i>
                    <form action="{{ route('post.index') }}" method="get" class="search-form">
                        <input type="text" class="search" value="{{ request('q') }}" placeholder="Search  title"
                            name="q">
                        {{-- <button class="sbutton" type="submit">Search</button> --}}
                    </form>
                </div>
            </div>
        </div>

        <nav id="global-navi">
            <ul class="menu">
                @if (Auth::user())
                    <li class="left-write">
                        <a href="{{ route('post.create') }}">
                            <i class="fa-solid fa-pen-to-square"></i><span>write</span></a></li>
                    <li>
                        <div class="select-box">
                            @if (Auth::user())
                                <img src="{{ asset('storage/' . Auth::user()->profile) }}" alt="">
                            @else
                                <img src="{{ asset('storage/people.png') }}" alt="">
                            @endif
                            <div class="">
                                <p class="down-icon">
                                    <i class="fa-solid fa-caret-down"></i></i>
                                </p>
                                <div class="custom-select">
                                    <p><a href="{{ route('user.profile') }}">profile</a></p>
                                    <p><a href="{{ route('post.index') }}">Post</a></p>
                                    <div class="custom-logout">
                                        <form action="{{ route('logout') }}" method="post">
                                            @csrf
                                            <button type="submit">logout</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                @else
                    <li><a href="{{ route('login.create') }}">Write</a></li>
                    <li><a href="{{ route('login.create') }}" class="sign-green">Sign In</a></li>
                    <li><a href="{{ route('register.create') }}" class="get-button">Get start</a></li>
                @endif

            </ul>
        </nav>
    </div>
</header>
