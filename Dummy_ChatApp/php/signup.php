<?php
    session_start();
    include_once "config.php";
    $fname = mysqli_real_escape_string($conn, $_POST['fname']);
    $lname = mysqli_real_escape_string($conn, $_POST['lname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    if(!empty($fname) && !empty($lname) && !empty($email) && !empty($password)){

        //Verifying whether the user email is valid or not
        if(filter_var($email, FILTER_VALIDATE_EMAIL)){ //if the email is valid
            $sql = mysqli_query($conn, "SELECT * FROM users WHERE email = '{$email}'");

            if(mysqli_num_rows($sql) > 0){ //if email already exists

                echo "$email - This email already exist!";
                
             }else{
                if(isset($_FILES['image'])){ //if file is uploaded
                    $img_name = $_FILES['image']['name']; // user uploading image name
                    $img_type = $_FILES['image']['type']; // user uploading image type
                    $tmp_name = $_FILES['image']['tmp_name'];
                    
                    // Exploring images and getting the last extension like jpg and png
                    $img_explode = explode('.',$img_name);
                    $img_ext = end($img_explode); //here we get the extension of an user uploaded image files
    
                    $extensions = ["jpeg", "png", "jpg"];  // here are some of the valid image extension and we have stored them in an array

                    if(in_array($img_ext, $extensions) === true){ //if the uploaded image extension by the user matches any of the array extensions
                        $types = ["image/jpeg", "image/jpg", "image/png"]; 

                        if(in_array($img_type, $types) === true){
                            $time = time(); //this returns the current time because when a user uploads img in our folder we rename user file with current time so that every img file will have a unique name

                            // here we move the user uploaded image to our folder
                            $new_img_name = $time.$img_name;
                            if(move_uploaded_file($tmp_name,"images/".$new_img_name)){// if the uploaded image moved successfully to our folder
                                $ran_id = rand(time(), 100000000);//this will creat a random id for the user

                                $status = "Active now"; //when a user in logged in this will show that they a available
                                $encrypt_pass = md5($password);

                                 // Insert all data provided by the user inside the table
                                $insert_query = mysqli_query($conn, "INSERT INTO users (unique_id, fname, lname, email, password, img, status)
                                VALUES ({$ran_id}, '{$fname}','{$lname}', '{$email}', '{$encrypt_pass}', '{$new_img_name}', '{$status}')");

                                if($insert_query){ //if the data are insided into the table
                                    $select_sql2 = mysqli_query($conn, "SELECT * FROM users WHERE email = '{$email}'");

                                    if(mysqli_num_rows($select_sql2) > 0){
                                        $result = mysqli_fetch_assoc($select_sql2);
                                        $_SESSION['unique_id'] = $result['unique_id'];//using this session we used user unique_id in other php
                                        echo "success";
                                    }else{
                                        echo "This email address not Exist!";
                                    }
                                }else{
                                    echo "Something went wrong. Please try again!";
                                }
                            }
                        }else{
                            echo "Please upload an image file - jpeg, png, jpg";
                        }
                    }else{
                        echo "Please upload an image file - jpeg, png, jpg";
                    }
                }
            }
        }else{
            echo "$email is not a valid email!";
        }
    }else{
        echo "All input fields are required!";
    }
?>