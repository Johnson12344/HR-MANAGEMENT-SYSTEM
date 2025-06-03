@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header bg-primary text-light d-flex justify-content-between align-items-center">
        <h2 class="card-title mb-0">Employee Details</h2>
        <div>
            <a href="{{ route('employees.edit', $employee) }}" class="btn btn-light">Edit</a>
            <a href="{{ route('employees.index') }}" class="btn btn-secondary">Back to List</a>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <h4>Personal Information</h4>
                <table class="table">
                    <tr>
                        <th>Name:</th>
                        <td>{{ $employee->name }}</td>
                    </tr>
                    <tr>
                        <th>Email:</th>
                        <td>{{ $employee->email }}</td>
                    </tr>
                    <tr>
                        <th>Role:</th>
                        <td>{{ ucfirst($employee->role) }}</td>
                    </tr>
                    <tr>
                        <th>Department:</th>
                        <td>{{ $employee->department->name ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>Created At:</th>
                        <td>{{ $employee->created_at->format('M d, Y H:i A') }}</td>
                    </tr>
                    <tr>
                        <th>Last Updated:</th>
                        <td>{{ $employee->updated_at->format('M d, Y H:i A') }}</td>
                    </tr>
                </table>
            </div>

            <div class="col-md-6">
                <h4>Recent Activity</h4>
                <div class="list-group">
                    @forelse($employee->attendances()->latest()->take(5)->get() as $attendance)
                        <div class="list-group-item">
                            <div class="d-flex w-100 justify-content-between">
                                <h6 class="mb-1">Attendance Record</h6>
                                <small>{{ $attendance->created_at->format('M d, Y') }}</small>
                            </div>
                            <p class="mb-1">
                                Clock In: {{ $attendance->clock_in->format('h:i A') }}
                                @if($attendance->clock_out)
                                    <br>Clock Out: {{ $attendance->clock_out->format('h:i A') }}
                                @endif
                            </p>
                        </div>
                    @empty
                        <div class="list-group-item">No recent attendance records</div>
                    @endforelse
                </div>

                <h4 class="mt-4">Leave Requests</h4>
                <div class="list-group">
                    @forelse($employee->leaves()->latest()->take(5)->get() as $leave)
                        <div class="list-group-item">
                            <div class="d-flex w-100 justify-content-between">
                                <h6 class="mb-1">{{ $leave->type }} Leave</h6>
                                <small>{{ $leave->created_at->format('M d, Y') }}</small>
                            </div>
                            <p class="mb-1">
                                From: {{ $leave->start_date->format('M d, Y') }}
                                <br>To: {{ $leave->end_date->format('M d, Y') }}
                                <br>Status: <span class="badge bg-{{ $leave->status === 'approved' ? 'success' : ($leave->status === 'rejected' ? 'danger' : 'warning') }}">
                                    {{ ucfirst($leave->status) }}
                                </span>
                            </p>
                        </div>
                    @empty
                        <div class="list-group-item">No recent leave requests</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
