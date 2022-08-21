<?php
session_start();
include '../library/header.php';

if (isset($_POST['submit-edit-profile'])){
    $filename = $_FILES["profilePicture"]["name"];
    $tempname = $_FILES["profilePicture"]["tmp_name"];
    $rnd = rand(1000,9999);
    
    if (!is_uploaded_file($_FILES['profilePicture']['tmp_name'])) {
        $messageResult =  'تصویر پروفایل انتخاب نکردید';
    }else{
        if(isset($_POST['name_edit']) && isset($_POST['lName_edit']) && isset($_POST['email_edit']) && isset($_POST['fathername_edit']) && isset($_POST['bDate']) && isset($_FILES['profilePicture'])){
            $folder = "../uploads/".$rnd.$filename;
            //upload
            if (move_uploaded_file($tempname, $folder)) {
                $newProfilePicture = $folder;
                $msg = "Image uploaded successfully";
                // echo "<script>alert('$msg');</script>";
        
            }else{
        
                $msg = "Failed to upload image";
                //echo "<script>alert('$msg');</script>";
            }
            $newName = $_POST['name_edit'];
            $newLName = $_POST['lName_edit'];
            $newEmail = $_POST['email_edit'];
            $newFatherName = $_POST['fathername_edit'];
            $newBdate = $_POST['bDate'];
            
            $query ="UPDATE `user` SET `name`='$newName',`lName` = '$newLName',`fatherName`='$newFatherName',`bDate`='$newBdate',`profilePicture`='$newProfilePicture',`email`='$newEmail' WHERE `user`.`id` = '$user_id';";
            $result = mysqli_query($conn,$query);
            if($result == true){
                $messageResult = "اطلاعات با موفقیت بروزرسانی شدند...";
            }else{
                $messageResult = "مشکل غیر منتظره".$result->error;
            }
        }else{
            echo "<script>alert('تمامی فیلد های ضروری باید پر شده باشند');</script>";
            echo "<audio src='http://freesoundeffect.net/sites/default/files/incorrect-answer--6-sound-effect-99679566.mp3' autoplay ></audio>";
        }
    }
}

   

if (isset($_POST['changePassword'])){
    $pass2Edit = $_POST['pass2Edit'];
    $pass1Edit = $_POST['pass1Edit'];

    if ($pass1Edit == $pass2Edit){
        $hashPassword = md5($pass1Edit);
        $query = "UPDATE `user` SET `password` = '$hashPassword' WHERE `user`.`id` = '$user_id';";
        if(mysqli_query($conn,$query)){
            $messageResult = "پسورد با موفقیت عوض شد...";
        }else{
            $messageResult = "مشکل غیر منتظره";
        }

    }else{
        $messageResult = "پسورد ها یکسان نیست";
    }
}

$Query = "SELECT `name`,`lName`,`nCode`,`fatherName`,`bDate`,`profilePicture`,`email` FROM `user` WHERE `nCode` = '$nCode'";
$result = mysqli_query($conn,$Query);
if (mysqli_num_rows($result) > 0) {
    while ($Row = mysqli_fetch_assoc($result)) {
        $name = $Row['name'];
        $lName = $Row['lName'];
        $nCode = $Row['nCode'];
        $fatherName = $Row['fatherName'];
        $bDate = $Row['bDate'];
        $profilePicture = $Row['profilePicture'];
        $email = $Row['email'];
    }

}

// get user all debts
//----------------------
$sumDeptValue = 0;
$sumMonthCount = 0;
$query = "SELECT deptValue,payed,monthCount FROM `dept` WHERE `user_id`='$user_id'";
$result = mysqli_query($conn,$query);
if(mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        $deptValue = $row["deptValue"];
        $sumDeptValue = $deptValue + $sumDeptValue;
        $countOfdept = mysqli_num_rows($result);
        $payed = $row["payed"];
        $monthCount = $row["monthCount"];
        $sumPayed = $sumPayed + $payed;
        $sumMonthCount = $sumMonthCount + $monthCount;
    }

}else{
    echo "شما هیچ وامی ندارید";
    $countOfdept ="0";
}
?>

