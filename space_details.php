<?php
include('api/db.php');
session_start();

// Redirect if not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$owner_id = $_SESSION['user_id'];
$id = $_GET['id'] ?? 0;

// ✅ Fetch owner info
$userQuery = "SELECT name, email FROM users WHERE id = ?";
$userStmt = $conn->prepare($userQuery);
$userStmt->bind_param("i", $owner_id);
$userStmt->execute();
$user = $userStmt->get_result()->fetch_assoc();


$user_name = $user['name'] ?? 'Unknown User';
$user_email = $user['email'] ?? 'No Email';
// ✅ Fetch rental space details
$sql = "SELECT * FROM rental_spaces WHERE id = ? AND owner_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $id, $owner_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "<h2 class='text-center mt-5'>No space found for this ID.</h2>";
    exit;
}

$space = $result->fetch_assoc();

// ✅ Fetch owner details
$ownerQuery = "SELECT name, mobile, email FROM users WHERE id = ?";
$ownerStmt = $conn->prepare($ownerQuery);
$ownerStmt->bind_param("i", $space['owner_id']);
$ownerStmt->execute();
$owner = $ownerStmt->get_result()->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title><?= htmlspecialchars($space['space_title']) ?> | SpaceRent Admin</title>
    <link rel="shortcut icon" href="images/spacerent.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet" />
    <link rel="stylesheet" href="styles.css">

    <style>
        header {
            position: sticky;
            top: 0;
            z-index: 1000;
            background-color: white;
            border-bottom: 1px solid #e5e7eb;
        }

        .card-img-top {
            height: 380px;
            width: 100%;
            object-fit: cover;
            border-radius: 12px;
        }

        .thumbnail {
            width: 75px;
            height: 65px;
            object-fit: cover;
            border-radius: 8px;
            cursor: pointer;
            border: 2px solid transparent;
        }

        .thumbnail:hover {
            border-color: #ff385c;
        }

        .owner-details {
            background: #fff;
            border-radius: 12px;
            padding: 15px 20px;
            margin-top: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .owner-details h5 {
            color: #ff385c;
            font-weight: 600;
        }

        .btn-back {
            text-decoration: none;
            color: #555;
        }

        .btn-back:hover {
            color: #ff385c;
        }

        main {
            height: 90vh !important;
        }
    </style>
</head>

<body>
    <div class="d-flex">
        <!-- Sidebar -->
        <aside class="sidebar" id="sidebar">
            <div class="sidebar-header">
                <h4>
                    <p class="mb-0">
                        <img src="images/spacerent.png" alt="" width="40" height="40"> SpaceRent
                    </p>
                </h4>
            </div>
            <?php include('admin_nav.php'); ?>
        </aside>

        <!-- Overlay -->
        <div class="content-overlay" id="contentOverlay"></div>

        <!-- Main -->
        <div class="main-wrapper flex-grow-1 d-flex flex-column">
            <?php include('admin_header.php'); ?>

            <main class="flex-grow-1 overflow-auto p-4 bg-light">
                <a href="admin_panel.php" class="btn-back mb-3 d-inline-block">
                    <i class="bi bi-arrow-left"></i> Back to My Spaces
                </a>

                <div class="card border-0 shadow-sm p-4">
                    <!-- Main Image -->
                    <img src="<?= htmlspecialchars($space['image_url']) ?>" class="card-img-top mb-3" id="mainImage"
                        alt="Main Image">

                    <!-- Thumbnails -->
                    <div class="d-flex gap-2 mb-4">
                        <?php for ($i = 1; $i <= 4; $i++):
                            $img = $space["image_$i"] ?? '';
                            if (!empty($img)): ?>
                                <img src="<?= htmlspecialchars($img) ?>" class="thumbnail" onclick="setMainImage(this)"
                                    alt="Thumbnail <?= $i ?>">
                            <?php endif;
                        endfor; ?>
                    </div>

                    <h2 class="fw-bold mb-2"><?= htmlspecialchars($space['space_title']) ?></h2>
                    <p><i class="bi bi-geo-alt-fill text-danger"></i>
                        <?= htmlspecialchars($space['location_address']) ?></p>

                    <?php
                    $coords = htmlspecialchars($space['location_link']); // e.g., "https://www.google.com/maps?q=13.0154496,80.019456"
                    ?>
                    <div class="map-container mb-4">
                        <iframe src="<?= $coords ?>&output=embed" width="100%" height="400"
                            style="border:0; border-radius:12px;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>


                    <h4 class="text-danger fw-bold mb-3">₹<?= htmlspecialchars($space['price_day']) ?> / night</h4>

                    <div class="row">
                        <div class="col-md-8">
                            <h5 class="fw-semibold mt-3">About this Space</h5>
                            <p class="text-muted"><?= nl2br(htmlspecialchars($space['description'])) ?></p>

                            <h5 class="fw-semibold mt-3">Details</h5>
                            <ul class="list-unstyled">
                                <li><strong>Space Type:</strong> <?= htmlspecialchars($space['space_type']) ?></li>
                                <li><strong>Size:</strong> <?= htmlspecialchars($space['size']) ?> sq ft</li>
                                <li><strong>Capacity:</strong> <?= htmlspecialchars($space['total_persons']) ?> people
                                </li>
                                <li><strong>Amenities:</strong> <?= htmlspecialchars($space['amenities']) ?></li>
                            </ul>
                        </div>

                        <div class="col-md-4">
                            <div class="owner-details">
                                <h5>Owner Information</h5>
                                <hr>
                                <p><strong>Name:</strong> <?= htmlspecialchars($owner['name'] ?? 'Not Available') ?></p>
                                <p><strong>Mobile:</strong> <?= htmlspecialchars($owner['mobile'] ?? 'Not Provided') ?>
                                </p>
                                <p><strong>Email:</strong> <?= htmlspecialchars($owner['email'] ?? 'Not Provided') ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script>
        function setMainImage(imgElement) {
            document.getElementById('mainImage').src = imgElement.src;
        }
    </script>
</body>

</html>