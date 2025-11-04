<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>SIGNIN</title>
    <link rel="shortcut icon" href="images/spacerent.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        body {
            background: linear-gradient(to bottom right, #0f172a, #6e21a7, #0f172a);
            height: 100vh;
        }

        .card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .form-control::placeholder {
            color: #b497db;
        }

        .icon-bg {
            background-color: #7e3af2;
            width: 3rem;
            height: 3rem;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1rem;
        }

        .icon-bg svg {
            stroke: white;
            width: 1.5rem;
            height: 1.5rem;
        }

        .btn-gradient {
            background: linear-gradient(90deg, #7e3af2 0%, #ec4899 100%);
            color: white;
            border: none;
            box-shadow: 0 10px 15px -3px rgba(124, 58, 237, 0.4);
            transition: background 0.2s ease;
        }

        .btn-gradient:hover {
            background: linear-gradient(90deg, #6b21a8 0%, #db2777 100%);
            box-shadow: 0 15px 20px -5px rgba(124, 58, 237, 0.6);
            color: white;
        }

        .text-purple-200 {
            color: #c4b5fd !important;
        }

        .text-purple-300 {
            color: #a78bfa !important;
        }

        .border-white-20 {
            border-color: rgba(255, 255, 255, 0.2) !important;
        }

        .bg-transparent {
            background-color: transparent !important;
        }

        .btn-google {
            background: rgba(255, 255, 255, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: white;
            backdrop-filter: blur(10px);
            transition: all 0.3s ease;
        }

        .btn-google:hover {
            background: rgba(255, 255, 255, 0.3);
            color: #0f172a;
            transform: translateY(-2px);
        }
    </style>

</head>

<body class="d-flex align-items-center justify-content-center p-4">

    <div class="w-100" style="max-width: 540px;">
        <div class="card p-4 rounded-4 shadow-lg">
            <div class="text-center">
                <div class="icon-bg mx-auto">
                    <!-- Rocket SVG icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round" class="bi bi-rocket" viewBox="0 0 24 24"
                        aria-hidden="true">
                        <path
                            d="M4.5 16.5c-1.5 1.26-2 5-2 5s3.74-.5 5-2c.71-.84.7-2.13-.09-2.91a2.18 2.18 0 0 0-2.91-.09z">
                        </path>
                        <path
                            d="m12 15-3-3a22 22 0 0 1 2-3.95A12.88 12.88 0 0 1 22 2c0 2.72-.78 7.5-6 11a22.35 22.35 0 0 1-4 2z">
                        </path>
                        <path d="M9 12H4s.55-3.03 2-4c1.62-1.08 5 0 5 0"></path>
                        <path d="M12 15v5s3.03-.55 4-2c1.08-1.62 0-5 0-5"></path>
                    </svg>
                </div>
                <h1 class="h3 text-white mb-2">Welcome Back</h1>
                <p class="text-purple-200 mb-4">Sign in to your Space Rent account</p>
            </div>
            <form>
                <div class="mb-3">
                    <label for="email" class="form-label text-purple-200">Email</label>
                    <div class="input-group">
                        <span class="input-group-text bg-transparent border border-white-20 text-purple-300">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round" class="bi bi-envelope" width="16"
                                height="16" viewBox="0 0 24 24" aria-hidden="true">
                                <path d="m22 7-8.991 5.727a2 2 0 0 1-2.009 0L2 7"></path>
                                <rect x="2" y="4" width="20" height="16" rx="2"></rect>
                            </svg>
                        </span>
                        <input type="email" class="form-control bg-transparent border border-white-20 text-white"
                            id="email" placeholder="Enter your email" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label text-purple-200">Password</label>
                    <div class="input-group">
                        <span class="input-group-text bg-transparent border border-white-20 text-purple-300">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round" class="bi bi-lock" width="16" height="16"
                                viewBox="0 0 24 24" aria-hidden="true">
                                <rect width="18" height="11" x="3" y="11" rx="2" ry="2"></rect>
                                <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                            </svg>
                        </span>
                        <input type="password" class="form-control bg-transparent border border-white-20 text-white"
                            id="password" placeholder="Enter your password" required>
                    </div>
                </div>
                <!-- <div class="d-flex justify-content-between align-items-center mb-3 text-purple-200">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="rememberMe">
                        <label class="form-check-label" for="rememberMe">
                            Remember me
                        </label>
                    </div>
                    <a href="#" class="text-purple-300 text-decoration-none">Forgot password?</a>
                </div> -->
                <button type="submit" class="btn btn-gradient w-100 fw-semibold">Sign In</button>
            </form>
            <div class="text-center mt-4 text-purple-200">
                <p>Don't have an account? <a href="register.php"
                        class="text-purple-300 fw-semibold text-decoration-none">Sign up</a></p>
            </div>
            <!-- Google Sign In button -->
            <button type="button"
                class="btn btn-google w-100 fw-semibold d-flex align-items-center justify-content-center gap-2">
                <img src="https://www.svgrepo.com/show/355037/google.svg" width="20" height="20" alt="Google logo">
                Sign in with Google
            </button>
        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            $("form").on("submit", function (e) {
                e.preventDefault();

                const email = $("#email").val().trim();
                const password = $("#password").val().trim();

                if (!email || !password) {
                    alert("Please enter both email and password.");
                    return;
                }

                $.ajax({
                    url: "api/login.php", // backend PHP file
                    type: "POST",
                    dataType: "json",
                    data: { email: email, password: password },
                    success: function (response) {
                        alert(response.message);
                        if (response.status === "success") {
                            // redirect to dashboard after 1.5s
                            setTimeout(() => window.location.href = "browse_spaces.php", 1500);
                        }
                    },
                    error: function () {
                        alert("Server error. Please try again later.");
                    }
                });
            });
        });
    </script>

</body>

</html>