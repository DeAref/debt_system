<?php

//session_start();
if(isset($_POST['submit']))
{

    $conn=mysqli_connect("localhost","root","","deptsystem");
    $emailnamepost=$_POST['email'];
    $password =$_POST['password'];
    $query = "SELECT * FROM `user` WHERE `email`='$emailnamepost' AND `password`='$password'";
    $result = mysqli_query($conn,$query);

    if(mysqli_num_rows($result) > 0)
    {
        $_SESSION['email']= $_POST['username'];
        $_SESSION['password']= $_POST['password'];
        $_SESSION['Validation']= "true";
        header("Location: ../index.php");
    }else{

        echo "user name or password not correct";
        unset($_SESSION['Validation']);
        echo "<audio src='http://freesoundeffect.net/sites/default/files/incorrect-answer--6-sound-effect-99679566.mp3' autoplay ></audio>";
    }


}




?>