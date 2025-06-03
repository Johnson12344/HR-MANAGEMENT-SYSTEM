@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header bg-primary text-light">
        <h2 class="card-title mb-0">Edit Attendance Record</h2>
    </div>
    <div class="card-body">
        <form action="{{ route('attendance.update', $attendance) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="clock_in" class="form-label">Clock In</label>
                    <input type="datetime-local" class="form-control @error('clock_in') is-invalid @enderror" id="clock_in" name="clock_in" value="{{ old('clock_in', $attendance->clock_in->format('Y-m-d\TH:i')) }}" required>
                    @error('clock_in')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="clock_out" class="form-label">Clock Out</label>
                    <input type="datetime-local" class="form-control @error('clock_out') is-invalid @enderror" id="clock_out" name="clock_out" value="{{ old('clock_out', $attendance->clock_out ? $attendance->clock_out->format('Y-m-d\TH:i') : '') }}">
                    @error('clock_out')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-12 mb-3">
                    <label for="notes" class="form-label">Notes</label>
                    <textarea class="form-control @error('notes') is-invalid @enderror" id="notes" name="notes" rows="3">{{ old('notes', $attendance->notes) }}</textarea>
                    @error('notes')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Update Attendance</button>
                    <a href="{{ route('attendance.index') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
