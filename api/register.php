<?php
    include("connect.php");

    $nam=$_POST['name'];
    $email=$_POST['email'];
    $password=$_POST['password'];
    $cpassword=$_POST['cpassword'];

    if($password===$cpassword)
    {
        $insert=mysqli_query($connect,"INSERT INTO users (name,email,password) VALUES('$nam','$email','$password')");
        if($insert)
        {
            echo '
                <script>
                    alert("Registration Successful");
                    window.location="../index.html";
                </script>
            ';
        }
        else
        {
            echo '
                <script>
                    alert("Some error occured");
                    window.location="../routes/register.html";
                </script>
            ';
        }
    }
    else
    {
        echo '
            <script>
                alert("Passord and confirm password does not match");
                window.location="../routes/register.html";
            </script>
        ';
    }
?>