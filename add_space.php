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

// ✅ Fetch rental spaces added by the logged-in owner
$query = "SELECT * FROM rental_spaces WHERE owner_id = ? ORDER BY id DESC";
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
            <?php include('admin_nav.php') ?>
        </aside>

        <!-- Overlay -->
        <div class="content-overlay" id="contentOverlay"></div>

        <!-- Main -->
        <div class="main-wrapper flex-grow-1 d-flex flex-column">
            <?php include('admin_header.php') ?>

            <!-- <header class="d-flex justify-content-end align-items-center border-bottom bg-white px-4 py-3">
                <button class="hamburger-btn" id="hamburgerBtn" aria-label="Toggle Sidebar">&#9776;</button>
            </header> -->

            <main class="flex-grow-1 overflow-auto p-4 bg-light">
                <form class="booking-form" enctype="multipart/form-data">
                    <h3 class="mb-4 text-center">Add Space</h3>

                    <!-- 🟦 Row 1 -->
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label for="spaceType" class="form-label">Space Type *</label>
                            <select id="spaceType" name="spaceType" class="form-select" required>
                                <option value="">Select space type...</option>
                                <option value="garage">Garage</option>
                                <option value="yard">Yard/Garden</option>
                                <option value="trailer">Trailer/Container</option>
                                <option value="office">Office/Desk Space</option>
                                <option value="storage">Storage Unit</option>
                                <option value="warehouse">Warehouse Space</option>
                                <option value="retail">Retail/Shop Space</option>
                                <option value="parking">Parking Spot</option>
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label for="spaceTitle" class="form-label">Space Title *</label>
                            <input type="text" id="spaceTitle" name="spaceTitle" class="form-control"
                                placeholder="e.g., Spacious 2-Car Garage" required />
                        </div>

                        <div class="col-md-4">
                            <label for="locationAddress" class="form-label">Location Address *</label>
                            <input type="text" id="locationAddress" name="locationAddress" class="form-control"
                                placeholder="e.g. Avadi, Tamil Nadu" required />
                        </div>
                    </div>

                    <!-- 🟩 Row 2 -->
                    <div class="row g-3 mt-3">
                        <!-- <div class="col-md-4">
                            <label for="locationLink" class="form-label">Google Maps Link *</label>
                            <input type="url" id="locationLink" name="locationLink" class="form-control"
                                placeholder="Paste Google Maps link here" required />
                        </div> -->
                        <div class="col-md-4 position-relative">
                            <label for="locationLink" class="form-label fw-semibold">Google Maps Link *</label>
                            <input type="url" id="locationLink" name="locationLink"
                                class="form-control border-primary-subtle"
                                placeholder="Click here to auto-fill your current location" required />
                        </div>



                        <div class="col-md-4">
                            <label for="size" class="form-label">Size (sq ft) *</label>
                            <input type="number" id="size" name="size" class="form-control" placeholder="e.g., 400"
                                required />
                        </div>

                        <div class="col-md-4">
                            <label for="availableFrom" class="form-label">Available From *</label>
                            <input type="date" id="availableFrom" name="availableFrom" class="form-control" required />
                        </div>
                    </div>

                    <!-- 🟨 Row 3 -->
                    <div class="row g-3 mt-3">
                        <div class="col-md-4">
                            <label for="amenities" class="form-label">Amenities</label>
                            <input type="text" id="amenities" name="amenities" class="form-control"
                                placeholder="e.g. Wi-Fi, Parking, Kitchen" />
                        </div>

                        <div class="col-md-4">
                            <label for="description" class="form-label">Description *</label>
                            <input type="text" id="description" name="description" class="form-control"
                                placeholder="Describe your space" required>
                        </div>

                        <div class="col-md-4">
                            <label for="priceDay" class="form-label">Price per Day ($) *</label>
                            <input type="number" id="priceDay" name="priceDay" class="form-control" placeholder="25"
                                required />
                        </div>
                    </div>

                    <!-- 🟧 Row 4 -->
                    <div class="row g-3 mt-3">
                        <div class="col-md-4">
                            <label for="priceWeek" class="form-label">Price per Week ($)</label>
                            <input type="number" id="priceWeek" name="priceWeek" class="form-control"
                                placeholder="150" />
                        </div>

                        <div class="col-md-4">
                            <label for="totalPersons" class="form-label">Total Number Of Persons *</label>
                            <input type="number" id="totalPersons" name="totalPersons" class="form-control"
                                placeholder="e.g., 4" required>
                        </div>

                        <div class="col-md-4">
                            <label for="spaceImage" class="form-label">Upload Image *</label>
                            <input type="file" id="spaceImage" name="spaceImage" class="form-control" accept="image/*"
                                required />
                        </div>
                    </div>

                    <div class="d-flex justify-content-center mt-4">
                        <button type="submit" class="btn btn-sm text-white w-25 p-2"
                            style="background: linear-gradient(135deg, #3b82f6, #8b5cf6);">
                            List My Space
                        </button>
                    </div>
                </form>

            </main>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // Fetch current location when the input is clicked or focused
        document.getElementById("locationLink").addEventListener("focus", function () {
            const input = this;

            if (navigator.geolocation) {
                input.placeholder = "Fetching your location...";

                navigator.geolocation.getCurrentPosition(
                    function (position) {
                        const lat = position.coords.latitude;
                        const lon = position.coords.longitude;
                        const googleMapsLink = `https://www.google.com/maps?q=${lat},${lon}`;
                        input.value = googleMapsLink;
                        input.placeholder = "Location fetched successfully ✅";
                    },
                    function () {
                        input.placeholder = "Unable to fetch location ❌";
                        alert("Please enable location access and try again.");
                    }
                );
            } else {
                alert("Geolocation is not supported by your browser.");
            }
        });
    </script>


    <script>
        $(document).ready(function () {
            $(".booking-form").on("submit", function (e) {
                e.preventDefault();
                let formData = new FormData(this);

                $.ajax({
                    url: "api/add_spaces.php",
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    dataType: "json",
                    success: function (response) {
                        alert(response.message);
                        if (response.status === "success") {
                            $(".booking-form")[0].reset();
                        }
                    },
                    error: function () {
                        alert("Something went wrong while submitting your space listing.");
                    }
                });
            });
        });
    </script>
</body>

</html>