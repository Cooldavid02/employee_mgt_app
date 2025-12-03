<?php if (isset($_SESSION['admin_id'])): ?>
<nav class="navbar navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">
            <i class="bi bi-people"></i> Employee Management
        </a>
        <div class="text-light">
            <i class="bi bi-person-circle"></i> <?php echo $_SESSION['admin_username']; ?>
            <a href="logout.php" class="btn btn-sm btn-outline-light ms-3">
                <i class="bi bi-box-arrow-right"></i> Logout
            </a>
        </div>
    </div>
</nav>
<?php endif; ?>