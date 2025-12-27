<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Service Provider Registration</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body {
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    background: linear-gradient(135deg, #f0f4ff 0%, #e8f5e9 100%);
    margin: 0;
    min-height: 100vh;
}

.registration-wrapper {
    display: flex;
    align-items: stretch; /* Make children stretch */
    min-height: 100vh;
    padding: 40px 20px;
}

.left-section, .right-section {
    display: flex;
    flex-direction: column;
    justify-content: center;
    border-radius: 24px;
}

.left-section {
    background: #fff;
    padding: 50px;
    box-shadow: 0 10px 40px rgba(0,0,0,0.08);
}

.right-section {
    position: relative;
    background-image: url("/images/provider_register.png"); /* replace with your image path */
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    min-height: 600px;
    flex: 1;
}

/* Overlay */
.right-section::before {
    content: '';
    position: absolute;
    inset: 0;
    background: rgba(0,0,0,0.45);
    border-radius: 24px;
}

.right-section-content {
    position: relative;
    z-index: 2;
    color: #fff;
    text-align: center;
    padding: 40px;
}

.right-section-content h1 {
    font-size: 48px;
    font-weight: 700;
}

.right-section-content p {
    font-size: 16px;
    opacity: 0.9;
}

/* Responsive */
@media (max-width: 991px) {
    .registration-wrapper {
        flex-direction: column;
        padding: 20px 15px;
    }

    .right-section {
        min-height: 300px;
        margin-top: 30px;
    }

    .right-section-content h1 {
        font-size: 32px;
    }

    .right-section-content p {
        font-size: 14px;
    }
}

@media (max-width: 576px) {
    .left-section {
        padding: 20px;
    }

    .right-section {
        min-height: 250px;
    }

    .right-section-content h1 {
        font-size: 28px;
    }

    .right-section-content p {
        font-size: 13px;
    }
}
</style>
</head>

<body>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="container-fluid registration-wrapper">

    <!-- LEFT: Form -->
    <div class="col-lg-6 left-section">
        <div class="logo-section d-flex align-items-center gap-3 mb-4">
            <div class="logo-icon" style="width:50px;height:50px;border-radius:12px;background:linear-gradient(135deg,#00d4aa,#00b894);color:white;display:flex;align-items:center;justify-content:center;font-weight:bold;font-size:24px;">S</div>
            <div class="logo-text fw-bold" style="font-size:24px;">Register</div>
        </div>

        <h2>Service Provider Registration</h2>
        <p class="subtitle">Join our platform and start providing your services</p>

        <!-- FORM -->
        <form method="POST" action="{{ route('provider.register.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="row g-3">
                <div class="col-md-6"><label>Full Name *</label><input type="text" name="name" class="form-control" required></div>
                <div class="col-md-6"><label>Email *</label><input type="email" name="email" class="form-control" required></div>
                <div class="col-md-6"><label>Phone *</label><input type="text" name="phone" class="form-control" required></div>
                <div class="col-md-6"><label>Aadhaar Number *</label><input type="text" name="aadhaar_number" maxlength="12" class="form-control" required></div>
                <div class="col-md-6"><label>Bank Account *</label><input type="text" name="bank_account_number" class="form-control" required></div>
                <div class="col-md-6"><label>Profile Image</label><input type="file" name="profile_image" class="form-control"></div>
                <div class="col-md-6"><label>Password *</label><input type="password" name="password" class="form-control" required></div>
                <div class="col-md-6"><label>Confirm Password *</label><input type="password" name="password_confirmation" class="form-control" required></div>
                <div class="col-12">
                    <div class="form-check"><input class="form-check-input" type="checkbox" name="terms" required><label>I agree to Terms & Conditions</label></div>
                </div>
                <div class="col-12"><button type="submit" class="btn btn-success w-100">Register as Provider</button></div>
            </div>
        </form>

        <div class="mt-3 text-center">Already have an account? <a href="{{ route('provider.login') }}">Login</a></div>
    </div>

    <!-- RIGHT: Image -->
    <div class="col-lg-6 right-section">
        <div class="right-section-content">
            <h1>Services. Providers. Excellence.</h1>
            <p>Connect with customers and grow your service business</p>
        </div>
    </div>
</div>
</body>
</html>
