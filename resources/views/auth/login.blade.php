@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header bg-primary text-light">
         <h2 class="card-title">Login</h2>
    </div>
    <div class="card-body">
         <form method="POST" action="{{ route('login') }}">
             @csrf
             <div class="mb-3">
                 <label for="email" class="form-label">Email Address</label>
                 <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
                 @error('email')
                     <div class="invalid-feedback d-block">{{ $message }}</div>
                 @enderror
             </div>
             <div class="mb-3">
                 <label for="password" class="form-label">Password</label>
                 <input id="password" type="password" class="form-control" name="password" required>
                 @error('password')
                     <div class="invalid-feedback d-block">{{ $message }}</div>
                 @enderror
             </div>
             <div class="mb-3 form-check">
                 <input id="remember" type="checkbox" class="form-check-input" name="remember" {{ old('remember') ? 'checked' : '' }} />
                 <label for="remember" class="form-check-label">Remember Me</label>
             </div>
             <button type="submit" class="btn btn-primary">Login</button>
         </form>
    </div>
</div>
@endsection
