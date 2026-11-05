
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Notifications | CampusCare</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: "Segoe UI", Arial, sans-serif;
            background: #f5f7fa;
            color: #1d2e40;
        }

        .container {
            max-width: 1050px;
            margin: auto;
            padding: 45px 25px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            margin-bottom: 28px;
        }

        .header h1 {
            font-size: 27px;
            margin-bottom: 8px;
        }

        .header p {
            color: #7b8998;
            font-size: 13px;
        }

        .count {
            background: #e7eef5;
            color: #193653;
            padding: 10px 15px;
            border-radius: 5px;
            font-size: 12px;
            font-weight: 700;
        }

        .message {
            padding: 13px 16px;
            background: #eaf5ef;
            color: #26835b;
            border-radius: 6px;
            margin-bottom: 18px;
            font-size: 13px;
        }

        .notification-list {
            display: grid;
            gap: 12px;
        }

        .notification {
            background: white;
            border: 1px solid #e7ebf0;
            border-radius: 7px;
            padding: 21px;
            display: flex;
            justify-content: space-between;
            gap: 20px;
        }

        .notification.unread {
            border-left: 4px solid #527fa5;
            background: #fbfdff;
        }

        .notification h3 {
            font-size: 14px;
            margin-bottom: 8px;
        }

        .notification p {
            color: #667789;
            font-size: 12px;
            line-height: 1.7;
        }

        .meta {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            margin-top: 12px;
            color: #7b8998;
            font-size: 11px;
        }

        .status {
            color: #193653;
            font-weight: 700;
        }

        .unread-label {
            display: inline-block;
            margin-bottom: 8px;
            color: #527fa5;
            font-size: 10px;
            font-weight: 800;
            text-transform: uppercase;
        }

        .read-button {
            align-self: center;
            flex-shrink: 0;
            border: 1px solid #dce4ec;
            background: white;
            color: #193653;
            padding: 9px 12px;
            border-radius: 5px;
            font-size: 11px;
            font-weight: 700;
            cursor: pointer;
        }

        .read-button:hover {
            background: #f0f4f8;
        }

        .empty {
            background: white;
            border: 1px solid #e7ebf0;
            border-radius: 7px;
            padding: 55px 20px;
            text-align: center;
        }

        .empty h3 {
            font-size: 15px;
            margin-bottom: 8px;
        }

        .empty p {
            color: #7b8998;
            font-size: 12px;
        }

        .back {
            display: inline-block;
            margin-top: 25px;
            color: #527fa5;
            font-size: 12px;
            font-weight: 700;
            text-decoration: none;
        }

        .pagination {
            margin-top: 22px;
        }

        @media (max-width: 600px) {
            .header {
                align-items: flex-start;
                flex-direction: column;
            }

            .notification {
                flex-direction: column;
            }

            .read-button {
                align-self: flex-start;
            }
        }
    </style>
</head>

<body>

<div class="container">

    <header class="header">
        <div>
            <h1>Notifications</h1>
            <p>Stay updated about your CampusCare service requests.</p>
        </div>

        <div class="count">
            {{ $unreadCount }} Unread
        </div>
    </header>

    @if (session('success'))
        <div class="message">
            {{ session('success') }}
        </div>
    @endif

    @if ($notifications->count())

        <div class="notification-list">

            @foreach ($notifications as $notification)

                <article class="notification {{ $notification->read_at ? '' : 'unread' }}">

                    <div>

                        @if (!$notification->read_at)
                            <span class="unread-label">New Notification</span>
                        @endif

                        <h3>
                            {{ $notification->data['title'] ?? 'CampusCare Notification' }}
                        </h3>

                        <p>
                            {{ $notification->data['message'] ?? 'You have a new notification.' }}
                        </p>

                        <div class="meta">

                            <span>
                                Reference:
                                {{ $notification->data['reference_number'] ?? 'N/A' }}
                            </span>

                            <span class="status">
                                {{ $notification->data['status'] ?? 'Updated' }}
                            </span>

                            <span>
                                {{ $notification->created_at->format('M d, Y h:i A') }}
                            </span>

                        </div>

                    </div>

                    @if (!$notification->read_at)

                        <form
                            method="POST"
                            action="{{ route('student.notifications.read', $notification->id) }}"
                        >
                            @csrf
                            @method('PATCH')

                            <button type="submit" class="read-button">
                                Mark as Read
                            </button>
                        </form>

                    @endif

                </article>

            @endforeach

        </div>

        <div class="pagination">
            {{ $notifications->links() }}
        </div>

    @else

        <div class="empty">
            <h3>No notifications yet</h3>
            <p>Updates about your service requests will appear here.</p>
        </div>

    @endif

    <a href="{{ route('dashboard') }}" class="back">
        ← Back to Dashboard
    </a>

</div>

</body>
</html>
