<?php

declare(strict_types=1);

require_once __DIR__ . '/includes/bootstrap.php';

$appName = app_config('name', 'School ERP');
$error = $_GET['errormsg'] ?? '';
$message = '';
if ($error === '1') {
    $message = 'Invalid username or password.';
} elseif ($error === '2') {
    $message = 'Your account was not found.';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo htmlspecialchars($appName, ENT_QUOTES, 'UTF-8'); ?> | Sign In</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/enterprise.css">
    <style>
        body.app-body {
            display: grid;
            place-items: center;
            min-height: 100vh;
        }
        .login-card {
            width: min(420px, 92vw);
            background: var(--app-surface);
            border-radius: var(--app-radius);
            box-shadow: var(--app-shadow);
            padding: 32px;
        }
    </style>
</head>
<body class="app-body">
    <div class="login-card">
        <div class="text-center mb-4">
            <div class="app-logo mx-auto mb-3">ERP</div>
            <h1 class="h4 mb-1">Welcome back</h1>
            <p class="text-muted">Sign in to <?php echo htmlspecialchars($appName, ENT_QUOTES, 'UTF-8'); ?></p>
        </div>
        <?php if ($message !== ''): ?>
            <div class="alert alert-danger" role="alert">
                <?php echo htmlspecialchars($message, ENT_QUOTES, 'UTF-8'); ?>
            </div>
        <?php endif; ?>
        <form method="post" action="login_process.php" class="d-grid gap-3">
            <div>
                <label class="form-label" for="username">Username</label>
                <input class="form-control" id="username" name="username" type="text" required>
            </div>
            <div>
                <label class="form-label" for="password">Password</label>
                <input class="form-control" id="password" name="password" type="password" required>
            </div>
            <button class="btn btn-primary btn-lg" type="submit" name="login">Sign In</button>
        </form>
        <div class="text-center text-muted mt-4">Secure enterprise access portal</div>
    </div>
</body>
</html>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width"/>
<title>Schoolerp</title>
<link href="css/reset.css" rel="stylesheet" type="text/css">
<link href="css/layout.css" rel="stylesheet" type="text/css">
<link href="css/themes.css" rel="stylesheet" type="text/css">
<link href="css/typography.css" rel="stylesheet" type="text/css">
<link href="css/styles.css" rel="stylesheet" type="text/css">
<link href="css/shCore.css" rel="stylesheet" type="text/css">
<link href="css/bootstrap.css" rel="stylesheet" type="text/css">
<link href="css/jquery.jqplot.css" rel="stylesheet" type="text/css">
<link href="css/jquery-ui-1.8.18.custom.css" rel="stylesheet" type="text/css">
<link href="css/data-table.css" rel="stylesheet" type="text/css">
<link href="css/form.css" rel="stylesheet" type="text/css">
<link href="css/ui-elements.css" rel="stylesheet" type="text/css">
<link href="css/wizard.css" rel="stylesheet" type="text/css">
<link href="css/sprite.css" rel="stylesheet" type="text/css">
<link href="css/gradient.css" rel="stylesheet" type="text/css">
<!--[if IE 7]>
<link rel="stylesheet" type="text/css" href="css/ie/ie7.css" />
<![endif]-->
<!--[if IE 8]>
<link rel="stylesheet" type="text/css" href="css/ie/ie8.css" />
<![endif]-->
<!--[if IE 9]>
<link rel="stylesheet" type="text/css" href="css/ie/ie9.css" />
<![endif]-->
<!-- Jquery -->
<script src="js/jquery-1.7.1.min.js"></script>
<script src="js/jquery-ui-1.8.18.custom.min.js"></script>
<script src="js/chosen.jquery.js"></script>
<script src="js/uniform.jquery.js"></script>
<script src="js/bootstrap-dropdown.js"></script>
<script src="js/bootstrap-colorpicker.js"></script>
<script src="js/sticky.full.js"></script>
<script src="js/jquery.noty.js"></script>
<script src="js/selectToUISlider.jQuery.js"></script>
<script src="js/fg.menu.js"></script>
<script src="js/jquery.tagsinput.js"></script>
<script src="js/jquery.cleditor.js"></script>
<script src="js/jquery.tipsy.js"></script>
<script src="js/jquery.peity.js"></script>
<script src="js/jquery.simplemodal.js"></script>
<script src="js/jquery.jBreadCrumb.1.1.js"></script>
<script src="js/jquery.colorbox-min.js"></script>
<script src="js/jquery.idTabs.min.js"></script>
<script src="js/jquery.multiFieldExtender.min.js"></script>
<script src="js/jquery.confirm.js"></script>
<script src="js/elfinder.min.js"></script>
<script src="js/accordion.jquery.js"></script>
<script src="js/autogrow.jquery.js"></script>
<script src="js/check-all.jquery.js"></script>
<script src="js/data-table.jquery.js"></script>
<script src="js/ZeroClipboard.js"></script>
<script src="js/TableTools.min.js"></script>
<script src="js/jeditable.jquery.js"></script>
<script src="js/duallist.jquery.js"></script>
<script src="js/easing.jquery.js"></script>
<script src="js/full-calendar.jquery.js"></script>
<script src="js/input-limiter.jquery.js"></script>
<script src="js/inputmask.jquery.js"></script>
<script src="js/iphone-style-checkbox.jquery.js"></script>
<script src="js/meta-data.jquery.js"></script>
<script src="js/quicksand.jquery.js"></script>
<script src="js/raty.jquery.js"></script>
<script src="js/smart-wizard.jquery.js"></script>
<script src="js/stepy.jquery.js"></script>
<script src="js/treeview.jquery.js"></script>
<script src="js/ui-accordion.jquery.js"></script>
<script src="js/vaidation.jquery.js"></script>
<script src="js/mosaic.1.0.1.min.js"></script>
<script src="js/jquery.collapse.js"></script>
<script src="js/jquery.cookie.js"></script>
<script src="js/jquery.autocomplete.min.js"></script>
<script src="js/localdata.js"></script>
<script src="js/excanvas.min.js"></script>
<script src="js/jquery.jqplot.min.js"></script>
<script src="js/chart-plugins/jqplot.dateAxisRenderer.min.js"></script>
<script src="js/chart-plugins/jqplot.cursor.min.js"></script>
<script src="js/chart-plugins/jqplot.logAxisRenderer.min.js"></script>
<script src="js/chart-plugins/jqplot.canvasTextRenderer.min.js"></script>
<script src="js/chart-plugins/jqplot.canvasAxisTickRenderer.min.js"></script>
<script src="js/chart-plugins/jqplot.highlighter.min.js"></script>
<script src="js/chart-plugins/jqplot.pieRenderer.min.js"></script>
<script src="js/chart-plugins/jqplot.barRenderer.min.js"></script>
<script src="js/chart-plugins/jqplot.categoryAxisRenderer.min.js"></script>
<script src="js/chart-plugins/jqplot.pointLabels.min.js"></script>
<script src="js/chart-plugins/jqplot.meterGaugeRenderer.min.js"></script>
<script src="js/custom-scripts.js"></script>
<script type="text/javascript">
$(function(){
	$(window).resize(function(){
		$('.login_container').css({
			position:'absolute',
			left: ($(window).width() - $('.login_container').outerWidth())/2,
			top: ($(window).height() - $('.login_container').outerHeight())/2
		});
	});
	// To initially run the function:
	$(window).resize();
});
</script>
    <link rel="stylesheet" href="css/enterprise.css">
</head>
<body id="theme-default" class="full_block">
<div id="login_page">
	<div class="login_container">
		<div class="login_header blue_lgel">
			<ul class="login_branding">
				<li>
				<div class="logo_small">
					<img src="images/logo.png" width="300" height="49" alt="bingo">
				</div>
				
				</li>
				
			</ul>
		</div>
		<form action="login_process.php" method="post">
			<div class="login_form">
				<h3 class="blue_d">Admin Login</h3>
				<ul>
                 <?php 
				if($_GET['errormsg']==1)
				{
									?>
                <li   style="color:#F00;">
					Username or password is worng.
					</li>
                    
                     <?php } ?>
			
					<li class="login_user">
					<input name="username"  type="text">
					</li>
					<li class="login_pass">
					<input name="password" type="password" >
					</li>
				</ul>
			</div>
			<input class="login_btn blue_lgel" name="login" value="Login" type="submit">
			<ul class="login_opt_link">
				<li><a href="forgot-pass.html" style="color:#666">Forgot Password?</a></li>
				<li class="remember_me right" style="color:#666">
				<input name="apdiv" class="rem_me" type="checkbox" value="checked">
				Remember Me</li>
			</ul>
		</form>
	</div>
</div>
</body>
</html>
