
@extends('layouts.student')

@section('title', 'Request History')
@section('page_title', 'Request History')

@section('content')

<style>
    .request-history-page {
        max-width: 1200px;
        margin: 0 auto;
        color: #172033;
    }

    .request-history-page * {
        box-sizing: border-box;
    }

    .request-history-page .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 20px;
        margin-bottom: 26px;
    }

    .request-history-page .eyebrow {
        display: block;
        margin-bottom: 9px;
        color: #527fa5;
        font-size: 11px;
        font-weight: 800;
        letter-spacing: 1.3px;
        text-transform: uppercase;
    }

    .request-history-page h1 {
        margin: 0 0 9px;
        font-size: 27px;
        color: #172b40;
        letter-spacing: -.6px;
    }

    .request-history-page .subtitle {
        margin: 0;
        color: #64748b;
        font-size: 13px;
        line-height: 1.6;
    }

    .request-history-page .btn-primary {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 12px 18px;
        border-radius: 8px;
        background: #193653;
        color: white;
        text-decoration: none;
        font-size: 13px;
        font-weight: 650;
        white-space: nowrap;
        transition: background .2s;
    }

    .request-history-page .btn-primary:hover {
        background: #10243e;
    }

    .request-history-page .success-alert {
        margin-bottom: 20px;
        padding: 14px 16px;
        border: 1px solid #ccebd7;
        border-radius: 8px;
        background: #eaf7ef;
        color: #246b42;
        font-size: 13px;
    }

    .request-history-page .table-card {
        background: white;
        border: 1px solid #e5e9f0;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 5px 20px rgba(20,35,60,.04);
    }

    .request-history-page .table-card-header {
        padding: 20px 24px;
        border-bottom: 1px solid #e7ebf0;
    }

    .request-history-page .table-card-header h2 {
        margin: 0;
        font-size: 15px;
        color: #172b40;
    }

    .request-history-page .table-card-header p {
        margin: 6px 0 0;
        color: #7b8998;
        font-size: 12px;
    }

    .request-history-page .table-wrapper {
        overflow-x: auto;
    }

    .request-history-page table {
        width: 100%;
        min-width: 760px;
        border-collapse: collapse;
    }

    .request-history-page th,
    .request-history-page td {
        padding: 17px 19px;
        border-bottom: 1px solid #edf0f5;
        text-align: left;
        font-size: 12px;
        vertical-align: middle;
    }

    .request-history-page th {
        background: #f9fafc;
        color: #64748b;
        font-size: 10px;
        font-weight: 750;
        letter-spacing: .6px;
        text-transform: uppercase;
    }

    .request-history-page td {
        color: #344054;
    }

    .request-history-page tbody tr:hover {
        background: #fafbfd;
    }

    .request-history-page tbody tr:last-child td {
        border-bottom: none;
    }

    .request-history-page .reference {
        font-weight: 700;
        color: #203b63;
        white-space: nowrap;
    }

    .request-history-page .status {
        display: inline-block;
        padding: 6px 10px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 700;
        white-space: nowrap;
    }

    .request-history-page .status-pending {
        background: #fff4d6;
        color: #946200;
    }

    .request-history-page .status-progress {
        background: #e8f1ff;
        color: #2457a6;
    }

    .request-history-page .status-completed {
        background: #e7f6ed;
        color: #267548;
    }

    .request-history-page .status-rejected {
        background: #fdeaea;
        color: #ae3535;
    }

    .request-history-page .empty-state {
        padding: 65px 20px;
        text-align: center;
    }

    .request-history-page .empty-state h2 {
        margin: 0 0 10px;
        font-size: 18px;
        color: #172b40;
    }

    .request-history-page .empty-state p {
        max-width: 340px;
        margin: 0 auto 22px;
        color: #64748b;
        font-size: 13px;
        line-height: 1.7;
    }

    @media (max-width: 650px) {
        .request-history-page .page-header {
            flex-direction: column;
            align-items: flex-start;
        }

        .request-history-page h1 {
            font-size: 23px;
        }
    }
</style>

<div class="request-history-page">

    <div class="page-header">
        <div>
            <span class="eyebrow">Student Services</span>

            <h1>Request History</h1>

            <p class="subtitle">
                View and track your submitted service requests.
            </p>
        </div>

        <a href="{{ route('student.requests.create') }}"
           class="btn-primary">
            + New Request
        </a>
    </div>

    @if (session('success'))
        <div class="success-alert" role="status">
            {{ session('success') }}
        </div>
    @endif

    <section class="table-card">

        <div class="table-card-header">
            <h2>My Service Requests</h2>
            <p>All the requests you have submitted.</p>
        </div>

        @if ($requests->isEmpty())

            <div class="empty-state">
                <h2>No service requests yet</h2>

                <p>
                    You haven't submitted any service requests.
                    Your requests will appear here.
                </p>

                <a href="{{ route('student.requests.create') }}"
                   class="btn-primary">
                    Create Your First Request
                </a>
            </div>

        @else

            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>Reference Number</th>
                            <th>Subject</th>
                            <th>Category</th>
                            <th>Date Submitted</th>
                            <th>Status</th>
                            <th>Admin Remarks</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($requests as $request)
                            <tr>
                                <td class="reference">
                                    {{ $request->reference_number }}
                                </td>

                                <td>{{ $request->subject }}</td>

                                <td>{{ $request->category }}</td>

                                <td>
                                    {{ $request->created_at->format('M d, Y') }}
                                </td>

                                <td>
                                    @php
                                        $statusClass = match ($request->status) {
                                            'Pending' => 'status-pending',
                                            'In Progress' => 'status-progress',
                                            'Completed' => 'status-completed',
                                            'Rejected' => 'status-rejected',
                                            default => 'status-pending',
                                        };
                                    @endphp

                                    <span class="status {{ $statusClass }}">
                                        {{ $request->status }}
                                    </span>
                                </td>

                                <td>
                                    {{ $request->admin_remarks ?: 'No remarks yet.' }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        @endif

    </section>

</div>

@endsection
