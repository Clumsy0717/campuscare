
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="CampusCare helps students submit service requests, track progress, and receive campus support.">

    <title>CampusCare | Student Services Made Simple</title>

    <link rel="icon" type="image/png"
          href="{{ asset('images/branding/05_favicon.png') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700;800&family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --navy: #10243e;
            --navy-deep: #0b1d33;
            --navy-soft: #193653;
            --blue: #2f80c9;
            --blue-light: #eaf4fc;
            --background: #f4f7fb;
            --white: #fff;
            --text: #192c40;
            --muted: #687b90;
            --border: #e2e9f1;
        }

        * { box-sizing: border-box; }

        html { scroll-behavior: smooth; }

        body {
            margin: 0;
            font-family: 'DM Sans', sans-serif;
            color: var(--text);
            background: var(--background);
            -webkit-font-smoothing: antialiased;
        }

        a { text-decoration: none; color: inherit; }
        button { font: inherit; }
        img { max-width: 100%; }

        .container {
            width: min(1180px, calc(100% - 48px));
            margin: 0 auto;
        }

        /* NAVIGATION */

        .site-header {
            position: sticky;
            top: 0;
            z-index: 100;
            background: rgba(255,255,255,.96);
            border-bottom: 1px solid var(--border);
            backdrop-filter: blur(14px);
        }

        .navbar {
            min-height: 80px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 24px;
        }

        .brand {
            display: inline-flex;
            align-items: center;
            flex-shrink: 0;
        }

        .brand img {
            display: block;
            width: 205px;
            height: 53px;
            object-fit: contain;
            object-position: left center;
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 32px;
        }

        .nav-links > a:not(.btn) {
            font-size: 13px;
            font-weight: 700;
            color: #52667c;
            transition: color .2s;
        }

        .nav-links > a:not(.btn):hover {
            color: var(--blue);
        }

        .nav-actions {
            display: flex;
            align-items: center;
            gap: 11px;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            min-height: 45px;
            padding: 12px 19px;
            border-radius: 9px;
            font-size: 13px;
            font-weight: 800;
            line-height: 1.4;
            transition: .2s ease;
            white-space: nowrap;
        }

        .btn-primary {
            color: white;
            background: var(--navy);
            border: 1px solid var(--navy);
        }

        .btn-primary:hover {
            background: var(--navy-soft);
            transform: translateY(-2px);
        }

        .btn-outline {
            color: var(--navy);
            background: white;
            border: 1px solid var(--border);
        }

        .btn-outline:hover {
            border-color: #a6bdd2;
            background: #f7fafd;
        }

        .btn-light {
            color: var(--navy);
            background: white;
            border: 1px solid white;
        }

        .mobile-menu-button {
            display: none;
            border: 1px solid var(--border);
            border-radius: 9px;
            width: 43px;
            height: 43px;
            background: white;
            color: var(--navy);
            cursor: pointer;
            font-size: 23px;
        }

        /* HERO */

        .hero {
            position: relative;
            overflow: hidden;
            background:
                radial-gradient(ellipse at 80% 20%, rgba(47,128,201,.09), transparent 48%),
                linear-gradient(180deg, #fff 0%, #f4f7fb 100%);
            border-bottom: 1px solid var(--border);
        }

        .hero-inner {
            display: grid;
            grid-template-columns: 1fr 1fr;
            align-items: center;
            gap: 72px;
            padding-top: 105px;
            padding-bottom: 110px;
        }

        .eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            color: #286ea9;
            font-size: 11px;
            font-weight: 800;
            letter-spacing: 1.5px;
            text-transform: uppercase;
        }

        .eyebrow::before {
            content: "";
            width: 24px;
            height: 2px;
            background: var(--blue);
        }

        .hero h1 {
            margin: 24px 0;
            font-family: 'Manrope', sans-serif;
            font-size: clamp(42px, 4.7vw, 66px);
            font-weight: 800;
            line-height: 1.13;
            letter-spacing: -3px;
            color: var(--navy);
        }

        .hero h1 span {
            color: var(--blue);
        }

        .hero-description {
            max-width: 490px;
            margin: 0;
            color: var(--muted);
            font-size: 15px;
            line-height: 1.95;
        }

        .hero-actions {
            display: flex;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
            margin-top: 32px;
        }

        .hero-note {
            display: flex;
            align-items: center;
            gap: 9px;
            margin-top: 30px;
            color: #708398;
            font-size: 12px;
        }

        .hero-note svg {
            color: #26865d;
        }

        /* SERVICE PREVIEW */

        .preview {
            padding: 12px;
            border-radius: 19px;
            border: 1px solid #dbe5ef;
            background: rgba(255,255,255,.8);
            box-shadow: 0 26px 70px rgba(16,36,62,.11);
        }

        .preview-window {
            overflow: hidden;
            border: 1px solid var(--border);
            border-radius: 13px;
            background: white;
        }

        .preview-topbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            padding: 17px 20px;
            border-bottom: 1px solid var(--border);
        }

        .preview-brand {
            display: flex;
            align-items: center;
            gap: 10px;
            color: var(--navy);
            font-weight: 800;
            font-size: 13px;
        }

        .preview-brand img {
            width: 34px;
            height: 34px;
            object-fit: contain;
        }

        .preview-label {
            padding: 7px 10px;
            border-radius: 6px;
            background: #eef4f9;
            color: #55718c;
            font-size: 10px;
            font-weight: 700;
        }

        .preview-body {
            padding: 27px;
        }

        .preview-kicker {
            color: var(--blue);
            font-size: 10px;
            font-weight: 800;
            letter-spacing: 1.3px;
            text-transform: uppercase;
        }

        .preview-body h2 {
            margin: 9px 0 8px;
            color: var(--navy);
            font-family: 'Manrope', sans-serif;
            font-size: 23px;
            letter-spacing: -.8px;
        }

        .preview-body > p {
            margin: 0 0 26px;
            color: var(--muted);
            font-size: 12px;
            line-height: 1.7;
        }

        .preview-request {
            padding: 17px;
            margin-bottom: 11px;
            border: 1px solid var(--border);
            border-radius: 10px;
            background: white;
        }

        .preview-request:last-child {
            margin-bottom: 0;
        }

        .request-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 10px;
        }

        .request-title {
            font-size: 12px;
            font-weight: 800;
            color: #243a53;
        }

        .request-ref {
            margin-top: 7px;
            color: #8493a5;
            font-size: 10px;
        }

        .status {
            display: inline-flex;
            align-items: center;
            padding: 6px 9px;
            border-radius: 6px;
            font-size: 10px;
            font-weight: 800;
            white-space: nowrap;
        }

        .status-progress {
            background: #eaf3ff;
            color: #316db0;
        }

        .status-completed {
            background: #e8f7ee;
            color: #277c4c;
        }

        .status-pending {
            background: #fff4dd;
            color: #a16b16;
        }

        .preview-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            margin-top: 20px;
            padding-top: 19px;
            border-top: 1px solid var(--border);
            font-size: 11px;
            color: #74879b;
        }

        .preview-footer strong {
            color: var(--blue);
        }

        /* SECTION HEADINGS */

        .section {
            padding: 100px 0;
        }

        .section-header {
            max-width: 610px;
            margin-bottom: 45px;
        }

        .section-header.centered {
            margin-left: auto;
            margin-right: auto;
            text-align: center;
        }

        .section-kicker {
            color: var(--blue);
            font-size: 11px;
            font-weight: 800;
            letter-spacing: 1.7px;
            text-transform: uppercase;
        }

        .section-header h2 {
            margin: 15px 0;
            font-family: 'Manrope', sans-serif;
            color: var(--navy);
            font-size: clamp(28px, 3.4vw, 40px);
            line-height: 1.25;
            letter-spacing: -1.5px;
        }

        .section-header p {
            color: var(--muted);
            font-size: 14px;
            line-height: 1.85;
        }

        /* FEATURES */

        .features-section {
            background: white;
        }

        .feature-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 20px;
        }

        .feature-card {
            padding: 32px;
            border: 1px solid var(--border);
            border-radius: 13px;
            background: white;
            transition: .2s ease;
        }

        .feature-card:hover {
            transform: translateY(-4px);
            border-color: #c1d5e7;
            box-shadow: 0 15px 35px rgba(16,36,62,.05);
        }

        .feature-icon {
            display: grid;
            place-items: center;
            width: 48px;
            height: 48px;
            margin-bottom: 28px;
            border-radius: 11px;
            background: var(--blue-light);
            color: var(--blue);
        }

        .feature-icon svg {
            width: 23px;
            height: 23px;
        }

        .feature-card h3 {
            margin: 0 0 12px;
            font-family: 'Manrope', sans-serif;
            color: var(--navy);
            font-size: 17px;
        }

        .feature-card p {
            margin: 0;
            color: var(--muted);
            font-size: 13px;
            line-height: 1.85;
        }

        /* HOW IT WORKS */

        .steps-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 24px;
        }

        .step {
            position: relative;
            padding-top: 22px;
            border-top: 2px solid #dce6ef;
        }

        .step-number {
            display: block;
            margin-bottom: 22px;
            color: var(--blue);
            font-family: 'Manrope', sans-serif;
            font-size: 29px;
            font-weight: 800;
        }

        .step h3 {
            margin: 0 0 10px;
            color: var(--navy);
            font-size: 16px;
        }

        .step p {
            margin: 0;
            color: var(--muted);
            font-size: 13px;
            line-height: 1.8;
        }

        /* CTA */

        .cta-section {
            padding: 0 0 95px;
        }

        .cta-card {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 40px;
            padding: 55px 60px;
            border-radius: 16px;
            background: var(--navy);
            color: white;
        }

        .cta-card h2 {
            max-width: 550px;
            margin: 0 0 12px;
            font-family: 'Manrope', sans-serif;
            font-size: clamp(24px, 3vw, 32px);
            letter-spacing: -1px;
        }

        .cta-card p {
            max-width: 550px;
            margin: 0;
            color: #b7c9da;
            font-size: 13px;
            line-height: 1.85;
        }

        /* FOOTER */

        .footer {
            padding: 48px 0 25px;
            background: var(--navy-deep);
            color: white;
        }

        .footer-main {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 40px;
            padding-bottom: 45px;
        }

        .footer-logo {
            width: 210px;
            height: 60px;
            object-fit: contain;
            object-position: left center;
        }

        .footer-description {
            max-width: 370px;
            margin: 15px 0 0;
            color: #a9bacb;
            font-size: 12px;
            line-height: 1.9;
        }

        .footer-links {
            display: flex;
            flex-direction: column;
            gap: 13px;
        }

        .footer-links strong {
            margin-bottom: 7px;
            font-size: 12px;
        }

        .footer-links a {
            color: #b7c6d6;
            font-size: 12px;
        }

        .footer-links a:hover {
            color: white;
        }

        .footer-bottom {
            padding-top: 22px;
            border-top: 1px solid rgba(255,255,255,.12);
            color: #94a9bc;
            font-size: 11px;
        }

        /* RESPONSIVE */

        @media (max-width: 1000px) {
            .hero-inner {
                gap: 35px;
            }

            .hero h1 {
                font-size: 46px;
            }

            .nav-links {
                gap: 18px;
            }
        }

        @media (max-width: 800px) {
            .hero-inner {
                grid-template-columns: 1fr;
                padding-top: 75px;
                padding-bottom: 80px;
            }

            .hero-content {
                max-width: 650px;
            }

            .preview {
                max-width: 600px;
            }

            .feature-grid,
            .steps-grid {
                grid-template-columns: 1fr;
            }

            .cta-card {
                padding: 40px;
            }
        }

        @media (max-width: 650px) {
            .container {
                width: min(100% - 32px, 1180px);
            }

            .navbar {
                min-height: 72px;
                flex-wrap: wrap;
            }

            .brand img {
                width: 170px;
                height: 48px;
            }

            .mobile-menu-button {
                display: grid;
                place-items: center;
            }

            .nav-links {
                display: none;
                flex-direction: column;
                align-items: stretch;
                width: 100%;
                gap: 17px;
                padding: 0 0 20px;
            }

            .nav-links.open {
                display: flex;
            }

            .nav-actions {
                flex-wrap: wrap;
            }

            .hero-inner {
                padding-top: 65px;
                padding-bottom: 70px;
            }

            .hero h1 {
                font-size: clamp(38px, 10vw, 48px);
                letter-spacing: -2px;
            }

            .hero-description {
                font-size: 14px;
            }

            .preview-body {
                padding: 19px;
            }

            .section {
                padding: 75px 0;
            }

            .feature-card {
                padding: 26px;
            }

            .cta-section {
                padding-bottom: 70px;
            }

            .cta-card {
                flex-direction: column;
                align-items: flex-start;
                padding: 35px 26px;
            }

            .footer-main {
                flex-direction: column;
            }
        }

        @media (prefers-reduced-motion: reduce) {
            html { scroll-behavior: auto; }

            *, *::before, *::after {
                transition-duration: .01ms !important;
            }
        }
    </style>
</head>

<body>

    <!-- NAVIGATION -->
    <header class="site-header">
        <div class="container navbar">

            <a href="{{ route('home') }}"
               class="brand"
               aria-label="CampusCare Home">

                <img
                    src="{{ asset('images/branding/01_primary_horizontal.png') }}"
                    alt="CampusCare"
                >
            </a>

            <button
                type="button"
                class="mobile-menu-button"
                id="mobileMenuButton"
                aria-label="Toggle navigation"
                aria-controls="mainNavigation"
                aria-expanded="false">
                ☰
            </button>

            <nav class="nav-links" id="mainNavigation" aria-label="Main navigation">
                <a href="#services">Services</a>
                <a href="#how-it-works">How It Works</a>
                <a href="#about">About</a>

                <div class="nav-actions">
                    @auth
                        <a href="{{ route('dashboard') }}" class="btn btn-primary">
                            Dashboard
                            <span aria-hidden="true">→</span>
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-outline">
                            Log In
                        </a>

                        <a href="{{ route('register') }}" class="btn btn-primary">
                            Get Started
                            <span aria-hidden="true">→</span>
                        </a>
                    @endauth
                </div>
            </nav>
        </div>
    </header>

    <main>

        <!-- HERO -->
        <section class="hero">
            <div class="container hero-inner">

                <div class="hero-content">
                    <div class="eyebrow">
                        CampusCare Student Services
                    </div>

                    <h1>
                        Campus support,<br>
                        <span>made simple.</span>
                    </h1>

                    <p class="hero-description">
                        No more confusion when submitting student concerns.
                        CampusCare gives you one organized place to send
                        service requests, check their progress, and
                        receive updates from campus staff.
                    </p>

                    <div class="hero-actions">
                        @auth
                            <a href="{{ route('dashboard') }}"
                               class="btn btn-primary">
                                Open Dashboard
                                <span aria-hidden="true">→</span>
                            </a>
                        @else
                            <a href="{{ route('register') }}"
                               class="btn btn-primary">
                                Get Started
                                <span aria-hidden="true">→</span>
                            </a>

                            <a href="{{ route('login') }}"
                               class="btn btn-outline">
                                I Have an Account
                            </a>
                        @endauth
                    </div>

                    <div class="hero-note">
                        <svg width="17" height="17"
                             viewBox="0 0 24 24"
                             fill="none"
                             stroke="currentColor"
                             stroke-width="2">
                            <path d="M20 6 9 17l-5-5"/>
                        </svg>

                        Simple requests. Clear updates. Better organization.
                    </div>
                </div>

                <!-- ILLUSTRATIVE DASHBOARD PREVIEW -->
                <div class="preview"
                     aria-label="Example CampusCare request dashboard">

                    <div class="preview-window">

                        <div class="preview-topbar">
                            <div class="preview-brand">
                                <img
                                    src="{{ asset('images/branding/04_icon_only.png') }}"
                                    alt=""
                                >
                                CampusCare
                            </div>

                            <span class="preview-label">
                                Student Portal Preview
                            </span>
                        </div>

                        <div class="preview-body">

                            <span class="preview-kicker">
                                Student Workspace
                            </span>

                            <h2>My Service Requests</h2>

                            <p>
                                An example of how students can track
                                submitted requests.
                            </p>

                            <div class="preview-request">
                                <div class="request-top">
                                    <span class="request-title">
                                        Document Request
                                    </span>

                                    <span class="status status-completed">
                                        Completed
                                    </span>
                                </div>

                                <div class="request-ref">
                                    Example request · Student documents
                                </div>
                            </div>

                            <div class="preview-request">
                                <div class="request-top">
                                    <span class="request-title">
                                        Technical Support
                                    </span>

                                    <span class="status status-progress">
                                        In Progress
                                    </span>
                                </div>

                                <div class="request-ref">
                                    Example request · Technical concern
                                </div>
                            </div>

                            <div class="preview-request">
                                <div class="request-top">
                                    <span class="request-title">
                                        General Inquiry
                                    </span>

                                    <span class="status status-pending">
                                        Pending
                                    </span>
                                </div>

                                <div class="request-ref">
                                    Example request · Student inquiry
                                </div>
                            </div>

                            <div class="preview-footer">
                                <span>Request tracking made easier</span>
                                <strong>CampusCare</strong>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </section>

        <!-- SERVICES -->
        <section class="section features-section"
                 id="services">

            <div class="container">

                <div class="section-header centered">
                    <span class="section-kicker">
                        What You Can Do
                    </span>

                    <h2>
                        Everything you need for student requests.
                    </h2>

                    <p>
                        CampusCare brings student service requests
                        into one easy-to-use system.
                    </p>
                </div>

                <div class="feature-grid">

                    <article class="feature-card">
                        <div class="feature-icon">
                            <svg viewBox="0 0 24 24"
                                 fill="none"
                                 stroke="currentColor"
                                 stroke-width="1.8"
                                 stroke-linecap="round"
                                 stroke-linejoin="round">
                                <path d="M12 5v14M5 12h14"/>
                                <rect x="3" y="3" width="18" height="18" rx="3"/>
                            </svg>
                        </div>

                        <h3>Submit Service Requests</h3>

                        <p>
                            Send your concerns, document requests,
                            and other student service needs through
                            a simple online form.
                        </p>
                    </article>

                    <article class="feature-card">
                        <div class="feature-icon">
                            <svg viewBox="0 0 24 24"
                                 fill="none"
                                 stroke="currentColor"
                                 stroke-width="1.8"
                                 stroke-linecap="round"
                                 stroke-linejoin="round">
                                <path d="M3 12a9 9 0 1 0 3-6.7"/>
                                <path d="M3 3v6h6"/>
                                <path d="M12 7v5l3 2"/>
                            </svg>
                        </div>

                        <h3>Track Request Progress</h3>

                        <p>
                            Check your request history and see
                            whether a request is pending,
                            in progress, completed, or rejected.
                        </p>
                    </article>

                    <article class="feature-card">
                        <div class="feature-icon">
                            <svg viewBox="0 0 24 24"
                                 fill="none"
                                 stroke="currentColor"
                                 stroke-width="1.8"
                                 stroke-linecap="round"
                                 stroke-linejoin="round">
                                <path d="M18 8a6 6 0 0 0-12 0c0 7-3 7-3 9h18c0-2-3-2-3-9"/>
                                <path d="M10 21h4"/>
                            </svg>
                        </div>

                        <h3>Receive Notifications</h3>

                        <p>
                            Get notified when campus staff
                            update your request status, and
                            view important remarks.
                        </p>
                    </article>

                </div>
            </div>
        </section>

        <!-- HOW IT WORKS -->
        <section class="section" id="how-it-works">

            <div class="container">

                <div class="section-header">
                    <span class="section-kicker">
                        Getting Started
                    </span>

                    <h2>Three simple steps to get support.</h2>

                    <p>
                        From submitting a concern to checking its
                        status, CampusCare keeps the process organized.
                    </p>
                </div>

                <div class="steps-grid">

                    <article class="step">
                        <span class="step-number">01</span>

                        <h3>Create Your Account</h3>

                        <p>
                            Register as a student and receive
                            your automatically generated Student ID.
                        </p>
                    </article>

                    <article class="step">
                        <span class="step-number">02</span>

                        <h3>Submit a Request</h3>

                        <p>
                            Select a category, enter a subject,
                            and describe what you need.
                        </p>
                    </article>

                    <article class="step">
                        <span class="step-number">03</span>

                        <h3>Stay Updated</h3>

                        <p>
                            Track your request and receive
                            notifications when its status changes.
                        </p>
                    </article>

                </div>
            </div>
        </section>

        <!-- CALL TO ACTION -->
        <section class="cta-section" id="about">
            <div class="container">

                <div class="cta-card">
                    <div>
                        <h2>
                            A more organized way to access
                            campus support.
                        </h2>

                        <p>
                            CampusCare helps students and campus
                            staff manage service requests in one place.
                            Get started with your student account.
                        </p>
                    </div>

                    @auth
                        <a href="{{ route('dashboard') }}"
                           class="btn btn-light">
                            Open Dashboard
                            <span aria-hidden="true">→</span>
                        </a>
                    @else
                        <a href="{{ route('register') }}"
                           class="btn btn-light">
                            Create Account
                            <span aria-hidden="true">→</span>
                        </a>
                    @endauth
                </div>

            </div>
        </section>

    </main>

    <!-- FOOTER -->
    <footer class="footer">
        <div class="container">

            <div class="footer-main">

                <div>
                    <a href="{{ route('home') }}"
                       aria-label="CampusCare Home">
                        <img
                            src="{{ asset('images/branding/02_sidebar_dark.png') }}"
                            alt="CampusCare"
                            class="footer-logo"
                        >
                    </a>

                    <p class="footer-description">
                        A student service request and management
                        system designed to make campus support
                        easier and more organized.
                    </p>
                </div>

                <nav class="footer-links" aria-label="Footer navigation">
                    <strong>Quick Links</strong>
                    <a href="#services">Services</a>
                    <a href="#how-it-works">How It Works</a>

                    @auth
                        <a href="{{ route('dashboard') }}">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}">Log In</a>
                        <a href="{{ route('register') }}">Register</a>
                    @endauth
                </nav>

            </div>

            <div class="footer-bottom">
                © {{ date('Y') }} CampusCare.
                Student Services Management System.
            </div>

        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const button = document.getElementById('mobileMenuButton');
            const navigation = document.getElementById('mainNavigation');

            button.addEventListener('click', function () {
                const isOpen = navigation.classList.toggle('open');

                button.setAttribute(
                    'aria-expanded',
                    String(isOpen)
                );
            });

            navigation.querySelectorAll('a').forEach(function (link) {
                link.addEventListener('click', function () {
                    navigation.classList.remove('open');
                    button.setAttribute('aria-expanded', 'false');
                });
            });
        });
    </script>

</body>
</html>
