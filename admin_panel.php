<?php
session_start();
include('api/db.php');

// ✅ Redirect if not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$owner_id = $_SESSION['user_id'];

// ✅ Fetch user details
$userQuery = "SELECT name, email FROM users WHERE id = ?";
$userStmt = $conn->prepare($userQuery);
$userStmt->bind_param("i", $owner_id);
$userStmt->execute();
$userResult = $userStmt->get_result();
$user = $userResult->fetch_assoc();

$user_name = $user['name'] ?? 'Unknown User';
$user_email = $user['email'] ?? 'No Email';

// ✅ Fetch total properties
$totalSpacesQuery = "SELECT COUNT(*) AS total_spaces FROM rental_spaces WHERE owner_id = ?";
$stmt1 = $conn->prepare($totalSpacesQuery);
$stmt1->bind_param("i", $owner_id);
$stmt1->execute();
$totalSpaces = $stmt1->get_result()->fetch_assoc()['total_spaces'] ?? 0;

// ✅ Fetch total bookings
$totalBookingsQuery = "SELECT COUNT(*) AS total_bookings FROM bookings WHERE owner_id = ?";
$stmt2 = $conn->prepare($totalBookingsQuery);
$stmt2->bind_param("i", $owner_id);
$stmt2->execute();
$totalBookings = $stmt2->get_result()->fetch_assoc()['total_bookings'] ?? 0;

// ✅ Fetch total revenue
$totalRevenueQuery = "SELECT SUM(total_amount) AS total_amount FROM bookings WHERE owner_id = ?";
$stmt3 = $conn->prepare($totalRevenueQuery);
$stmt3->bind_param("i", $owner_id);
$stmt3->execute();
$totalRevenue = $stmt3->get_result()->fetch_assoc()['total_amount'] ?? 0;

// ✅ Fetch bookings for table (with user name joined from users table)
$bookingsQuery = "
    SELECT 
        b.id, 
        b.space_id, 
        u.name AS user_name,  -- Fetch user name from users table
        b.checkin, 
        b.checkout, 
        b.total_amount, 
        b.room_status, 
        r.space_title
    FROM bookings b
    JOIN rental_spaces r ON b.space_id = r.id
    JOIN users u ON b.user_id = u.id   -- Join with users table
    WHERE b.owner_id = ?
    ORDER BY b.id DESC
";

$stmt4 = $conn->prepare($bookingsQuery);
$stmt4->bind_param("i", $owner_id);
$stmt4->execute();
$bookings = $stmt4->get_result();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Spacerent Admin Panel</title>
    <link rel="shortcut icon" href="images/spacerent.png" type="image/x-icon">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="styles.css" />
    <style>
        header {
            position: sticky;
            top: 0;
            z-index: 1000;
            background-color: #fff;
            border-bottom: 1px solid #e5e7eb;
        }

        a {
            text-decoration: none;
        }

        .dashboard-card {
            background: #fff;
            border-radius: 15px;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .dashboard-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        }

        .dashboard-icon {
            font-size: 32px;
        }

        .blue {
            color: #4e73df;
        }

        .green {
            color: #1cc88a;
        }

        .purple {
            color: #6f42c1;
        }

        .table-container {
            background: #fff;
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 0 25px rgba(0, 0, 0, 0.05);
        }

        .status-badge {
            font-size: 0.85rem;
            border-radius: 20px;
            padding: 5px 12px;
        }

        .status-booked {
            background-color: #4e73df;
            color: white;
        }

        .status-cancelled {
            background-color: #dc3545;
            color: white;
        }

        .status-completed {
            background-color: #1cc88a;
            color: white;
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
                <!-- <p>Admin Panel</p> -->
            </div>
            <?php include('admin_nav.php'); ?>
        </aside>

        <!-- Overlay for mobile -->
        <div class="content-overlay" id="contentOverlay"></div>

        <!-- Main content -->
        <div class="main-wrapper flex-grow-1 d-flex flex-column">
            <?php include('admin_header.php'); ?>

            <main class="p-4">
                <div class="mb-4">
                    <h2 class="fw-bold text-gray-800">Dashboard Overview</h2>
                    <p class="text-muted">Welcome back, <?= htmlspecialchars($user_name) ?>! Here’s what’s happening
                        today.</p>
                </div>

                <!-- ✅ Dashboard Cards -->
                <div class="row g-4 mb-5">
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="dashboard-card">
                            <div class="d-flex justify-content-between align-items-start">
                                <div class="dashboard-icon blue">🏠</div>
                                <!-- <span class="text-success fw-semibold">+12%</span> -->
                            </div>
                            <div class="mt-3">
                                <p class="dashboard-label mb-1">Total Properties</p>
                                <p class="dashboard-stat"><?= htmlspecialchars($totalSpaces) ?></p>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="dashboard-card">
                            <div class="d-flex justify-content-between align-items-start">
                                <div class="dashboard-icon green">👥</div>
                                <!-- <span class="text-success fw-semibold">+8%</span> -->
                            </div>
                            <div class="mt-3">
                                <p class="dashboard-label mb-1">Total Bookings</p>
                                <p class="dashboard-stat"><?= htmlspecialchars($totalBookings) ?></p>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="dashboard-card">
                            <div class="d-flex justify-content-between align-items-start">
                                <div class="dashboard-icon purple">💰</div>
                                <!-- <span class="text-success fw-semibold">+15%</span> -->
                            </div>
                            <div class="mt-3">
                                <p class="dashboard-label mb-1">Total Revenue</p>
                                <p class="dashboard-stat">$<?= number_format($totalRevenue) ?></p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ✅ Bookings Table -->
                <div class="table-container mt-4">
                    <h5 class="fw-semibold mb-3">📅 Recent Bookings</h5>
                    <div class="table-responsive">
                        <table class="table table-bordered align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>S No</th>
                                    <th>Space</th>
                                    <th>Customer</th>
                                    <th>Check-In</th>
                                    <th>Check-Out</th>
                                    <th>Total ($)</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($bookings->num_rows > 0): ?>
                                    <?php $i = 1;
                                    while ($row = $bookings->fetch_assoc()): ?>
                                        <tr>
                                            <td><?= $i++ ?></td>
                                            <td><?= htmlspecialchars($row['space_title']) ?></td>
                                            <td><?= htmlspecialchars($row['user_name']) ?></td>
                                            <td><?= htmlspecialchars($row['checkin']) ?></td>
                                            <td><?= htmlspecialchars($row['checkout']) ?></td>
                                            <td>$<?= number_format($row['total_amount']) ?></td>
                                            <td>
                                                <?php
                                                $status = strtolower($row['room_status']);
                                                $class = match ($status) {
                                                    'completed' => 'status-completed',
                                                    'cancelled' => 'status-cancelled',
                                                    default => 'status-booked',
                                                };
                                                ?>
                                                <span class="status-badge <?= $class ?>"><?= ucfirst($status) ?></span>
                                            </td>
                                        </tr>
                                    <?php endwhile; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="7" class="text-center text-muted">No bookings found.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- ✅ Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        const sidebar = document.getElementById('sidebar');
        const toggleBtn = document.getElementById('hamburgerBtn');
        const overlay = document.getElementById('contentOverlay');

        if (toggleBtn && sidebar && overlay) {
            toggleBtn.addEventListener('click', () => {
                sidebar.classList.toggle('show');
                overlay.classList.toggle('show');
            });

            overlay.addEventListener('click', () => {
                sidebar.classList.remove('show');
                overlay.classList.remove('show');
            });
        }
    </script>
</body>

</html>