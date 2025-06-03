<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = Attendance::with('employee');

        if (auth()->user()->role === 'employee') {
            $query->where('employee_id', auth()->id());
        }

        $attendances = $query->latest()->paginate(10);
        $todayAttendance = null;

        if (auth()->user()->role === 'employee') {
            $todayAttendance = Attendance::where('employee_id', auth()->id())
                ->whereDate('clock_in', Carbon::today())
                ->first();
        }

        return view('attendance.index', compact('attendances', 'todayAttendance'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Attendance $attendance)
    {
        if (auth()->user()->role !== 'admin' && auth()->id() !== $attendance->employee_id) {
            abort(403);
        }

        return view('attendance.edit', compact('attendance'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Attendance $attendance)
    {
        if (auth()->user()->role !== 'admin' && auth()->id() !== $attendance->employee_id) {
            abort(403);
        }

        $validated = $request->validate([
            'clock_in' => 'required|date',
            'clock_out' => 'nullable|date|after:clock_in',
            'notes' => 'nullable|string',
        ]);

        $attendance->update($validated);

        return redirect()->route('attendance.index')
            ->with('success', 'Attendance record updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Attendance $attendance)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403);
        }

        $attendance->delete();

        return redirect()->route('attendance.index')
            ->with('success', 'Attendance record deleted successfully.');
    }

    public function clockIn()
    {
        if (auth()->user()->role !== 'employee') {
            abort(403);
        }

        $todayAttendance = Attendance::where('employee_id', auth()->id())
            ->whereDate('clock_in', Carbon::today())
            ->first();

        if ($todayAttendance) {
            return redirect()->route('attendance.index')
                ->with('error', 'You have already clocked in today.');
        }

        Attendance::create([
            'employee_id' => auth()->id(),
            'clock_in' => Carbon::now(),
        ]);

        return redirect()->route('attendance.index')
            ->with('success', 'Clock in recorded successfully.');
    }

    public function clockOut()
    {
        if (auth()->user()->role !== 'employee') {
            abort(403);
        }

        $todayAttendance = Attendance::where('employee_id', auth()->id())
            ->whereDate('clock_in', Carbon::today())
            ->whereNull('clock_out')
            ->first();

        if (!$todayAttendance) {
            return redirect()->route('attendance.index')
                ->with('error', 'No active clock in record found.');
        }

        $todayAttendance->update([
            'clock_out' => Carbon::now(),
        ]);

        return redirect()->route('attendance.index')
            ->with('success', 'Clock out recorded successfully.');
    }
}
