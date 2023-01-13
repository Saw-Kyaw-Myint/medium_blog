@extends('template.layout')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/reset.css') }}">
    <link rel="stylesheet" href="{{ asset('css/login/header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/login/style.css') }}">
@endsection
@section('header')
    @extends('template.login_nav')
@endsection
@section('title')
    Post List
@endsection

@section('content')
    <div class="container">
        <div class="postlist-content">
            <div class="clearfix">
                <div class="post-list">
                    @forelse ($posts as $post)
                        <div class="post">
                            <a href="{{ route('post.show', $post->id) }}">
                                <div class="clearfix">
                                    <div class="post-text">
                                        <div class="people">
                                            <div class="clearfix">
                                                <div class="profile-img">
                                                    <img src="{{ asset('storage/' . $post->user->profile) }}" alt=""
                                                        alt="img1" width="100%" height="100%">
                                                </div>
                                                <p class="name">{{ $post->user->name }}</p>
                                            </div>
                                        </div>
                                        <!--post-user-->

                                        <div>
                                            <h2 class="post-title">{{ $post->title }}</h2>
                                            <p class="post-description">
                                                {{ strip_tags(html_entity_decode($post->description)) }}</p>
                                            <div class="post-footer">
                                                <div class="postfo-left">
                                                    @foreach ($post->categories as $category)
                                                        <span>{{ $category->ctitle }}</span>
                                                    @endforeach
                                                    <p class="post-date">{{ $post->created_at->diffForHumans() }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="post-img">
                                        <img src="{{ asset('storage/' . $post->image) }}" alt="" width="100%"
                                            height="100%">
                                    </div>
                                    <!--post-left-->
                                </div>
                            </a>
                            <div class="postfo-right">
                                <p class="see-tools" onclick="editDelete({{ $post->id }})"><i class="fa-solid fa-ellipsis"></i></p>
                                <div class="tools" id="{{ $post->id }}">
                                    <form action="{{ route('post.destroy', $post->id) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button class="del-btn">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </button>
                                    </form>
                                    <a href="{{ route('post.edit', $post->id) }}"><i
                                            class="fa-solid fa-pen-to-square"></i></a>
                                </div>
                            </div>
                        </div>


                        <!--second post-->
                    @empty
                        <h2>your result is empty</h2>
                    @endforelse

                </div>
                <div class="category">
                    <div class="category-list">
                        <h2 class="cate-name">2022 IN Latest Post</h2>
                        @foreach ($latestPosts as $lpost)
                            <div class="latest-post-whole">
                                <div class="latest-post">
                                    <div class="list-latest-profile">
                                        <img src="{{ asset('storage/' . $lpost->user->profile) }}" alt=""
                                            alt="img1" width="100%" height="100%">
                                        <p class="name">{{ $lpost->user->name }}</p>
                                    </div>
                                </div>
                                <!--post-user-->
                                <div class="latest-description">{{ strip_tags(html_entity_decode($lpost->description)) }}
                                </div>
                            </div>
                        @endforeach

                    </div>
                    <div class="category-item">
                        @foreach ($categories as $cat)
                            <p>{{ $cat->posts }}</p>
                            <a href="{{ route('home.search', $cat->ctitle) }}">{{ $cat->ctitle }}</a>
                        @endforeach
                    </div>
                </div>
            </div>
            <!--right-category-->
        </div>
    </div>
@endsection
@push('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"
        integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script>
            function editDelete(id){
             const sid='#'+id;
             $(`${sid}`).slideToggle()
            }
        </script>
    <script src="{{ asset('css/login/js/login_nav.js') }}"></script>
@endpush
