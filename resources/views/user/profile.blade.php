@extends('template.layout')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/reset.css') }}">
    <link rel="stylesheet" href="{{ asset('css/login/header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/login/profile.css') }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>

    <!-- jQuery Modal -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />
@endsection
@section('header')
    @extends('template.login_nav')
@endsection
@section('title')
    Profile
@endsection

@section('content')
    <div class="container">
        <div class="profile">
            <div class="clearfix">
                <div class="profile-left-side">
                    <div class="left-profile-header">
                        <div class="clearfix">
                            <div class="pf-left-side">
                                <img src="{{ asset('storage/' . Auth::user()->profile) }}" alt=""
                                    class="pfl-profile">
                                <h2>{{ Auth::user()->name }}</h2>
                            </div>
                            <div class="pf-right-side">

                                <div id="ex1" class="modal">
                                    <form action="{{ route('user.update') }}" method="POST"
                                        class="user-edit" enctype="multipart/form-data">
                                        @csrf
                                        <h3 class="edit-ttl">Edit Your Information</h3>
                                        <div class="profile-image">
                                            <img src="{{ asset('storage/' . Auth::user()->profile) }}" alt="prview image"
                                                id="output"><br>
                                            <input type="file" name="profile" onchange="loadFile(event)" value="Auth::user()->profile"><br>
                                        </div>
                                        <input type="text" name="name" value="{{ Auth::user()->name }}"><br>
                                        @error('name')
                                            <div class="error">{{ $message }}</div>
                                        @enderror
                                        <input type="email" name="email" value="{{ Auth::user()->email }}"><br>
                                        @error('email')
                                            <div class="error">{{ $message }}</div>
                                        @enderror
                                        <input type="text" name="bio" value="{{ Auth::user()->bio }}"><br>
                                        @error('bio')
                                            <div class="error">{{ $message }}</div>
                                        @enderror
                                        <div>
                                            <button class="cancel" type="reset">Cancel</button>
                                            <button class="button-primary" type="submit">Update</button>
                                        </div>
                                    </form>
                                </div>
                                <div id="ex2" class="modal">
                                    <h2 class="cps-title">ChangePassword Form</h2>
                                    <form action="{{ route('update.password') }}" method="POST">
                                        @csrf
                                        <div class="cps-input-group">
                                            <input type="password" name="current_password" id="current_password"
                                                placeholder="Enter current password..." value="{{ old('current_password') }}">
                                            @error('current_password')
                                                <span class="error-message">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="cps-input-group">
                                            <input type="password" name="new_password" id="new_password" placeholder="Enter new password..."
                                                value="{{ old('new_password') }}">
                                            @error('new_password')
                                                <span class="error-message">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="cps-input-group">
                                            <input type="password" name="confirm_password" id="confirm_password"
                                                placeholder="Enter confirm password..." value="{{ old('confirm_password') }}">
                                            @error('confirm_password')
                                                <span class="error-message">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="input-gp change-blk">
                                            <input type="submit" value="Change Password" class="change-btn">
                                        </div>
                                    </form>
                                </div>
                                        <!-- Link to open the modal -->
                                       <div class="edit-update">
                                        <p><a href="#ex1" rel="modal:open">Edit Profile</a></p>
                                        <p><a href="#ex2" rel="modal:open">Update Password</a></p>
                                       </div>
                                </div>
                            </div>
                        </div>
                        <div class="pls-content">
                            <h2>Information</h2>
                            <div class="pls-email">
                                <h3>Email</h3>
                                <p>{{ Auth::user()->email }}</p>
                            </div>
                            <div class="pls-post-count">
                                <h3>Post Count</h3>
                                <p>{{ count($posts) }}</p>
                            </div>
                            <div class="pls-Bio">
                                <h3>Bio</h3>
                                <p>{{ Auth::user()->bio }}</p>
                            </div>
                            <h2>My Posts</h2>
                            @foreach ($posts as $post)
                                <div class="mypost-whole">
                                    <div class="pls-myPost">
                                        <p> <img src="{{ asset('storage/' . Auth::user()->profile) }}" alt="">
                                            <span>{{ Auth::user()->name }}
                                                <span>{{ $post->created_at->format('d m Y') }}</span> </span>
                                        </p>
                                    </div>
                                    <div class="pf-post-content">
                                        <div class="clearfix">
                                            <div class="prof-post">
                                                <div class="prof-left-post">
                                                    <h3>{{ $post->title }} </h3>
                                                    <p>{{ strip_tags(html_entity_decode($post->description)) }}</p>
                                                    <div class="prof-leftPost-footer">
                                                        <a href="#">{{ $post->category }}</a>
                                                        <div class="leftfo-right">
                                                            <p class="see-tools"><i class="fa-solid fa-ellipsis"></i></p>
                                                            <div class="tools">
                                                                <form action="{{ route('profile.delete', $post->id) }}"
                                                                    method="post">
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
                                                </div>
                                            </div>
                                            <div class="prof-right-post">
                                                <img src="{{ asset('storage/' . $post->image) }}" alt="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach


                        </div>
                    </div>
                    <div class="profile-right-side">
                        <div class="prors-content">
                            <h2>2022 in Latest Posts</h2>
                            @foreach ($latestPosts as $lpost)
                                <div class="prors-post">
                                    <div class="prors-head">
                                        <img src="{{ asset('storage/' . Auth::user()->profile) }}" alt=""
                                            class="pplp-profile">
                                        <p>{{ Auth::user()->name }}</p>
                                    </div>
                                    <p class="prors-title">{{ $lpost->title }}</p>
                                </div>
                            @endforeach

                            <div class="profile-category">
                                @foreach ($categories as $cat)
                                <a href="{{ route('category.search', $cat->ctitle) }}">{{ $cat->ctitle }}</a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
    @push('script')
    <script>
        var loadFile = function(event) {
            var reader = new FileReader();
            reader.onload = function() {
                var output = document.getElementById('output');
                output.src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        };
    </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"
            integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="{{ asset('css/login/js/login_nav.js') }}"></script>
    @endpush
