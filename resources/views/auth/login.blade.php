@extends('template.layout')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/unlogin/header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/unlogin/login.css') }}">
@endsection
@section('header')
    @extends('template.navbar')
@endsection
@section('title')
    login
@endsection
@section('content')
<div class="container">
    @if (session('status'))
    <div class="alert-box">
        <span class="alert-message">{{ session('status') }}</span>
    </div>
@endif
@if (session('error'))
<div class="alert-box">
    <span class="alert-fail">{{ session('error') }}</span>
</div>
@endif
    <div class="login-form">
    <h2>Login</h2>
    <form action="{{ route('login.store') }}" method="POST">
        @csrf
    <div class="form-group">
        <label for="email">Email</label>
        <input type="text" id="email" name="email" value="{{ old('email') }}" placeholder="Youremail(example@gmail.com)">
        @error('email')
         <span class="error-message">{{ $message }}</span>
        @enderror
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" value="{{ old('password') }}" placeholder="Password">
        @error('password')
        <span class="error-message">{{ $message }}</span>
       @enderror
    </div>
    <button type="submit" class="login">Login</button>
</form>
    </div>
</div>

@endsection
@push('script')
    <script src="{{ asset('css/unlogin/js/header.js') }}"></script>
@endpush
