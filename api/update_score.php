<?php
    session_start();
    include("connect.php");

    if(!isset($_SESSION['user']))
    {
        echo "Unauthorized: session not set";
        exit();
    }

    $email=$_SESSION['user'];
    $wpm=$_POST['wpm'];
    $cpm=$_POST['cpm'];
    $accuracy=$_POST['accuracy'];

    $query="UPDATE users SET wpm='$wpm', cpm='$cpm', accuracy='$accuracy' WHERE email='$email' ";
    $result=mysqli_query($connect,$query);

    if($result)
    {
        echo"Scores updated successfully";
    }
    else
    {
        echo"Failed to update score: ".mysqli_error($connect);
    }
?>