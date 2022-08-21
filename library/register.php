<?php
session_start();
include '../library/config.php';

if(!isset($_SESSION['register'])){
    header("Location: $loginAddress");

}
if(isset($_POST['back2login'])){
    unset($_SESSION['register']);
    header("Location: $loginAddress");
}
if(isset($_POST['submit'])) {

    if (empty($_POST['name']) || empty($_POST['email']) || empty($_POST['lName']) || empty($_POST['password']) || empty($_POST['nCode']) || empty($_POST['fatherName'])) {

        echo "<script>alert('تمامی فیلد های ضروری باید پر شده باشند');</script>";
        echo "<audio src='http://freesoundeffect.net/sites/default/files/incorrect-answer--6-sound-effect-99679566.mp3' autoplay ></audio>";

    } else {

       
        $name = $_POST['name'];
        $lName = $_POST['lName'];
        $email = $_POST['email'];
        $password = md5($_POST['password']);
        $nCode = $_POST['nCode'];
        $fatherName = $_POST['fatherName'];
        $bDate = $_POST['bDate'];
        $profilePicrure = "https://s6.uupload.ir/files/photo_2022-05-13_22-39-17_dfc0.jpg";
        $password2 =md5($_POST['password']);

        //profile picture
        /********************/
        //if(isset($_POST["fileToUpload"])){
           // echo "<h1>تست تستس ستس تستس تس ست  تستستس </h1>";
            $filename = $_FILES["fileToUpload"]["name"];

            $tempname = $_FILES["fileToUpload"]["tmp_name"];
            $rnd = rand(1000,9999);
            $folder = "../uploads/".$rnd.$filename;
            //upload
            if (move_uploaded_file($tempname, $folder)) {
                $profilePicrure = $folder;
                $msg = "Image uploaded successfully";
                echo "<script>alert('$msg');</script>";

            }else{

                $msg = "Failed to upload image";
                echo "<script>alert('$msg');</script>";
            }
       // }



        //test password
        if($password2==$password){
            $query = "INSERT INTO `user` (`id`, `name`, `lName`, `nCode`, `fatherName`, `bDate`, `profilePicture`, `password`, `email`) VALUES (NULL, '$name', '$lName', '$nCode', '$fatherName', '$bDate', '$profilePicrure', '$password', '$email');";
            $result = mysqli_query($conn, $query);
            if ($result === TRUE) {
                sleep(3);
                echo("<h3>ثبت نام با موفقیت انجام شد</h3>");
                session_start();
                $_SESSION['sign-up'] = "true";
                header("Location: login.php");
                unset($_SESSION['register']);
            } else {
                echo "Error: " . $query . "<br>" . $result->error;
            }
        }else{
            echo "<script>alert('پسورد ها یکسان نیست');</script>";
        }

    }
}

?>