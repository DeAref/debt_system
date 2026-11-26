<?php
include 'header.php';
require_once '../library/db.php';

// ایجاد اتصال به دیتابیس
$db = new Database();
$conn = $db->getConnection();

// متغیرهای جستجو
$searchButtonIsClick = false;
$table_search = "";

if (isset($_POST['search'])){
    $searchButtonIsClick = true;
    $table_search = trim($_POST['table_search']);
}

// تابع برای دریافت وضعیت وام
function getDeptStatus($status) {
    switch($status) {
        case 0:
            return ["رد شد", "badge-danger"];
        case 1:
            return ["تایید شده", "badge-success"];
        default:
            return ["درحال بررسی", "bg-primary"];
    }
}

// تابع برای تعیین رنگ ردیف بر اساس تسویه حساب
function getPaidColorClass($payed, $monthCount) {
    return ($payed == $monthCount) ? "backGreen50Op" : "";
}

?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <!-- TABLE: LATEST ORDERS -->
            <div class="card">
                <div class="card-header border-transparent">
                    <h3 class="card-title">همه ی وام ها</h3>
                    <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 200px;">
                            <form action="" method="post" style="display: flex;">
                                <input type="text" name="table_search" class="form-control float-right" placeholder="جستجو بر اساس نام" value="<?php echo htmlspecialchars($table_search); ?>">
                                <div class="input-group-append">
                                    <button type="submit" name="search" class="btn btn-default"><i class="fa fa-search"></i></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table m-0">
                            <thead>
                                <tr>
                                    <th>ای دی محصول</th>
                                    <th>نام متقاضی</th>
                                    <th>مقدار وام</th>
                                    <th>تاریخ دریافت</th>
                                    <th>تعداد اقساط</th>
                                    <th>اقساط پرداخت شده</th>
                                    <th>اقساط مانده</th>
                                    <th>وضعیت</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // آماده‌سازی کوئری
                                if (!$searchButtonIsClick) {
                                    $query = "SELECT dept.`id`,`deptValue`,`date`,`status`,`monthCount`,`unPayed`,`payed`,`user`.`name` 
                                             FROM dept 
                                             INNER JOIN `user` ON dept.user_id=user.id 
                                             ORDER BY `dept`.`date` DESC";
                                } else {
                                    $query = "SELECT dept.`id`,`deptValue`,`date`,`status`,`monthCount`,`unPayed`,`payed`,`user`.`name` 
                                             FROM dept 
                                             INNER JOIN `user` ON dept.user_id=user.id 
                                             WHERE `user`.`name` LIKE ? 
                                             ORDER BY `dept`.`date` DESC";
                                }

                                // اجرای کوئری
                                if (!$searchButtonIsClick) {
                                    $result = mysqli_query($conn, $query);
                                } else {
                                    $stmt = mysqli_prepare($conn, $query);
                                    $searchParam = "%$table_search%";
                                    mysqli_stmt_bind_param($stmt, "s", $searchParam);
                                    mysqli_stmt_execute($stmt);
                                    $result = mysqli_stmt_get_result($stmt);
                                }

                                // نمایش نتایج
                                if ($result && mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $id = $row["id"];
                                        $deptValue = $row["deptValue"];
                                        $date = $row["date"];
                                        $status = $row["status"];
                                        $monthCount = $row["monthCount"];
                                        $name = $row["name"];
                                        $unPayed = $row["unPayed"];
                                        $payed = $row["payed"];
                                        
                                        // دریافت وضعیت و رنگ مربوطه
                                        list($resultStatus, $colorStatus) = getDeptStatus($status);
                                        
                                        // تعیین رنگ ردیف
                                        $paidColor = getPaidColorClass($payed, $monthCount);
                                        
                                        echo "<tr class='$paidColor'>
                                                <td>$id</td>
                                                <td>" . htmlspecialchars($name) . "</td>
                                                <td>$deptValue</td>
                                                <td>$date</td>
                                                <td>$monthCount</td>
                                                <td>$payed</td>
                                                <td>$unPayed</td>
                                                <td><span class='badge $colorStatus'>$resultStatus</span></td>
                                              </tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='8' class='text-center'>نتیجه‌ای یافت نشد.</td></tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.table-responsive -->
                </div>
                <!-- /.card-body -->
                <div class="card-footer clearfix">
                    <a href="statusDebts.php" class="btn btn-sm btn-info float-left">تایید و رد</a>
                </div>
                <!-- /.card-footer -->
            </div>
            <!-- /.card -->
        </div><!--/. container-fluid -->
    </section>
</div>

<?php
include 'footer.php';
?>