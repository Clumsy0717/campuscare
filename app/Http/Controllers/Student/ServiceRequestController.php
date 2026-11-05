<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class ServiceRequestController extends Controller
{
    public function create()
    {
        return view('student.requests.create');
    }

    public function index()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $requests = $user->serviceRequests()
            ->latest()
            ->get();

        return view('student.requests.index', compact('requests'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category' => [
                'required',
                'in:General Inquiry,Document Request,Technical Support,Student Support,Facilities/Maintenance',
            ],
            'subject' => ['required', 'string', 'max:150'],
            'description' => ['required', 'string', 'max:2000'],
        ]);

        do {
            $referenceNumber = 'CC-' . Str::upper(Str::random(8));
        } while (
            \App\Models\ServiceRequest::where(
                'reference_number',
                $referenceNumber
            )->exists()
        );

        /** @var \App\Models\User $user */
        $user = Auth::user();

        $user->serviceRequests()->create([
            'reference_number' => $referenceNumber,
            'category' => $validated['category'],
            'subject' => $validated['subject'],
            'description' => $validated['description'],
            'status' => 'Pending',
        ]);

        return redirect()
            ->route('student.requests.index')
            ->with('success', 'Your service request was submitted successfully.');
    }
}
