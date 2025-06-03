@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header bg-primary text-light d-flex justify-content-between align-items-center">
        <h2 class="card-title mb-0">Departments</h2>
        <a href="{{ route('departments.create') }}" class="btn btn-light">Add Department</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Employees</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($departments as $department)
                    <tr>
                        <td>{{ $department->name }}</td>
                        <td>{{ $department->description }}</td>
                        <td>{{ $department->employees_count }}</td>
                        <td>
                            <div class="btn-group">
                                <a href="{{ route('departments.show', $department) }}" class="btn btn-sm btn-info">View</a>
                                <a href="{{ route('departments.edit', $department) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('departments.destroy', $department) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure? This will affect all employees in this department.')">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
