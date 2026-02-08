<?php
declare(strict_types=1);

/**
 * ID 2.0: Fees Manager Hub
 * Group 2: Fees & Accounts
 */
require_once("includes/bootstrap.php");
require_once("includes/header.php");
require_once("includes/sidebar.php");
?>

<div class="page_title" style="background: transparent; box-shadow: none; border-bottom: 1px solid var(--app-border); border-radius: 0; margin-bottom: 30px;">
    <h3 style="font-weight: 400; color: var(--fluent-slate); font-size: 24px;">Fees Management</h3>
</div>

<?php include_once("includes/fees_setting_sidebar.php");?>

<div class="grid_container">
    <div class="azure-card" style="margin-bottom: 30px; padding: 25px;">
        <h4 style="color: var(--app-primary); margin-bottom: 15px; font-weight: 500;">Search Fee Records</h4>
        <form action="fees_search_result.php" method="post" class="fluent-search-form">
            <div style="display: grid; grid-template-columns: 1fr 1fr 150px; gap: 15px; align-items: end;">
                <div class="form_group">
                    <label style="font-size: 12px; font-weight: 600;">Registration Number</label>
                    <input name="registration_no" type="text" class="form-control fluent-input" placeholder="e.g. 2024/001">
                </div>
                <div class="form_group">
                    <label style="font-size: 12px; font-weight: 600;">Student Name</label>
                    <input name="student_name" type="text" class="form-control fluent-input" placeholder="Search by name...">
                </div>
                <button type="submit" class="btn-fluent-primary" style="height: 42px;">Search Records</button>
            </div>
        </form>
    </div>

    <div class="widget_wrap azure-card">
        <div class="widget_top">
            <h6 class="fluent-card-header">Fee Collection Records</h6>
            <div class="widget_actions">
                <a href="fees_searchby_name.php" class="btn-fluent-primary">+ Collect New Fee</a>
            </div>
        </div>
        <div class="widget_content">
            <table class="display data_tbl fluent-table">
                <thead>
                    <tr>
                        <th style="width: 50px;">#</th>
                        <th>Reg. No</th>
                        <th>Student Name</th>
                        <th>Term</th>
                        <th>Amount</th>
                        <th class="center">Deposit Date</th>
                        <th class="center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $mytablename = "student_fees_detail";
                    include("fees_manager_pagination.php"); // Preserving existing pagination
                    
                    $i = $start + 1;
                    $sql = "SELECT f.*, a.student_name 
                            FROM student_fees_detail f 
                            JOIN admissions a ON f.registration_no = a.reg_no 
                            WHERE f.session = '".$_SESSION['session']."' 
                            ORDER BY f.id DESC LIMIT $start, $limit";
                    $res = db_query($sql);
                    
                    while($row = db_fetch_array($res)) { ?>
                    <tr>
                        <td class="center"><?php echo $i; ?></td>
                        <td class="center"><span class="fluent-badge-outline"><?php echo $row['registration_no']; ?></span></td>
                        <td style="font-weight: 600;"><?php echo htmlspecialchars($row['student_name']); ?></td>
                        <td class="center"><?php echo $row['fees_term']; ?></td>
                        <td class="center" style="color: #059669; font-weight: 700;">₹<?php echo number_format((float)$row['fees_amount'], 2); ?></td>
                        <td class="center"><?php echo date('d-M-Y', strtotime($row['deposit_date'])); ?></td>
                        <td class="center">
                            <div class="fluent-action-group">
                                <a href="fees_reciept.php?registration_no=<?php echo $row['registration_no']; ?>" class="fluent-btn-icon" title="View Receipt">
                                    <svg viewBox="0 0 24 24" width="18" height="18"><path d="M19 8H5c-1.66 0-3 1.33-3 3v6h4v4h12v-4h4v-6c0-1.67-1.34-3-3-3zm-3 11H8v-5h8v5zm3-7c-.55 0-1-.45-1-1s.45-1 1-1 1 .45 1 1-.45 1-1 1zm-1-9H6v4h12V3z"/></svg>
                                </a>
                                <a href="edit_student_fees.php?sid=<?php echo $row[0]; ?>" class="fluent-btn-icon" title="Edit Record">
                                    <svg viewBox="0 0 24 24" width="18" height="18"><path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04c.39-.39.39-1.02 0-1.41l-2.34-2.34c-.39-.39-1.02-.39-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z"/></svg>
                                </a>
                            </div>
                        </td>
                    </tr>
                    <?php $i++; } ?>
                </tbody>
            </table>
            
            <div class="fluent-pagination-wrapper">
                <?php echo $pagination; ?>
            </div>
        </div>
    </div>
</div>

<style>
    .title_icon { display: none !important; }
    .fluent-pagination-wrapper { padding: 20px; text-align: right; border-top: 1px solid var(--app-border); }
    .fluent-pagination-wrapper a, .fluent-pagination-wrapper span { 
        padding: 6px 14px; border: 1px solid var(--app-border); margin-left: 5px; border-radius: 4px; color: var(--app-primary); text-decoration: none; font-size: 13px;
    }
    .fluent-pagination-wrapper .current { background: var(--app-primary); color: white; border-color: var(--app-primary); }
</style>

<?php require_once("includes/footer.php"); ?>
