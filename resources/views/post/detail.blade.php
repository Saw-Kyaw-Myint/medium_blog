@extends('template.layout')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/reset.css') }}">
    <link rel="stylesheet" href="{{ asset('css/login/header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/login/detail.css') }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />
@endsection
@section('header')
    @extends('template.login_nav')
@endsection
@section('title')
    Post List
@endsection

@section('content')
    <div class="container">
        <div class="clearfix">
            <div class="detail-post">
                <div class="">
                    <div class="post-header">
                        <div class="clearfix">
                            <div class="left-header">
                                <div class="clearfix">
                                    <div class="profile-picture">
                                        <img src="{{ asset('storage/' . $post->user->profile) }}" alt=""
                                            width="20px" height="20px">
                                    </div>
                                    <div class="name-date">
                                        <p>{{ $post->user->name }}</p>
                                        <p class="date">{{ $post->created_at->format('M d') }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="right-header">
                                <a href="#">Delete</a>
                            </div>
                        </div>
                    </div>
                    <div class="post-img">
                        <img src="{{ asset('storage/' . $post->image) }}" alt="">
                    </div>
                    <h2 class="post-title">{{ $post->title }}</h2>
                    <p class="post-description">
                        {{ strip_tags(html_entity_decode($post->description)) }}
                    </p>
                </div>
                <!--detail psot-->
            </div>

            <div class="right-detail">
                <div class="detail-left-profile">
                    <div class="left-profile-image">
                        <img src="{{ asset('storage/' . $post->user->profile) }}" alt="">
                    </div>
                    <p class="profile-name">{{ $post->user->name }}</p>
                    <p class="count-post">{{ count($countPosts) }}</p>
                    <p class='post-reasion'>
                        {{ $post->bio }}
                    </p>
                </div>
                <!--left detail post-->

                <div class="related-category">
                    <h2>More from Medium</h2>
                    {{--  @foreach ($relatedPosts as $rPost)
                        <a href="{{ route('post.show', $rPost->id) }}">
                            <div class="category-post clearfix">
                                <div class="left-side">
                                    <div class="left-side-header">
                                        <img src="{{ asset('storage/' . $rPost->user->profile) }}" alt=""
                                            class="category-profile">
                                        <p class="category-profile-name">{{ $rPost->user->name }}</p>
                                    </div>
                                    <p class="category-short-description">
                                        {{ $rPost->title }}
                                    </p>

                                </div>
                            </div>
                        </a>
                    @endforeach  --}}
                </div>
            </div>
        </div>
        <div class="line"></div>

        <!-- comment  -->
        <section class="comment">
            <h2 class="">Comment <span class="comment-count">{{ count($commentsTotal) }}</span></h2>
            <p class="comment-here">Here you can left message !</p>
            <form method="post" action="{{ route('comment.add') }}">
                @csrf
                <textarea name="comment" id="" placeholder="What are you thoughts?" class="comment-description"></textarea>
                <input type="hidden" name="post_id" value="{{ $post->id }}" />
                <input type="submit" class="comment-btn" value="Comment" />
            </form>

            <!-- reply comment  -->
            @include('post.partials.replies', ['comments' => $post->comments, 'post_id' => $post->id])
        </section>
    </div>
@endsection
@push('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"
        integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
      function  edit(id){
        let sid='#'+id;
               $(`${sid}`).show(100);
               $(`.reply${id}`).focus();
        }
        function closeEdit(){
            $('.edit-form').hide(200);
        }
    </script>
    <script src="{{ asset('css/login/js/login_nav.js') }}"></script>
@endpush
