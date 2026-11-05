@extends('layouts.admin')

@section('title', 'Service Requests')
@section('page_title', 'Service Requests')

@section('content')
<style>
    :root {
        --navy: #10243e;
        --blue: #2f80c9;
        --light-blue: #eaf3fb;
        --background: #f4f7fb;
        --text: #243447;
        --muted: #718096;
        --border: #e4eaf1;
    }

    * {
        box-sizing: border-box;
    }

    body {
        margin: 0;
        background: var(--background);
        color: var(--text);
        font-family: Arial, sans-serif;
    }

    .admin-layout {
        display: flex;
        min-height: 100vh;
    }

    .sidebar {
        width: 250px;
        min-width: 250px;
        background: var(--navy);
        color: white;
        padding: 28px 18px;
        display: flex;
        flex-direction: column;
    }

    .brand {
        font-size: 23px;
        font-weight: 700;
        padding: 0 12px;
        margin-bottom: 38px;
    }

    .sidebar-label {
        color: #a9b8ca;
        font-size: 11px;
        text-transform: uppercase;
        letter-spacing: 1px;
        padding: 0 12px;
        margin-bottom: 12px;
    }

    .nav-link {
        display: block;
        padding: 13px 14px;
        margin-bottom: 7px;
        border-radius: 8px;
        color: #dce6f1;
        text-decoration: none;
        font-size: 14px;
    }

    .nav-link:hover,
    .nav-link.active {
        background: #24415f;
        color: white;
    }

    .sidebar-bottom {
        margin-top: auto;
        padding-top: 25px;
    }

    .logout-button {
        width: 100%;
        padding: 12px;
        border: 1px solid #52677e;
        border-radius: 8px;
        background: transparent;
        color: white;
        cursor: pointer;
        text-align: left;
    }

    .main-content {
        flex: 1;
        min-width: 0;
        padding: 32px;
    }

    .topbar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
        margin-bottom: 28px;
    }

    .page-title {
        margin: 0;
        color: var(--navy);
        font-size: 27px;
    }

    .page-subtitle {
        margin: 7px 0 0;
        color: var(--muted);
        font-size: 14px;
    }

    .menu-button {
        display: none;
        padding: 9px 12px;
        border: 1px solid var(--border);
        border-radius: 7px;
        background: white;
        cursor: pointer;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 18px;
        margin-bottom: 25px;
    }

    .stat-card {
        background: white;
        border: 1px solid var(--border);
        border-radius: 12px;
        padding: 20px;
        box-shadow: 0 3px 12px rgba(16, 36, 62, .04);
    }

    .stat-label {
        color: var(--muted);
        font-size: 13px;
    }

    .stat-number {
        display: block;
        margin-top: 10px;
        color: var(--navy);
        font-size: 28px;
        font-weight: 700;
    }

    .content-card {
        background: white;
        border: 1px solid var(--border);
        border-radius: 12px;
        padding: 22px;
        box-shadow: 0 3px 12px rgba(16, 36, 62, .04);
    }

    .section-heading {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
        margin-bottom: 20px;
    }

    .section-heading h2 {
        margin: 0;
        color: var(--navy);
        font-size: 19px;
    }

    .filters {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-bottom: 18px;
    }

    .filters input,
    .filters select {
        min-height: 42px;
        padding: 9px 12px;
        border: 1px solid var(--border);
        border-radius: 7px;
        background: white;
        font-size: 13px;
    }

    .filters input {
        flex: 1;
        min-width: 200px;
    }

    .filters select {
        min-width: 150px;
    }

    .table-wrapper {
        width: 100%;
        overflow-x: auto;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        min-width: 750px;
    }

    th {
        padding: 13px 12px;
        background: #f7f9fc;
        color: #65758a;
        text-align: left;
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: .4px;
    }

    td {
        padding: 15px 12px;
        border-bottom: 1px solid var(--border);
        font-size: 13px;
        vertical-align: middle;
    }

    .student-name {
        color: var(--navy);
        font-weight: 600;
    }

    .secondary-text {
        display: block;
        margin-top: 4px;
        color: var(--muted);
        font-size: 12px;
    }

    .status {
        display: inline-block;
        padding: 6px 10px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 600;
        white-space: nowrap;
    }

    .status-pending {
        background: #fff3d8;
        color: #956000;
    }

    .status-in-progress {
        background: #e5f1ff;
        color: #2165a6;
    }

    .status-completed {
        background: #e2f7eb;
        color: #237847;
    }

    .status-rejected {
        background: #fde8e8;
        color: #a83232;
    }

    .manage-button {
        padding: 8px 12px;
        border: 0;
        border-radius: 6px;
        background: var(--blue);
        color: white;
        cursor: pointer;
        font-size: 12px;
    }

    .manage-button:hover {
        background: #216ba9;
    }

    .empty-message {
        padding: 30px;
        color: var(--muted);
        text-align: center;
    }

    .pagination-area {
        margin-top: 18px;
    }

    .pagination-area nav {
        display: flex;
        justify-content: center;
    }

    .pagination-area nav div:first-child {
        display: none;
    }

    .pagination-area svg {
        width: 18px;
    }

    /* Modal */

    .modal-overlay {
        position: fixed;
        inset: 0;
        z-index: 1000;
        display: none;
        align-items: center;
        justify-content: center;
        padding: 20px;
        background: rgba(8, 22, 39, .65);
    }

    .modal-overlay.show {
        display: flex;
    }

    .modal-box {
        width: 100%;
        max-width: 600px;
        max-height: 90vh;
        overflow-y: auto;
        padding: 25px;
        border-radius: 13px;
        background: white;
        box-shadow: 0 15px 45px rgba(0, 0, 0, .2);
    }

    .modal-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 22px;
    }

    .modal-header h2 {
        margin: 0;
        color: var(--navy);
        font-size: 21px;
    }

    .close-modal {
        border: 0;
        background: transparent;
        color: #65758a;
        font-size: 25px;
        cursor: pointer;
    }

    .form-group {
        margin-bottom: 16px;
    }

    .form-group label {
        display: block;
        margin-bottom: 7px;
        color: var(--text);
        font-size: 13px;
        font-weight: 600;
    }

    .form-group select,
    .form-group textarea,
    .form-group input {
        width: 100%;
        padding: 11px 12px;
        border: 1px solid var(--border);
        border-radius: 7px;
        background: white;
        font-family: inherit;
        font-size: 13px;
    }

    .form-group textarea {
        min-height: 100px;
        resize: vertical;
    }

    .request-details {
        margin: 15px 0;
        padding: 15px;
        border: 1px solid var(--border);
        border-radius: 8px;
        background: #f8fafc;
        font-size: 13px;
        line-height: 1.6;
    }

    .request-details p {
        margin: 5px 0;
    }

    .modal-actions {
        display: flex;
        justify-content: flex-end;
        gap: 10px;
        margin-top: 20px;
    }

    .cancel-button,
    .save-button {
        padding: 11px 17px;
        border: 0;
        border-radius: 7px;
        cursor: pointer;
        font-size: 13px;
    }

    .cancel-button {
        background: #edf1f5;
        color: #405166;
    }

    .save-button {
        background: var(--blue);
        color: white;
    }

    .no-requests {
        color: var(--muted);
        font-size: 13px;
    }

    @media (max-width: 1000px) {
        .stats-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media (max-width: 750px) {
        .sidebar {
            position: fixed;
            top: 0;
            bottom: 0;
            left: -260px;
            z-index: 1100;
            transition: left .2s ease;
        }

        .sidebar.open {
            left: 0;
        }

        .main-content {
            width: 100%;
            padding: 20px;
        }

        .menu-button {
            display: block;
        }

        .topbar {
            align-items: flex-start;
        }
    }

    @media (max-width: 480px) {
        .stats-grid {
            grid-template-columns: 1fr 1fr;
            gap: 10px;
        }

        .stat-card {
            padding: 15px;
        }

        .stat-number {
            font-size: 23px;
        }

        .main-content {
            padding: 15px;
        }

        .content-card {
            padding: 15px;
        }

        .page-title {
            font-size: 22px;
        }
    }
</style>

<div class="admin-layout">

    <aside class="sidebar" id="adminSidebar">
        <div class="brand">CampusCare</div>

        <div class="sidebar-label">Admin Menu</div>

        <a href="{{ route('admin.dashboard') }}" class="nav-link">
            Dashboard
        </a>

        <a href="{{ route('admin.requests.index') }}" class="nav-link active">
            Service Requests
        </a>

        <a href="{{ route('admin.students.index') }}" class="nav-link">
            Student Management
        </a>

        <div class="sidebar-bottom">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="logout-button">
                    Log Out
                </button>
            </form>
        </div>
    </aside>

    <main class="main-content"
          id="requestsPage"
          data-requests="{{ json_encode($allRequests) }}">

        <div class="topbar">
            <div>
                <h1 class="page-title">Service Requests</h1>
                <p class="page-subtitle">
                    View and manage student service requests.
                </p>
            </div>

            <button type="button"
                    class="menu-button"
                    id="menuButton">
                ☰ Menu
            </button>
        </div>

        {{-- Statistics --}}

        <div class="stats-grid">

            <div class="stat-card">
                <span class="stat-label">Total Requests</span>
                <strong class="stat-number">{{ $totalRequests }}</strong>
            </div>

            <div class="stat-card">
                <span class="stat-label">Pending</span>
                <strong class="stat-number">{{ $pendingRequests }}</strong>
            </div>

            <div class="stat-card">
                <span class="stat-label">In Progress</span>
                <strong class="stat-number">{{ $inProgressRequests }}</strong>
            </div>

            <div class="stat-card">
                <span class="stat-label">Completed</span>
                <strong class="stat-number">{{ $completedRequests }}</strong>
            </div>

        </div>

        {{-- Requests Table --}}

        <section class="content-card">

            <div class="section-heading">
                <h2>All Student Requests</h2>
            </div>

            <div class="filters">
                <input type="text"
                       id="searchInput"
                       placeholder="Search student, ID, reference, or subject...">

                <select id="statusFilter">
                    <option value="">All Statuses</option>
                    <option value="Pending">Pending</option>
                    <option value="In Progress">In Progress</option>
                    <option value="Completed">Completed</option>
                    <option value="Rejected">Rejected</option>
                </select>
            </div>

            <div class="table-wrapper">
                <table id="requestsTable">
                    <thead>
                        <tr>
                            <th>Reference</th>
                            <th>Student</th>
                            <th>Request</th>
                            <th>Date Submitted</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($requests as $request)
                            <tr class="request-row"
                                data-search="{{ strtolower(
                                    ($request->reference_number ?? '') . ' ' .
                                    ($request->user->name ?? '') . ' ' .
                                    ($request->user->student_id ?? '') . ' ' .
                                    ($request->subject ?? '') . ' ' .
                                    ($request->category ?? '')
                                ) }}"
                                data-status="{{ $request->status }}">

                                <td>
                                    <strong>{{ $request->reference_number }}</strong>
                                </td>

                                <td>
                                    <span class="student-name">
                                        {{ $request->user->name ?? 'Unknown Student' }}
                                    </span>
                                    <span class="secondary-text">
                                        {{ $request->user->student_id ?? 'No Student ID' }}
                                    </span>
                                </td>

                                <td>
                                    <strong>{{ $request->subject }}</strong>
                                    <span class="secondary-text">
                                        {{ $request->category }}
                                    </span>
                                </td>

                                <td>
                                    {{ $request->created_at->format('M d, Y') }}
                                </td>

                                <td>
                                    @php
                                        $statusClass = match ($request->status) {
                                            'Pending' => 'status-pending',
                                            'In Progress' => 'status-in-progress',
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
                                    <button type="button"
                                            class="manage-button"
                                            data-request-id="{{ $request->id }}">
                                        Manage
                                    </button>
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="empty-message">
                                    No service requests have been submitted yet.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <p id="noSearchResults"
                   class="empty-message"
                   style="display: none;">
                    No matching requests found.
                </p>
            </div>

            <div class="pagination-area">
                {{ $requests->links() }}
            </div>

        </section>

    </main>
</div>

{{-- Manage Request Modal --}}

<div class="modal-overlay" id="requestModal">

    <div class="modal-box">

        <div class="modal-header">
            <h2>Manage Service Request</h2>

            <button type="button"
                    class="close-modal"
                    id="closeModal">
                &times;
            </button>
        </div>

        <form method="POST"
              id="manageRequestForm"
              data-update-url="{{ url('/admin/requests') }}">

            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="studentSelect">Select Student</label>

                <select id="studentSelect" required>
                    <option value="">Choose a student</option>

                    @foreach ($students as $student)
                        <option value="{{ $student->id }}">
                            {{ $student->name }} ({{ $student->student_id }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="requestSelect">Select Service Request</label>

                <select id="requestSelect" required disabled>
                    <option value="">Choose a request</option>
                </select>
            </div>

            <div class="request-details"
                 id="requestDetails"
                 style="display: none;">

                <p>
                    <strong>Reference:</strong>
                    <span id="detailReference">-</span>
                </p>

                <p>
                    <strong>Category:</strong>
                    <span id="detailCategory">-</span>
                </p>

                <p>
                    <strong>Subject:</strong>
                    <span id="detailSubject">-</span>
                </p>

                <p>
                    <strong>Description:</strong>
                </p>

                <p id="detailDescription">-</p>

                <p>
                    <strong>Date Submitted:</strong>
                    <span id="detailDate">-</span>
                </p>
            </div>

            <div class="form-group">
                <label for="statusSelect">Update Status</label>

                <select name="status"
                        id="statusSelect"
                        required>

                    <option value="Pending">Pending</option>
                    <option value="In Progress">In Progress</option>
                    <option value="Completed">Completed</option>
                    <option value="Rejected">Rejected</option>

                </select>
            </div>

            <div class="form-group">
                <label for="adminRemarks">Admin Remarks</label>

                <textarea name="admin_remarks"
                          id="adminRemarks"
                          maxlength="2000"
                          placeholder="Write remarks for the student..."></textarea>
            </div>

            <div class="modal-actions">
                <button type="button"
                        class="cancel-button"
                        id="cancelModal">
                    Cancel
                </button>

                <button type="submit"
                        class="save-button"
                        id="saveButton"
                        disabled>
                    Save Changes
                </button>
            </div>

        </form>

    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const page = document.getElementById('requestsPage');
    const modal = document.getElementById('requestModal');
    const form = document.getElementById('manageRequestForm');

    const studentSelect = document.getElementById('studentSelect');
    const requestSelect = document.getElementById('requestSelect');

    const statusSelect = document.getElementById('statusSelect');
    const adminRemarks = document.getElementById('adminRemarks');

    const requestDetails = document.getElementById('requestDetails');
    const saveButton = document.getElementById('saveButton');

    const searchInput = document.getElementById('searchInput');
    const statusFilter = document.getElementById('statusFilter');

    const menuButton = document.getElementById('menuButton');
    const sidebar = document.getElementById('adminSidebar');

    let allRequests = [];

    try {
        allRequests = JSON.parse(page.dataset.requests || '[]');
    } catch (error) {
        console.error('Unable to read service request data:', error);
    }

    let selectedRequest = null;

    // Open and close the sidebar on smaller screens.

    menuButton.addEventListener('click', function () {
        sidebar.classList.toggle('open');
    });

    // Search and status filter.

    function filterTable() {
        const searchValue = searchInput.value.toLowerCase().trim();
        const selectedStatus = statusFilter.value;

        const rows = document.querySelectorAll('.request-row');

        let visibleRows = 0;

        rows.forEach(function (row) {
            const searchText = row.dataset.search || '';
            const rowStatus = row.dataset.status || '';

            const matchesSearch = searchText.includes(searchValue);
            const matchesStatus = !selectedStatus || rowStatus === selectedStatus;

            if (matchesSearch && matchesStatus) {
                row.style.display = '';
                visibleRows++;
            } else {
                row.style.display = 'none';
            }
        });

        const noResults = document.getElementById('noSearchResults');

        if (noResults) {
            noResults.style.display = visibleRows === 0 ? 'block' : 'none';
        }
    }

    searchInput.addEventListener('input', filterTable);
    statusFilter.addEventListener('change', filterTable);

    // Find a request by its ID.

    function findRequestById(id) {
        return allRequests.find(function (request) {
            return String(request.id) === String(id);
        });
    }

    // Load requests belonging to the selected student.

    function loadStudentRequests() {
        const studentId = studentSelect.value;

        requestSelect.innerHTML = '<option value="">Choose a request</option>';

        requestDetails.style.display = 'none';
        saveButton.disabled = true;
        selectedRequest = null;

        if (!studentId) {
            requestSelect.disabled = true;
            return;
        }

        const studentRequests = allRequests.filter(function (request) {
            return String(request.user_id) === String(studentId);
        });

        if (studentRequests.length === 0) {
            requestSelect.disabled = true;

            const option = document.createElement('option');
            option.value = '';
            option.textContent = 'This student has no service requests';

            requestSelect.appendChild(option);

            return;
        }

        requestSelect.disabled = false;

        studentRequests.forEach(function (request) {
            const option = document.createElement('option');

            option.value = request.id;

            option.textContent =
                request.reference_number + ' - ' + request.subject;

            requestSelect.appendChild(option);
        });
    }

    studentSelect.addEventListener('change', loadStudentRequests);

    // Display the selected request details.

    function displayRequestDetails(request) {
        selectedRequest = request;

        document.getElementById('detailReference').textContent =
            request.reference_number || '-';

        document.getElementById('detailCategory').textContent =
            request.category || '-';

        document.getElementById('detailSubject').textContent =
            request.subject || '-';

        document.getElementById('detailDescription').textContent =
            request.description || '-';

        let formattedDate = '-';

        if (request.created_at) {
            const date = new Date(request.created_at);

            if (!Number.isNaN(date.getTime())) {
                formattedDate = date.toLocaleDateString();
            }
        }

        document.getElementById('detailDate').textContent = formattedDate;

        statusSelect.value = request.status || 'Pending';
        adminRemarks.value = request.admin_remarks || '';

        const updateUrl = form.dataset.updateUrl;

        form.action = updateUrl.replace(/\/$/, '') + '/' + request.id;

        requestDetails.style.display = 'block';
        saveButton.disabled = false;
    }

    requestSelect.addEventListener('change', function () {
        const request = findRequestById(requestSelect.value);

        if (!request) {
            selectedRequest = null;
            requestDetails.style.display = 'none';
            saveButton.disabled = true;
            return;
        }

        displayRequestDetails(request);
    });

    // Open the modal for a specific request.

    function openModal(requestId) {
        const request = findRequestById(requestId);

        if (!request) {
            alert('The selected request could not be found.');
            return;
        }

        studentSelect.value = String(request.user_id);

        loadStudentRequests();

        requestSelect.value = String(request.id);

        displayRequestDetails(request);

        modal.classList.add('show');
    }

    document.querySelectorAll('[data-request-id]').forEach(function (button) {
        button.addEventListener('click', function () {
            openModal(button.dataset.requestId);
        });
    });

    // Close the modal.

    function closeModal() {
        modal.classList.remove('show');
    }

    document.getElementById('closeModal').addEventListener('click', closeModal);
    document.getElementById('cancelModal').addEventListener('click', closeModal);

    modal.addEventListener('click', function (event) {
        if (event.target === modal) {
            closeModal();
        }
    });

    // Prevent saving without a selected request.

    form.addEventListener('submit', function (event) {
        if (!selectedRequest || !requestSelect.value) {
            event.preventDefault();
            alert('Please select a student and service request first.');
        }
    });

});
</script>
@endsection
