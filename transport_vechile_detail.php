<?php
declare(strict_types=1);
require_once("includes/bootstrap.php");
include_once("includes/header.php");
include_once("includes/sidebar.php");

$conn = Database::connection();

// Handle vehicle deletion
if(isset($_GET['sid']) && $_GET['sid'] != '') {
    $sid = mysqli_real_escape_string($conn, $_GET['sid']);
    mysqli_query($conn, "DELETE FROM transport_add_vechile WHERE vechile_id='$sid'");
    header("Location: transport_vechile_detail.php?msg=2");
    exit;
}

$msg = "";
if(isset($_GET['msg'])) {
    if($_GET['msg'] == 1) {
        $msg = "<div class='alert alert-success'>Vehicle added successfully</div>";
    } else if($_GET['msg'] == 2) {
        $msg = "<div class='alert alert-success'>Vehicle deleted successfully</div>";
    } else if($_GET['msg'] == 3) {
        $msg = "<div class='alert alert-success'>Vehicle updated successfully</div>";
    }
}
?>

<div class="page_title">
    <h3>Vehicle Detail</h3>
</div>

<?php include_once("includes/transport_setting_sidebar.php"); ?>

<div id="container">
    <div id="content">
        <div class="grid_container">
            <div class="grid_12">
                <div class="widget_wrap enterprise-card">
                    <div class="widget_top d-flex justify-content-between align-items-center">
                        <h6>Transport Vehicles</h6>
                        <a href="transport_add_vechile.php" class="btn-fluent-primary">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" style="vertical-align:middle;margin-right:6px;">
                                <path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z" fill="currentColor"/>
                            </svg>
                            Add New Vehicle
                        </a>
                    </div>
                    <div class="widget_content">
                        <?php if($msg != "") echo $msg; ?>
                        
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th style="width: 80px;">S.No.</th>
                                        <th>Vehicle Number</th>
                                        <th>Destination(s)</th>
                                        <th style="text-align: center;">No of Seats</th>
                                        <th style="text-align: center;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $i = 0;
                                    $sql = "SELECT * FROM transport_add_vechile ORDER BY vechile_no ASC";
                                    $res = mysqli_query($conn, $sql);
                                    
                                    if(mysqli_num_rows($res) > 0) {
                                        while($row_v = mysqli_fetch_assoc($res)) {
                                            $i++;
                                            
                                            // Resolve comma-separated route IDs to Names
                                            $route_ids = explode(",", (string)$row_v['route_id']);
                                            $route_names = [];
                                            foreach($route_ids as $id) {
                                                $id = trim($id);
                                                if(!empty($id)) {
                                                    $safe_id = mysqli_real_escape_string($conn, $id);
                                                    $res_r = mysqli_query($conn, "SELECT route_name FROM transport_add_route WHERE route_id='$safe_id'");
                                                    if($r_data = mysqli_fetch_assoc($res_r)) {
                                                        $route_names[] = $r_data['route_name'];
                                                    }
                                                }
                                            }
                                            $display_routes = !empty($route_names) ? implode(", ", $route_names) : "None";
                                    ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td class="fw-bold text-primary"><?php echo htmlspecialchars((string)$row_v['vechile_no']); ?></td>
                                        <td class="text-muted small"><?php echo htmlspecialchars($display_routes); ?></td>
                                        <td style="text-align: center;" class="fw-bold"><?php echo htmlspecialchars((string)$row_v['no_of_seats']); ?></td>
                                        <td style="text-align: center;">
                                            <a href="transport_edit_vehicle.php?sid=<?php echo $row_v['vechile_id']; ?>" class="btn btn-sm btn-primary me-2">Edit</a>
                                            <a href="transport_vechile_detail.php?sid=<?php echo $row_v['vechile_id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this vehicle?')">Delete</a>
                                        </td>
                                    </tr>
                                    <?php 
                                        } 
                                    } else { ?>
                                    <tr>
                                        <td colspan="5" style="text-align: center; padding: 60px; color: #64748b;">
                                            <div style="font-size: 16px; margin-bottom: 10px;">No vehicles found.</div>
                                            <div style="font-size: 13px;">Click "Add New Vehicle" to register your first transport vehicle.</div>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once("includes/footer.php"); ?>
