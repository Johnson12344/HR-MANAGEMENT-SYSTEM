<?php

namespace App\Http\Controllers;

use App\Models\Leave;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Validation\Rule;

class LeaveController extends Controller
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
        $query = Leave::with(['employee', 'approver']);

        if (auth()->user()->role === 'employee') {
            $query->where('employee_id', auth()->id());
        }

        $leaves = $query->latest()->paginate(10);
        return view('leaves.index', compact('leaves'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (auth()->user()->role !== 'employee') {
            abort(403);
        }

        return view('leaves.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (auth()->user()->role !== 'employee') {
            abort(403);
        }

        $validated = $request->validate([
            'type' => ['required', 'string', Rule::in(['annual', 'sick', 'unpaid', 'maternity', 'paternity', 'bereavement'])],
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after_or_equal:start_date',
            'reason' => 'required|string',
        ]);

        $validated['employee_id'] = auth()->id();
        $validated['status'] = 'pending';

        Leave::create($validated);

        return redirect()->route('leaves.index')
            ->with('success', 'Leave request submitted successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Leave $leave)
    {
        if (auth()->user()->role !== 'admin' && auth()->id() !== $leave->employee_id) {
            abort(403);
        }

        $leave->load(['employee', 'approver']);
        return view('leaves.show', compact('leave'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Leave $leave)
    {
        if (auth()->user()->role !== 'employee' || auth()->id() !== $leave->employee_id || $leave->status !== 'pending') {
            abort(403);
        }

        return view('leaves.edit', compact('leave'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Leave $leave)
    {
        if (auth()->user()->role !== 'employee' || auth()->id() !== $leave->employee_id || $leave->status !== 'pending') {
            abort(403);
        }

        $validated = $request->validate([
            'type' => ['required', 'string', Rule::in(['annual', 'sick', 'unpaid', 'maternity', 'paternity', 'bereavement'])],
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after_or_equal:start_date',
            'reason' => 'required|string',
        ]);

        $leave->update($validated);

        return redirect()->route('leaves.index')
            ->with('success', 'Leave request updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Leave $leave)
    {
        if (auth()->user()->role !== 'employee' || auth()->id() !== $leave->employee_id || $leave->status !== 'pending') {
            abort(403);
        }

        $leave->delete();

        return redirect()->route('leaves.index')
            ->with('success', 'Leave request cancelled successfully.');
    }

    public function approve(Leave $leave)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403);
        }

        if ($leave->status !== 'pending') {
            return redirect()->route('leaves.index')
                ->with('error', 'This leave request has already been processed.');
        }

        $leave->update([
            'status' => 'approved',
            'approved_by' => auth()->id(),
            'approved_at' => Carbon::now(),
        ]);

        return redirect()->route('leaves.index')
            ->with('success', 'Leave request approved successfully.');
    }

    public function reject(Request $request, Leave $leave)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403);
        }

        if ($leave->status !== 'pending') {
            return redirect()->route('leaves.index')
                ->with('error', 'This leave request has already been processed.');
        }

        $validated = $request->validate([
            'rejection_reason' => 'required|string',
        ]);

        $leave->update([
            'status' => 'rejected',
            'approved_by' => auth()->id(),
            'approved_at' => Carbon::now(),
            'rejection_reason' => $validated['rejection_reason'],
        ]);

        return redirect()->route('leaves.index')
            ->with('success', 'Leave request rejected successfully.');
    }
}
