@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header bg-primary text-light">
        <h2 class="card-title mb-0">Edit Leave Request</h2>
    </div>
    <div class="card-body">
        <form action="{{ route('leaves.update', $leave) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="type" class="form-label">Leave Type</label>
                    <select class="form-select @error('type') is-invalid @enderror" id="type" name="type" required>
                        <option value="">Select Leave Type</option>
                        <option value="annual" {{ old('type', $leave->type) == 'annual' ? 'selected' : '' }}>Annual Leave</option>
                        <option value="sick" {{ old('type', $leave->type) == 'sick' ? 'selected' : '' }}>Sick Leave</option>
                        <option value="unpaid" {{ old('type', $leave->type) == 'unpaid' ? 'selected' : '' }}>Unpaid Leave</option>
                        <option value="maternity" {{ old('type', $leave->type) == 'maternity' ? 'selected' : '' }}>Maternity Leave</option>
                        <option value="paternity" {{ old('type', $leave->type) == 'paternity' ? 'selected' : '' }}>Paternity Leave</option>
                        <option value="bereavement" {{ old('type', $leave->type) == 'bereavement' ? 'selected' : '' }}>Bereavement Leave</option>
                    </select>
                    @error('type')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="start_date" class="form-label">Start Date</label>
                    <input type="date" class="form-control @error('start_date') is-invalid @enderror" id="start_date" name="start_date" value="{{ old('start_date', $leave->start_date->format('Y-m-d')) }}" min="{{ date('Y-m-d') }}" required>
                    @error('start_date')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="end_date" class="form-label">End Date</label>
                    <input type="date" class="form-control @error('end_date') is-invalid @enderror" id="end_date" name="end_date" value="{{ old('end_date', $leave->end_date->format('Y-m-d')) }}" min="{{ date('Y-m-d') }}" required>
                    @error('end_date')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-12 mb-3">
                    <label for="reason" class="form-label">Reason for Leave</label>
                    <textarea class="form-control @error('reason') is-invalid @enderror" id="reason" name="reason" rows="3" required>{{ old('reason', $leave->reason) }}</textarea>
                    @error('reason')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Update Request</button>
                    <a href="{{ route('leaves.index') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const startDateInput = document.getElementById('start_date');
        const endDateInput = document.getElementById('end_date');

        startDateInput.addEventListener('change', function() {
            endDateInput.min = this.value;
            if (endDateInput.value && endDateInput.value < this.value) {
                endDateInput.value = this.value;
            }
        });
    });
</script>
@endpush
@endsection
