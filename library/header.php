<?php
include __DIR__ . '/config.php';

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

if (empty($_SESSION['Validation']) || empty($_SESSION['nCode'])) {
    header("Location: $loginAddress");
    exit;
}

$nCode = $_SESSION['nCode'];
$stmt = mysqli_prepare($conn, 'SELECT id, name, lName, profilePicture FROM `user` WHERE nCode = ? LIMIT 1');
if (!$stmt) {
    http_response_code(500);
    exit('خطا در بارگذاری اطلاعات کاربر.');
}
mysqli_stmt_bind_param($stmt, 's', $nCode);
mysqli_stmt_execute($stmt);
$userResult = mysqli_stmt_get_result($stmt);
$user = $userResult ? mysqli_fetch_assoc($userResult) : null;
mysqli_stmt_close($stmt);

if (!$user) {
    header("Location: $loginAddress");
    exit;
}

$user_id = (int) $user['id'];
$userName = trim($user['name'] . ' ' . $user['lName']);
$profilePicture = $user['profilePicture'] ?: '../dist/img/user-default.png';

$stmt = mysqli_prepare($conn, "SELECT COUNT(*) AS total FROM `dept` WHERE user_id = ? AND status NOT IN (0, 2)");
mysqli_stmt_bind_param($stmt, 'i', $user_id);
mysqli_stmt_execute($stmt);
$countOfDebt = (int) mysqli_fetch_assoc(mysqli_stmt_get_result($stmt))['total'];
mysqli_stmt_close($stmt);
?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>پنل کاربر | داشبورد</title>
    <link rel="stylesheet" href="../plugins/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="../dist/css/adminlte.min.css">
    <link rel="stylesheet" href="../dist/css/bootstrap-rtl.min.css">
    <link rel="stylesheet" href="../dist/css/custom-style.css">
    <style>
        body, .brand-text, .nav-link, .breadcrumb-item, .small-box h3, .info-box-text, .description-text {
            font-family: 'Vazir', Tahoma, Geneva, Verdana, sans-serif;
        }
        .main-header .navbar-nav .nav-link { padding: .5rem 1rem; }
        .user-panel .info { text-align: right; }
        .sidebar .nav-link p { margin-right: 5px; }
        .small-box .icon { top: 10px; }
        .content-header h1 { font-weight: bold; }
    </style>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
    <nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom" aria-label="منوی بالای صفحه">
        <ul class="navbar-nav">
            <li class="nav-item"><a class="nav-link" data-widget="pushmenu" href="#" aria-label="باز و بسته کردن منو"><i class="fa fa-bars" aria-hidden="true"></i></a></li>
            <li class="nav-item d-none d-sm-inline-block"><a href="index.php" class="nav-link">خانه</a></li>
            <li class="nav-item d-none d-sm-inline-block"><a href="logout.php" class="nav-link">خروج</a></li>
        </ul>
    </nav>
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <a href="index.php" class="brand-link">
            <img src="../dist/img/bank-flat.png" alt="" class="brand-image img-circle elevation-3" style="opacity:.8">
            <span class="brand-text font-weight-light">پنل کاربر</span>
        </a>
        <div class="sidebar" style="direction:ltr"><div style="direction:rtl">
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image"><img src="<?php echo htmlspecialchars($profilePicture, ENT_QUOTES, 'UTF-8'); ?>" class="img-circle" alt="تصویر پروفایل"></div>
                <div class="info"><a href="profile.php" class="d-block"><?php echo htmlspecialchars($userName, ENT_QUOTES, 'UTF-8'); ?></a></div>
            </div>
            <nav class="mt-2" aria-label="منوی اصلی">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <li class="nav-item"><a href="index.php" class="nav-link <?php echo basename($_SERVER['PHP_SELF']) === 'index.php' ? 'active' : ''; ?>"><i class="nav-icon fa fa-dashboard" aria-hidden="true"></i><p>داشبورد</p></a></li>
                    <li class="nav-item"><a href="depts.php" class="nav-link <?php echo basename($_SERVER['PHP_SELF']) === 'depts.php' ? 'active' : ''; ?>"><i class="nav-icon fa fa-th" aria-hidden="true"></i><p>وام‌ها</p></a></li>
                    <li class="nav-item"><a href="payment.php" class="nav-link <?php echo basename($_SERVER['PHP_SELF']) === 'payment.php' ? 'active' : ''; ?>"><i class="nav-icon fa fa-pie-chart" aria-hidden="true"></i><p>پرداختی‌ها <span class="right badge badge-danger"><?php echo $countOfDebt; ?></span></p></a></li>
                    <li class="nav-item"><a href="ticket.php" class="nav-link <?php echo basename($_SERVER['PHP_SELF']) === 'ticket.php' ? 'active' : ''; ?>"><i class="nav-icon fa fa-envelope-o" aria-hidden="true"></i><p>ایجاد تیکت</p></a></li>
                    <li class="nav-item"><a href="ticketList.php" class="nav-link <?php echo basename($_SERVER['PHP_SELF']) === 'ticketList.php' ? 'active' : ''; ?>"><i class="nav-icon fa fa-list" aria-hidden="true"></i><p>تیکت‌ها</p></a></li>
                    <li class="nav-item"><a href="getdept.php" class="nav-link <?php echo basename($_SERVER['PHP_SELF']) === 'getdept.php' ? 'active' : ''; ?>"><i class="nav-icon fa fa-edit" aria-hidden="true"></i><p>درخواست وام</p></a></li>
                    <li class="nav-item"><a href="profile.php" class="nav-link <?php echo basename($_SERVER['PHP_SELF']) === 'profile.php' ? 'active' : ''; ?>"><i class="nav-icon fa fa-user" aria-hidden="true"></i><p>پروفایل</p></a></li>
                    <li class="nav-item"><a href="logout.php" class="nav-link"><i class="nav-icon fa fa-sign-out" aria-hidden="true"></i><p>خروج</p></a></li>
                </ul>
            </nav>
        </div></div>
    </aside>