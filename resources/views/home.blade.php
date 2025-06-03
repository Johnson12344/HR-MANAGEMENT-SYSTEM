@extends('layouts.app')

@section('content')
<div class="row animate__animated animate__fadeIn">
    <div class="col-12 mb-4">
        <div class="card shadow animate__animated animate__fadeInDown">
            <div class="card-header bg-primary text-light animate__animated animate__fadeIn">
                <h2 class="card-title mb-0">Welcome, {{ $user->name }}!</h2>
            </div>
            <div class="card-body">
                <p class="lead animate__animated animate__fadeInUp">This is your Human Resources Management System dashboard. Use the quick links below to get started.</p>
            </div>
        </div>
    </div>

    @if ($role === 'admin')
        <div class="col-md-4 mb-3 animate__animated animate__zoomIn">
            <div class="card h-100">
                <div class="card-body text-center">
                    <h5 class="card-title">Manage Employees</h5>
                    <p class="card-text">Add, edit, or remove employees.</p>
                    <a href="{{ route('employees.index') }}" class="btn btn-outline-primary">Go</a>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3 animate__animated animate__zoomIn">
            <div class="card h-100">
                <div class="card-body text-center">
                    <h5 class="card-title">Manage Departments</h5>
                    <p class="card-text">Organize and update departments.</p>
                    <a href="{{ route('departments.index') }}" class="btn btn-outline-primary">Go</a>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3 animate__animated animate__zoomIn">
            <div class="card h-100">
                <div class="card-body text-center">
                    <h5 class="card-title">Leave Requests</h5>
                    <p class="card-text">Review and approve leave requests.</p>
                    <a href="{{ route('leaves.index') }}" class="btn btn-outline-primary">Go</a>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3 animate__animated animate__zoomIn">
            <div class="card h-100">
                <div class="card-body text-center">
                    <h5 class="card-title">Attendance</h5>
                    <p class="card-text">View and manage attendance records.</p>
                    <a href="{{ route('attendance.index') }}" class="btn btn-outline-primary">Go</a>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3 animate__animated animate__zoomIn">
            <div class="card h-100">
                <div class="card-body text-center">
                    <h5 class="card-title">Documents</h5>
                    <p class="card-text">Manage HR documents.</p>
                    <a href="{{ route('documents.index') }}" class="btn btn-outline-primary">Go</a>
                </div>
            </div>
        </div>
    @elseif ($role === 'employee')
        <div class="col-md-4 mb-3 animate__animated animate__zoomIn">
            <div class="card h-100">
                <div class="card-body text-center">
                    <h5 class="card-title">My Profile</h5>
                    <p class="card-text">View and update your profile.</p>
                    <a href="{{ route('profile') }}" class="btn btn-outline-primary">Go</a>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3 animate__animated animate__zoomIn">
            <div class="card h-100">
                <div class="card-body text-center">
                    <h5 class="card-title">Request Leave</h5>
                    <p class="card-text">Submit a new leave request.</p>
                    <a href="{{ route('leaves.create') }}" class="btn btn-outline-primary">Go</a>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3 animate__animated animate__zoomIn">
            <div class="card h-100">
                <div class="card-body text-center">
                    <h5 class="card-title">Attendance</h5>
                    <p class="card-text">View your attendance records.</p>
                    <a href="{{ route('attendance.index') }}" class="btn btn-outline-primary">Go</a>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3 animate__animated animate__zoomIn">
            <div class="card h-100">
                <div class="card-body text-center">
                    <h5 class="card-title">My Documents</h5>
                    <p class="card-text">Access your HR documents.</p>
                    <a href="{{ route('documents.index') }}" class="btn btn-outline-primary">Go</a>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection
