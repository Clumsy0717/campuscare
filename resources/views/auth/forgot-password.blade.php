
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Forgot Password | CampusCare</title>

    <link rel="icon" type="image/png"
          href="{{ asset('images/branding/05_favicon.png') }}">

    <style>
        :root {
            --navy: #193653;
            --navy-dark: #12283e;
            --blue: #527fa5;
            --background: #f5f6f8;
            --text: #192c40;
            --muted: #788697;
            --border: #e2e7ed;
            --danger: #c43e45;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: "Segoe UI", Arial, sans-serif;
            background: var(--background);
            color: var(--text);
            min-height: 100vh;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        .navbar {
            min-height: 78px;
            padding: 15px 8%;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            background: white;
            border-bottom: 1px solid var(--border);
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 20px;
            font-weight: 800;
            letter-spacing: -0.7px;
        }

        .brand-logo {
            width: 40px;
            height: 40px;
            object-fit: contain;
        }

        .brand span {
            color: var(--blue);
        }

        .nav-link {
            font-size: 13px;
            font-weight: 600;
            color: var(--navy);
        }

        .nav-link:hover {
            color: var(--blue);
        }

        .page {
            min-height: calc(100vh - 78px);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 55px 20px;
        }

        .forgot-container {
            width: 100%;
            max-width: 440px;
        }

        .forgot-card {
            background: white;
            padding: 42px;
            border: 1px solid var(--border);
            border-radius: 11px;
            box-shadow: 0 15px 45px rgba(25, 54, 83, 0.045);
        }

        .heading {
            margin-bottom: 30px;
        }

        .heading small {
            display: block;
            color: var(--blue);
            font-size: 11px;
            font-weight: 800;
            letter-spacing: 1.8px;
            text-transform: uppercase;
            margin-bottom: 12px;
        }

        .heading h1 {
            font-size: 29px;
            letter-spacing: -1px;
            margin-bottom: 10px;
        }

        .heading p {
            font-size: 13px;
            line-height: 1.7;
            color: var(--muted);
        }

        .form-group {
            margin-bottom: 21px;
        }

        .form-group label {
            display: block;
            font-size: 12px;
            font-weight: 700;
            margin-bottom: 9px;
        }

        .form-group input {
            width: 100%;
            height: 47px;
            padding: 0 14px;
            border: 1px solid var(--border);
            border-radius: 6px;
            outline: none;
            font-size: 13px;
            color: var(--text);
            background: white;
        }

        .form-group input:focus {
            border-color: var(--blue);
            box-shadow: 0 0 0 3px rgba(82, 127, 165, 0.1);
        }

        .form-group input::placeholder {
            color: #a7b0bb;
        }

        .captcha-container {
            margin: 5px 0 22px;
            max-width: 100%;
            overflow-x: auto;
        }

        .field-error {
            display: block;
            color: var(--danger);
            font-size: 12px;
            margin-top: 8px;
        }

        .alert {
            padding: 12px 14px;
            border-radius: 6px;
            font-size: 12px;
            line-height: 1.6;
            margin-bottom: 20px;
        }

        .alert-success {
            color: #216b45;
            background: #edf8f1;
            border: 1px solid #cdebd8;
        }

        .alert-error {
            color: #a53239;
            background: #fff0f0;
            border: 1px solid #f1d0d0;
        }

        .submit-button {
            width: 100%;
            min-height: 48px;
            padding: 12px;
            border: none;
            border-radius: 6px;
            background: var(--navy);
            color: white;
            font-size: 13px;
            font-weight: 700;
            cursor: pointer;
            transition: background .2s;
        }

        .submit-button:hover {
            background: var(--navy-dark);
        }

        .back-link {
            display: block;
            text-align: center;
            margin-top: 25px;
            font-size: 12px;
            font-weight: 700;
            color: var(--navy);
        }

        .back-link:hover {
            color: var(--blue);
        }

        .footer {
            text-align: center;
            color: #98a3af;
            font-size: 11px;
            padding: 20px;
        }

        @media (max-width: 500px) {
            .navbar {
                padding: 15px 5%;
            }

            .brand {
                font-size: 17px;
            }

            .nav-link {
                font-size: 11px;
            }

            .forgot-card {
                padding: 30px 23px;
            }

            .heading h1 {
                font-size: 26px;
            }
        }
    </style>
</head>

<body>

    <!-- Navigation -->
    <header class="navbar">
        <a href="{{ route('home') }}" class="brand">
            <img
                src="{{ asset('images/branding/04_icon_only.png') }}"
                alt=""
                class="brand-logo"
            >

            <div>Campus<span>Care</span></div>
        </a>

        <a href="{{ route('login') }}" class="nav-link">
            Back to Login
        </a>
    </header>

    <main class="page">
        <div class="forgot-container">

            <section class="forgot-card">

                <div class="heading">
                    <small>Account Recovery</small>

                    <h1>Forgot your password?</h1>

                    <p>
                        Enter your registered email address.
                        We'll send you a password reset link
                        so you can create a new password.
                    </p>
                </div>

                <!-- Success Message -->
                @if (session('status'))
                    <div class="alert alert-success" role="status">
                        {{ session('status') }}
                    </div>
                @endif

                <!-- General Errors -->
                @if ($errors->any())
                    <div class="alert alert-error" role="alert">
                        Please check the information below
                        and try again.
                    </div>
                @endif

                <!-- Password Reset Request Form -->
                <form
                    method="POST"
                    action="{{ route('password.email') }}"
                >
                    @csrf

                    <!-- Email Address -->
                    <div class="form-group">
                        <label for="email">
                            Email Address
                        </label>

                        <input
                            type="email"
                            id="email"
                            name="email"
                            value="{{ old('email') }}"
                            placeholder="Enter your registered email"
                            autocomplete="email"
                            required
                            autofocus
                        >

                        @error('email')
                            <span class="field-error">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <!-- Google reCAPTCHA -->
                    <div class="captcha-container">
                        <div
                            class="g-recaptcha"
                            data-sitekey="{{ config('services.recaptcha.site_key') }}"
                        ></div>

                        @error('g-recaptcha-response')
                            <span class="field-error">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="submit-button">
                        Email Password Reset Link
                    </button>
                </form>

                <a href="{{ route('login') }}" class="back-link">
                    Back to Login
                </a>

            </section>

            <footer class="footer">
                © {{ date('Y') }} CampusCare. All rights reserved.
            </footer>

        </div>
    </main>

    <!-- Google reCAPTCHA v2 -->
    <script
        src="https://www.google.com/recaptcha/api.js"
        async
        defer
    ></script>

</body>
</html>
