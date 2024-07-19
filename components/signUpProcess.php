<?php

    require '../config/db_connect.php';

    $errorMessage = '';
    $errors = array(
        'username' => '',
        'email' => '',
        'mobile' => '',
        'pfp' => ''
    );

    if (isset($_POST['signUp'])) {

        if (isset($_POST['email']) && 
            isset($_POST['confirm_password']) &&
            isset($_POST['username']) && 
            isset($_POST['gender']) && 
            isset($_POST['bday']) && 
            isset($_POST['mobile'])) {
            $email = mysqli_real_escape_string($conn, $_POST['email']);
            $confirm_password = mysqli_real_escape_string($conn, $_POST['confirm_password']);
            $username = mysqli_real_escape_string($conn, $_POST['username']);
            $gender = mysqli_real_escape_string($conn, $_POST['gender']);
            $bday = mysqli_real_escape_string($conn, $_POST['bday']);
            $mobile = '63' . mysqli_real_escape_string($conn, $_POST['mobile']);
        }

        $pfpFile = isset($_FILES['pfpFile']) ? $_FILES['pfpFile'] : '../assets/pfp/default.png';
        $typePreference = isset($_POST['type']) ? mysqli_real_escape_string($conn, implode('/', $_POST['type'])) : null;
        $regionPreference = isset($_POST['region']) ? mysqli_real_escape_string($conn, implode('/', $_POST['region'])) : null;
        
        // Select Pokemon Data
        $username_query = "SELECT username FROM account WHERE username = '$username'";

        $email_query = "SELECT email FROM account WHERE email = '$email'";

        $mobile_query = "SELECT mobile FROM account WHERE mobile = '$mobile'";

        // // SQL Check
        if (!mysqli_query($conn, $username_query)) {
            die('Query error: ' . mysqli_error($conn));
        } else {
            // Make Query & Get Result
            $result = mysqli_query($conn, $username_query);

            // Fetch the Resulting Rows as an Array
            $user_username = mysqli_fetch_all($result, MYSQLI_ASSOC);

            // Free results From Memory
            mysqli_free_result($result);
        }

        // SQL Check
        if (!mysqli_query($conn, $email_query)) {
            die('Query error: ' . mysqli_error($conn));
        } else {
            // Make Query & Get Result
            $result = mysqli_query($conn, $email_query);

            // Fetch the Resulting Rows as an Array
            $user_email = mysqli_fetch_all($result, MYSQLI_ASSOC);

            // Free results From Memory
            mysqli_free_result($result);
        }

        // SQL Check
        if (!mysqli_query($conn, $mobile_query)) {
            die('Query error: ' . mysqli_error($conn));
        } else {
            // Make Query & Get Result
            $result = mysqli_query($conn, $mobile_query);

            // Fetch the Resulting Rows as an Array
            $user_mobile = mysqli_fetch_all($result, MYSQLI_ASSOC);

            // Free results From Memory
            mysqli_free_result($result);
        }

        if (!empty($user_username[0]['username'])) {
            $errors['username'] = 'Username already exists\n';
        }
        
        if (!empty($user_email[0]['email'])) {
            $errors['email'] = 'Email already in use\n';
        }

        if (!empty($user_mobile[0]['mobile'])) {
            $errors['mobile'] = 'Mobile number already in use\n';
        }

        if (isset($_FILES['pfpFile'])) {
            $target_dir = "../assets/pfp/"; // Replace with your desired upload directory
            $target_file = $target_dir . strtolower($username) . '.' . strtolower(pathinfo(basename($pfpFile["name"]),PATHINFO_EXTENSION));
            $uploadOk = true;
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
          
            // // Check if image file is a actual image
            // if(isset($_POST["save"])) {
            //   $check = getimagesize($pfpFile["tmp_name"]);
            //   if($check !== false) {
            //     // echo "File is an image - " . $check["mime"] . ".";
            //     $uploadOk = true;
            //   } else {
            //     $errors['pfp'] .= 'File is not an image.\n';
            //     $uploadOk = false;
            //   }
            // }
          
            // // Check if file already exists
            // if (file_exists($target_file)) {
            //   echo "Sorry, file already exists.";
            //   $uploadOk = false;
            // }
          
            // Check file size (optional)
            if ($pfpFile["size"] > 50000000) { // Limit to 5 mb (adjust as needed)
                $errors['pfp'] .= 'Sorry, your file is too large.\n';
                $uploadOk = false;
            }
          
            // Allow certain file formats (optional)
            $allowedExtensions = array("jpg", "jpeg", "png");
            if (!in_array($imageFileType, $allowedExtensions)) {
                $errors['pfp'] .= 'Sorry, only JPG, JPEG & PNG files are allowed.\n';
                $uploadOk = false;
            }
          
            // Check if $uploadOk is set to false by any error
            if ($uploadOk === false) {
                $errors['pfp'] .= 'Sorry, your file was not uploaded.\n';
            // if everything is ok, try to upload file
            } else {
              if (move_uploaded_file($pfpFile["tmp_name"], $target_file)) {
                $pfpFile = $target_file;
              } else {
                // Upload failed
                $errors['pfp'] .= 'Sorry, there was an error uploading your file.\n';
              }
            }

        }

        if (array_filter($errors)) {

            foreach (array_filter($errors) as $error) {
                $errorMessage .= $error;
            }

            if (isset($_SESSION['userID'])) {
                session_unset();
                session_destroy();
            }
    
            echo "<script>alert('$errorMessage');</script>";
            header('Refresh: 0; URL=../pages/guest.php');
            exit;

        } else {

            $insert_query = "INSERT INTO account (role_id, email, password, pfp_url, username, gender, bday, mobile, typePreference, regionPreference)
            VALUES ((SELECT id FROM role WHERE role = 'user'), '$email', ':password', '$pfpFile', '$username', '$gender', ':bday', '$mobile',  '$typePreference', '$regionPreference')";

            $insert_query = str_replace(':password', password_hash($confirm_password, PASSWORD_DEFAULT), $insert_query);
            
            $insert_query = str_replace(':bday', date('Y-m-d', strtotime($bday)), $insert_query);

            if (!mysqli_query($conn, $insert_query)) {
                die('Query error: ' . mysqli_error($conn));
            } else {
                
                $query = "SELECT * FROM account WHERE email = '$email'";

                if (!mysqli_query($conn, $query)) {
                    die('Query error: ' . mysqli_error($conn));
                } else {

                    // Make Query & Get Result
                    $result = mysqli_query($conn, $query);
        
                    // Fetch the Resulting Rows as an Array
                    $user = mysqli_fetch_all($result, MYSQLI_ASSOC);
        
                    // Free results From Memory
                    mysqli_free_result($result);
    
                    // Close Connection
                    mysqli_close($conn);
    
                    session_start();
        
                    if(isset($_POST['remember'])) {
                        setcookie("userID", $user['0']['id'], time()+30*24*60*60, "/", "");
                    } else {
                        $_SESSION['userID'] = $user['0']['id'];
                    }
    
                    header('Refresh: 0; URL=../pages/pokedopt.php');
                    exit;
                }

            }

        }

    }

?>