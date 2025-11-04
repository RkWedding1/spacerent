<?php
include('api/db.php');
session_start();

// Redirect if not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$owner_id = $_SESSION['user_id'];

// ✅ Fetch owner details from users table
$userQuery = "SELECT name, email FROM users WHERE id = ?";
$userStmt = $conn->prepare($userQuery);
$userStmt->bind_param("i", $owner_id);
$userStmt->execute();
$userResult = $userStmt->get_result();
$user = $userResult->fetch_assoc();

$user_name = $user['name'] ?? 'Unknown User';
$user_email = $user['email'] ?? 'No Email';

// ✅ Fetch bookings for the spaces owned by this user
$query = "
    SELECT 
        b.id AS booking_id,
        b.user_id,
        u.name AS booked_by,
        u.email AS booked_email,
        rs.space_title,
        rs.image_url,
        rs.location_address,
        b.checkin,
        b.checkout,
        b.total_amount,
        b.payment_id
    FROM bookings b
    JOIN rental_spaces rs ON b.space_id = rs.id
    JOIN users u ON b.user_id = u.id
    WHERE rs.owner_id = ?
    ORDER BY b.id DESC
";

$stmt = $conn->prepare($query);
$stmt->bind_param("i", $owner_id);
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Spacerent Admin Panel</title>
    <link rel="shortcut icon" href="images/spacerent.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="styles.css">
    <style>
        header {
            position: sticky;
            top: 0;
            z-index: 1000;
            background-color: white;
            border-bottom: 1px solid #e5e7eb;
        }

        main {
            height: 90vh !important;
        }

        .card-img-top {
            height: 220px;
            width: 100%;
            object-fit: cover;
            border-top-left-radius: 0.5rem;
            border-top-right-radius: 0.5rem;
        }

        .user-initials {
            width: 45px;
            height: 45px;
            background-color: #007bff;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            font-weight: bold;
            font-size: 18px;
        }
    </style>
</head>

<body>
    <div class="d-flex">
        <!-- Sidebar -->
        <aside class="sidebar" id="sidebar">
            <div class="sidebar-header">
                <h4>
                    <p class="mb-0"> <img src="images/spacerent.png " alt="" width="40" height="40">
                        SpaceRent</p>
                </h4>
            </div>
            <?php include('admin_nav.php'); ?>
        </aside>

        <div class="main-wrapper flex-grow-1 d-flex flex-column">
            <?php include('admin_header.php'); ?>

            <!-- <header class="d-flex justify-content-end align-items-center border-bottom bg-white px-4 py-3">
                <button class="hamburger-btn" id="hamburgerBtn" aria-label="Toggle Sidebar">&#9776;</button>
            </header> -->

            <main class="flex-grow-1 overflow-auto p-4 bg-light">
                <h2 class="page-title text-center mb-5">Bookings for Your Spaces</h2>

                <div class="row">
                    <?php if ($result->num_rows > 0): ?>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <div class="col-12 col-sm-6 col-lg-4">
                                <div class="card h-100 shadow-sm">
                                    <img src="<?= htmlspecialchars($row['image_url']) ?>" class="card-img-top"
                                        alt="<?= htmlspecialchars($row['space_title']) ?>" />

                                    <div class="card-body">
                                        <h5 class="card-title"><?= htmlspecialchars($row['space_title']) ?></h5>
                                        <p class="card-text text-muted mb-1">
                                            <small>📍 <?= htmlspecialchars($row['location_address']) ?></small>
                                        </p>

                                        <p class="fw-bold text-primary mb-1">
                                            👤 Booked by: <?= htmlspecialchars($row['booked_by']) ?>
                                        </p>
                                        <p class="text-muted mb-2">
                                            ✉️ <?= htmlspecialchars($row['booked_email']) ?>
                                        </p>

                                        <p class="mb-1">🗓️ Check-in:
                                            <strong><?= htmlspecialchars($row['checkin']) ?></strong>
                                        </p>
                                        <p class="mb-1">🏁 Check-out:
                                            <strong><?= htmlspecialchars($row['checkout']) ?></strong>
                                        </p>
                                        <p class="fw-bold text-danger mb-1">💰 Total:
                                            $<?= htmlspecialchars($row['total_amount']) ?></p>
                                        <!-- <p class="text-muted small">💳 Payment ID: <?= htmlspecialchars($row['payment_id']) ?>
                                        </p> -->
                                    </div>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <p class="text-center text-muted">No bookings yet for your spaces.</p>
                    <?php endif; ?>
                </div>
            </main>
        </div>
    </div>
</body>

</html>