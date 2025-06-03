@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header bg-primary text-light d-flex justify-content-between align-items-center">
        <h2 class="card-title mb-0">Leave Requests</h2>
        @if(auth()->user()->role === 'employee')
            <a href="{{ route('leaves.create') }}" class="btn btn-light">Request Leave</a>
        @endif
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Employee</th>
                        <th>Type</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Duration</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($leaves as $leave)
                    <tr>
                        <td>{{ $leave->employee->name }}</td>
                        <td>{{ ucfirst($leave->type) }}</td>
                        <td>{{ $leave->start_date->format('M d, Y') }}</td>
                        <td>{{ $leave->end_date->format('M d, Y') }}</td>
                        <td>{{ $leave->start_date->diffInDays($leave->end_date) + 1 }} days</td>
                        <td>
                            <span class="badge bg-{{ $leave->status === 'approved' ? 'success' : ($leave->status === 'rejected' ? 'danger' : 'warning') }}">
                                {{ ucfirst($leave->status) }}
                            </span>
                        </td>
                        <td>
                            <div class="btn-group">
                                <a href="{{ route('leaves.show', $leave) }}" class="btn btn-sm btn-info">View</a>
                                @if(auth()->user()->role === 'admin' && $leave->status === 'pending')
                                    <form action="{{ route('leaves.approve', $leave) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-sm btn-success" onclick="return confirm('Are you sure you want to approve this leave request?')">Approve</button>
                                    </form>
                                    <form action="{{ route('leaves.reject', $leave) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to reject this leave request?')">Reject</button>
                                    </form>
                                @endif
                                @if(auth()->user()->role === 'employee' && $leave->status === 'pending')
                                    <a href="{{ route('leaves.edit', $leave) }}" class="btn btn-sm btn-warning">Edit</a>
                                    <form action="{{ route('leaves.destroy', $leave) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Cancel</button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{ $leaves->links() }}
    </div>
</div>
@endsection
