
@extends('layouts.student')

@section('title', 'My Profile')
@section('page_title', 'My Profile')

@section('content')

<style>
    .student-profile-page {
        max-width: 850px;
        margin: 0 auto;
        color: #1d2e40;
    }

    .student-profile-page * {
        box-sizing: border-box;
    }

    .student-profile-page .page-header {
        margin-bottom: 26px;
    }

    .student-profile-page .eyebrow {
        display: block;
        margin-bottom: 9px;
        color: #527fa5;
        font-size: 11px;
        font-weight: 800;
        letter-spacing: 1.3px;
        text-transform: uppercase;
    }

    .student-profile-page .page-header h1 {
        margin: 0 0 9px;
        font-size: 27px;
        color: #172b40;
        letter-spacing: -.6px;
    }

    .student-profile-page .page-header p {
        margin: 0;
        color: #7b8998;
        font-size: 13px;
        line-height: 1.6;
    }

    .student-profile-page .profile-card {
        background: white;
        border: 1px solid #e7ebf0;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 5px 20px rgba(20,35,60,.04);
    }

    .student-profile-page .card-section {
        padding: 27px 30px;
    }

    .student-profile-page .card-section + .card-section {
        border-top: 1px solid #e7ebf0;
    }

    .student-profile-page .section-title {
        margin: 0 0 8px;
        color: #172b40;
        font-size: 16px;
    }

    .student-profile-page .section-description {
        margin: 0 0 23px;
        color: #7b8998;
        font-size: 12px;
        line-height: 1.6;
    }

    .student-profile-page .form-group {
        margin-bottom: 20px;
    }

    .student-profile-page .form-group label {
        display: block;
        margin-bottom: 9px;
        font-size: 13px;
        font-weight: 650;
        color: #253750;
    }

    .student-profile-page .form-control {
        width: 100%;
        padding: 13px 14px;
        border: 1px solid #d8e0eb;
        border-radius: 8px;
        background: #fff;
        color: #172033;
        font: inherit;
        font-size: 13px;
        outline: none;
        transition: border-color .2s, box-shadow .2s;
    }

    .student-profile-page .form-control:focus {
        border-color: #527fa5;
        box-shadow: 0 0 0 3px rgba(82,127,165,.12);
    }

    .student-profile-page .field-error {
        margin: 7px 0 0;
        color: #c0392b;
        font-size: 12px;
    }

    .student-profile-page .success-message {
        padding: 13px 15px;
        margin-bottom: 22px;
        border: 1px solid #ccebd7;
        border-radius: 8px;
        background: #e8f5ec;
        color: #216b38;
        font-size: 13px;
    }

    .student-profile-page .error-message {
        padding: 13px 15px;
        margin-bottom: 22px;
        border: 1px solid #f3cccc;
        border-radius: 8px;
        background: #fff0f0;
        color: #a52a2a;
        font-size: 13px;
    }

    .student-profile-page .save-button {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 12px 19px;
        border: none;
        border-radius: 8px;
        background: #193653;
        color: white;
        font: inherit;
        font-size: 13px;
        font-weight: 650;
        cursor: pointer;
        transition: background .2s;
    }

    .student-profile-page .save-button:hover {
        background: #10243e;
    }

    .student-profile-page .profile-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 20px;
        padding: 16px 0;
        border-bottom: 1px solid #e7ebf0;
    }

    .student-profile-page .profile-row:first-of-type {
        padding-top: 0;
    }

    .student-profile-page .profile-row:last-child {
        padding-bottom: 0;
        border-bottom: none;
    }

    .student-profile-page .profile-row span {
        color: #7b8998;
        font-size: 12px;
    }

    .student-profile-page .profile-row strong {
        color: #253750;
        font-size: 13px;
        text-align: right;
        overflow-wrap: anywhere;
    }

    .student-profile-page .back-link {
        display: inline-block;
        margin-top: 24px;
        color: #527fa5;
        font-size: 13px;
        font-weight: 600;
        text-decoration: none;
    }

    .student-profile-page .back-link:hover {
        text-decoration: underline;
    }

    @media (max-width: 600px) {
        .student-profile-page .card-section {
            padding: 20px;
        }

        .student-profile-page .page-header h1 {
            font-size: 23px;
        }

        .student-profile-page .profile-row {
            align-items: flex-start;
            flex-direction: column;
            gap: 7px;
        }

        .student-profile-page .profile-row strong {
            text-align: left;
        }
    }
</style>

@php
    $student = auth()->user();
@endphp

<div class="student-profile-page">

    <div class="page-header">
        <span class="eyebrow">Account Settings</span>

        <h1>My Profile</h1>

        <p>
            Manage your registered CampusCare account information.
        </p>
    </div>

    <div class="profile-card">

        <section class="card-section">

            @if (session('success'))
                <div class="success-message" role="status">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="error-message" role="alert">
                    Please check the form for errors.
                </div>
            @endif

            <h2 class="section-title">Edit Account Information</h2>

            <p class="section-description">
                Update your name and email address below.
            </p>

            <form action="{{ route('profile.update') }}"
                  method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="name">Full Name</label>

                    <input
                        type="text"
                        id="name"
                        name="name"
                        class="form-control"
                        value="{{ old('name', $student->name) }}"
                        required
                        maxlength="255"
                    >

                    @error('name')
                        <p class="field-error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email">Email Address</label>

                    <input
                        type="email"
                        id="email"
                        name="email"
                        class="form-control"
                        value="{{ old('email', $student->email) }}"
                        required
                        maxlength="255"
                    >

                    @error('email')
                        <p class="field-error">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit" class="save-button">
                    Save Changes
                </button>
            </form>

        </section>

        <section class="card-section">

            <h2 class="section-title">Account Details</h2>

            <p class="section-description">
                Your registered student account information.
            </p>

            <div class="profile-row">
                <span>Student ID</span>
                <strong>
                    {{ $student->student_id ?: 'Not assigned' }}
                </strong>
            </div>

            <div class="profile-row">
                <span>Account Role</span>
                <strong>{{ ucfirst($student->role) }}</strong>
            </div>

            <div class="profile-row">
                <span>Member Since</span>
                <strong>
                    {{ $student->created_at?->format('F d, Y') ?? 'N/A' }}
                </strong>
            </div>

        </section>

    </div>

    <a href="{{ route('dashboard') }}" class="back-link">
        &larr; Back to Dashboard
    </a>

</div>

@endsection
