@extends('layouts.app')

@section('content')
<div class="row justify-content-center animate__animated animate__fadeInDown">
    <div class="col-md-8">
        <div class="card shadow-lg animate__animated animate__zoomIn">
            <div class="card-header bg-primary text-white text-center animate__animated animate__fadeIn">
                <h2>Welcome to the Human Resources Management System</h2>
            </div>
            <div class="card-body">
                <p class="lead text-center animate__animated animate__fadeInUp">
                    This project is a comprehensive Human Resources Management System (HRMS) designed to streamline employee and admin operations. Employees can manage their profiles, attendance, leave requests, and documents, while admins can oversee all HR activities efficiently.
                </p>
                <hr>
                <div class="row text-center">
                    <div class="col-md-6 mb-3">
                        <h4 class="animate__animated animate__fadeInLeft">Employee</h4>
                        <p>Access your dashboard, manage your attendance, request leaves, and view documents.</p>
                        <a href="{{ route('login') }}" class="btn btn-outline-primary btn-block mb-2 animate__animated animate__pulse animate__infinite">Login as Employee</a>
                    </div>
                    <div class="col-md-6 mb-3">
                        <h4 class="animate__animated animate__fadeInRight">Admin</h4>
                        <p>Manage employees, departments, attendance, leaves, and HR documents.</p>
                        <a href="{{ route('login') }}" class="btn btn-outline-success btn-block mb-2 animate__animated animate__pulse animate__infinite">Login as Admin</a>
                    </div>
                </div>
                <div class="text-center mt-3">
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn btn-secondary animate__animated animate__bounceIn">Register</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
