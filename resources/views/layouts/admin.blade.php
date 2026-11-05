
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link
    rel="icon"
    type="image/png"
    href="{{ asset('images/branding/05_favicon.png') }}"
>
    <title>@yield('title', 'Admin Panel') | CampusCare</title>

    <style>
        * { box-sizing: border-box; }

        body {
            margin: 0;
            background: #f4f7fb;
            color: #23364b;
            font-family: Arial, sans-serif;
        }

        .cc-shell {
            --sidebar-width: 252px;
            display: flex;
            min-height: 100vh;
        }

        .cc-shell.compact {
            --sidebar-width: 76px;
        }

        .cc-sidebar {
            position: fixed;
            inset: 0 auto 0 0;
            z-index: 100;
            width: var(--sidebar-width);
            background: #10243e;
            color: white;
            padding: 25px 14px;
            display: flex;
            flex-direction: column;
            overflow: hidden;
            transition: width .2s ease;
        }

        .cc-brand {
            display: flex;
            align-items: center;
            gap: 10px;
            min-height: 48px;
            padding: 0 10px;
            margin-bottom: 36px;
            font-size: 20px;
            font-weight: 700;
            white-space: nowrap;
        }

        .cc-brand-icon {
            display: grid;
            place-items: center;
            width: 34px;
            min-width: 34px;
            height: 34px;
            border-radius: 10px;
            background: #2c80c5;
            font-size: 18px;
        }

        .cc-brand-logo {
            width: 44px;
            height: 44px;
            min-width: 44px;
            object-fit: contain;
            flex-shrink: 0;
        }

        .cc-nav-label {
            margin: 0 10px 13px;
            color: #9eb2ca;
            font-size: 10px;
            font-weight: bold;
            letter-spacing: 1.3px;
            white-space: nowrap;
        }

        .cc-nav {
            display: flex;
            flex-direction: column;
            gap: 7px;
        }

        .cc-nav-link {
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

        .cc-nav-link:hover,
        .cc-nav-link.active {
            background: #294867;
            color: white;
        }

        .cc-nav-icon {
            width: 23px;
            min-width: 23px;
            font-size: 19px;
            text-align: center;
        }

        .cc-nav-text,
        .cc-brand-text,
        .cc-nav-label {
            transition: opacity .12s ease;
        }

        .cc-logout {
            margin-top: auto;
        }

        .cc-logout button {
            width: 100%;
            border: 0;
            background: transparent;
            text-align: left;
            cursor: pointer;
            font-family: inherit;
        }

        .cc-shell.compact .cc-brand-text,
        .cc-shell.compact .cc-nav-text,
        .cc-shell.compact .cc-nav-label {
            opacity: 0;
            pointer-events: none;
        }

        .cc-workspace {
            flex: 1;
            min-width: 0;
            margin-left: var(--sidebar-width);
            transition: margin-left .2s ease;
        }

        .cc-topbar {
            height: 72px;
            padding: 0 30px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            background: white;
            border-bottom: 1px solid #e5ebf2;
        }

        .cc-topbar-left {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .cc-toggle {
            display: grid;
            place-items: center;
            width: 38px;
            height: 38px;
            border: 1px solid #e3eaf1;
            border-radius: 9px;
            background: white;
            color: #243b53;
            cursor: pointer;
            font-size: 20px;
        }

        .cc-topbar-title {
            font-size: 14px;
            font-weight: 700;
            color: #10243e;
        }

        .cc-admin-name {
            font-size: 13px;
            color: #63748a;
            text-align: right;
        }

        .cc-content {
            padding: 30px;
        }

        /* Adapt existing Service Requests markup to the shared layout */
        .cc-content .admin-layout {
            display: block;
            min-height: 0;
        }

        .cc-content .admin-layout > .sidebar {
            display: none !important;
        }

        .cc-content .admin-layout > .main-content {
            width: 100%;
            padding: 0;
        }

        .cc-content .admin-layout .menu-button {
            display: none !important;
        }

        @media (max-width: 1100px) and (min-width: 701px){
            .cc-shell {
                --sidebar-width: 76px;
            }

            .cc-sidebar .cc-brand-text,
            .cc-sidebar .cc-nav-text,
            .cc-sidebar .cc-nav-label {
                opacity: 0;
            }

            .cc-shell:not(.compact) .cc-sidebar .cc-brand-text,
            .cc-shell:not(.compact) .cc-sidebar .cc-nav-text,
            .cc-shell:not(.compact) .cc-sidebar .cc-nav-label {
                opacity: 0;
            }
        }

        @media (max-width: 700px) {
            .cc-shell,
            .cc-shell.compact {
                --sidebar-width: 0px;
            }

            .cc-sidebar {
                width: 252px;
                transform: translateX(-100%);
                transition: transform .2s ease;
            }

            .cc-shell.mobile-open .cc-sidebar {
                transform: translateX(0);
            }

            .cc-shell .cc-sidebar .cc-brand-text,
            .cc-shell .cc-sidebar .cc-nav-text,
            .cc-shell .cc-sidebar .cc-nav-label {
                opacity: 1 !important;
            }

            .cc-topbar {
                padding: 0 16px;
            }

            .cc-content {
                padding: 18px 14px;
            }

            .cc-admin-name {
                max-width: 130px;
                overflow: hidden;
                text-overflow: ellipsis;
                white-space: nowrap;
            }
        }

        @media (prefers-reduced-motion: reduce) {
            .cc-sidebar,
            .cc-workspace {
                transition: none;
            }
        }
    </style>

    @stack('styles')
</head>
<body>

<div class="cc-shell" id="ccShell">

    <aside class="cc-sidebar" id="ccSidebar">

        <img
            src="{{ asset('images/branding/07_monochrome_white.png') }}"
            alt="CampusCare"
            class="cc-brand-logo"
        >

        <div class="cc-nav-label">ADMIN MENU</div>

        <nav class="cc-nav">

            <a href="{{ route('admin.dashboard') }}"
               title="Dashboard"
               class="cc-nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <span class="cc-nav-icon">▦</span>
                <span class="cc-nav-text">Dashboard</span>
            </a>

            <a href="{{ route('admin.requests.index') }}"
               title="Service Requests"
               class="cc-nav-link {{ request()->routeIs('admin.requests.*') ? 'active' : '' }}">
                <span class="cc-nav-icon">☷</span>
                <span class="cc-nav-text">Service Requests</span>
            </a>

            <a href="{{ route('admin.students.index') }}"
               title="Student Management"
               class="cc-nav-link {{ request()->routeIs('admin.students.*') ? 'active' : '' }}">
                <span class="cc-nav-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor"
                        stroke-width="1.8" stroke-linecap="round"
                        stroke-linejoin="round" aria-hidden="true">
                        <circle cx="12" cy="8" r="4"></circle>
                        <path d="M5 21v-2a7 7 0 0 1 14 0v2"></path>
                    </svg>
                </span>
                <span class="cc-nav-text">Student Management</span>
            </a>

        </nav>

        <div class="cc-logout">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="cc-nav-link" title="Log Out">
                    <span class="cc-nav-icon">⇥</span>
                    <span class="cc-nav-text">Log Out</span>
                </button>
            </form>
        </div>

    </aside>

    <div class="cc-workspace">

        <header class="cc-topbar">
            <div class="cc-topbar-left">
                <button type="button"
                        class="cc-toggle"
                        id="ccSidebarToggle"
                        aria-label="Toggle sidebar"
                        aria-expanded="true">
                    ☰
                </button>

                <span class="cc-topbar-title">
                    @yield('page_title', 'Admin Panel')
                </span>
            </div>

            <span class="cc-admin-name">
                {{ auth()->user()->name ?? 'Administrator' }}
            </span>
        </header>

        <div class="cc-content">
            @yield('content')
        </div>

    </div>
</div>


<script>
document.addEventListener('DOMContentLoaded', function () {
    const shell = document.getElementById('ccShell');
    const toggle = document.getElementById('ccSidebarToggle');

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
