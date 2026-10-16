<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Autentikasi') </title>
    <link rel="icon"type="image/x-icon"href="{{ asset('favicon/favicon.ico') }}?v=1">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css"
    >

    <!-- Boxicons untuk toggle password -->
    <link
        rel="stylesheet"
        href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css"
    >

    <style>
        /* =========================
           GLOBAL
        ========================= */

        * {
            box-sizing: border-box;
        }

        :root {
            --primary: #2769A8;
            --primary-dark: #1F568B;
            --primary-light: #E8F3FF;
            --primary-border: #C9E0F8;

            --text: #243047;
            --text-muted: #687386;
            --border: #DCE3ED;
            --surface: #FFFFFF;
            --background: #F4F7FB;

            --success-bg: #E7F7ED;
            --success-text: #176B38;

            --error-bg: #FFF0F0;
            --error-text: #A4262C;
        }

        body {
            min-height: 100vh;
            margin: 0;
            padding: 1px 0;
            background: var(--background);
            color: var(--text);
            font-family: 'Poppins', sans-serif;
            font-size: 14px;
            -webkit-font-smoothing: antialiased;
        }

        a {
            -webkit-tap-highlight-color: transparent;
        }

        button,
        input,
        textarea {
            font: inherit;
        }

        /* =========================
           LAYOUT
        ========================= */

        .container {
            width: 100%;
            max-width: 520px;
            margin: 45px auto;
            padding: 0 18px;
        }

        .card {
            width: 100%;
            padding: 28px;
            border: 1px solid rgba(220, 227, 237, 0.75);
            border-radius: 16px;
            background: var(--surface);
            box-shadow: 0 6px 24px rgba(36, 48, 71, 0.07);
        }

        h1,
        h2 {
            color: var(--text);
        }

        h1 {
            margin-top: 0;
            margin-bottom: 8px;
            font-size: 26px;
        }

        .subtitle {
            color: var(--text-muted);
            margin-bottom: 24px;
            line-height: 1.7;
        }

        /* =========================
           GENERAL FORM
        ========================= */

        .form-group {
            margin-bottom: 16px;
        }

        .form-group label,
        label {
            display: block;
            margin-bottom: 7px;
            font-weight: 600;
        }

        input,
        textarea {
            width: 100%;
            padding: 11px 12px;
            border: 1px solid #CCD3DF;
            border-radius: 8px;
            background: #FFFFFF;
            color: var(--text);
            font-size: 14px;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        textarea {
            min-height: 95px;
            resize: vertical;
        }

        input:focus,
        textarea:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(39, 105, 168, 0.10);
        }

        input::placeholder,
        textarea::placeholder {
            color: #A0AABA;
        }

        /* =========================
           GENERAL BUTTON
        ========================= */

        .btn {
            display: block;
            width: 100%;
            padding: 12px 16px;
            border: 0;
            border-radius: 9px;
            background: var(--primary);
            color: #FFFFFF;
            text-align: center;
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s, transform 0.2s;
        }

        .btn:hover {
            background: var(--primary-dark);
        }

        .btn:focus-visible {
            outline: 2px solid var(--primary);
            outline-offset: 3px;
        }

        /* =========================
           GENERAL LINKS
        ========================= */

        .link {
            color: var(--primary);
            text-decoration: none;
        }

        .link:hover {
            text-decoration: underline;
        }

        .footer {
            margin-top: 20px;
            text-align: center;
            font-size: 13px;
        }

        /* =========================
           GENERAL ALERTS
        ========================= */

        .alert-success {
            margin-bottom: 16px;
            padding: 12px 14px;
            border: 1px solid #C5E8D0;
            border-radius: 9px;
            background: var(--success-bg);
            color: var(--success-text);
            font-size: 13px;
            line-height: 1.6;
        }

        .alert-error {
            margin-bottom: 16px;
            padding: 12px 14px;
            border: 1px solid #F0CACA;
            border-radius: 9px;
            background: var(--error-bg);
            color: var(--error-text);
            font-size: 13px;
            line-height: 1.6;
        }

        .field-error {
            margin-top: 5px;
            color: var(--error-text);
            font-size: 12px;
        }

        /* =========================
           REGISTER ACCOUNT CHOICE
        ========================= */

        .register-header {
            margin-bottom: 28px;
            text-align: center;
        }

        .brand-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 64px;
            height: 64px;
            margin: 0 auto 12px;
            border-radius: 18px;
            background: var(--primary-light);
            color: var(--primary);
            font-size: 30px;
        }

        .brand-name {
            margin: 0 0 24px;
            color: var(--primary);
            font-size: 15px;
            font-weight: 700;
            letter-spacing: 1px;
        }

        .register-header h1 {
            margin-bottom: 10px;
            font-family: 'Poppins', sans-serif;
            font-size: 27px;
            font-weight: 700;
        }

        .register-header .subtitle {
            margin-bottom: 0;
            font-size: 13px;
        }

        .account-options {
            display: flex;
            flex-direction: column;
            gap: 14px;
        }

        .account-card {
            display: flex;
            align-items: flex-start;
            gap: 16px;
            padding: 20px;
            border: 1px solid var(--border);
            border-radius: 12px;
            background: #FFFFFF;
            color: var(--text);
            text-decoration: none;
            transition: border-color 0.2s, box-shadow 0.2s,
                        transform 0.2s;
        }

        .account-card:hover {
            border-color: var(--primary);
            box-shadow: 0 5px 16px rgba(39, 105, 168, 0.10);
            transform: translateY(-2px);
        }

        .account-card:focus-visible {
            outline: 2px solid var(--primary);
            outline-offset: 3px;
        }

        .account-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            width: 52px;
            height: 52px;
            border-radius: 12px;
            font-size: 25px;
        }

        .customer-icon {
            background: var(--primary-light);
            color: var(--primary);
        }

        .merchant-icon {
            background: #FFF1DF;
            color: #946323;
        }

        .account-info {
            flex: 1;
            min-width: 0;
        }

        .account-info h2 {
            margin: 2px 0 7px;
            font-size: 18px;
            font-weight: 600;
        }

        .account-info p {
            margin: 0 0 13px;
            color: var(--text-muted);
            font-size: 13px;
            line-height: 1.7;
        }

        .account-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: var(--primary);
            font-size: 13px;
            font-weight: 700;
        }

        .account-link i {
            transition: transform 0.2s;
        }

        .account-card:hover .account-link i {
            transform: translateX(4px);
        }

        .register-footer {
            margin-top: 25px;
            padding-top: 18px;
            border-top: 1px solid #EDF0F5;
            text-align: center;
            font-size: 13px;
        }

        .register-footer p {
            margin: 0;
            color: var(--text-muted);
        }

        .register-footer a {
            color: var(--primary);
            font-weight: 600;
            text-decoration: none;
        }

        .register-footer a:hover {
            text-decoration: underline;
        }

        /* =========================
           REGISTER CUSTOMER & MERCHANT
        ========================= */

        .register-brand,
        .register-heading,
        .register-login,
        .register-back {
            text-align: center;
        }

        .register-brand {
            margin-bottom: 25px;
        }

        .register-logo {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 64px;
            height: 64px;
            margin: 0 auto 10px;
            border-radius: 18px;
            background: var(--primary-light);
            color: var(--primary);
            font-size: 30px;
        }

        .register-brand h1 {
            margin: 0;
            color: var(--primary);
            font-family: 'Poppins', sans-serif;
            font-size: 29px;
            font-weight: 700;
            letter-spacing: 0.5px;
        }

        .register-brand > p {
            margin: 4px 0 0;
            color: #5488B8;
            font-size: 9px;
            font-weight: 600;
            letter-spacing: 3px;
        }

        .brand-decoration {
            width: 44px;
            height: 2px;
            margin: 17px auto 0;
            background: #B8D7F5;
        }

        .register-heading h2 {
            margin: 0 0 8px;
            color: var(--text);
            font-family: 'Poppins', sans-serif;
            font-size: 27px;
            font-weight: 600;
        }

        .register-heading > p {
            margin: 0 0 25px;
            color: var(--text-muted);
            font-size: 12px;
            line-height: 1.8;
        }

        /* Register fields */

        .register-field {
            margin-bottom: 18px;
        }

        .register-field label {
            display: block;
            margin-bottom: 8px;
            color: #34445C;
            font-size: 12px;
            font-weight: 600;
        }

        .register-field input {
            display: block;
            width: 100%;
            height: 47px;
            padding: 0 14px;
            border: 1px solid var(--border);
            border-radius: 10px;
            outline: none;
            background: #FFFFFF;
            color: var(--text);
            font-family: 'Poppins', sans-serif;
            font-size: 12px;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        .register-field input::placeholder {
            color: #A0AABA;
        }

        .register-field input:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(39, 105, 168, 0.10);
        }

        /* Password toggle */

        .password-wrapper {
            position: relative;
        }

        .password-wrapper input {
            padding-right: 48px;
        }

        .password-toggle {
            position: absolute;
            top: 0;
            right: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 46px;
            height: 47px;
            padding: 0;
            border: 0;
            border-radius: 8px;
            background: transparent;
            color: #8794A8;
            cursor: pointer;
        }

        .password-toggle:hover {
            color: var(--primary);
        }

        .password-toggle:focus-visible {
            outline: 2px solid var(--primary);
            outline-offset: -4px;
        }

        .password-toggle i {
            font-size: 19px;
        }

        /* Register submit button */

        .btn-register {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            width: 100%;
            min-height: 48px;
            margin-top: 7px;
            padding: 12px 16px;
            border: 0;
            border-radius: 10px;
            background: var(--primary);
            color: #FFFFFF;
            font-family: 'Poppins', sans-serif;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s, transform 0.2s;
        }

        .btn-register:hover {
            background: var(--primary-dark);
            transform: translateY(-1px);
        }

        .btn-register:focus-visible {
            outline: 2px solid var(--primary);
            outline-offset: 3px;
        }

        .btn-register i {
            font-size: 15px;
        }

        /* Register links */

        .register-login {
            margin: 23px 0 0;
            color: var(--text-muted);
            font-size: 12px;
        }

        .register-back {
            margin: 15px 0 0;
            font-size: 11px;
        }

        .register-login a,
        .register-back a {
            color: var(--primary);
            font-weight: 600;
            text-decoration: none;
        }

        .register-login a:hover,
        .register-back a:hover {
            text-decoration: underline;
        }

        .register-back a {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 5px;
        }

        /* Register validation */

        .register-alert {
            display: flex;
            align-items: flex-start;
            gap: 8px;
            margin-bottom: 18px;
            padding: 12px 14px;
            border: 1px solid var(--primary-border);
            border-radius: 9px;
            background: var(--primary-light);
            color: var(--primary);
            font-size: 12px;
            line-height: 1.6;
        }

        .register-alert i {
            margin-top: 1px;
        }

        .register-error {
            display: block;
            margin-top: 6px;
            color: var(--error-text);
            font-size: 11px;
            line-height: 1.6;
        }

        /* =========================
           RESPONSIVE
        ========================= */

        @media (max-width: 480px) {
            .container {
                margin: 24px auto;
                padding: 0 14px;
            }

            .card {
                padding: 22px 18px;
                border-radius: 14px;
            }

            .register-header h1 {
                font-size: 23px;
            }

            .register-brand h1 {
                font-size: 26px;
            }

            .register-heading h2 {
                font-size: 24px;
            }

            .account-card {
                gap: 12px;
                padding: 16px;
            }

            .account-icon {
                width: 44px;
                height: 44px;
                font-size: 22px;
            }

            .account-info h2 {
                font-size: 16px;
            }

            .account-info p {
                font-size: 12px;
            }

            .account-link {
                font-size: 12px;
            }
        }

        .login-page {
            width: 100%;
            max-width: 390px;
            margin: 0 auto;
            color: #243047;
            font-family: 'Poppins', sans-serif;
        }

        /* Identitas aplikasi */

        .login-brand {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            margin-bottom: 30px;
        }

        .login-brand-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            width: 46px;
            height: 46px;
            border-radius: 13px;
            background: #e8f3ff;
            color: #2769a8;
        }

        .login-brand-icon svg {
            width: 26px;
            height: 26px;
        }

        .login-brand-name {
            color: #243047;
            font-size: 15px;
            font-weight: 700;
            letter-spacing: -0.3px;
        }

        .login-brand-caption {
            margin-top: 3px;
            color: #8490a2;
            font-size: 10px;
        }

        /* Judul */

        .login-heading {
            margin-bottom: 28px;
            text-align: center;
        }

        .login-heading .auth-title {
            margin: 0 0 9px;
            color: #202d43;
            font-size: 28px;
            font-weight: 700;
            letter-spacing: -0.7px;
            line-height: 1.4;
            text-align: center;
        }

        .login-heading p {
            margin: 0;
            color: #7a8598;
            font-size: 12px;
            line-height: 1.8;
        }

        /* Input */

        .login-field {
            margin-bottom: 20px;
        }

        .login-label {
            display: block;
            margin-bottom: 8px;
            color: #344158;
            font-size: 12px;
            font-weight: 600;
        }

        .login-input {
            display: block;
            width: 100%;
            min-height: 48px;
            padding: 12px 14px;
            border: 1px solid #dce3ed;
            border-radius: 10px;
            outline: none;
            background: #fff;
            color: #243047;
            font-family: inherit;
            font-size: 12px;
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
        }

        .login-input::placeholder {
            color: #a0a9b8;
        }

        .login-input:hover {
            border-color: #becbda;
        }

        .login-input:focus {
            border-color: #4385c3;
            box-shadow: 0 0 0 3px rgba(39, 105, 168, 0.10);
        }

        .login-input.is-invalid {
            border-color: #dc3545;
        }

        .login-input.is-invalid:focus {
            box-shadow: 0 0 0 3px rgba(220, 53, 69, 0.08);
        }

        .login-field-error {
            margin-top: 7px;
            color: #dc3545;
            font-size: 11px;
            line-height: 1.6;
        }

        /* Notifikasi status */

        .login-status {
            margin-bottom: 18px;
            padding: 12px 14px;
            border: 1px solid #ccebd5;
            border-radius: 9px;
            background: #eff9f2;
            color: #17663a;
            font-size: 12px;
            line-height: 1.7;
        }

        /* Tombol login */

        .login-submit {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            width: 100%;
            min-height: 48px;
            margin-top: 27px;
            padding: 12px 18px;
            border: 1px solid #2769a8;
            border-radius: 10px;
            background: #2769a8;
            color: #fff;
            font-family: inherit;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s ease, box-shadow 0.2s ease;
        }

        .login-submit svg {
            width: 16px;
            height: 16px;
        }

        .login-submit:hover {
            border-color: #1f568b;
            background: #1f568b;
            box-shadow: 0 5px 14px rgba(39, 105, 168, 0.16);
        }

        .login-submit:focus-visible {
            outline: 3px solid rgba(39, 105, 168, 0.22);
            outline-offset: 3px;
        }

        /* Link registrasi */

        .login-footer {
            margin-top: 24px;
            padding-top: 20px;
            border-top: 1px solid #edf0f5;
            color: #7a8598;
            font-size: 11px;
            line-height: 1.8;
            text-align: center;
        }

        .login-footer a {
            margin-left: 4px;
            color: #2769a8;
            font-weight: 600;
            text-decoration: none;
        }

        .login-footer a:hover {
            color: #1f568b;
            text-decoration: underline;
        }

        /* Tampilan layar kecil */

        @media (max-width: 480px) {
            .login-brand {
                margin-bottom: 25px;
            }

            .login-heading .auth-title {
                font-size: 25px;
            }

            .login-heading {
                margin-bottom: 24px;
            }
        }
    </style>
</head>

<body>
    <main class="container">
        <section class="card">

            @if (session('success'))
                <div class="alert-success" role="status">
                    <i class="bi bi-check-circle" aria-hidden="true"></i>
                    {{ session('success') }}
                </div>
            @endif

            @yield('content')

        </section>
    </main>

    @stack('scripts')
</body>
</html>
