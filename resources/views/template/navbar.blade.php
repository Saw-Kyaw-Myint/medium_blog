<header>
    <div class="container">
        <p class="btn-gnavi">
            <span></span>
            <span></span>
            <span></span>
        </p>
        <div class="header-content">
            <h1 class="logo"><a href="{{ route('home.index') }}"><img src="template/logo.png" alt="">Medium</a>
            </h1>
            <nav id="global-navi">
                <ul class="menu">
                    <li><a href="#">Write</a></li>
                    <li><a href="{{ route('login.create') }}">Sign In</a></li>
                    <li><a href="{{ route('register.create') }}" class="get-button">Get start</a></li>
                </ul>
            </nav>
        </div>
    </div>
</header>
