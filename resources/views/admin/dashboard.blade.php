@extends('layouts.app')

@section('content')
<div class="card animate__animated animate__fadeInUp">
    <div class="card-header bg-primary text-light animate__animated animate__fadeInDown">
         <h2 class="card-title">Admin Dashboard</h2>
    </div>
    <div class="card-body">
         <p class="animate__animated animate__fadeIn">Welcome, {{ Auth::user()->name }}. Use the buttons below to manage your Human Resources Management System.</p>
         <ul class="list-group list-group-flush">
             <li class="list-group-item"><a class="btn btn-primary animate__animated animate__pulse animate__infinite" href="{{ route('employees.index') }}">Manage Employees</a></li>
             <li class="list-group-item"><a class="btn btn-primary animate__animated animate__pulse animate__infinite" href="{{ route('departments.index') }}">Manage Departments</a></li>
             <li class="list-group-item"><a class="btn btn-primary animate__animated animate__pulse animate__infinite" href="{{ route('leaves.index') }}">Leave Requests</a></li>
             <li class="list-group-item"><a class="btn btn-primary animate__animated animate__pulse animate__infinite" href="{{ route('attendance.index') }}">Attendance</a></li>
             <li class="list-group-item"><a class="btn btn-primary animate__animated animate__pulse animate__infinite" href="{{ route('documents.index') }}">Documents</a></li>
         </ul>
    </div>
</div>
@endsection