<div class="content-wrapper" style="margin-top:30px;">

    <!-- Main content -->
    <section class="content">
    <h1>پروفایل</h1>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                        <img class="profile-user-img img-fluid img-circle"
                            src="<?php echo($profilePicture);  ?>"
                            alt="User profile picture">
                        </div>
                        <h3 class="profile-username text-center"> <?php echo $name." ".$lName; ?></h3>
                        <p class="text-muted text-center"> فرزند: <?php echo $fatherName; ?> </p>
                        <ul class="list-group list-group-unbordered mb-3">
                        <li class="list-group-item">
                            <b class="float-right"> مبلغ دریافتی </b> <a class="float-right"><?php  echo(" ".number_format($sumDeptValue,0,".",",")); ?></a>
                        </li>
                        <li class="list-group-item">
                            <b class="float-right">  تعداد وام های دریافتی </b> <a class="float-right"><?php echo($countOfdept); ?></a>
                        </li>
                        <li class="list-group-item">
                            <b class="float-right">اقساط پرداختی: </b> <a class="float-right"><?php  echo($sumMonthCount); ?></a>
                        </li>
                        </ul>
                        <a href="logout.php" class="btn btn-primary btn-block"><b>خروج از حساب </b></a>
                    </div>
                <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>  
            <!-- tab view -->
            <div class="col-md-9">
                        <div class="card">
                        <?php if(isset($_POST['changePassword']) || isset($_POST['submit-edit-profile'])){echo "<div class='callout callout-danger'>$messageResult</div>";}  ?>
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                            
                            <li class="nav-item"><a class="nav-link active" href="#profile" data-toggle="tab">نمایه</a></li>
                            <li class="nav-item"><a class="nav-link" href="#editPassword" data-toggle="tab">تغییر رمزعبور</a></li>
                            <li class="nav-item"><a class="nav-link" href="#edit" data-toggle="tab">تغییر پروفایل</a></li>
                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">
                            <div class="active tab-pane" id="profile">
                                    <div class="form-group">
                                        <label for="inputName" class="col-sm-2 control-label">آیدی</label>
                                        <div class="col-sm-10">
                                        <span><?php echo($user_id) ?></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail" class="col-sm-2 control-label">ایمیل</label>
                                        <div class="col-sm-10">
                                        <span><?php echo($email) ?></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputName2" class="col-sm-2 control-label">نام پدر</label>
                                        <div class="col-sm-10">
                                        <span><?php echo($fatherName) ?></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputExperience" class="col-sm-2 control-label">کد ملی</label>
                                        <div class="col-sm-10">
                                        <span><?php echo($nCode) ?></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputSkills" class="col-sm-2 control-label">تاریخ تولد</label>
                                        <div class="col-sm-10">
                                        <span><?php echo($bDate) ?></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                    </div>
                            </div>
                            <!-- /.tab-pane -->
                            <div class="tab-pane" id="editPassword">
                                <form action="" method="post">
                                    <div class="form-group">
                                   
                                        <label for="inputName"  class="col-sm-2 control-label">کلمه عبور</label>
                                        <div class="col-sm-10">
                                        <input type="password" name="pass1Edit" class="form-control" id="inputName" placeholder="********">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail" class="col-sm-2 control-label">تکرار کلمه عبور</label>
                                        <div class="col-sm-10">
                                        <input type="password"  name="pass2Edit" class="form-control" id="inputName" placeholder="********">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" name="changePassword" class="btn btn-danger">تغییر</button>
                                    </div>
                                </form>
                                </div>
                                    <div class="form-group">
                                    </div>
                            </div>
                            <!-- /.tab-pane -->
                            <div class="tab-pane" id="edit">
                                <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="inputName" class="col-sm-2 control-label">نام</label>

                                    <div class="col-sm-10">
                                    <input type="text" name="name_edit" class="form-control" value="<?php echo($name) ?>" id="inputName" placeholder="محمد">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputLName"  class="col-sm-2 control-label">نام خانوادگی</label>

                                    <div class="col-sm-10">
                                    <input type="text" name="lName_edit" class="form-control" value="<?php echo($lName) ?>" id="inputLName" placeholder="محمدی">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail" class="col-sm-2 control-label">ایمیل</label>

                                    <div class="col-sm-10">
                                    <input type="email" name="email_edit" class="form-control" id="inputEmail" value="<?php echo($email) ?>" placeholder="Aref@post.ir">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputNcode" class="col-sm-2 control-label"> کد ملی</label>

                                    <div class="col-sm-10">
                                    <input type="text"  name="nCode" class="form-control" id="inputNcode" value="<?php echo($nCode) ?>" placeholder="54500336520" disabled>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="inputFatherName" class="col-sm-2 control-label">نام پدر</label>

                                    <div class="col-sm-10">
                                    <input type="text" name="fathername_edit" class="form-control" id="inputFatherName" value="<?php echo($fatherName) ?>" placeholder="Skills">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputBdate" name="" class="col-sm-2 control-label"> تاریخ تولد</label>

                                    <div class="col-sm-10">
                                    <input type="text" name="bDate" class="form-control" id="inputBdate" value="<?php echo($bDate) ?>" placeholder="2002-05-03">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputProfilePicture" class="col-sm-2 control-label">تصویر پروفایل</label>

                                    <div class="col-sm-10">
                                    <input type="file" name="profilePicture"  accept="image/*" class="form-control" id="inputProfilePicture" placeholder="a.jpg">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" name="submit-edit-profile" class="btn btn-danger">ذخیره</button>
                                    </div>
                                </div>
                                </form>
                            </div>
                            <!-- /.tab-pane -->
                            </div>
                            <!-- /.tab-content -->
                        </div><!-- /.card-body -->
        </div> 
    </section>

</div>
<?php
include '../library/footer.php';
?>