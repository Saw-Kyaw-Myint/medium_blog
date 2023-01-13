@extends('template.layout')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/unlogin/header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/unlogin/login.css') }}">
    <link rel="stylesheet" href="{{ asset('css/unlogin/register.css') }}">
@endsection
@section('title')
    register
@endsection
@section('header')
    @extends('template.navbar')
@endsection

@section('content')
    <div class="container">
        <div class="login-whole">
            <h2>Sign Up</h2>
            <form action="{{ route('register.store') }}" method="POST">
                @csrf
                <div class="input-group">
                <div class="left-form">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" id="name" value="{{ old('name') }}" name="name" placeholder="Your Name">
                        @error('name')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" value="{{ old('password') }}" id="password" name="password" placeholder="Password">
                        @error('password')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                    </div>
                </div>

                <div class="right-form">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" value="{{ old('email') }}" id="email" name="email" placeholder="Your Email(example@gmail.com">
                        @error('email')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                    </div>
                    <div class="form-group">
                        <label for="password">Confirm Password</label>
                        <input type="password" id="confirmpassword" value="{{ old('confirm_password') }}" name="confirm_password" placeholder="Confirm Password">
                        @error('confirm_password')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                    </div>
                </div>
            </div>
                <div class="bio-input">
                <label for="bio">Bio</label>
                <input type="text" placeholder="Your bio" id="bio" name="bio" value="{{ old('bio') }}">
               @error('bio')
               <span class="error-message">{{ $message }}</span>
               @enderror
            </div>
                <button type="submit" class="signUp">SignUP</button>
            </form>
            <div class="">

            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="{{ asset('css/unlogin/js/header.js') }}"></script>
@endpush
