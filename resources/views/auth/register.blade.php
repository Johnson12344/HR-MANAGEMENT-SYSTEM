@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header bg-primary text-light">
         <h2 class="card-title">Register</h2>
    </div>
    <div class="card-body">
         <form method="POST" action="{{ route('register') }}">
             @csrf
             <div class="mb-3">
                 <label for="name" class="form-label">Name</label>
                 <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>
                 @error('name')
                     <div class="invalid-feedback d-block">{{ $message }}</div>
                 @enderror
             </div>
             <div class="mb-3">
                 <label for="email" class="form-label">Email Address</label>
                 <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                 @error('email')
                     <div class="invalid-feedback d-block">{{ $message }}</div>
                 @enderror
             </div>
             <div class="mb-3">
                 <label for="phone" class="form-label">Phone</label>
                 <input id="phone" type="text" class="form-control" name="phone" value="{{ old('phone') }}">
                 @error('phone')
                     <div class="invalid-feedback d-block">{{ $message }}</div>
                 @enderror
             </div>
             <div class="mb-3">
                 <label for="role" class="form-label">Role</label>
                 <select id="role" name="role" class="form-select">
                     <option value="employee" {{ old('role') == 'employee' ? 'selected' : '' }}>Employee</option>
                     <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                 </select>
                 @error('role')
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
             <div class="mb-3">
                 <label for="password-confirm" class="form-label">Confirm Password</label>
                 <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
             </div>
             <button type="submit" class="btn btn-primary">Register</button>
         </form>
    </div>
</div>
@endsection
