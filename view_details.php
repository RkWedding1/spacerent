<?php
session_start();
include('api/db.php');

$id = $_GET['id'] ?? 0;

// Fetch rental space details
$sql = "SELECT * FROM rental_spaces WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "<h2 class='text-center mt-5'>No space found for this ID.</h2>";
    exit;
}

$space = $result->fetch_assoc();

// ✅ Fetch owner details from users table
$ownerQuery = "SELECT name, mobile, email FROM users WHERE id = ?";
$ownerStmt = $conn->prepare($ownerQuery);
$ownerStmt->bind_param("i", $space['owner_id']);
$ownerStmt->execute();
$ownerResult = $ownerStmt->get_result();
$owner = $ownerResult->fetch_assoc();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Book Your Space</title>
    <link rel="shortcut icon" href="images/spacerent.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">

    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            background: #fff;
            color: #222;
        }

        .container-main {
            max-width: 1240px;
            margin: 33px auto;
            padding: 0 16px;
        }

        .flex-lg-row {
            display: flex;
            gap: 2.5rem;
        }

        .main-image {
            width: 100%;
            height: 340px;
            object-fit: cover;
            border-radius: 14px;
        }

        .thumbnails {
            display: flex;
            gap: 7px;
            margin: 14px 0 24px;
        }

        .thumbnail {
            width: 65px;
            height: 52px;
            object-fit: cover;
            border-radius: 8px;
            cursor: pointer;
            border: 2px solid transparent;
        }

        .thumbnail.selected {
            border-color: #ff385c;
        }

        .price-block {
            background: #f7f7f7;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 2px 13px rgba(34, 34, 34, 0.06);
            position: sticky;
            top: 24px;
            min-width: 380px;
        }

        .price-block h2 {
            color: #ff385c;
            font-weight: 700;
            font-size: 1.7rem;
            margin-bottom: 20px;
        }

        .btn-book {
            background-color: #ff385c;
            color: white;
            font-weight: 700;
            width: 100%;
            padding: 14px 0;
            border: none;
            border-radius: 10px;
            margin-top: 20px;
        }

        .btn-book:hover {
            background-color: #e72c4b;
        }

        .booked-date a {
            background-color: #28a745 !important;
            color: white !important;
            border-radius: 50%;
        }

        @media (max-width: 991px) {
            .flex-lg-row {
                flex-direction: column;
            }

            .price-block {
                position: static;
                margin-top: 36px;
            }

            .main-image {
                height: 220px;
            }
        }
    </style>
    <style>
        .owner-details {
            background-color: #f9f9ff;
            padding: 15px 20px;
            border-radius: 10px;
            margin-top: 20px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
        }

        .owner-details h4 {
            color: #3b82f6;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom shadow-sm sticky-top">
        <div class="container max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <a class="navbar-brand fw-bold text-primary" href="index.php">
                <p class="mb-0"> <img src="images/spacerent.png " alt="" width="50" height="50">
                    SpaceRent</p>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link fw-semibold d-flex align-items-center" href="admin_panel.php">
                            <i class="bi bi-plus-square me-2"></i> List My Space
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-semibold d-flex align-items-center" href="browse_spaces.php">
                            <i class="bi bi-search me-2"></i> Browse Spaces
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-semibold d-flex align-items-center" href="logout.php">
                            <i class="bi bi-person-circle me-2"></i> Logout
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container-main">
        <div class="flex-lg-row">
            <!-- LEFT: Main content -->
            <div class="flex-fill">
                <!-- Main image -->
                <img src="<?= htmlspecialchars($space['image_url']) ?>" class="main-image shadow-sm" id="mainImage"
                    alt="<?= htmlspecialchars($space['space_title']) ?>" />

                <!-- Thumbnails -->
                <div class="thumbnails">
                    <?php for ($i = 1; $i <= 4; $i++):
                        $img = $space["image_$i"] ?? '';
                        if (!empty($img)): ?>
                            <img src="<?= htmlspecialchars($img) ?>" class="thumbnail <?= $i === 1 ? 'selected' : '' ?>"
                                onclick="setMainImage(this)" alt="Thumbnail <?= $i ?>" />
                        <?php endif; endfor; ?>
                </div>

                <!-- Owner Info Card -->
                <div class="card border-0 shadow-sm mt-3 p-3 rounded-4" style="background-color: #f8f9fa;">
                    <div class="card-body">
                        <h4 class="fw-semibold mb-3 text-primary">
                            <i class="bi bi-person-badge me-2 text-danger"></i> Owner Details
                        </h4>
                        <ul class="list-unstyled fs-6 mb-0">
                            <li class="mb-2">
                                <i class="bi bi-person-circle text-danger me-2"></i>
                                <strong>Name:</strong> <?= htmlspecialchars($owner['name'] ?? 'Not Available') ?>
                            </li>
                            <li class="mb-2">
                                <i class="bi bi-telephone-fill text-danger me-2"></i>
                                <strong>Mobile:</strong> <?= htmlspecialchars($owner['mobile'] ?? 'Not Available') ?>
                            </li>
                            <li class="mb-1">
                                <i class="bi bi-envelope-fill text-danger me-2"></i>
                                <strong>Email:</strong> <?= htmlspecialchars($owner['email'] ?? 'Not Available') ?>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Space Info -->
                <h2 class="fw-bold mt-4"><?= htmlspecialchars($space['space_title']) ?></h2>
                <p class="mb-2"><strong>Address:</strong> <?= htmlspecialchars($space['location_address']) ?></p>

                <?php
                $coords = htmlspecialchars($space['location_link']); // e.g., "https://www.google.com/maps?q=13.0154496,80.019456"
                ?>
                <div class="map-container mb-4">
                    <iframe src="<?= $coords ?>&output=embed" width="100%" height="400"
                        style="border:0; border-radius:12px;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>

                <!-- Price -->
                <p class="fs-4 fw-bold text-danger mb-4">
                    $<?= htmlspecialchars($space['price_day']) ?> <small class="text-muted">/ night</small>
                </p>

                <!-- About -->
                <div class="p-3 border rounded-4 shadow-sm bg-light">
                    <h4 class="fw-semibold mb-2 text-primary">
                        <i class="bi bi-info-circle-fill me-2"></i> About this space
                    </h4>
                    <p class="mb-0 text-secondary"><?= nl2br(htmlspecialchars($space['description'])) ?></p>
                </div>
            </div>


            <!-- RIGHT: Booking section -->
            <div style="width: 480px;">
                <div class="price-block">
                    <h2>$<?= htmlspecialchars($space['price_day']) ?> <small>/ night</small></h2>
                    <form id="bookingForm">
                        <div class="mb-2">
                            <label for="checkin" class="form-label">Check-in</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="bi bi-calendar-date"></i></span>
                                <input type="text" id="checkin" class="form-control" placeholder="Select check-in date"
                                    autocomplete="off" required />
                            </div>
                        </div>

                        <div class="mb-2">
                            <label for="checkout" class="form-label">Check-out</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="bi bi-calendar-check"></i></span>
                                <input type="text" id="checkout" class="form-control"
                                    placeholder="Select check-out date" autocomplete="off" required />
                            </div>
                        </div>

                        <div class="mb-2">
                            <label for="guests" class="form-label">Guests</label>
                            <input type="number" id="guests" name="guests" class="form-control"
                                value="<?= htmlspecialchars($space['total_persons']) ?>" min="1" readonly />
                        </div>

                        <div id="priceSummary">
                            <div class="d-flex justify-content-between fw-semibold">
                                <span id="priceBreakdown">$<?= htmlspecialchars($space['price_day']) ?> x 0
                                    nights</span>
                                <span id="subtotal">$0</span>
                            </div>

                            <hr />
                            <div class="d-flex justify-content-between fw-bold fs-5">
                                <span>Total</span>
                                <span id="totalPrice">$0</span>
                            </div>
                        </div>

                        <button type="submit" class="btn-book">Book Now</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- SCRIPTS -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Include Razorpay JS SDK -->
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function () {
            const spaceId = <?= $space['id'] ?>;
            const ownerId = <?= $space['owner_id'] ?? 'null' ?>; // take from DB
            let bookedDates = [];
            const pricePerNight = <?= htmlspecialchars($space['price_day']) ?>;

            // Load booked dates
            $.getJSON(`api/get_booked_dates.php?space_id=${spaceId}`, function (dates) {
                bookedDates = dates;

                $("#checkin, #checkout").datepicker({
                    dateFormat: "yy-mm-dd",
                    minDate: 0,
                    beforeShowDay: function (date) {
                        const d = $.datepicker.formatDate("yy-mm-dd", date);
                        if (bookedDates.includes(d)) return [false, "booked-date", "Already booked"];
                        return [true, "", "Available"];
                    },
                    onSelect: function (dateText, inst) {
                        if (inst.id === "checkin") {
                            $("#checkout").datepicker("option", "minDate", dateText);
                        }
                        calculateTotal();
                    }
                });
            });

            // Total calculation
            function calculateTotal() {
                const checkin = $("#checkin").val();
                const checkout = $("#checkout").val();

                if (checkin && checkout) {
                    const start = new Date(checkin);
                    const end = new Date(checkout);

                    if (end >= start) {
                        const nights = ((end - start) / (1000 * 60 * 60 * 24)) + 1; // ✅ inclusive of check-in night
                        const total = pricePerNight * nights;

                        $("#priceBreakdown").text(`$${pricePerNight} × ${nights} night${nights > 1 ? 's' : ''}`);
                        $("#subtotal").text(`$${total.toLocaleString()}`);
                        $("#totalPrice").text(`$${total.toLocaleString()}`);
                        $("#totalAmount").val(total);
                        return;
                    }
                }

                $("#priceBreakdown").text(`$${pricePerNight} × 0 nights`);
                $("#subtotal, #totalPrice").text("$0");
                $("#totalAmount").val(0);
            }




            $("#checkin, #checkout").on("change", calculateTotal);

            // Booking with Razorpay payment
            // Booking with Razorpay payment
            $("#bookingForm").on("submit", function (e) {
                e.preventDefault();

                <?php if (!isset($_SESSION['user_id'])): ?>
                    // 🔒 User not logged in — show alert and stop
                    Swal.fire({
                        icon: "warning",
                        title: "Login Required",
                        text: "You need to log in before booking a space.",
                        confirmButtonText: "Go to Login",
                        confirmButtonColor: "#ff385c"
                    }).then(() => {
                        window.location.href = "login.php"; // redirect to your login page
                    });
                    return;
                <?php endif; ?>

                const checkin = $("#checkin").val();
                const checkout = $("#checkout").val();
                const guests = $("#guests").val();
                const days = (new Date(checkout) - new Date(checkin)) / (1000 * 60 * 60 * 24);
                const amount = days * pricePerNight;

                if (!checkin || !checkout || days <= 0) {
                    Swal.fire({
                        icon: "warning",
                        title: "Invalid Dates",
                        text: "Please select valid check-in and check-out dates.",
                        confirmButtonColor: "#ff385c"
                    });
                    return;
                }

                const totalAmount = amount * 100; // Amount in paise for Razorpay

                const options = {
                    key: "rzp_test_DrASf34mihEAtB",
                    amount: totalAmount,
                    currency: "INR",
                    name: "SpaceRent Booking",
                    description: "Payment for your space booking",
                    image: "https://cdn-icons-png.flaticon.com/512/891/891462.png",
                    handler: function (response) {
                        // On successful payment
                        $.ajax({
                            url: "api/book_space.php",
                            type: "POST",
                            data: {
                                space_id: spaceId,
                                owner_id: ownerId,
                                checkin: checkin,
                                checkout: checkout,
                                guests: guests,
                                amount: amount,
                                payment_id: response.razorpay_payment_id
                            },
                            dataType: "json",
                            success: function (res) {
                                if (res.status === "success") {
                                    Swal.fire({
                                        icon: "success",
                                        title: "Booking Confirmed!",
                                        text: "Your payment and booking were successful.",
                                        confirmButtonColor: "#28a745"
                                    }).then(() => {
                                        location.reload(); // reload page
                                    });
                                } else {
                                    Swal.fire({
                                        icon: "error",
                                        title: "Booking Failed!",
                                        text: res.message,
                                        confirmButtonColor: "#ff385c"
                                    });
                                }
                            },
                            error: function () {
                                Swal.fire({
                                    icon: "error",
                                    title: "Server Error",
                                    text: "Something went wrong while saving your booking.",
                                    confirmButtonColor: "#ff385c"
                                });
                            }
                        });
                    },
                    prefill: {
                        name: "<?= $_SESSION['username'] ?? 'Guest User' ?>",
                        email: "<?= $_SESSION['email'] ?? 'guest@example.com' ?>",
                        contact: "9876543210"
                    },
                    theme: {
                        color: "#ff385c"
                    }
                };

                const rzp = new Razorpay(options);
                rzp.open();
            });

        });
    </script>

</body>

</html>