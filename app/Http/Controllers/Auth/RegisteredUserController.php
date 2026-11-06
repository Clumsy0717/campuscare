<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Rules\ValidRecaptcha;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    public function create(): View
    {
        return view('auth.register');
    }

    public function store(Request $request): RedirectResponse
    {
        // Validate registration fields and Google reCAPTCHA.
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'email' => [
                'required',
                'string',
                'email:rfc',
                'max:255',
                'unique:users,email',
            ],

            'password' => [
                'required',
                'confirmed',
                Password::min(8)
                    ->mixedCase()
                    ->numbers()
                    ->symbols(),
            ],

            // Google reCAPTCHA verification
            'g-recaptcha-response' => [
                'required',
                new ValidRecaptcha(),
            ],
        ]);

        // Generate a unique Student ID.
        $user = DB::transaction(function () use ($validated) {

            $year = now()->year;

            // Create the sequence record if it doesn't exist.
            DB::table('student_id_sequences')->insertOrIgnore([
                'year' => $year,
                'last_number' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Lock the sequence to prevent duplicate IDs.
            $sequence = DB::table('student_id_sequences')
                ->where('year', $year)
                ->lockForUpdate()
                ->first();

            // Find the highest existing Student ID.
            $existingMax = User::where(
                'student_id',
                'like',
                $year . '-%'
            )
                ->get(['student_id'])
                ->map(fn ($user) => (int) substr($user->student_id, 5))
                ->max() ?? 0;

            // Generate the next available number.
            $nextNumber = max(
                (int) $sequence->last_number,
                (int) $existingMax
            ) + 1;

            if ($nextNumber > 9999) {
                throw new \RuntimeException(
                    'The Student ID limit for this year has been reached.'
                );
            }

            $studentId = $year . '-' . str_pad(
                $nextNumber,
                4,
                '0',
                STR_PAD_LEFT
            );

            // Update the Student ID sequence.
            DB::table('student_id_sequences')
                ->where('year', $year)
                ->update([
                    'last_number' => $nextNumber,
                    'updated_at' => now(),
                ]);

            // Create the student account.
            return User::create([
                'name' => $validated['name'],
                'student_id' => $studentId,
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
            ]);
        });

        // Trigger Laravel's registered event.
        event(new Registered($user));

        // Automatically log in the new student.
        Auth::login($user);

        return redirect()->route('home');
    }
}
