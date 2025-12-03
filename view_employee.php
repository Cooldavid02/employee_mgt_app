<?php
require_once 'config/database.php';

// Check if admin is logged in
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

if (!isset($_GET['id'])) {
    header("Location: employees.php");
    exit();
}

$database = new Database();
$db = $database->getConnection();

$id = $_GET['id'];
$query = "SELECT * FROM employees WHERE id = :id";
$stmt = $db->prepare($query);
$stmt->bindParam(':id', $id);
$stmt->execute();
$employee = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$employee) {
    header("Location: employees.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Employee - Employee Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
</head>
<body>
    <?php include 'navbar.php'; ?>
    
    <div class="container-fluid">
        <div class="row">
            <?php include 'sidebar.php'; ?>
            
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Employee Details</h1>
                    <div>
                        <a href="edit_employee.php?id=<?php echo $employee['id']; ?>" class="btn btn-warning">
                            <i class="bi bi-pencil"></i> Edit
                        </a>
                        <a href="employees.php" class="btn btn-secondary">
                            <i class="bi bi-arrow-left"></i> Back
                        </a>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body text-center">
                                <div class="mb-3">
                                    <div class="rounded-circle bg-primary d-inline-flex align-items-center justify-content-center" 
                                         style="width: 100px; height: 100px; font-size: 2rem; color: white;">
                                        <?php echo strtoupper(substr($employee['first_name'], 0, 1) . substr($employee['last_name'], 0, 1)); ?>
                                    </div>
                                </div>
                                <h4><?php echo $employee['first_name'] . ' ' . $employee['last_name']; ?></h4>
                                <p class="text-muted"><?php echo $employee['position']; ?></p>
                                <span class="badge bg-info"><?php echo $employee['department']; ?></span>
                            </div>
                        </div>
                        
                        <div class="card mt-3">
                            <div class="card-header">
                                <h6 class="mb-0">Contact Information</h6>
                            </div>
                            <div class="card-body">
                                <p><i class="bi bi-envelope"></i> <?php echo $employee['email']; ?></p>
                                <p><i class="bi bi-telephone"></i> <?php echo $employee['phone']; ?></p>
                                <p><i class="bi bi-geo-alt"></i> <?php echo $employee['address']; ?></p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">
                                <h6 class="mb-0">Employment Details</h6>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <table class="table table-borderless">
                                            <tr>
                                                <th>Employee ID</th>
                                                <td>#EMP<?php echo str_pad($employee['id'], 4, '0', STR_PAD_LEFT); ?></td>
                                            </tr>
                                            <tr>
                                                <th>Department</th>
                                                <td><?php echo $employee['department']; ?></td>
                                            </tr>
                                            <tr>
                                                <th>Position</th>
                                                <td><?php echo $employee['position']; ?></td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="col-md-6">
                                        <table class="table table-borderless">
                                            <tr>
                                                <th>Salary</th>
                                                <td>$<?php echo number_format($employee['salary'], 2); ?></td>
                                            </tr>
                                            <tr>
                                                <th>Hire Date</th>
                                                <td><?php echo date('F d, Y', strtotime($employee['hire_date'])); ?></td>
                                            </tr>
                                            <tr>
                                                <th>Joined</th>
                                                <td><?php echo date('F d, Y', strtotime($employee['created_at'])); ?></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
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