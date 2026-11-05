<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ServiceRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Notifications\ServiceRequestStatusUpdated;

class ServiceRequestController extends Controller
{
    /**
     * Admin Dashboard
     */

public function dashboard()
{
    $totalStudents = User::where('role', 'student')->count();

    // Count unique students who submitted at least one request today
    $studentsRequestedToday = ServiceRequest::whereDate(
        'created_at',
        today()
    )->distinct()->count('user_id');

    $pendingRequests = ServiceRequest::where(
        'status',
        'Pending'
    )->count();

    $completedRequests = ServiceRequest::where(
        'status',
        'Completed'
    )->count();

    // Get the number of unique students per day for the last 7 days
    $startDate = now()->startOfDay()->subDays(6);
    $endDate = now()->endOfDay();

    $activity = ServiceRequest::selectRaw(
        'DATE(created_at) as request_date, COUNT(DISTINCT user_id) as students_count'
    )
        ->whereBetween('created_at', [$startDate, $endDate])
        ->groupBy('request_date')
        ->get()
        ->keyBy('request_date');

    $dailyActivity = [];

    for ($i = 6; $i >= 0; $i--) {
        $date = now()->startOfDay()->subDays($i);
        $dateKey = $date->toDateString();

        $dailyActivity[] = [
            'date' => $dateKey,
            'label' => $date->format('D'),
            'full_date' => $date->format('M d, Y'),
            'count' => (int) ($activity[$dateKey]->students_count ?? 0),
        ];
    }

    $maxDailyStudents = max(
        array_column($dailyActivity, 'count')
    );

    return view('admin.dashboard', compact(
        'totalStudents',
        'studentsRequestedToday',
        'pendingRequests',
        'completedRequests',
        'dailyActivity',
        'maxDailyStudents'
    ));
}



public function index()
{
    // Requests displayed in the main table
    $requests = ServiceRequest::with('user')
        ->latest()
        ->paginate(10);

    // All requests available inside the management modal
    $allRequests = ServiceRequest::with('user')
        ->latest()
        ->get();

    // Student options for the modal
    $students = User::where('role', 'student')
        ->orderBy('name')
        ->get(['id', 'name', 'student_id']);

    $totalRequests = ServiceRequest::count();

    $pendingRequests = ServiceRequest::where(
        'status',
        'Pending'
    )->count();

    $inProgressRequests = ServiceRequest::where(
        'status',
        'In Progress'
    )->count();

    $completedRequests = ServiceRequest::where(
        'status',
        'Completed'
    )->count();

    return view('admin.requests.index', compact(
        'requests',
        'allRequests',
        'students',
        'totalRequests',
        'pendingRequests',
        'inProgressRequests',
        'completedRequests'
    ));
}


    /**
     * Update a Service Request
     */
    public function update(Request $request, ServiceRequest $serviceRequest)
    {
        $validated = $request->validate([
            'status' => [
                'required',
                Rule::in([
                    'Pending',
                    'In Progress',
                    'Completed',
                    'Rejected',
                ]),
            ],
            'admin_remarks' => ['nullable', 'string', 'max:2000'],
        ]);

        $oldStatus = $serviceRequest->status;

        $serviceRequest->update([
            'status' => $validated['status'],
            'admin_remarks' => $validated['admin_remarks'] ?? null,
        ]);

        // Notify the student only when the status changes
        if ($oldStatus !== $serviceRequest->status) {
            $serviceRequest->user->notify(
                new ServiceRequestStatusUpdated($serviceRequest)
            );
        }

        return redirect()
            ->route('admin.requests.index')
            ->with('success', 'Service request updated successfully.');
    }

    public function students()
{
    $students = User::where('role', 'student')
        ->withCount('serviceRequests')
        ->latest()
        ->paginate(10);

    $totalStudents = User::where('role', 'student')->count();

    return view('admin.students.index', compact(
        'students',
        'totalStudents'
    ));
}
}
