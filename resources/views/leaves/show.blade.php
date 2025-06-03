@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header bg-primary text-light d-flex justify-content-between align-items-center">
        <h2 class="card-title mb-0">Leave Request Details</h2>
        <div>
            @if(auth()->user()->role === 'admin' && $leave->status === 'pending')
                <form action="{{ route('leaves.approve', $leave) }}" method="POST" class="d-inline">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="btn btn-success" onclick="return confirm('Are you sure you want to approve this leave request?')">Approve</button>
                </form>
                <form action="{{ route('leaves.reject', $leave) }}" method="POST" class="d-inline">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to reject this leave request?')">Reject</button>
                </form>
            @endif
            @if(auth()->user()->role === 'employee' && $leave->status === 'pending')
                <a href="{{ route('leaves.edit', $leave) }}" class="btn btn-warning">Edit</a>
                <form action="{{ route('leaves.destroy', $leave) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Cancel</button>
                </form>
            @endif
            <a href="{{ route('leaves.index') }}" class="btn btn-secondary">Back to List</a>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <h4>Leave Information</h4>
                <table class="table">
                    <tr>
                        <th>Employee:</th>
                        <td>{{ $leave->employee->name }}</td>
                    </tr>
                    <tr>
                        <th>Leave Type:</th>
                        <td>{{ ucfirst($leave->type) }}</td>
                    </tr>
                    <tr>
                        <th>Start Date:</th>
                        <td>{{ $leave->start_date->format('M d, Y') }}</td>
                    </tr>
                    <tr>
                        <th>End Date:</th>
                        <td>{{ $leave->end_date->format('M d, Y') }}</td>
                    </tr>
                    <tr>
                        <th>Duration:</th>
                        <td>{{ $leave->start_date->diffInDays($leave->end_date) + 1 }} days</td>
                    </tr>
                    <tr>
                        <th>Status:</th>
                        <td>
                            <span class="badge bg-{{ $leave->status === 'approved' ? 'success' : ($leave->status === 'rejected' ? 'danger' : 'warning') }}">
                                {{ ucfirst($leave->status) }}
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <th>Reason:</th>
                        <td>{{ $leave->reason }}</td>
                    </tr>
                    <tr>
                        <th>Requested At:</th>
                        <td>{{ $leave->created_at->format('M d, Y H:i A') }}</td>
                    </tr>
                </table>
            </div>

            @if($leave->status !== 'pending')
            <div class="col-md-6">
                <h4>Approval Information</h4>
                <table class="table">
                    <tr>
                        <th>Status:</th>
                        <td>
                            <span class="badge bg-{{ $leave->status === 'approved' ? 'success' : 'danger' }}">
                                {{ ucfirst($leave->status) }}
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <th>Approved/Rejected By:</th>
                        <td>{{ $leave->approver->name }}</td>
                    </tr>
                    <tr>
                        <th>Approved/Rejected At:</th>
                        <td>{{ $leave->approved_at->format('M d, Y H:i A') }}</td>
                    </tr>
                    @if($leave->status === 'rejected')
                    <tr>
                        <th>Rejection Reason:</th>
                        <td>{{ $leave->rejection_reason }}</td>
                    </tr>
                    @endif
                </table>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
