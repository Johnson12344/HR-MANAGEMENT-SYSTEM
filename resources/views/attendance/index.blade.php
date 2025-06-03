@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header bg-primary text-light d-flex justify-content-between align-items-center">
        <h2 class="card-title mb-0">Attendance Records</h2>
        @if(auth()->user()->role === 'employee' && !$todayAttendance)
            <a href="{{ route('attendance.clock-in') }}" class="btn btn-light">Clock In</a>
        @elseif(auth()->user()->role === 'employee' && $todayAttendance && !$todayAttendance->clock_out)
            <a href="{{ route('attendance.clock-out') }}" class="btn btn-light">Clock Out</a>
        @endif
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Employee</th>
                        <th>Clock In</th>
                        <th>Clock Out</th>
                        <th>Duration</th>
                        <th>Notes</th>
                        @if(auth()->user()->role === 'admin')
                            <th>Actions</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach($attendances as $attendance)
                    <tr>
                        <td>{{ $attendance->employee->name }}</td>
                        <td>{{ $attendance->clock_in->format('M d, Y h:i A') }}</td>
                        <td>{{ $attendance->clock_out ? $attendance->clock_out->format('M d, Y h:i A') : 'Not clocked out' }}</td>
                        <td>
                            @if($attendance->clock_out)
                                {{ $attendance->clock_in->diffInHours($attendance->clock_out) }} hours
                                {{ $attendance->clock_in->diffInMinutes($attendance->clock_out) % 60 }} minutes
                            @else
                                -
                            @endif
                        </td>
                        <td>{{ $attendance->notes ?? 'N/A' }}</td>
                        @if(auth()->user()->role === 'admin')
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('attendance.edit', $attendance) }}" class="btn btn-sm btn-warning">Edit</a>
                                    <form action="{{ route('attendance.destroy', $attendance) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                </div>
                            </td>
                        @endif
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{ $attendances->links() }}
    </div>
</div>
@endsection
