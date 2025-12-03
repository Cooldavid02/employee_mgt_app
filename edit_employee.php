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

// Fetch employee data
$query = "SELECT * FROM employees WHERE id = :id";
$stmt = $db->prepare($query);
$stmt->bindParam(':id', $id);
$stmt->execute();
$employee = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$employee) {
    header("Location: employees.php");
    exit();
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $department = $_POST['department'];
    $position = $_POST['position'];
    $salary = $_POST['salary'];
    $hire_date = $_POST['hire_date'];
    
    $query = "UPDATE employees SET 
              first_name = :first_name,
              last_name = :last_name,
              email = :email,
              phone = :phone,
              address = :address,
              department = :department,
              position = :position,
              salary = :salary,
              hire_date = :hire_date
              WHERE id = :id";
    
    $stmt = $db->prepare($query);
    $stmt->bindParam(':first_name', $first_name);
    $stmt->bindParam(':last_name', $last_name);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':phone', $phone);
    $stmt->bindParam(':address', $address);
    $stmt->bindParam(':department', $department);
    $stmt->bindParam(':position', $position);
    $stmt->bindParam(':salary', $salary);
    $stmt->bindParam(':hire_date', $hire_date);
    $stmt->bindParam(':id', $id);
    
    if ($stmt->execute()) {
        header("Location: employees.php?msg=updated");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Employee - Employee Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include 'navbar.php'; ?>
    
    <div class="container-fluid">
        <div class="row">
            <?php include 'sidebar.php'; ?>
            
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Edit Employee</h1>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Edit Employee Information</h5>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="first_name" class="form-label">First Name *</label>
                                    <input type="text" class="form-control" id="first_name" name="first_name" 
                                           value="<?php echo $employee['first_name']; ?>" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="last_name" class="form-label">Last Name *</label>
                                    <input type="text" class="form-control" id="last_name" name="last_name" 
                                           value="<?php echo $employee['last_name']; ?>" required>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="email" class="form-label">Email *</label>
                                    <input type="email" class="form-control" id="email" name="email" 
                                           value="<?php echo $employee['email']; ?>" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="phone" class="form-label">Phone</label>
                                    <input type="tel" class="form-control" id="phone" name="phone" 
                                           value="<?php echo $employee['phone']; ?>">
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label for="address" class="form-label">Address</label>
                                <textarea class="form-control" id="address" name="address" rows="3"><?php echo $employee['address']; ?></textarea>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label for="department" class="form-label">Department</label>
                                    <select class="form-select" id="department" name="department">
                                        <option value="IT" <?php echo ($employee['department'] == 'IT') ? 'selected' : ''; ?>>IT</option>
                                        <option value="HR" <?php echo ($employee['department'] == 'HR') ? 'selected' : ''; ?>>Human Resources</option>
                                        <option value="Sales" <?php echo ($employee['department'] == 'Sales') ? 'selected' : ''; ?>>Sales</option>
                                        <option value="Marketing" <?php echo ($employee['department'] == 'Marketing') ? 'selected' : ''; ?>>Marketing</option>
                                        <option value="Finance" <?php echo ($employee['department'] == 'Finance') ? 'selected' : ''; ?>>Finance</option>
                                    </select>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="position" class="form-label">Position</label>
                                    <input type="text" class="form-control" id="position" name="position" 
                                           value="<?php echo $employee['position']; ?>">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="salary" class="form-label">Salary</label>
                                    <input type="number" step="0.01" class="form-control" id="salary" name="salary" 
                                           value="<?php echo $employee['salary']; ?>">
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label for="hire_date" class="form-label">Hire Date</label>
                                <input type="date" class="form-control" id="hire_date" name="hire_date" 
                                       value="<?php echo $employee['hire_date']; ?>">
                            </div>
                            
                            <div class="d-flex justify-content-end">
                                <a href="view_employee.php?id=<?php echo $employee['id']; ?>" class="btn btn-secondary me-2">Cancel</a>
                                <button type="submit" class="btn btn-primary">Update Employee</button>
                            </div>
                        </form>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>