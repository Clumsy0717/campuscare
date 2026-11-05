
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Create Account | CampusCare</title>

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
            padding: 45px 20px;
        }

        .register-container {
            width: 100%;
            max-width: 470px;
        }

        .register-card {
            background: white;
            padding: 40px;
            border: 1px solid var(--border);
            border-radius: 11px;
            box-shadow: 0 15px 45px rgba(25, 54, 83, 0.045);
        }

        .heading {
            margin-bottom: 29px;
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
            color: var(--muted);
            font-size: 13px;
            line-height: 1.7;
        }

        .form-group {
            margin-bottom: 19px;
        }

        .form-group label {
            display: block;
            font-size: 12px;
            font-weight: 700;
            margin-bottom: 9px;
        }

        .form-group input {
            width: 100%;
            height: 46px;
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

        /* Password fields */

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
            top: 50%;
            right: 12px;
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

        /* Password requirements */

        .password-requirements {
            margin-top: 12px;
            font-size: 12px;
            color: #64748b;
        }

        .password-requirements p {
            margin-bottom: 9px;
            font-weight: 600;
        }

        .password-requirements ul {
            list-style: none;
            padding: 0;
        }

        .password-requirements li {
            margin-bottom: 7px;
            line-height: 1.5;
        }

        .password-requirements li::before {
            content: "○";
            display: inline-block;
            width: 19px;
            color: #94a3b8;
        }

        .password-requirements li.valid {
            color: #198754;
        }

        .password-requirements li.valid::before {
            content: "✓";
            color: #198754;
        }

        .field-error {
            display: block;
            color: var(--danger);
            font-size: 11px;
            margin-top: 7px;
        }

        .error-summary {
            padding: 12px 14px;
            background: #fff0f0;
            border: 1px solid #f1d0d0;
            border-radius: 6px;
            color: #a53239;
            font-size: 12px;
            margin-bottom: 20px;
        }

        .submit-button {
            width: 100%;
            height: 48px;
            margin-top: 5px;
            border: none;
            border-radius: 6px;
            background: var(--navy);
            color: white;
            font-size: 13px;
            font-weight: 700;
            cursor: pointer;
            transition: .2s;
        }

        .submit-button:hover {
            background: var(--navy-dark);
        }

        .login-text {
            text-align: center;
            color: var(--muted);
            font-size: 12px;
            margin-top: 25px;
        }

        .login-text a {
            color: var(--navy);
            font-weight: 700;
        }

        .login-text a:hover {
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

            .register-card {
                padding: 30px 23px;
            }

            .heading h1 {
                font-size: 26px;
            }
        }
    </style>
</head>

<body>

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
            Already registered? Log in
        </a>

    </header>

    <main class="page">

        <div class="register-container">

            <section class="register-card">

                <div class="heading">
                    <small>Student Registration</small>

                    <h1>Create your account</h1>

                    <p>
                        Enter your student information to get started
                        with CampusCare.
                    </p>
                </div>

                @if ($errors->any())
                    <div class="error-summary" role="alert">
                        Please correct the highlighted fields
                        and try again.
                    </div>
                @endif

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <!-- Full Name -->
                    <div class="form-group">
                        <label for="name">Full Name</label>

                        <input
                            id="name"
                            type="text"
                            name="name"
                            value="{{ old('name') }}"
                            placeholder="Enter your full name"
                            required
                            autofocus
                            autocomplete="name"
                        >

                        @error('name')
                            <span class="field-error">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="form-group">
                        <label for="email">Email Address</label>

                        <input
                            type="email"
                            id="email"
                            name="email"
                            value="{{ old('email') }}"
                            placeholder="Enter your email address"
                            autocomplete="email"
                            required
                        >

                        @error('email')
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
                                type="password"
                                id="password"
                                name="password"
                                autocomplete="new-password"
                                placeholder="Create a password"
                                aria-describedby="password-requirements"
                                required
                            >

                            <button
                                type="button"
                                class="show-password"
                                onclick="togglePassword('password', this)"
                                aria-label="Show password"
                                aria-pressed="false"
                            >
                                Show
                            </button>
                        </div>

                        <div
                            class="password-requirements"
                            id="password-requirements"
                        >
                            <p>Password must contain:</p>

                            <ul>
                                <li id="length">
                                    At least 8 characters
                                </li>

                                <li id="uppercase">
                                    One uppercase letter (A-Z)
                                </li>

                                <li id="lowercase">
                                    One lowercase letter (a-z)
                                </li>

                                <li id="number">
                                    One number (0-9)
                                </li>

                                <li id="symbol">
                                    One special character (!@#$%)
                                </li>
                            </ul>
                        </div>

                        @error('password')
                            <span class="field-error">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <!-- Confirm Password -->
                    <div class="form-group">
                        <label for="password_confirmation">
                            Confirm Password
                        </label>

                        <div class="password-wrapper">
                            <input
                                type="password"
                                id="password_confirmation"
                                name="password_confirmation"
                                autocomplete="new-password"
                                placeholder="Confirm your password"
                                required
                            >

                            <button
                                type="button"
                                class="show-password"
                                onclick="togglePassword('password_confirmation', this)"
                                aria-label="Show confirm password"
                                aria-pressed="false"
                            >
                                Show
                            </button>
                        </div>
                    </div>

                    <button type="submit" class="submit-button">
                        Create Account
                    </button>

                </form>

                <div class="login-text">
                    Already have an account?
                    <a href="{{ route('login') }}">Log in</a>
                </div>

            </section>

            <footer class="footer">
                © {{ date('Y') }} CampusCare. All rights reserved.
            </footer>

        </div>

    </main>

    <script>
        function togglePassword(inputId, button) {
            const input = document.getElementById(inputId);

            if (!input) return;

            const showPassword = input.type === 'password';

            input.type = showPassword ? 'text' : 'password';

            button.textContent = showPassword ? 'Hide' : 'Show';

            button.setAttribute(
                'aria-pressed',
                String(showPassword)
            );

            button.setAttribute(
                'aria-label',
                (showPassword ? 'Hide ' : 'Show ') +
                (inputId === 'password_confirmation'
                    ? 'confirm password'
                    : 'password')
            );
        }

        // Live password requirements
        const passwordInput = document.getElementById('password');

        function updatePasswordRequirements() {
            const password = passwordInput.value;

            const requirements = {
                length: password.length >= 8,
                uppercase: /[A-Z]/.test(password),
                lowercase: /[a-z]/.test(password),
                number: /[0-9]/.test(password),
                symbol: /[^A-Za-z0-9]/.test(password)
            };

            Object.keys(requirements).forEach(function (key) {
                const item = document.getElementById(key);

                if (item) {
                    item.classList.toggle(
                        'valid',
                        requirements[key]
                    );
                }
            });
        }

        passwordInput.addEventListener(
            'input',
            updatePasswordRequirements
        );

        updatePasswordRequirements();
    </script>

</body>
</html>
