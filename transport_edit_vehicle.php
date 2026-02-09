<?php
declare(strict_types=1);
require_once("includes/bootstrap.php");
include_once("includes/header.php");
include_once("includes/sidebar.php");

$conn = Database::connection();
$sid = isset($_GET['sid']) ? db_escape($_GET['sid']) : '';
$msg = "";

// Process Update Logic
if(isset($_POST['submit'])) {
    $vechile_number = db_escape($_POST['vechile_number']);
    $seats = db_escape($_POST['seat']);
    // Escape each route ID before joining
    $route_ids = isset($_POST['route_id']) ? array_map('db_escape', $_POST['route_id']) : [];
    $route_id_str = implode(",", $route_ids);
    
    $sql_update = "UPDATE transport_add_vechile SET vechile_no='$vechile_number', route_id='$route_id_str', no_of_seats='$seats' WHERE vechile_id='" . db_escape($sid) . "'";
    
    if(db_query($sql_update)) {
        header("Location: transport_vechile_detail.php?msg=3");
        exit;
    } else {
        $msg = "<div class='alert alert-danger'>Update Error: " . htmlspecialchars(db_error()) . "</div>";
    }
}

// Fetch Data
if(empty($sid)) {
    header("Location: transport_vechile_detail.php");
    exit;
}

$sql_fetch = "SELECT * FROM transport_add_vechile WHERE vechile_id='" . db_escape($sid) . "'";
$res_fetch = db_query($sql_fetch);

if(!$res_fetch || db_num_rows($res_fetch) == 0) {
    header("Location: transport_vechile_detail.php?msg=error");
    exit;
}

$row = db_fetch_array($res_fetch);

// Handle potential column name differences
$display_number = $row['vechile_no'] ?? $row['vechile_number'] ?? '';
$display_seats = $row['no_of_seats'] ?? $row['seat'] ?? '';
?>

<div class="page_title">
    <h3>Edit Vehicle</h3>
</div>

<?php include_once("includes/transport_setting_sidebar.php"); ?>

<div id="container">
    <div id="content">
        <div class="grid_container">
            <div class="grid_12">
                <div class="widget_wrap enterprise-card">
                    <div class="widget_top">
                        <h6>Edit Vehicle Detail</h6>
                    </div>
                    <div class="widget_content p-4">
                        <?php if($msg != "") echo $msg; ?>
                        
                        <form action="transport_edit_vehicle.php?sid=<?php echo htmlspecialchars($sid); ?>" method="post">
                            <div class="row g-3 mb-4">
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Vehicle Number <span class="text-danger">*</span></label>
                                    <input name="vechile_number" type="text" class="form-control" value="<?php echo htmlspecialchars((string)$display_number); ?>" required />
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Number of Seats <span class="text-danger">*</span></label>
                                    <input name="seat" type="number" class="form-control" value="<?php echo htmlspecialchars((string)$display_seats); ?>" required />
                                </div>
                            </div>
                            
                            <div class="row g-3 mb-4">
                                <div class="col-md-12">
                                    <label class="form-label fw-bold">Select Route(s)</label>
                                    <div class="border rounded p-3 bg-light" style="max-height: 250px; overflow-y: auto;">
                                        <?php 
                                        $current_routes = explode(",", (string)$row['route_id']);
                                        $sql_r = "SELECT * FROM transport_add_route ORDER BY route_name ASC";
                                        $res_r = db_query($sql_r);
                                        
                                        if($res_r && db_num_rows($res_r) > 0) {
                                            while($row_r = db_fetch_array($res_r)) {
                                                $checked = in_array($row_r['route_id'], $current_routes) ? 'checked' : '';
                                                echo '<div class="form-check mb-2">';
                                                echo '<input class="form-check-input" type="checkbox" name="route_id[]" value="'.$row_r['route_id'].'" id="route_'.$row_r['route_id'].'" '.$checked.'>';
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
                                    Update Vehicle
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

<?php include_once("includes/footer.php"); ?>
