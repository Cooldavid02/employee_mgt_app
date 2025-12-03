<?php
require_once 'config/database.php';

// Check if admin is logged in
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

$database = new Database();
$db = $database->getConnection();

// Count employees
$query = "SELECT COUNT(*) as total FROM employees";
$stmt = $db->prepare($query);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);
$total_employees = $result['total'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Employee Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <style>
        .sidebar {
            min-height: 100vh;
            background: linear-gradient(180deg, #667eea 0%, #764ba2 100%);
            color: white;
        }
        .sidebar .nav-link {
            color: white;
            padding: 15px 20px;
            margin: 5px 0;
            border-radius: 10px;
            transition: all 0.3s;
        }
        .sidebar .nav-link:hover, .sidebar .nav-link.active {
            background: rgba(255,255,255,0.1);
            transform: translateX(5px);
        }
        .stat-card {
            border-radius: 15px;
            padding: 25px;
            color: white;
            margin-bottom: 20px;
            transition: transform 0.3s;
        }
        .stat-card:hover {
            transform: translateY(-5px);
        }
        .card-1 { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); }
        .card-2 { background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); }
        .card-3 { background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-md-3 col-lg-2 d-md-block sidebar collapse">
                <div class="position-sticky pt-3">
                    <div class="text-center mb-4">
                        <h4>EMP Management</h4>
                        <p class="text-light">Welcome, <?php echo $_SESSION['admin_username']; ?>!</p>
                    </div>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" href="index.php">
                                <i class="bi bi-speedometer2"></i> Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="employees.php">
                                <i class="bi bi-people"></i> Employees
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="add_employee.php">
                                <i class="bi bi-person-plus"></i> Add Employee
                            </a>
                        </li>
                        <li class="nav-item mt-4">
                            <a class="nav-link text-danger" href="logout.php">
                                <i class="bi bi-box-arrow-right"></i> Logout
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Main Content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
                    <h1 class="h2">Dashboard</h1>
                </div>

                <!-- Stats Cards -->
                <div class="row">
                    <div class="col-md-4">
                        <div class="stat-card card-1">
                            <h3><i class="bi bi-people"></i> Total Employees</h3>
                            <h2><?php echo $total_employees; ?></h2>
                            <p>Active employees in system</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="stat-card card-2">
                            <h3><i class="bi bi-building"></i> Departments</h3>
                            <h2>5</h2>
                            <p>Various departments</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="stat-card card-3">
                            <h3><i class="bi bi-graph-up"></i> Active</h3>
                            <h2>100%</h2>
                            <p>System status</p>
                        </div>
                    </div>
                </div>

                <!-- Recent Employees -->
                <div class="card mt-4">
                    <div class="card-header">
                        <h5 class="mb-0">Quick Actions</h5>
                    </div>
                    <div class="card-body">
                        <div class="row text-center">
                            <div class="col-md-3 mb-3">
                                <a href="employees.php" class="btn btn-outline-primary btn-lg w-100 py-3">
                                    <i class="bi bi-people fs-1"></i><br>
                                    View Employees
                                </a>
                            </div>
                            <div class="col-md-3 mb-3">
                                <a href="add_employee.php" class="btn btn-outline-success btn-lg w-100 py-3">
                                    <i class="bi bi-person-plus fs-1"></i><br>
                                    Add Employee
                                </a>
                            </div>
                            <div class="col-md-3 mb-3">
                                <a href="#" class="btn btn-outline-info btn-lg w-100 py-3">
                                    <i class="bi bi-printer fs-1"></i><br>
                                    Generate Reports
                                </a>
                            </div>
                            <div class="col-md-3 mb-3">
                                <a href="#" class="btn btn-outline-warning btn-lg w-100 py-3">
                                    <i class="bi bi-gear fs-1"></i><br>
                                    Settings
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>