<!-- ✅ Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />

<!-- ✅ Bootstrap Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

<!-- ✅ HEADER with Offcanvas Toggle -->
<header class="d-flex justify-content-between align-items-center px-4 py-3 border-bottom bg-white">
    <div class="d-flex align-items-center">
        <!-- Hamburger (Offcanvas Toggle) -->
        <button class="btn btn-outline-primary d-lg-none" type="button" data-bs-toggle="offcanvas"
            data-bs-target="#adminSidebar" aria-controls="adminSidebar">
            <i class="bi bi-list fs-4"></i>
        </button>
    </div>

    <div class="header-icons d-flex align-items-center gap-3">
        <a href="logout.php" class="btn btn-danger btn-sm">
            <i class="bi bi-box-arrow-right me-1"></i> Logout
        </a>
    </div>
</header>

<!-- ✅ OFFCANVAS SIDEBAR -->
<div class="offcanvas offcanvas-start" tabindex="-1" id="adminSidebar" aria-labelledby="adminSidebarLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="adminSidebarLabel">
            <i class="bi bi-building"></i> RentalHub Menu
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>

    <div class="offcanvas-body d-flex flex-column justify-content-between">
        <!-- Navigation -->
        <nav class="flex-grow-1 p-3 d-flex flex-column gap-2">
            <a href="admin_panel.php" class="btn btn-outline-primary text-start">
                <i class="bi bi-house-door"></i> Dashboard
            </a>
            <a href="add_space.php" class="btn btn-outline-primary text-start">
                <i class="bi bi-plus-circle"></i> Add Space
            </a>
            <a href="list_space.php" class="btn btn-outline-primary text-start">
                <i class="bi bi-list-ul"></i> List Your Space
            </a>
            <a href="bookings.php" class="btn btn-outline-primary text-start">
                <i class="bi bi-journal-text"></i> Bookings
            </a>
        </nav>

        <!-- ✅ User Info -->
        <div class="sidebar-footer d-flex align-items-center px-3 py-3 border-top">
            <div class="user-initials bg-primary text-white rounded-circle d-flex align-items-center justify-content-center"
                style="width:45px; height:45px; font-weight:bold;">
                <?= strtoupper(substr($user_name, 0, 1)) ?>
            </div>
            <div class="user-info ms-3">
                <p class="mb-0 fw-medium"><?= htmlspecialchars($user_name) ?></p>
                <p class="mb-0 text-muted small"><?= htmlspecialchars($user_email) ?></p>
            </div>
        </div>
    </div>
</div>

<!-- ✅ Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>