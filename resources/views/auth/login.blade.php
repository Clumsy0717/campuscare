
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Log In | CampusCare</title>

    <link rel="icon" type="image/png"
          href="{{ asset('images/branding/05_favicon.png') }}">

    <style>
        :root {
            --navy: #193653;
            --navy-dark: #12283e;
            --blue: #527fa5;
            --background: #f5f6f8;
            --white: #ffffff;
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
            color: inherit;
            text-decoration: none;
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
            flex-shrink: 0;
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

        .login-container {
            width: 100%;
            max-width: 440px;
        }

        .login-card {
            background: white;
            padding: 42px;
            border: 1px solid var(--border);
            border-radius: 11px;
            box-shadow: 0 15px 45px rgba(25, 54, 83, 0.045);
        }

        .heading {
            margin-bottom: 32px;
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
            transition: border-color .2s, box-shadow .2s;
        }

        .form-group input:focus {
            border-color: var(--blue);
            box-shadow: 0 0 0 3px rgba(82, 127, 165, 0.1);
        }

        .form-group input::placeholder {
            color: #a7b0bb;
        }

        /* Password input */

        .password-wrapper {
            position: relative;
            width: 100%;
        }

        .password-wrapper input {
            display: block;
            width: 100%;
            padding-right: 78px;
        }

        .password-wrapper .show-password {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            display: flex;
            align-items: center;
            justify-content: center;
            width: auto;
            height: 32px;
            padding: 0 9px;
            margin: 0;
            border: none;
            border-radius: 5px;
            background: transparent;
            color: var(--blue);
            font-size: 12px;
            font-weight: 700;
            line-height: 1;
            cursor: pointer;
            z-index: 2;
        }

        .password-wrapper .show-password:hover {
            background: #eaf4fc;
        }

        .password-wrapper .show-password:focus-visible {
            outline: 2px solid var(--blue);
            outline-offset: 2px;
        }

        .field-error {
            display: block;
            color: var(--danger);
            font-size: 11px;
            margin-top: 7px;
        }

        .form-options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 10px;
            margin: 5px 0 25px;
        }

        .remember {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 12px;
            color: var(--muted);
            cursor: pointer;
        }

        .remember input {
            accent-color: var(--navy);
        }

        .forgot {
            color: var(--blue);
            font-size: 11px;
            font-weight: 700;
        }

        .forgot:hover {
            text-decoration: underline;
        }

        .submit-button {
            width: 100%;
            height: 48px;
            border: none;
            border-radius: 6px;
            background: var(--navy);
            color: white;
            font-size: 13px;
            font-weight: 700;
            cursor: pointer;
            transition: background .2s, transform .2s;
        }

        .submit-button:hover {
            background: var(--navy-dark);
            transform: translateY(-1px);
        }

        .register-text {
            text-align: center;
            font-size: 12px;
            color: var(--muted);
            margin-top: 25px;
        }

        .register-text a {
            color: var(--navy);
            font-weight: 700;
        }

        .register-text a:hover {
            color: var(--blue);
        }

        .alert {
            padding: 12px 14px;
            border-radius: 6px;
            font-size: 12px;
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

            .login-card {
                padding: 30px 23px;
            }

            .heading h1 {
                font-size: 26px;
            }

            .form-options {
                flex-wrap: wrap;
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

        <a href="{{ route('register') }}" class="nav-link">
            Create an account
        </a>

    </header>

    <main class="page">

        <div class="login-container">

            <section class="login-card">

                <div class="heading">
                    <small>Welcome Back</small>

                    <h1>Log in to CampusCare</h1>

                    <p>
                        Enter your account details to access
                        your student services.
                    </p>
                </div>

                <!-- Session Status -->
                @if (session('status'))
                    <div class="alert alert-success" role="status">
                        {{ session('status') }}
                    </div>
                @endif

                <!-- Login Errors -->
                @if ($errors->any())
                    <div class="alert alert-error" role="alert">
                        Please check your login details
                        and try again.
                    </div>
                @endif

                <!-- Login Form -->
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Email or Student ID -->
                    <div class="form-group">
                        <label for="login">
                            Email Address or Student ID
                        </label>

                        <input
                            type="text"
                            id="login"
                            name="login"
                            value="{{ old('login') }}"
                            placeholder="Enter your email or Student ID"
                            autocomplete="username"
                            required
                            autofocus
                        >

                        @error('login')
                            <span class="field-error">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="form-group">
                        <label for="password">Password</label>

                        <div class="password-wrapper">
                            <input
                                id="password"
                                type="password"
                                name="password"
                                placeholder="Enter your password"
                                required
                                autocomplete="current-password"
                            >

                            <button
                                type="button"
                                class="show-password"
                                onclick="togglePassword()"
                                id="passwordToggle"
                                aria-label="Show password"
                                aria-pressed="false"
                            >
                                Show
                            </button>
                        </div>

                        @error('password')
                            <span class="field-error">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <!-- Remember Me and Forgot Password -->
                    <div class="form-options">

                        <label class="remember">
                            <input
                                type="checkbox"
                                name="remember"
                                value="1"
                                {{ old('remember') ? 'checked' : '' }}
                            >

                            Remember me
                        </label>

                        <a
                            href="{{ route('password.request') }}"
                            class="forgot"
                        >
                            Forgot password?
                        </a>

                    </div>

                    <button type="submit" class="submit-button">
                        Log In
                    </button>

                </form>

                <div class="register-text">
                    Don't have an account?

                    <a href="{{ route('register') }}">
                        Create one
                    </a>
                </div>

            </section>

            <footer class="footer">
                © {{ date('Y') }} CampusCare. All rights reserved.
            </footer>

        </div>

    </main>

    <script>
        function togglePassword() {
            const password = document.getElementById('password');
            const toggle = document.getElementById('passwordToggle');

            const isHidden = password.type === 'password';

            password.type = isHidden ? 'text' : 'password';

            toggle.textContent = isHidden ? 'Hide' : 'Show';

            toggle.setAttribute(
                'aria-pressed',
                String(isHidden)
            );

            toggle.setAttribute(
                'aria-label',
                isHidden ? 'Hide password' : 'Show password'
            );
        }
    </script>

</body>
</html>
