@extends('layouts.app')

@section('title', 'Login')

@section('content')
<h3>Login</h3>

<form method="post" action="{{ route('login.proses') }}" style="max-width:320px">
    @csrf

    @error('username')
        <p class="err">{{ $message }}</p>
    @enderror

    <p><input type="text" name="username" value="{{ old('username') }}" placeholder="Username" required></p>
    <p><input type="password" name="password" placeholder="Password" required></p>
    <button type="submit">Masuk</button>
</form>
@endsection