<?php
declare(strict_types=1);
require_once("includes/header.php");
require_once("includes/sidebar.php");
?>

<div class="page_title">
    <h3>Access Denied</h3>
</div>

<div id="container">
    <div id="content">
        <div class="grid_container">
            <div class="grid_12">
                <div class="widget_wrap">
                    <div class="widget_top">
                        <span class="h_icon enterprise-card-icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"/>
                            </svg>
                        </span>
                        <h4 class="heading">Access Denied</h4>
                    </div>
                    <div class="widget_content" style="padding: 40px; text-align: center;">
                        <div style="margin-bottom: 30px;">
                            <svg width="120" height="120" viewBox="0 0 24 24" fill="#FF6B6B" style="opacity: 0.5;">
                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 11c-.55 0-1-.45-1-1V8c0-.55.45-1 1-1s1 .45 1 1v4c0 .55-.45 1-1 1zm1 4h-2v-2h2v2z"/>
                            </svg>
                        </div>
                        
                        <h2 style="color: #605E5C; margin-bottom: 15px; font-weight: 400;">Access Denied</h2>
                        <p style="color: #8A8886; font-size: 16px; line-height: 1.6; margin-bottom: 30px; max-width: 600px; margin-left: auto; margin-right: auto;">
                            You do not have permission to access this page. Your current role 
                            <strong style="color: #0078D4;"><?php echo htmlspecialchars(RBAC::getUserRole()); ?></strong> 
                            does not have the required permissions.
                        </p>
                        
                        <?php if (isset($_GET['module']) && isset($_GET['action'])): ?>
                        <div style="background: #FFF4CE; border: 1px solid #FFE69C; border-radius: 4px; padding: 15px; margin-bottom: 30px; max-width: 600px; margin-left: auto; margin-right: auto;">
                            <p style="margin: 0; color: #8A8100; font-size: 14px;">
                                <strong>Required Permission:</strong> 
                                <?php echo htmlspecialchars($_GET['module']); ?> - <?php echo htmlspecialchars($_GET['action']); ?>
                            </p>
                        </div>
                        <?php endif; ?>
                        
                        <div style="margin-top: 40px; display: flex; gap: 15px; justify-content: center; flex-wrap: wrap;">
                            <a href="dashboard.php" class="btn-fluent-primary">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor" style="margin-right: 6px;">
                                    <path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/>
                                </svg>
                                Go to Dashboard
                            </a>
                            <button onclick="history.back()" class="btn-fluent-secondary">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor" style="margin-right: 6px;">
                                    <path d="M20 11H7.83l5.59-5.59L12 4l-8 8 8 8 1.41-1.41L7.83 13H20v-2z"/>
                                </svg>
                                Go Back
                            </button>
                        </div>
                        
                        <div style="margin-top: 50px; padding-top: 30px; border-top: 1px solid #F3F2F1;">
                            <p style="color: #8A8886; font-size: 14px; margin: 0;">
                                If you believe you should have access to this page, please contact your system administrator.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.enterprise-card-icon {
    color: #FF6B6B;
}
</style>

<?php require_once("includes/footer.php"); ?>
