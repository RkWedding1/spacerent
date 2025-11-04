<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

<style>
    .nav-button {
        width: 100%;
        background: none;
        border: none;
        text-align: left;
        padding: 10px 15px;
        font-size: 16px;
        border-radius: 8px;
        transition: background 0.3s ease;
    }

    .nav-button:hover {
        background-color: #f1f3f5;
    }

    .nav-button.active {
        background-color: #0d6efd;
        color: white;
    }

    .nav-button i {
        font-size: 18px;
    }
</style>
<nav class="flex-grow-1 p-3 d-flex flex-column gap-1">
    <a href="admin_panel.php">
        <button class="nav-button active">
            <i class="bi bi-speedometer2 me-2"></i> Dashboard
        </button>
    </a>

    <a href="add_space.php">
        <button class="nav-button">
            <i class="bi bi-plus-circle me-2"></i> Add Space
        </button>
    </a>

    <a href="list_space.php">
        <button class="nav-button">
            <i class="bi bi-list-ul me-2"></i> List Your Space
        </button>
    </a>

    <a href="bookings.php">
        <button class="nav-button">
            <i class="bi bi-calendar-check me-2"></i> Bookings
        </button>
    </a>

    <a href="browse_spaces.php">
        <button class="nav-button">
            <i class="bi bi-search me-2"></i> Browse Your Space
        </button>
    </a>
</nav>

<!-- ✅ User Info in Sidebar Footer -->
<div class="sidebar-footer d-flex align-items-center px-4 py-3 border-top">
    <div class="user-initials">
        <?= strtoupper(substr($user_name, 0, 1)) ?>
    </div>
    <div class="user-info ms-3">
        <p class="mb-0 fw-medium text-gray-800"><?= htmlspecialchars($user_name) ?></p>
        <p class="mb-0 text-muted small"><?= htmlspecialchars($user_email) ?></p>
    </div>
</div>