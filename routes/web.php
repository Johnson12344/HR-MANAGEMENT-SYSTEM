<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('firsthome');
})->name('firsthome');

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {
    // Dashboard routes
    Route::get('/admin/dashboard', [DashboardController::class, 'admin'])->name('admin.dashboard');
    Route::get('/employee/dashboard', [DashboardController::class, 'employee'])->name('employee.dashboard');

    // Employee routes
    Route::resource('employees', EmployeeController::class);
    Route::get('/profile', [EmployeeController::class, 'profile'])->name('profile');

    // Department routes
    Route::resource('departments', DepartmentController::class);

    // Attendance routes
    Route::resource('attendance', AttendanceController::class);
    Route::post('/attendance/clock-in', [AttendanceController::class, 'clockIn'])->name('attendance.clock-in');
    Route::post('/attendance/clock-out', [AttendanceController::class, 'clockOut'])->name('attendance.clock-out');

    // Leave routes
    Route::resource('leaves', LeaveController::class);
    Route::post('/leaves/{leave}/approve', [LeaveController::class, 'approve'])->name('leaves.approve');
    Route::post('/leaves/{leave}/reject', [LeaveController::class, 'reject'])->name('leaves.reject');

    // Document routes
    Route::resource('documents', DocumentController::class);
    Route::get('/documents/download/{document}', [DocumentController::class, 'download'])->name('documents.download');
});

Route::fallback(function () { return redirect('/home'); });
