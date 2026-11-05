
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link
    rel="icon"
    type="image/png"
    href="{{ asset('images/branding/05_favicon.png') }}"
>

    <title>@yield('title', 'Student Dashboard') | CampusCare</title>

    <style>
        * { box-sizing: border-box; }

        body {
            margin: 0;
            font-family: "Segoe UI", Arial, sans-serif;
            background: #f4f7fb;
            color: #243447;
        }

        .student-shell {
            --sidebar-width: 255px;
            min-height: 100vh;
        }

        .student-shell.compact {
            --sidebar-width: 76px;
        }

        .student-sidebar {
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            width: var(--sidebar-width);
            z-index: 100;
            padding: 24px 14px;
            background: #10243e;
            color: white;
            display: flex;
            flex-direction: column;
            overflow-x: hidden;
            overflow-y: auto;
            transition: width .2s ease;
        }

        .student-brand {
            display: flex;
            align-items: center;
            gap: 10px;
            min-height: 48px;
            padding: 0 6px;
            margin-bottom: 35px;
            color: white;
            text-decoration: none;
            font-size: 20px;
            font-weight: 700;
            white-space: nowrap;
        }

        .student-brand-icon {
            width: 34px;
            min-width: 34px;
            height: 34px;
            display: grid;
            place-items: center;
            background: #2f80c9;
            border-radius: 9px;
            font-size: 13px;
        }

        .student-nav-label {
            margin: 0 10px 14px;
            color: #9eb2ca;
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 1.2px;
            white-space: nowrap;
        }

        .student-nav {
            display: flex;
            flex-direction: column;
            gap: 7px;
        }

        .student-nav-link {
            display: flex;
            align-items: center;
            gap: 14px;
            min-height: 45px;
            padding: 11px 12px;
            border-radius: 9px;
            color: #dce7f3;
            text-decoration: none;
            font-size: 13px;
            white-space: nowrap;
        }

        .student-nav-link:hover,
        .student-nav-link.active {
            background: #294867;
            color: white;
        }

        .student-nav-icon {
            width: 23px;
            min-width: 23px;
            display: grid;
            place-items: center;
        }

        .student-nav-icon svg {
            width: 20px;
            height: 20px;
        }

        .student-nav-text,
        .student-brand-text,
        .student-nav-label {
            transition: opacity .12s ease;
        }

        .student-shell.compact .student-nav-text,
        .student-shell.compact .student-brand-text,
        .student-shell.compact .student-nav-label {
            opacity: 0;
            visibility: hidden;
        }

        .student-bottom {
            margin-top: auto;
            padding-top: 20px;
        }

        .student-bottom button {
            width: 100%;
            border: 0;
            background: transparent;
            text-align: left;
            font-family: inherit;
            cursor: pointer;
        }

        .student-workspace {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
            min-width: 0;
            transition: margin-left .2s ease;
        }

        .student-topbar {
            height: 72px;
            padding: 0 30px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            background: white;
            border-bottom: 1px solid #e5ebf2;
        }

        .student-topbar-left {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .student-toggle {
            width: 38px;
            height: 38px;
            display: grid;
            place-items: center;
            border: 1px solid #e3eaf1;
            border-radius: 9px;
            background: white;
            color: #243b53;
            font-size: 20px;
            cursor: pointer;
        }

        .student-topbar-title {
            font-size: 14px;
            font-weight: 700;
            color: #10243e;
        }

        .student-topbar-user {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 12px;
            min-width: 0;
        }

        .student-topbar-name {
            font-size: 13px;
            color: #63748a;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .student-avatar {
            width: 36px;
            min-width: 36px;
            height: 36px;
            border-radius: 50%;
            display: grid;
            place-items: center;
            background: #e7eef5;
            color: #10243e;
            font-size: 12px;
            font-weight: 700;
        }

        .student-content {
            max-width: 1500px;
            margin: 0 auto;
            padding: 30px;
        }

        .student-notification-count {
            margin-left: auto;
            padding: 3px 7px;
            border-radius: 20px;
            background: #2f80c9;
            color: white;
            font-size: 10px;
            font-weight: 700;
        }

        .student-shell.compact .student-notification-count {
            display: none;
        }

        .student-overlay {
            display: none;
        }

        @media (max-width: 1100px) and (min-width: 701px) {
            .student-shell {
                --sidebar-width: 76px;
            }
        }

        @media (max-width: 700px) {
            .student-shell,
            .student-shell.compact {
                --sidebar-width: 0px;
            }

        @media (max-width: 480px) {
            .student-topbar-name {
                display: none;
            }
        }

            .student-sidebar {
                width: 255px;
                transform: translateX(-100%);
                transition: transform .2s ease;
            }

            .student-shell.mobile-open .student-sidebar {
                transform: translateX(0);
            }

            .student-shell .student-nav-text,
            .student-shell .student-brand-text,
            .student-shell .student-nav-label {
                opacity: 1;
                visibility: visible;
            }

            .student-shell .student-notification-count {
                display: inline-block;
            }

            .student-shell.mobile-open .student-overlay {
                display: block;
                position: fixed;
                inset: 0;
                z-index: 90;
                background: rgba(10, 25, 40, .45);
            }

            .student-topbar {
                padding: 0 16px;
            }

            .student-topbar-name {
                display: none;
            }

            .student-content {
                padding: 20px 15px;
            }
        }

        @media (prefers-reduced-motion: reduce) {
            .student-sidebar,
            .student-workspace {
                transition: none;
            }
        }

        
        /* Student topbar notification */

        .student-notification-bell {
            position: relative;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid #e5ebf2;
            border-radius: 10px;
            background: #ffffff;
            color: #52657a;
            text-decoration: none;
            transition: background .2s ease, color .2s ease;
        }

        .student-notification-bell:hover {
            background: #edf4fb;
            color: #2f80c9;
        }

        .notification-red-dot {
            position: absolute;
            top: 7px;
            right: 7px;
            width: 9px;
            height: 9px;
            border-radius: 50%;
            background: #e53935;
            border: 2px solid #ffffff;
        }

        .student-avatar:hover {
            background: #dceaf6;
        }

        .student-brand-logo {
            width: 44px;
            height: 44px;
            min-width: 44px;
            object-fit: contain;
            flex-shrink: 0;
        }

    </style>

    @stack('styles')
</head>
<body>

@php
    $currentStudent = auth()->user();

    $initials = collect(explode(' ', trim($currentStudent->name)))
        ->filter()
        ->take(2)
        ->map(fn ($part) => strtoupper(substr($part, 0, 1)))
        ->implode('');

    $unreadCount = $currentStudent->unreadNotifications()->count();
@endphp

<div class="student-shell" id="studentShell">

    <aside class="student-sidebar" id="studentSidebar">

        <a href="{{ route('dashboard') }}" class="student-brand">
            <img
                src="{{ asset('images/branding/07_monochrome_white.png') }}"
                alt="CampusCare"
                class="student-brand-logo"
            >

            <span class="student-brand-text">CampusCare</span>
        </a>

        <div class="student-nav-label">STUDENT WORKSPACE</div>

        <nav class="student-nav">

            <a href="{{ route('dashboard') }}"
               class="student-nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}"
               title="Dashboard">
                <span class="student-nav-icon">
                    <svg viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="1.8"
                         stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="3" width="7" height="7" rx="1"/>
                        <rect x="14" y="3" width="7" height="7" rx="1"/>
                        <rect x="3" y="14" width="7" height="7" rx="1"/>
                        <rect x="14" y="14" width="7" height="7" rx="1"/>
                    </svg>
                </span>
                <span class="student-nav-text">Dashboard</span>
            </a>

            <a href="{{ route('student.requests.create') }}"
               class="student-nav-link {{ request()->routeIs('student.requests.create') ? 'active' : '' }}"
               title="Service Requests">
                <span class="student-nav-icon">
                    <svg viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="1.8"
                         stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 5v14M5 12h14"/>
                        <rect x="3" y="3" width="18" height="18" rx="3"/>
                    </svg>
                </span>
                <span class="student-nav-text">Service Requests</span>
            </a>

            <a href="{{ route('student.requests.index') }}"
               class="student-nav-link {{ request()->routeIs('student.requests.index') ? 'active' : '' }}"
               title="Request History">
                <span class="student-nav-icon">
                    <svg viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="1.8"
                         stroke-linecap="round" stroke-linejoin="round">
                        <path d="M3 12a9 9 0 1 0 3-6.7"/>
                        <path d="M3 3v6h6"/>
                        <path d="M12 7v5l3 2"/>
                    </svg>
                </span>
                <span class="student-nav-text">Request History</span>
            </a>

            <a href="{{ route('profile.edit') }}"
               class="student-nav-link {{ request()->routeIs('profile', 'profile.edit') ? 'active' : '' }}"
               title="My Profile">
                <span class="student-nav-icon">
                    <svg viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="1.8"
                         stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="8" r="4"/>
                        <path d="M5 21v-2a7 7 0 0 1 14 0v2"/>
                    </svg>
                </span>
                <span class="student-nav-text">My Profile</span>
            </a>

        </nav>

        <div class="student-bottom">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="student-nav-link" title="Log Out">
                    <span class="student-nav-icon">
                        <svg viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="1.8"
                             stroke-linecap="round" stroke-linejoin="round">
                            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
                            <path d="M16 17l5-5-5-5"/>
                            <path d="M21 12H9"/>
                        </svg>
                    </span>
                    <span class="student-nav-text">Log Out</span>
                </button>
            </form>
        </div>

    </aside>

    <div class="student-overlay" id="studentOverlay"></div>

    <div class="student-workspace">

        <header class="student-topbar">
            <div class="student-topbar-left">
                <button type="button"
                        class="student-toggle"
                        id="studentSidebarToggle"
                        aria-label="Toggle sidebar"
                        aria-expanded="true">
                    ☰
                </button>

                <span class="student-topbar-title">
                    @yield('page_title', 'Student Dashboard')
                </span>
            </div>

            
            <div class="student-topbar-user">

                <!-- Notifications -->
                <a href="{{ route('student.notifications.index') }}"
                class="student-notification-bell"
                title="Notifications"
                aria-label="Notifications{{ $unreadCount > 0 ? ': ' . $unreadCount . ' unread' : '' }}">

                    <svg viewBox="0 0 24 24"
                        width="21"
                        height="21"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        aria-hidden="true">

                        <path d="M18 8a6 6 0 0 0-12 0c0 7-3 7-3 9h18c0-2-3-2-3-9"/>
                        <path d="M10 21h4"/>

                    </svg>

                    @if ($unreadCount > 0)
                        <span class="notification-red-dot"></span>
                    @endif

                </a>

                <a href="{{ route('profile.edit') }}"
                class="student-avatar"
                title="My Profile"
                style="text-decoration: none;">
                    {{ $initials }}
                </a>

                <span class="student-topbar-name">
                    {{ $currentStudent->name }}
                </span>

            </div>

        </header>

        <main class="student-content">
            @yield('content')
        </main>

    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const shell = document.getElementById('studentShell');
    const toggle = document.getElementById('studentSidebarToggle');
    const overlay = document.getElementById('studentOverlay');

    const compactScreen = window.matchMedia('(max-width: 1100px)');
    const mobileScreen = window.matchMedia('(max-width: 700px)');

    let manuallyChanged = false;

    function updateSidebar() {
        if (mobileScreen.matches) {
            shell.classList.remove('compact');
            shell.classList.remove('mobile-open');
            toggle.setAttribute('aria-expanded', 'false');
            return;
        }

        if (!manuallyChanged) {
            shell.classList.toggle('compact', compactScreen.matches);
        }

        toggle.setAttribute(
            'aria-expanded',
            String(!shell.classList.contains('compact'))
        );
    }

    function closeMobileSidebar() {
        shell.classList.remove('mobile-open');
        toggle.setAttribute('aria-expanded', 'false');
    }

    toggle.addEventListener('click', function () {
        if (mobileScreen.matches) {
            shell.classList.toggle('mobile-open');

            toggle.setAttribute(
                'aria-expanded',
                String(shell.classList.contains('mobile-open'))
            );
        } else {
            manuallyChanged = true;
            shell.classList.toggle('compact');

            toggle.setAttribute(
                'aria-expanded',
                String(!shell.classList.contains('compact'))
            );
        }
    });

    overlay.addEventListener('click', closeMobileSidebar);

    document.addEventListener('keydown', function (event) {
        if (event.key === 'Escape') {
            closeMobileSidebar();
        }
    });

    window.addEventListener('resize', function () {
        manuallyChanged = false;
        updateSidebar();
    });

    updateSidebar();
});
</script>

@stack('scripts')
</body>
</html>
