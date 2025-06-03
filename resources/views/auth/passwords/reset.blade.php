@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header bg-primary text-light">
         <h2 class="card-title">Reset Password</h2>
    </div>
    <div class="card-body">
         <form method="POST" action="{{ route('password.update') }}">
             @csrf
             <input type="hidden" name="token" value="{{ $token }}">
             <div class="mb-3">
                 <label for="email" class="form-label">Email Address</label>
                 <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
                 @error('email')
                     <div class="invalid-feedback d-block">{{ $message }}</div>
                 @enderror
             </div>
             <div class="mb-3">
                 <label for="password" class="form-label">Password</label>
                 <input id="password" type="password" class="form-control" name="password" required autocomplete="new-password">
                 @error('password')
                     <div class="invalid-feedback d-block">{{ $message }}</div>
                 @enderror
             </div>
             <div class="mb-3">
                 <label for="password-confirm" class="form-label">Confirm Password</label>
                 <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
             </div>
             <button type="submit" class="btn btn-primary">Reset Password</button>
         </form>
    </div>
</div>
@endsection
