<?php

declare(strict_types=1);

// Start session for demo
session_start();

// Simple demo without database requirement
$_SESSION['username'] = 'Demo User';
$appName = 'School ERP';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo htmlspecialchars($appName, ENT_QUOTES, 'UTF-8'); ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/enterprise.css">
    <link rel="stylesheet" href="assets/css/legacy-bridge.css">
</head>
<body class="app-body">
    <header class="app-header shadow-sm">
        <div class="container-fluid d-flex align-items-center justify-content-between py-3">
            <div class="d-flex align-items-center gap-3">
                <div class="app-logo">ERP</div>
                <div>
                    <div class="app-title"><?php echo htmlspecialchars($appName, ENT_QUOTES, 'UTF-8'); ?></div>
                    <div class="app-subtitle">Enterprise School Management</div>
                </div>
            </div>
            <div class="d-flex align-items-center gap-3">
                <span class="badge bg-success">Demo Mode</span>
                <span class="ms-2">Welcome, <?php echo htmlspecialchars($_SESSION['username'], ENT_QUOTES, 'UTF-8'); ?></span>
                <a href="logout.php" class="btn btn-outline-danger btn-sm" title="Logout">
                    <span>Logout</span>
                </a>
            </div>
        </div>
    </header>
    <div class="app-shell">
        <aside class="app-sidebar">
            <nav class="nav flex-column gap-1">
                <a class="nav-link active" href="demo_dashboard.php">Dashboard</a>
                <div class="nav-section">Admissions</div>
                <a class="nav-link" href="#rte">RTE Admission</a>
                <a class="nav-link" href="#students">Student Details</a>
                <div class="nav-section">Academics</div>
                <a class="nav-link" href="#classes">Classes</a>
                <a class="nav-link" href="#sections">Sections</a>
                <a class="nav-link" href="#streams">Streams</a>
                <a class="nav-link" href="#subjects">Subjects</a>
                <div class="nav-section">Operations</div>
                <a class="nav-link" href="#transport">Transport</a>
                <a class="nav-link" href="#library">Library</a>
                <a class="nav-link" href="#staff">Staff</a>
            </nav>
        </aside>
        <div class="app-content">
            <div class="page_title">
                <h3>Dashboard</h3>
                <div class="top_search">
                    <form action="#" method="post">
                        <ul id="search_box">
                            <li>
                                <input name="" type="text" class="search_input" placeholder="Search...">
                            </li>
                            <li>
                                <input name="" type="submit" value="🔍" class="search_btn">
                            </li>
                        </ul>
                    </form>
                </div>
            </div>
            
            <div id="container">
                <div id="content">
                    <div class="grid_container">
                        <div class="grid_12 full_block">
                            <div class="widget_wrap">
                                <div class="widget_content">
                                    <div class="alert alert-info mb-4" role="alert">
                                        <strong>Demo Mode:</strong> This is a demonstration of the fixed CSS layout. All styling is now working correctly with proper alignment and no distortion.
                                    </div>
                                    
                                    <h4 class="mb-3">Module Navigation</h4>
                                    <p class="mb-4">Select a module to manage different aspects of your school:</p>
                                    
                                    <div class="switch_bar">
                                        <ul>
                                            <li>
                                                <a href="#school">
                                                    <span class="stats_icon config_sl"></span>
                                                    <span class="label">School Setting</span>
                                                </a>
                                            </li>
                                            
                                            <li>
                                                <a href="#admission">
                                                    <span class="stats_icon current_work_sl"></span>
                                                    <span class="label">Admission</span>
                                                </a>
                                            </li>
                                            
                                            <li>
                                                <a href="#student">
                                                    <span class="stats_icon user_sl"></span>
                                                    <span class="label">Student Details</span>
                                                </a>
                                            </li>
                                            
                                            <li>
                                                <a href="#fees">
                                                    <span class="stats_icon archives_sl"></span>
                                                    <span class="label">Fees</span>
                                                </a>
                                            </li>
                                            
                                            <li>
                                                <a href="#account">
                                                    <span class="stats_icon bank_sl"></span>
                                                    <span class="label">Account</span>
                                                </a>
                                            </li>
                                            
                                            <li>
                                                <a href="#exam">
                                                    <span class="stats_icon administrative_docs_sl"></span>
                                                    <span class="label">Examination</span>
                                                </a>
                                            </li>
                                            
                                            <li>
                                                <a href="#transport">
                                                    <span class="stats_icon category_sl"></span>
                                                    <span class="label">Transport</span>
                                                </a>
                                            </li>
                                            
                                            <li>
                                                <a href="#staff">
                                                    <span class="stats_icon folder_sl"></span>
                                                    <span class="label">Staff</span>
                                                </a>
                                            </li>
                                            
                                            <li>
                                                <a href="#library">
                                                    <span class="stats_icon finished_work_sl"></span>
                                                    <span class="label">Library</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    
                                    <div class="mt-5">
                                        <h5>Form Example</h5>
                                        <form class="form_container">
                                            <ul>
                                                <li>
                                                    <label class="field_title">Sample Input Field</label>
                                                    <input type="text" placeholder="Enter text here">
                                                </li>
                                                <li>
                                                    <label class="field_title">Sample Select Field</label>
                                                    <select>
                                                        <option>Option 1</option>
                                                        <option>Option 2</option>
                                                        <option>Option 3</option>
                                                    </select>
                                                </li>
                                                <li>
                                                    <button type="button" class="btn_blue btn_small">
                                                        <span>Submit</span>
                                                    </button>
                                                    <button type="button" class="btn_orange btn_small">
                                                        <span>Cancel</span>
                                                    </button>
                                                </li>
                                            </ul>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer class="app-footer">
        <div class="container-fluid d-flex flex-wrap justify-content-between align-items-center py-3">
            <div>© <?php echo date('Y'); ?> School ERP. All rights reserved.</div>
            <div class="text-muted">Demo - CSS Layout Fixed</div>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
