<?php
// 1. Force the server to show us the actual error if it crashes
error_reporting(E_ALL);
ini_set('display_errors', '1');

declare(strict_types=1);

// We only keep the bootstrap for the database connection
require_once("includes/bootstrap.php");

$conn = Database::connection();
$msg = "";

// 2. Capture and validate ID
$dept_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($dept_id <= 0) {
    die("<h1 style='color:red;'>Error: No Department ID found in URL.</h1><p>Please return to the list and click edit again.</p>");
}

// 3. Update Process
if (isset($_POST['update_dept'])) {
    $new_name = mysqli_real_escape_string($conn, trim((string)$_POST['dept_name']));
    
    if (!empty($new_name)) {
        $update_sql = "UPDATE staff_department SET staff_department = '$new_name' WHERE id = $dept_id";
        
        if (mysqli_query($conn, $update_sql)) {
            $msg = "<div style='background:#d4edda; color:#155724; padding:15px; border:1px solid #c3e6cb; border-radius:5px; margin-bottom:20px;'>
                        <strong>Success!</strong> Department has been updated.
                    </div>";
        } else {
            $msg = "<div style='background:#f8d7da; color:#721c24; padding:15px; border:1px solid #f5c6cb; border-radius:5px; margin-bottom:20px;'>
                        <strong>MySQL Error:</strong> " . mysqli_error($conn) . "
                    </div>";
        }
    }
}

// 4. Fetch the data
$fetch_sql = "SELECT * FROM staff_department WHERE id = $dept_id";
$res = mysqli_query($conn, $fetch_sql);

if (!$res) {
    die("Database Query Failed: " . mysqli_error($conn));
}

$data = mysqli_fetch_assoc($res);

if (!$data) {
    die("<h1>Error</h1><p>Could not find department with ID $dept_id in the database.</p>");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Standalone Edit - Staff Department</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f4f7f6; padding: 50px; }
        .card { background: white; max-width: 600px; margin: 0 auto; padding: 30px; border-radius: 10px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); border-top: 5px solid #0078D4; }
        h2 { color: #0078D4; margin-top: 0; }
        label { display: block; margin-bottom: 8px; font-weight: bold; color: #333; }
        input[type="text"] { width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 5px; box-sizing: border-box; font-size: 16px; margin-bottom: 20px; }
        .btn-save { background: #0078D4; color: white; border: none; padding: 12px 25px; border-radius: 5px; cursor: pointer; font-size: 16px; font-weight: bold; }
        .btn-save:hover { background: #005a9e; }
        .btn-back { color: #666; text-decoration: none; margin-left: 15px; font-size: 14px; }
    </style>
</head>
<body>

<div class="card">
    <h2>Update Staff Department</h2>
    <hr style="border: 0; border-top: 1px solid #eee; margin-bottom: 25px;">
    
    <?php echo $msg; ?>

    <form action="edit_staff_department.php?id=<?php echo $dept_id; ?>" method="post">
        <label>Department Name</label>
        <input type="text" name="dept_name" value="<?php echo htmlspecialchars((string)$data['staff_department']); ?>" required>
        
        <button type="submit" name="update_dept" class="btn-save">Save Changes</button>
        <a href="view_staff_department.php" class="btn-back">Cancel & Go Back</a>
    </form>
</div>

</body>
</html>
