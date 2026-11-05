@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page_title', 'Dashboard')

@section('content')

<style>
    .dashboard-welcome {
        margin-bottom: 25px;
    }

    .dashboard-welcome h1 {
        margin: 0 0 8px;
        font-size: 27px;
        color: #172b40;
    }

    .dashboard-welcome p {
        margin: 0;
        color: #84909d;
        font-size: 13px;
    }

    .dashboard-stats {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 16px;
        margin-bottom: 25px;
    }

    .dashboard-stat-card,
    .dashboard-chart-card {
        background: white;
        border: 1px solid #e8edf2;
        border-radius: 12px;
        padding: 22px;
        box-shadow: 0 3px 12px rgba(16, 36, 62, .04);
    }

    .dashboard-stat-label {
        color: #84909d;
        font-size: 12px;
        margin-bottom: 13px;
    }

    .dashboard-stat-value {
        color: #172b40;
        font-size: 29px;
        font-weight: 700;
    }

    .dashboard-chart-card {
        padding: 25px;
    }

    .dashboard-chart-heading {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 12px;
        margin-bottom: 8px;
    }

    .dashboard-chart-heading h2 {
        margin: 0;
        font-size: 18px;
        color: #172b40;
    }

    .dashboard-chart-subtitle {
        color: #84909d;
        font-size: 12px;
        margin: 0 0 25px;
    }

    .dashboard-chart {
        height: 220px;
        display: flex;
        align-items: flex-end;
        justify-content: space-around;
        gap: 12px;
        border-bottom: 1px solid #e7ecf1;
        padding: 0 5px;
    }

    .dashboard-chart-day {
        flex: 1;
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: flex-end;
        align-items: center;
        gap: 8px;
        min-width: 0;
    }

    .dashboard-bar-value {
        font-size: 11px;
        color: #68788a;
        font-weight: 600;
    }

    .dashboard-bar {
        width: min(38px, 75%);
        height: var(--bar-height, 4px);
        min-height: 4px;
        background: #2f80c9;
        border-radius: 5px 5px 0 0;
        transition: height .2s ease, background .2s ease;
    }

    .dashboard-bar:hover {
        background: #1b5f9b;
    }

    .dashboard-day-label {
        color: #84909d;
        font-size: 11px;
        margin-top: 10px;
    }

    .dashboard-chart-footer {
        color: #84909d;
        font-size: 11px;
        margin: 20px 0 0;
        line-height: 1.6;
    }

    .dashboard-success {
        background: #e8f6ed;
        color: #247444;
        padding: 12px 15px;
        border-radius: 7px;
        margin-bottom: 20px;
        font-size: 13px;
    }

    @media (max-width: 1000px) {
        .dashboard-stats {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media (max-width: 650px) {
        .dashboard-welcome h1 {
            font-size: 22px;
        }

        .dashboard-stats {
            gap: 10px;
        }

        .dashboard-stat-card {
            padding: 15px;
        }

        .dashboard-stat-value {
            font-size: 24px;
        }

        .dashboard-chart-card {
            padding: 18px 12px;
        }

        .dashboard-chart {
            gap: 5px;
        }
    }
</style>

@if (session('success'))
    <div class="dashboard-success">
        {{ session('success') }}
    </div>
@endif

<section class="dashboard-welcome">
    <h1>Welcome, Admin</h1>
    <p>Here's an overview of your CampusCare system.</p>
</section>

<section class="dashboard-stats">

    <div class="dashboard-stat-card">
        <div class="dashboard-stat-label">
            Students Requested Today
        </div>

        <div class="dashboard-stat-value">
            {{ $studentsRequestedToday }}
        </div>
    </div>

    <div class="dashboard-stat-card">
        <div class="dashboard-stat-label">
            Total Students
        </div>

        <div class="dashboard-stat-value">
            {{ $totalStudents }}
        </div>
    </div>

    <div class="dashboard-stat-card">
        <div class="dashboard-stat-label">
            Pending Requests
        </div>

        <div class="dashboard-stat-value">
            {{ $pendingRequests }}
        </div>
    </div>

    <div class="dashboard-stat-card">
        <div class="dashboard-stat-label">
            Completed Requests
        </div>

        <div class="dashboard-stat-value">
            {{ $completedRequests }}
        </div>
    </div>

</section>

<section class="dashboard-chart-card">

    <div class="dashboard-chart-heading">
        <h2>Service Request Activity</h2>
    </div>

    <p class="dashboard-chart-subtitle">
        Unique students who submitted requests each day
        over the last 7 days.
    </p>

    <div class="dashboard-chart">

        @foreach ($dailyActivity as $day)

            @php
                $barHeight = $maxDailyStudents > 0
                    ? max(4, ($day['count'] / $maxDailyStudents) * 145)
                    : 4;
            @endphp

            <div class="dashboard-chart-day">

                <span class="dashboard-bar-value">
                    {{ $day['count'] }}
                </span>

                <div
                    class="dashboard-bar"
                    style="--bar-height: {{ $barHeight }}px;"
                    title="{{ $day['full_date'] }}: {{ $day['count'] }} students">
                </div>

                <span class="dashboard-day-label">
                    {{ $day['label'] }}
                </span>

            </div>

        @endforeach

    </div>

    <p class="dashboard-chart-footer">
        Each student is counted only once per day,
        even if they submitted multiple requests.
    </p>

</section>

@endsection
