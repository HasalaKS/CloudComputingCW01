<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

<div class="container my-5">
    <!-- Header Section -->
    <div class="text-center mb-4">
        <h1 class="fw-bold text-success" style="font-family: 'Roboto', sans-serif;">S3 Bucket File Upload</h1>
        <p class="text-muted">Log in to manage your files</p>
    </div>

    <!-- Login Form -->
    <div class="card shadow-sm border mb-5" style="border-color: #ddd;">
        <div class="card-body p-4" style="background-color: #e0e0e0;">
            <h4 class="card-title mb-4 text-dark" style="font-family: 'Roboto', sans-serif;">Login</h4>
            <form action="{{ url('/login') }}" method="POST">
                {{ csrf_field() }}
                
                <!-- Email Input -->
                <div class="mb-3">
                    <label for="email" class="form-label fw-semibold text-dark">Email address</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>

                <!-- Password Input -->
                <div class="mb-3">
                    <label for="password" class="form-label fw-semibold text-dark">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>

                <!-- Login Button -->
                <button type="submit" class="btn w-100" style="background-color: #2e8b57; color: white;">
                    <i class="fa-solid fa-sign-in-alt me-2"></i>Login
                </button>
            </form>
        </div>
    </div>

    <!-- Footer Section -->
    <div class="text-center">
        <p class="text-muted">Don't have an account? <a href="{{ url('/register') }}" class="text-success">Sign up</a></p>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<style>
    /* Card Hover Effect */
    .card:hover {
        transform: scale(1.03);
        transition: all 0.3s ease-in-out;
    }

    /* Reduce button width and align them to the left */
    .btn {
        width: auto; /* Set the width to auto for buttons */
        height: 38px; /* Ensure the height is consistent */
    }

    /* Footer Link Style */
    a {
        text-decoration: none;
        font-weight: bold;
    }

    a:hover {
        text-decoration: underline;
    }
</style>
