<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Provider Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: #f0f4ff;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-wrapper {
            max-width: 1000px;
            width: 100%;
            display: flex;
            gap: 30px;
        }
        .left-section, .right-section {
            flex: 1;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 10px 40px rgba(0,0,0,0.08);
        }
        .left-section {
            background: white;
            padding: 50px;
        }
        .left-section h2 {
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 10px;
        }
        .left-section .subtitle {
            color: #6b7280;
            margin-bottom: 30px;
        }
        .form-control {
            border-radius: 12px;
            padding: 12px;
            margin-bottom: 15px;
        }
        .btn-login {
            background: linear-gradient(135deg, #00d4aa, #00b894);
            color: #fff;
            border-radius: 12px;
            padding: 14px;
            width: 100%;
            border: none;
            font-weight: 600;
        }
        .login-link {
            text-align: center;
            margin-top: 15px;
        }
        .right-section {
            background-image: url("/images/provider_register.png"); /* your image path */
            background-size: cover;
            background-position: center;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 600px;
        }
        .right-section::before {
            content: '';
            position: absolute;
            inset: 0;
            background: rgba(0,0,0,0.45);
        }
        .right-section-content {
            position: relative;
            z-index: 2;
            text-align: center;
            color: #fff;
            padding: 20px;
        }
        .right-section-content h1 {
            font-size: 42px;
            font-weight: 700;
        }
        .right-section-content p {
            font-size: 16px;
            opacity: 0.9;
        }
        @media(max-width: 992px){
            .login-wrapper {
                flex-direction: column;
            }
            .right-section {
                min-height: 300px;
            }
        }
    </style>
</head>
<body>

<div class="login-wrapper">

    <!-- LEFT FORM -->
    <div class="left-section">
        <h2>Provider Login</h2>
        <p class="subtitle">Access your account and manage your services</p>

        <!-- Show errors -->
        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('provider.login.store') }}">
            @csrf
            <input type="email" name="email" class="form-control" placeholder="Email" value="{{ old('email') }}" required>
            <input type="password" name="password" class="form-control" placeholder="Password" required>
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" name="remember" id="remember">
                <label class="form-check-label" for="remember">Remember Me</label>
            </div>
            <button type="submit" class="btn-login">Login</button>
        </form>

        <div class="login-link">
            Don't have an account? <a href="{{ route('provider.register') }}">Register</a>
        </div>
    </div>

    <!-- RIGHT IMAGE -->
    <div class="right-section">
        <div class="right-section-content">
            <h1>Services. Providers. Excellence.</h1>
            <p>Connect with customers and grow your service business</p>
        </div>
    </div>

</div>

</body>
</html>
