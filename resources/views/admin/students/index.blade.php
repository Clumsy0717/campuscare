@extends('layouts.admin')

@section('title', 'Student Management')
@section('page_title', 'Student Management')

@section('content')
<style>
    .students-heading {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 15px;
        margin-bottom: 25px;
    }

    .students-heading h1 {
        margin: 0 0 8px;
        color: #10243e;
        font-size: 26px;
    }

    .students-heading p {
        margin: 0;
        color: #718096;
        font-size: 13px;
    }

    .students-summary {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 16px;
        margin-bottom: 24px;
    }

    .students-stat,
    .students-card {
        background: #fff;
        border: 1px solid #e4eaf1;
        border-radius: 12px;
        box-shadow: 0 3px 12px rgba(16, 36, 62, .04);
    }

    .students-stat {
        padding: 22px;
    }

    .students-stat span {
        display: block;
        color: #718096;
        font-size: 13px;
    }

    .students-stat strong {
        display: block;
        margin-top: 12px;
        color: #10243e;
        font-size: 29px;
    }

    .students-card {
        padding: 24px;
    }

    .students-card-heading {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 14px;
        margin-bottom: 20px;
    }

    .students-card-heading h2 {
        margin: 0;
        color: #10243e;
        font-size: 19px;
    }

    .students-search {
        width: min(100%, 340px);
        min-height: 42px;
        padding: 10px 13px;
        border: 1px solid #e4eaf1;
        border-radius: 8px;
        background: white;
        font-size: 13px;
    }

    .students-table-wrap {
        overflow-x: auto;
    }

    .students-table {
        width: 100%;
        min-width: 720px;
        border-collapse: collapse;
    }

    .students-table th {
        background: #f7f9fc;
        color: #65758a;
        padding: 14px 12px;
        text-align: left;
        text-transform: uppercase;
        letter-spacing: .4px;
        font-size: 11px;
    }

    .students-table td {
        padding: 17px 12px;
        border-bottom: 1px solid #e4eaf1;
        color: #34475b;
        font-size: 13px;
    }

    .students-table tr:hover td {
        background: #fafcff;
    }

    .student-name {
        font-weight: 700;
        color: #10243e;
    }

    .student-id {
        color: #2f80c9;
        font-weight: 600;
    }

    .request-count {
        display: inline-block;
        min-width: 30px;
        padding: 6px 10px;
        border-radius: 20px;
        background: #eaf3fb;
        color: #2469a6;
        text-align: center;
        font-weight: 700;
    }

    .students-empty {
        padding: 30px;
        text-align: center;
        color: #718096;
    }

    .students-pagination {
        margin-top: 20px;
    }

    .students-pagination svg {
        width: 18px;
    }

    @media (max-width: 700px) {
        .students-heading h1 {
            font-size: 22px;
        }

        .students-summary {
            grid-template-columns: 1fr;
        }

        .students-card {
            padding: 16px;
        }

        .students-search {
            width: 100%;
        }
    }
</style>

<div class="students-heading">
    <div>
        <h1>Student Management</h1>
        <p>View registered students and their service request activity.</p>
    </div>
</div>

<div class="students-summary">

    <div class="students-stat">
        <span>Total Registered Students</span>
        <strong>{{ $totalStudents }}</strong>
    </div>

    <div class="students-stat">
        <span>Students on This Page</span>
        <strong>{{ $students->count() }}</strong>
    </div>

</div>

<section class="students-card">

    <div class="students-card-heading">
        <h2>Registered Students</h2>

        <input type="search"
               id="studentSearch"
               class="students-search"
               placeholder="Search name, Student ID, or email...">
    </div>

    <div class="students-table-wrap">

        <table class="students-table">
            <thead>
                <tr>
                    <th>Student ID</th>
                    <th>Student Name</th>
                    <th>Email Address</th>
                    <th>Requests</th>
                    <th>Date Registered</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($students as $student)
                    <tr class="student-row">
                        <td>
                            <span class="student-id">
                                {{ $student->student_id }}
                            </span>
                        </td>

                        <td>
                            <span class="student-name">
                                {{ $student->name }}
                            </span>
                        </td>

                        <td>{{ $student->email }}</td>

                        <td>
                            <span class="request-count">
                                {{ $student->service_requests_count }}
                            </span>
                        </td>

                        <td>
                            {{ $student->created_at->format('M d, Y') }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="students-empty">
                            No registered students found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <p id="studentsNoResults"
           class="students-empty"
           style="display: none;">
            No matching students found on this page.
        </p>

    </div>

    <div class="students-pagination">
        {{ $students->links() }}
    </div>

</section>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const search = document.getElementById('studentSearch');
    const rows = document.querySelectorAll('.student-row');
    const empty = document.getElementById('studentsNoResults');

    search.addEventListener('input', function () {
        const query = search.value.trim().toLowerCase();
        let matches = 0;

        rows.forEach(function (row) {
            const visible = row.textContent.toLowerCase().includes(query);

            row.style.display = visible ? '' : 'none';

            if (visible) {
                matches++;
            }
        });

        empty.style.display = rows.length > 0 && matches === 0
            ? 'block'
            : 'none';
    });
});
</script>
@endsection
