<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\User;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class EmployeeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized action.');
        }
        $employees = Employee::with(['user', 'department'])->latest()->paginate(10);
        return view('employees.index', compact('employees'));
    }

    public function create()
    {
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized action.');
        }
        $departments = Department::all();
        return view('employees.create', compact('departments'));
    }

    public function store(Request $request)
    {
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized action.');
        }

        // First validate the user data
        $userData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'role' => ['required', 'string', Rule::in(['admin', 'employee'])],
        ]);

        // Create the user first
        $user = User::create([
            'name' => $userData['name'],
            'email' => $userData['email'],
            'password' => Hash::make('password'), // Default password
            'role' => $userData['role'],
        ]);

        // Then create the employee record
        $employeeData = $request->validate([
            'department_id' => 'required|exists:departments,id',
        ]);

        $employee = Employee::create([
            'user_id' => $user->id,
            'department_id' => $employeeData['department_id'],
        ]);

        return redirect()->route('employees.index')
            ->with('success', 'Employee created successfully. Default password is "password".');
    }

    public function show(Employee $employee)
    {
        if (!auth()->user()->isAdmin() && auth()->id() !== $employee->user_id) {
            abort(403, 'Unauthorized action.');
        }
        return view('employees.show', compact('employee'));
    }

    public function edit(Employee $employee)
    {
        if (!auth()->user()->isAdmin() && auth()->id() !== $employee->user_id) {
            abort(403, 'Unauthorized action.');
        }
        $departments = Department::all();
        return view('employees.edit', compact('employee', 'departments'));
    }

    public function update(Request $request, Employee $employee)
    {
        if (!auth()->user()->isAdmin() && auth()->id() !== $employee->user_id) {
            abort(403, 'Unauthorized action.');
        }

        $userData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($employee->user_id)],
            'role' => ['required', 'string', Rule::in(['admin', 'employee'])],
        ]);

        $employeeData = $request->validate([
            'department_id' => 'required|exists:departments,id',
        ]);

        // Update user data
        $employee->user->update($userData);

        // Update employee data
        $employee->update($employeeData);

        return redirect()->route('employees.index')
            ->with('success', 'Employee updated successfully.');
    }

    public function destroy(Employee $employee)
    {
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized action.');
        }

        // This will also delete the associated user due to the foreign key constraint
        $employee->delete();

        return redirect()->route('employees.index')
            ->with('success', 'Employee deleted successfully.');
    }

    public function profile()
    {
        $employee = Employee::where('user_id', auth()->id())
            ->with(['user', 'department', 'attendances' => function($query) {
                $query->latest()->take(5);
            }])
            ->first();

        if (!$employee) {
            // If no employee record exists, create one
            $employee = Employee::create([
                'user_id' => auth()->id(),
                'department_id' => null, // You might want to set a default department
            ]);
        }

        return view('employees.profile', compact('employee'));
    }
}
