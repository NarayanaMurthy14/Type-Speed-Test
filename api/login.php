<?php
    session_start();
    include("connect.php");
    $email=$_POST['email'];
    $password=$_POST['password'];

    $check=mysqli_query($connect,"SELECT * FROM users WHERE email='$email' AND password='$password' ");
    $user=mysqli_fetch_assoc($check);
    if($user && $password===$user['password'])
    {
        $_SESSION['user']=$user['email'];
        header("Location: ../routes/test.php");
        exit();
    }
    else 
    {
        echo '
            <script>
                alert("Invalid email or password");
                window.location="../index.html";
            </script>
        ';
    }
?>