@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header bg-primary text-light d-flex justify-content-between align-items-center">
        <h2 class="card-title mb-0">Department Details</h2>
        <div>
            <a href="{{ route('departments.edit', $department) }}" class="btn btn-light">Edit</a>
            <a href="{{ route('departments.index') }}" class="btn btn-secondary">Back to List</a>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <h4>Department Information</h4>
                <table class="table">
                    <tr>
                        <th>Name:</th>
                        <td>{{ $department->name }}</td>
                    </tr>
                    <tr>
                        <th>Description:</th>
                        <td>{{ $department->description ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>Created At:</th>
                        <td>{{ $department->created_at->format('M d, Y H:i A') }}</td>
                    </tr>
                    <tr>
                        <th>Last Updated:</th>
                        <td>{{ $department->updated_at->format('M d, Y H:i A') }}</td>
                    </tr>
                </table>
            </div>

            <div class="col-md-6">
                <h4>Department Employees</h4>
                <div class="list-group">
                    @forelse($department->employees as $employee)
                        <div class="list-group-item">
                            <div class="d-flex w-100 justify-content-between">
                                <h6 class="mb-1">{{ $employee->name }}</h6>
                                <small>{{ $employee->role }}</small>
                            </div>
                            <p class="mb-1">{{ $employee->email }}</p>
                            <a href="{{ route('employees.show', $employee) }}" class="btn btn-sm btn-info">View Details</a>
                        </div>
                    @empty
                        <div class="list-group-item">No employees in this department</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
