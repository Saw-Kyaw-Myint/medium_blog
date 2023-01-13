@extends('template.layout')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/reset.css') }}">
    <link rel="stylesheet" href="{{ asset('css/unlogin/header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endsection
@section('header')
    @extends('template.navbar')
@endsection
@section('title')
    Home
@endsection
@section('content')

<section class="vender">
    <div class="container">
        <h2>Stay Crious</h2>
        <p>Discover sotories,thing,and expertise <br>
            from writers on any topic</p>
        <a href="#">Start reading</a>
    </div>
</section>

<section>
    <div class="container">
        <div class="clearfix">
            <div class="post-list">

            @forelse ($posts as $post)
                <a href="{{ route('post.show', $post->id) }}">
                <div class="post">
                    <div class="clearfix">
                        <div class="post-text">
                            <div class="people">
                                <div class="clearfix">
                                    <div class="profile-img">
                                        <img src="{{ asset('storage/'. $post->user->profile) }}" alt="" alt="img1" width="100%" height="100%">
                                    </div>
                                    <p class="name">{{ $post->user->name }}</p>
                                </div>
                            </div><!--post-user-->

                            <div>
                                <h2 class="post-title">{{ $post->title }}</h2>
                                <p class="post-description">{{ strip_tags(html_entity_decode($post->description)) }}</p>
                                <p class="post-date">{{ $post->created_at->diffForHumans() }} read </p>
                            </div>
                        </div>
                        <div class="post-img">
                            <img src="{{ asset('storage/'. $post->image) }}" alt="" width="100%" height="100%">
                        </div><!--post-left-->
                    </div>
                </div>
                </a>
            @empty
        <h2>Empty Result</h2>
            @endforelse
            </div>
            <div class="category">
                <div class="category-list">
                    <h2 class="cate-name">DISCOVER MORE OF WHAT MATTERS TO YOU</h2>
                    <div class="category-item">
                        @foreach ($categories as $cat)
                        <a href="{{ route('home.search', $cat->ctitle) }}">{{ $cat->ctitle }}</a>
                    @endforeach
                    </div>
                </div>
                <p class="category-footer">
                    <a href="#">Help</a>
                    <a href="#"> Status</a>
                    <a href="#">Writer</a>
                    <a href="#">Blog</a>
                    <a href="#">Cateers</a>
                    <a href="">Privacy</a>
                    <a href="">Trmms</a>
                    <a href="#">About</a>
                    <a href="">Text to speech</a>
                </p>
            </div><!--right-category-->
        </div>
    </div>
    </div>
</section>

@endsection
@push('script')
    <script src="{{ asset('css/unlogin/js/header.js') }}"></script>
@endpush
