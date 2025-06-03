@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header bg-primary text-light d-flex justify-content-between align-items-center">
        <h2 class="card-title mb-0">My Profile</h2>
        <div>
            <a href="{{ route('employees.edit', $employee) }}" class="btn btn-light">Edit Profile</a>
            <a href="{{ route('home') }}" class="btn btn-secondary">Back to Dashboard</a>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <h4>Personal Information</h4>
                <table class="table">
                    <tr>
                        <th>Name:</th>
                        <td>{{ $employee->user->name }}</td>
                    </tr>
                    <tr>
                        <th>Email:</th>
                        <td>{{ $employee->user->email }}</td>
                    </tr>
                    <tr>
                        <th>Role:</th>
                        <td>{{ ucfirst($employee->user->role) }}</td>
                    </tr>
                    <tr>
                        <th>Department:</th>
                        <td>{{ $employee->department->name ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>Position:</th>
                        <td>{{ $employee->position ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>Phone:</th>
                        <td>{{ $employee->user->phone ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>Address:</th>
                        <td>{{ $employee->address ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>Hire Date:</th>
                        <td>{{ $employee->hire_date ? $employee->hire_date->format('M d, Y') : 'N/A' }}</td>
                    </tr>
                </table>
            </div>

            <div class="col-md-6">
                <h4>Quick Links</h4>
                <div class="list-group mb-4">
                    <a href="{{ route('attendance.index') }}" class="list-group-item list-group-item-action">
                        <i class="fas fa-clock"></i> View Attendance Records
                    </a>
                    <a href="{{ route('leaves.create') }}" class="list-group-item list-group-item-action">
                        <i class="fas fa-calendar-alt"></i> Request Leave
                    </a>
                    <a href="{{ route('documents.index') }}" class="list-group-item list-group-item-action">
                        <i class="fas fa-file-alt"></i> My Documents
                    </a>
                </div>

                <h4>Recent Attendance</h4>
                <div class="table-responsive">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Clock In</th>
                                <th>Clock Out</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($employee->attendances as $attendance)
                                <tr>
                                    <td>{{ $attendance->clock_in->format('M d, Y') }}</td>
                                    <td>{{ $attendance->clock_in->format('h:i A') }}</td>
                                    <td>{{ $attendance->clock_out ? $attendance->clock_out->format('h:i A') : 'Not clocked out' }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center">No recent attendance records</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
