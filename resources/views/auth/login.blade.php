@extends('layouts.app')

@section('content')
    <style>
        .login-page {
            min-height: 100vh;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            background: url('/images/Hero.png') no-repeat center center;
            background-size: cover;
        }

        .login-page::before {
            content: "";
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg,
                    rgba(250, 247, 244, 0.95) 0%,
                    rgba(250, 247, 244, 0.7) 40%,
                    rgba(250, 247, 244, 0.3) 70%,
                    rgba(250, 247, 244, 0.1) 100%);
            z-index: 1;
        }

        /* Header overlay */
        .login-header {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            z-index: 20;
            padding: 20px 40px;
        }

        .login-logo {
            font-weight: 900;
            letter-spacing: 2px;
            font-size: 17px;
            color: #2b2b2b;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .login-logo img {
            height: 36px;
            width: auto;
        }

        .login-nav {
            display: flex;
            gap: 28px;
            align-items: center;
        }

        .login-nav a {
            font-size: 13px;
            font-weight: 500;
            color: #2b2b2b;
            text-decoration: none;
            letter-spacing: 0.5px;
            transition: opacity 0.2s;
        }

        .login-nav a:hover {
            opacity: 0.6;
        }

        .login-nav a.active {
            border-bottom: 2px solid #2b2b2b;
            padding-bottom: 2px;
        }

        /* Login panel */
        .login-panel {
            position: relative;
            z-index: 10;
            background: rgba(255, 255, 255, 0.92);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(0, 0, 0, 0.08);
            border-radius: 16px;
            padding: 44px 40px;
            width: 100%;
            max-width: 420px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.08);
            animation: panelFadeUp 0.6s ease forwards;
            opacity: 0;
            transform: translateY(20px);
        }

        @keyframes panelFadeUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .login-panel .panel-title {
            font-family: 'Playfair Display', serif;
            font-size: 28px;
            font-weight: 800;
            color: #2b2b2b;
            margin-bottom: 28px;
            letter-spacing: 0.3px;
        }

        .form-group {
            margin-bottom: 18px;
        }

        .form-group label {
            display: block;
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
            color: #6b655f;
            margin-bottom: 8px;
        }

        .form-group input {
            width: 100%;
            padding: 13px 16px;
            border: 1.5px solid #e0d8d0;
            border-radius: 10px;
            font-size: 14px;
            font-family: 'Inter', sans-serif;
            color: #2b2b2b;
            background: #fff;
            transition: border-color 0.25s, box-shadow 0.25s;
            outline: none;
        }

        .form-group input:focus {
            border-color: #2b2b2b;
            box-shadow: 0 0 0 3px rgba(43, 43, 43, 0.08);
        }

        .form-group input::placeholder {
            color: #b0a89e;
        }

        .forgot-row {
            display: flex;
            justify-content: flex-end;
            margin-bottom: 24px;
        }

        .forgot-row a {
            font-size: 12px;
            color: #6b655f;
            text-decoration: none;
            transition: color 0.2s;
        }

        .forgot-row a:hover {
            color: #2b2b2b;
        }

        .btn-login {
            width: 100%;
            padding: 14px;
            background: #2b2b2b;
            color: #fff;
            border: none;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 700;
            font-family: 'Inter', sans-serif;
            letter-spacing: 1px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-login:hover {
            background: #111;
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        .divider {
            display: flex;
            align-items: center;
            gap: 16px;
            margin: 24px 0;
            color: #b0a89e;
            font-size: 12px;
        }

        .divider::before,
        .divider::after {
            content: "";
            flex: 1;
            height: 1px;
            background: #e0d8d0;
        }

        .social-login {
            display: flex;
            gap: 10px;
            margin-bottom: 24px;
        }

        .social-btn {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 11px;
            border: 1.5px solid #e0d8d0;
            border-radius: 10px;
            font-size: 12px;
            font-weight: 500;
            color: #2b2b2b;
            background: #fff;
            text-decoration: none;
            cursor: pointer;
            transition: all 0.25s ease;
        }

        .social-btn:hover {
            border-color: #2b2b2b;
            background: #faf7f4;
            transform: translateY(-1px);
        }

        .social-btn img {
            width: 18px;
            height: 18px;
        }

        .register-row {
            text-align: center;
            margin-top: 20px;
            font-size: 13px;
            color: #6b655f;
        }

        .register-row a {
            color: #2b2b2b;
            font-weight: 600;
            text-decoration: none;
            margin-left: 4px;
            transition: opacity 0.2s;
        }

        .register-row a:hover {
            opacity: 0.7;
        }

        @media (max-width: 768px) {
            .login-page {
                justify-content: center;
            }

            .login-panel {
                margin: 0 20px;
                max-width: 100%;
            }

            .login-header {
                padding: 16px 20px;
            }

            .login-nav {
                display: none;
            }
        }
    </style>

    <div class="login-page">


        {{-- Login panel --}}
        <div class="login-panel">
            <h2 class="panel-title">Login Your Account</h2>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="form-group">
                    <label for="email">Email / Username</label>
                    <input id="email" type="text" name="email" value="{{ old('email') }}"
                        placeholder="Email or Username" required autocomplete="email" autofocus>
                    @error('email')
                        <span style="color:#d00;font-size:12px;margin-top:4px;display:block;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input id="password" type="password" name="password" placeholder="Enter your password" minlength="3"
                        required autocomplete="current-password">
                    @error('password')
                        <span style="color:#d00;font-size:12px;margin-top:4px;display:block;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="forgot-row">
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}">Forgot Password?</a>
                    @endif
                </div>

                <button type="submit" class="btn-login">LOGIN</button>
            </form>

            <div class="register-row">
                Don't Have Account?
                <a href="{{ route('register') }}">Sign Up</a>
            </div>
        </div>
    </div>
@endsection
