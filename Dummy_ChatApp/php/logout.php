<?php
    session_start();

    if(isset($_SESSION['unique_id'])){//if user logged in then come to this page otherwise go to login page
        include_once "config.php";
        $logout_id = mysqli_real_escape_string($conn, $_GET['logout_id']);

        if(isset($logout_id)){//If the user clicked on the logout the status will be set to "offline now"
            $status = "Offline now";

            // when the user logged out the status will be updated to "Offline now" as welll as in the login
            // form the updation will be made on the status to "Active now" provided the user logged in successfully
            $sql = mysqli_query($conn, "UPDATE users SET status = '{$status}' WHERE unique_id={$_GET['logout_id']}");
            
            if($sql){
                session_unset();
                session_destroy();
                header("location: ../login.php");
            }
        }else{
            header("location: ../users.php");
        }
    }else{  
        header("location: ../login.php");
    }
?>