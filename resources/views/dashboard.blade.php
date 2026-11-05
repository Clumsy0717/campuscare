@extends('layouts.student')

@section('title', 'Dashboard')
@section('page_title', 'Dashboard')

@section('content')

<style>
    .student-welcome {
        display: flex;
        justify-content: space-between;
        align-items: flex-end;
        gap: 20px;
        margin-bottom: 30px;
    }

    .student-welcome small {
        color: #527fa5;
        font-size: 10px;
        font-weight: 800;
        letter-spacing: 1.6px;
    }

    .student-welcome h1 {
        margin: 10px 0;
        font-size: 28px;
        color: #172b40;
    }

    .student-welcome p,
    .student-date {
        color: #7b8998;
        font-size: 13px;
    }

    .student-date {
        white-space: nowrap;
    }

    .student-summary-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 18px;
        margin-bottom: 25px;
    }

    .student-summary-card,
    .student-panel {
        background: white;
        border: 1px solid #e7ebf0;
        border-radius: 12px;
        box-shadow: 0 3px 12px rgba(16, 36, 62, .04);
    }

    .student-summary-card {
        padding: 23px;
    }

    .student-summary-card small {
        display: block;
        margin-bottom: 13px;
        color: #7b8998;
        font-size: 11px;
        font-weight: 600;
    }

    .student-summary-card h2 {
        margin: 0;
        color: #172b40;
        font-size: 22px;
        overflow-wrap: anywhere;
    }

    .student-summary-card p {
        margin: 10px 0 0;
        color: #7b8998;
        font-size: 11px;
    }

    .student-active-status {
        display: inline-block;
        padding: 6px 11px;
        border-radius: 6px;
        background: #eaf5ef;
        color: #26835b;
        font-size: 12px;
        font-weight: 700;
    }

    .student-dashboard-grid {
        display: grid;
        grid-template-columns: 1.35fr .85fr;
        gap: 20px;
    }

    .student-panel {
        overflow: hidden;
    }

    .student-panel-header {
        padding: 22px 24px;
        border-bottom: 1px solid #e7ebf0;
    }

    .student-panel-header h2 {
        margin: 0;
        color: #172b40;
        font-size: 16px;
    }

    .student-panel-header p {
        margin: 7px 0 0;
        color: #7b8998;
        font-size: 12px;
    }

    .student-panel-body {
        padding: 24px;
    }

    .student-profile-row {
        display: flex;
        justify-content: space-between;
        gap: 20px;
        padding: 15px 0;
        border-bottom: 1px solid #e7ebf0;
    }

    .student-profile-row:first-child {
        padding-top: 0;
    }

    .student-profile-row:last-child {
        border-bottom: none;
        padding-bottom: 0;
    }

    .student-profile-row span {
        color: #7b8998;
        font-size: 12px;
    }

    .student-profile-row strong {
        color: #243447;
        font-size: 12px;
        text-align: right;
        overflow-wrap: anywhere;
    }

    .student-empty-state {
        padding: 30px 10px;
        text-align: center;
    }

    .student-empty-line {
        width: 45px;
        height: 3px;
        margin: 0 auto 20px;
        border-radius: 5px;
        background: #dbe4ed;
    }

    .student-empty-state h3 {
        margin: 0 0 10px;
        font-size: 14px;
    }

    .student-empty-state p {
        max-width: 270px;
        margin: auto;
        color: #7b8998;
        font-size: 12px;
        line-height: 1.7;
    }

    .student-footer {
        margin-top: 35px;
        padding-top: 20px;
        border-top: 1px solid #e7ebf0;
        color: #9aa5b1;
        font-size: 11px;
    }

    @media (max-width: 1100px) {
        .student-dashboard-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 800px) {
        .student-summary-grid {
            grid-template-columns: 1fr;
        }

        .student-welcome {
            flex-direction: column;
            align-items: flex-start;
        }

        .student-welcome h1 {
            font-size: 23px;
        }

        .student-date {
            white-space: normal;
        }
    }

    @media (max-width: 480px) {
        .student-panel-body {
            padding: 17px;
        }

        .student-profile-row {
            flex-wrap: wrap;
            gap: 8px;
        }

        .student-profile-row strong {
            text-align: left;
        }
    }
</style>

@php
    $student = auth()->user();
@endphp

<section class="student-welcome">
    <div>
        <small>STUDENT OVERVIEW</small>

        <h1>Welcome back, {{ $student->name }}.</h1>

        <p>Here's an overview of your CampusCare account.</p>
    </div>

    <div class="student-date">
        {{ now()->format('l, F d, Y') }}
    </div>
</section>

<section class="student-summary-grid">

    <article class="student-summary-card">
        <small>ACCOUNT STATUS</small>

        <h2>
            <span class="student-active-status">Active</span>
        </h2>

        <p>Your account is registered in CampusCare.</p>
    </article>

    <article class="student-summary-card">
        <small>STUDENT ID</small>

        <h2>{{ $student->student_id ?: 'Not assigned' }}</h2>

        <p>Your registered student identification.</p>
    </article>

    <article class="student-summary-card">
        <small>MEMBER SINCE</small>

        <h2>
            {{ $student->created_at?->format('M d, Y') ?? 'N/A' }}
        </h2>

        <p>Your account registration date.</p>
    </article>

</section>

<section class="student-dashboard-grid">

    <article class="student-panel">

        <div class="student-panel-header">
            <h2>Account Information</h2>
            <p>Your registered student details.</p>
        </div>

        <div class="student-panel-body">

            <div class="student-profile-row">
                <span>Full Name</span>
                <strong>{{ $student->name }}</strong>
            </div>

            <div class="student-profile-row">
                <span>Student ID</span>
                <strong>
                    {{ $student->student_id ?: 'Not assigned' }}
                </strong>
            </div>

            <div class="student-profile-row">
                <span>Email Address</span>
                <strong>{{ $student->email }}</strong>
            </div>

            <div class="student-profile-row">
                <span>Account Created</span>
                <strong>
                    {{ $student->created_at?->format('F d, Y') ?? 'N/A' }}
                </strong>
            </div>

        </div>
    </article>

    <article class="student-panel">

        <div class="student-panel-header">
            <h2>Recent Activity</h2>
            <p>Your latest CampusCare activities.</p>
        </div>

        <div class="student-panel-body">

            <div class="student-empty-state">

                <div class="student-empty-line"></div>

                <h3>No activities yet</h3>

                <p>
                    Your service requests and account activities
                    will appear here.
                </p>

            </div>

        </div>
    </article>

</section>

<footer class="student-footer">
    © {{ date('Y') }} CampusCare. All rights reserved.
</footer>

@endsection
