<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>SIGNUP</title>
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
    </style>
</head>

<body class="d-flex align-items-center justify-content-center p-4">

    <div class="w-100" style="max-width: 540px;">
        <div class="card p-4 rounded-4 shadow-lg">
            <div class="text-center">
                <div class="icon-bg mx-auto">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round" class="bi bi-person-plus" viewBox="0 0 24 24"
                        aria-hidden="true">
                        <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                        <circle cx="9" cy="7" r="4"></circle>
                        <line x1="19" y1="8" x2="19" y2="14"></line>
                        <line x1="16" y1="11" x2="22" y2="11"></line>
                    </svg>
                </div>
                <h1 class="h3 text-white mb-2">Create Account</h1>
                <p class="text-purple-200 mb-4">Join Space Rent and start your journey</p>
            </div>

            <form>
                <div class="mb-3">
                    <label for="name" class="form-label text-purple-200">Full Name</label>
                    <div class="input-group">
                        <span class="input-group-text bg-transparent border border-white-20 text-purple-300">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round" class="bi bi-person" width="16"
                                height="16" viewBox="0 0 24 24" aria-hidden="true">
                                <circle cx="12" cy="7" r="4"></circle>
                                <path d="M5.5 21a7.5 7.5 0 0 1 13 0"></path>
                            </svg>
                        </span>
                        <input type="text" class="form-control bg-transparent border border-white-20 text-white"
                            id="name" placeholder="Enter your full name" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="mobile" class="form-label text-purple-200">Mobile Number</label>
                    <div class="input-group">
                        <span class="input-group-text bg-transparent border border-white-20 text-purple-300">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="bi bi-telephone" viewBox="0 0 24 24" aria-hidden="true">
                                <path
                                    d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.49 19.49 0 0 1-6.7-6.7A19.79 19.79 0 0 1 2 4.18V2a2 2 0 0 1 2-2 16.5 16.5 0 0 1 4.5 0 2 2 0 0 1 2 2.5a13.2 13.2 0 0 1-.7 3.5a2 2 0 0 1 1.7 1.7 13.2 13.2 0 0 1 3.5-.7 2 2 0 0 1 2.5 2 16.5 16.5 0 0 1 0 4.5z" />
                            </svg>
                        </span>
                        <input type="tel" class="form-control bg-transparent border border-white-20 text-white"
                            id="mobile" placeholder="Enter your mobile number" required>
                    </div>
                </div>

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
                            id="password" placeholder="Create a password" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="confirmPassword" class="form-label text-purple-200">Confirm Password</label>
                    <div class="input-group">
                        <span class="input-group-text bg-transparent border border-white-20 text-purple-300">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round" class="bi bi-lock-check" width="16"
                                height="16" viewBox="0 0 24 24" aria-hidden="true">
                                <rect width="18" height="11" x="3" y="11" rx="2" ry="2"></rect>
                                <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                                <path d="m9 16 2 2 4-4"></path>
                            </svg>
                        </span>
                        <input type="password" class="form-control bg-transparent border border-white-20 text-white"
                            id="confirmPassword" placeholder="Confirm your password" required>
                    </div>
                </div>

                <button type="submit" class="btn btn-gradient w-100 fw-semibold mt-2">Sign Up</button>
            </form>

            <div class="text-center mt-4 text-purple-200">
                <p>Already have an account? <a href="login.php"
                        class="text-purple-300 fw-semibold text-decoration-none">Sign in</a></p>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {

            $("form").on("submit", function (e) {
                e.preventDefault();

                const name = $("#name").val().trim();
                const mobile = $("#mobile").val().trim(); // NEW
                const email = $("#email").val().trim();
                const password = $("#password").val().trim();
                const confirmPassword = $("#confirmPassword").val().trim();

                if (!name || !mobile || !email || !password || !confirmPassword) { // UPDATED CHECK
                    alert("All fields are required.");
                    return;
                }
                if (password !== confirmPassword) {
                    alert("Passwords do not match.");
                    return;
                }

                $.ajax({
                    url: "api/register.php",
                    type: "POST",
                    dataType: "json",
                    data: {
                        name: name,
                        mobile: mobile, // NEW
                        email: email,
                        password: password,
                        confirmPassword: confirmPassword
                    },
                    success: function (response) {
                        alert(response.message);
                        if (response.status === "success") {
                            $("form")[0].reset();
                            setTimeout(() => window.location.href = "login.php", 1500);
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