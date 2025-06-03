<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function admin()
    {
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized action.');
        }
        return view('admin.dashboard');
    }

    public function employee()
    {
        if (!auth()->user()->isEmployee()) {
            abort(403, 'Unauthorized action.');
        }
        return view('employee.dashboard');
    }
}
