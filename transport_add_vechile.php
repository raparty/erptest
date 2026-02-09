<?php
declare(strict_types=1);
require_once("includes/bootstrap.php");
include_once("includes/header.php");
include_once("includes/sidebar.php");

$conn = Database::connection();
$msg = "";

// Form processing logic
if(isset($_POST['submit'])) {
    $vechile_no = mysqli_real_escape_string($conn, trim((string)$_POST['number']));
    $seats = (int)($_POST['seat'] ?? 0);
    
    // Escape each route ID before joining
    $route_ids_raw = isset($_POST['route_id']) ? $_POST['route_id'] : [];
    $route_ids_escaped = array_map(function($id) use ($conn) {
        return mysqli_real_escape_string($conn, $id);
    }, $route_ids_raw);
    $route_ids = implode(",", $route_ids_escaped);

    if(!empty($vechile_no)) {
        // Check if vehicle already exists
        $check_sql = "SELECT * FROM transport_add_vechile WHERE vechile_no = '$vechile_no'";
        $check_res = mysqli_query($conn, $check_sql);
        
        if($check_res && mysqli_num_rows($check_res) == 0) {
            $sql_ins = "INSERT INTO transport_add_vechile (vechile_no, route_id, no_of_seats) 
                        VALUES ('$vechile_no', '$route_ids', '$seats')";
            
            if(mysqli_query($conn, $sql_ins)) {
                header("Location: transport_vechile_detail.php?msg=1");
                exit;
            } else {
                $msg = "<div class='alert alert-danger'>Error adding vehicle: " . htmlspecialchars(mysqli_error($conn)) . "</div>";
            }
        } else {
            $msg = "<div class='alert alert-danger'>Vehicle Number already exists.</div>";
        }
    } else {
        $msg = "<div class='alert alert-danger'>Please fill in the Vehicle Number.</div>";
    }
}
?>

<div class="page_title">
    <h3>Add Vehicle</h3>
</div>

<?php include_once("includes/transport_setting_sidebar.php"); ?>

<div id="container">
    <div id="content">
        <div class="grid_container">
            <div class="grid_12">
                <div class="widget_wrap enterprise-card">
                    <div class="widget_top">
                        <h6>Add New Vehicle</h6>
                    </div>
                    <div class="widget_content p-4">
                        <?php if($msg != "") echo $msg; ?>
                        
                        <form action="transport_add_vechile.php" method="post">
                            <div class="row g-3 mb-4">
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Vehicle Number <span class="text-danger">*</span></label>
                                    <input name="number" type="text" class="form-control" placeholder="Enter vehicle number" required />
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Number of Seats <span class="text-danger">*</span></label>
                                    <input name="seat" type="number" class="form-control" placeholder="Enter number of seats" required />
                                </div>
                            </div>
                            
                            <div class="row g-3 mb-4">
                                <div class="col-md-12">
                                    <label class="form-label fw-bold">Select Route(s)</label>
                                    <div class="border rounded p-3 bg-light" style="max-height: 250px; overflow-y: auto;">
                                        <?php 
                                        $sql_r = "SELECT * FROM transport_add_route ORDER BY route_name ASC";
                                        $res_r = mysqli_query($conn, $sql_r);
                                        
                                        if($res_r && mysqli_num_rows($res_r) > 0) {
                                            while($row_r = mysqli_fetch_assoc($res_r)) {
                                                echo '<div class="form-check mb-2">';
                                                echo '<input class="form-check-input" type="checkbox" name="route_id[]" value="'.$row_r['route_id'].'" id="route_'.$row_r['route_id'].'">';
                                                echo '<label class="form-check-label" for="route_'.$row_r['route_id'].'">';
                                                echo htmlspecialchars($row_r['route_name']);
                                                echo '</label>';
                                                echo '</div>';
                                            }
                                        } else {
                                            echo '<p class="text-muted mb-0">No routes available. Please add routes first.</p>';
                                        }
                                        ?>
                                    </div>
                                    <small class="form-text text-muted">Select one or more routes for this vehicle.</small>
                                </div>
                            </div>

                            <div class="d-flex gap-2">
                                <button type="submit" name="submit" class="btn-fluent-primary">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" style="vertical-align:middle;margin-right:6px;">
                                        <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z" fill="currentColor"/>
                                    </svg>
                                    Save Vehicle
                                </button>
                                <a href="transport_vechile_detail.php" class="btn-fluent-secondary">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" style="vertical-align:middle;margin-right:6px;">
                                        <path d="M20 11H7.83l5.59-5.59L12 4l-8 8 8 8 1.41-1.41L7.83 13H20v-2z" fill="currentColor"/>
                                    </svg>
                                    Back
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once("includes/footer.php"); ?>
