<?php
include 'header.php';


if(isset($_POST['submit-add-admin'])) {

    if (empty($_POST['name']) || empty($_POST['email']) || empty($_POST['lName']) || empty($_POST['password']) || empty($_POST['userName'])||empty($_POST['role'])) {

        echo "<script>alert('تمامی فیلد های ضروری باید پر شده باشند');</script>";
        echo "<audio src='http://freesoundeffect.net/sites/default/files/incorrect-answer--6-sound-effect-99679566.mp3' autoplay ></audio>";

    } else {

        $name = $_POST['name'];
        $lName = $_POST['lName'];
        $email = $_POST['email'];
        $password = md5($_POST['password']);
        $userName = $_POST['userName'];
        $role = $_POST['role'];
        $profilePicrure = "https://s6.uupload.ir/files/photo_2022-05-13_22-39-17_dfc0.jpg";
       

        //profile picture
        /********************/
        //if(isset($_POST["fileToUpload"])){
            
            $filename = $_FILES["profilePicture"]["name"];

            $tempname = $_FILES["profilePicture"]["tmp_name"];
            $rnd = rand(1000,9999);
            $folder = "../uploads/".$rnd.$filename;
            //upload
            if (move_uploaded_file($tempname, $folder)) {
                $profilePicrure = $folder;
                $msg = "Image uploaded successfully";
               // echo "<script>alert('$msg');</script>";

            }else{

                $msg = "Failed to upload image";
                echo "<script>alert('$msg');</script>";
                die;
            }
       // }



        //test password
       
        $query = "INSERT INTO `admin` (`id`, `username`, `password`, `role`, `name`, `lName`, `countOfDept`, `profilePicture`) VALUES (NULL, '$userName', '$password', '$role', '$name', '$lName', NULL, '$profilePicrure');";
        $result = mysqli_query($conn, $query);
        if ($result === TRUE) {
            
            echo("<div class='content-wrapper'><h3>ثبت نام با موفقیت انجام شد</h3></div>");
           // header("Location: index.php");

        } else {
            echo "Error: " . $query . "<br>" . $result->error;
        }
        

    }
}

?>
<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <form role="form" action="" method="post" enctype="multipart/form-data">
                <div class="card-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">نام کاربری </label>
                        <input type="text" class="form-control" name="userName" id="exampleInputEmail1" placeholder="ایمیل را وارد کنید">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">ایمیل  </label>
                        <input type="email" class="form-control" name="email" id="exampleInputEmail1" placeholder="ایمیل را وارد کنید">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" class="form-control" name="password" id="exampleInputPassword1" placeholder="پسورد را وارد کنید">
                    </div>
                </div>
                <!-- /.card-header -->   
                <div class="form-group">
                    <label>نقش</label>
                    <select name="role" class="form-control select2" style="width: 30%;">
                        <option selected="selected" value="superAdmin">مدیر کل</option>
                        <option value="admin">ادمین</option>
                        <option value="dev">برنامه نویس</option>
                        <option value="bank">کارمند بانک</option>
                        <option value="adminBank">مدیر بانک</option>
                    </select>
                </div>
                <!-- name and Lname -->
                <div class="form-group">
                        <label for="exampleInputEmail1">نام:</label>
                        <input type="text" class="form-control" name="name" style="width: 30%;" placeholder="نام ادمین">
                </div>
                <!-- name and Lname -->
                <div class="form-group">
                        <label for="exampleInputEmail1">نام خانوادگی:</label>
                        <input type="text" class="form-control" name="lName" style="width: 30%;" placeholder="نام خانوادگی ادمین">
                </div>
                <span class="input-group-text" style="width: 30%;">تصویر پروفایل</span>
                <input type="file" class="form-control" name="profilePicture" value="" style="width: 30%;" name="fileToUpload">
                <div class="input-group-append">
                   
                </div>
</br>
                <!-- save button -->
                <div class="col-3">
                    <button type="submit" name="submit-add-admin" class="btn btn-primary btn-block btn-flat"> ذخیره</button>
                </div>
            </form>
        </div>
    </section>
</div>



<?php
include 'footer.php';
?>