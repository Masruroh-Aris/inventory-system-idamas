@extends('layouts.app')

@section('content')
<div class="container" style="max-width: 400px; margin-top:50px;">
    <h2 class="mb-4">Login</h2>
    <form action="{{ route('admin.login.submit') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label>Email</label>
        <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
        @error('email')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>
    <div class="mb-3">
        <label>Password</label>
        <input type="password" name="password" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary">Login</button>
</form>

