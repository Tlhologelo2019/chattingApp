<?php 
    session_start();
    include_once "config.php";
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    if(!empty($email) && !empty($password)){ // if email and password field are not empty, we check in the database that the email entered matches any
        $sql = mysqli_query($conn, "SELECT * FROM users WHERE email = '{$email}'");

        if(mysqli_num_rows($sql) > 0){ // we check if the entered password matches with the corresponding email entered in the database
            $row = mysqli_fetch_assoc($sql);
            $user_pass = md5($password);
            $enc_pass = $row['password'];

            if($user_pass === $enc_pass){
                $status = "Active now"; // Here we update the user status to "Active now" provided they logged in successfully
                $sql2 = mysqli_query($conn, "UPDATE users SET status = '{$status}' WHERE unique_id = {$row['unique_id']}");

                if($sql2){
                    $_SESSION['unique_id'] = $row['unique_id']; //using this session we used user unique_id in other php file
                    echo "success";
                }else{
                    echo "Something went wrong. Please try again!";
                }
            }else{
                echo "Email or Password is Incorrect!";
            }
        }else{
            echo "$email - This email not Exist!";
        }
    }else{
        echo "All input fields are required!";
    }
?>