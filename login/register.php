<?php

session_start();
if (isset($_SESSION['user'])) {
    header("Location: ../user/home.php");
    exit;
}

if (isset($_SESSION['adm'])) {
    header("Location: ../admin/dashboard.php");
    exit;
}

require_once '../components/db_connect.php';
require_once '../components/file_upload.php';

$error = false;

$firstName = $lastName = $address = $email = $phoneNum = '';
$fNameError = $lNameError = $addressError = $emailError = $passError = $phoneNumError  = '';


if (isset($_POST['register'])) {
    $firstName = cleanData($_POST['first_name']);
    $lastName = cleanData($_POST['last_name']);
    $address = cleanData($_POST['address']);
    $email = cleanData($_POST['email']);
    $phoneNum = cleanData($_POST['phone_number']);
    $pass = cleanData($_POST['password']);
    $image = imageUpload($_FILES['profile_img']);




    // validators for first name

    if (empty($firstName)) {
        $error = true;
        $fNameError = "Cannot leave empty this field";
    } else if (strlen($firstName) < 3) {
        $error = true;
        $fNameError = "Name must be at least 3 characters";
    } else if (!preg_match("/^[a-zA-Z]+$/", $firstName)) {
        $error = true;
        $fNameError = 'Name must not contain special characters';
    }



    // validators for last name
    if (empty($lastName)) {
        $error = true;
        $lNameError = 'Cannot leave empty this field';
    } elseif (strlen($lastName) < 3) {
        $error = true;
        $lNameError = 'Name must be at least 3 characters';
    } elseif (!preg_match("/^[a-zA-Z]+$/", $lastName)) {
        $error = true;
        $lNameError = 'Name must not contain special characters';
    }


    // validators for address
    if (empty($address)) {
        $error = true;
        $addressError = 'Cannot leave empty this field';
    } elseif (strlen($address) < 3) {
        $error = true;
        $addressError = 'Address must be at least 3 characters';
    }



    // validators email
    if (empty($email)) {
        $error = true;
        $emailError = 'Cannot leave this field empty ';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = true;
        $emailError = 'Please enter a valid email';
    }


    $queryEmail = "SELECT email FROM `users` WHERE `email` = '$email'";
    $result = mysqli_query($connect, $queryEmail);


    if (mysqli_num_rows($result) != 0) {
        $error = true;
        $emailError = "This email is already in use";
    }

    // validators phone num
    if (empty($phoneNum)) {
        $error = true;
        $phoneNumError = 'Cannot live empty this field';
    } elseif (strlen($phoneNum) < 11) {
        $error = true;
        $phoneNumError = 'Must contain at least 11 digits';
    } elseif (!preg_match("/^[0-9]+$/", $phoneNum)) {
        $error = true;
        $phoneNumError = 'Must not contain letters';
    }



    $queryPhone = "SELECT phone_number FROM `users` WHERE `phone_number` = '$phoneNum'";
    $resultPhone = mysqli_query($connect, $queryPhone);


    if (mysqli_num_rows($resultPhone) != 0) {
        $error = true;
        $phoneNumError = "This phone number is already in use";
    }


    //validators for pass
    if (empty($pass)) {
        $error = true;
        $passError = 'Please enter a password';
    } elseif (strlen($pass) < 8) {
        $error = true;
        $passError = 'Password must be at least 8 characters';
    } elseif (!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/", $pass)) {
        $error = true;
        $passError = 'Password must contain: at least one uppercase letter,lowercase letter,digit and special character';
    }




    // if all validation inputs are passed 

    if (!$error) {

        $pass = hash('sha256', $pass);

        $querySuccess = "INSERT INTO `users`( `first_name`, `last_name`, `address`, `password`, `profile_img`, `phone_number`,  `email`) VALUES ('$firstName','$lastName','$address','$pass','$image[0]','$phoneNum','$email')";

        $result = mysqli_query($connect, $querySuccess);


        if ($result) {
            echo "<div class='alert alert-success' role='alert'>
  <p class = 'text-center'>$image[1]! New account has been created!</P>
</div>";
        } else {
            echo "<div class='alert alert-warning' role='alert'>
        <p class = 'text-center'>Something went wrong. Please try again later </p>
      </div>";
        }
        // header("refresh: 3; url=index.php");
    } else {
    }
}

?>








<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="/style.css">
</head>

<body>
    <div class="container text-center py-5">
        <div class="row">
            <div class="col col-md-6 mx-auto">
                <h1 class="my-4 display-4">Sign Up</h1>
                <div class="style">
                    <form method="POST" enctype="multipart/form-data" class="rounded-4  bg-gradient text-light py-4 px-5">
                        <div class="mb-3">

                            <!-- first name -->
                            <label for="first_name" class="form-label "><strong class="write">First Name</strong></label>
                            <input type="text" id="first_name" class="form-control rounded-5 text-center" name="first_name" value="<?= $firstName ?>" placeholder="Enter your first name">
                            <!-- validator message -->
                            <span class="text-danger text-center"><?= $fNameError ?></span>

                        </div>

                        <!-- last name -->
                        <div class="mb-3">
                            <label for="last_name" class="form-label"><strong class="write">Last Name</strong></label>
                            <input type="text" id="last_name" class="form-control rounded-5 text-center" name="last_name" value="<?= $lastName ?>" placeholder="Enter your last name">
                            <!-- validator message -->
                            <span class="text-danger text-center"><?= $lNameError ?></span>
                        </div>

                        <!-- address -->
                        <div class="mb-3">
                            <label for="address" class="form-label"><strong class="write">Address</strong></label>
                            <input type="text" id="address" class="form-control rounded-5 text-center" name="address" value="<?= $address ?>" placeholder="Enter your address">
                            <!-- validator message -->
                            <span class="text-danger text-center"><?= $addressError ?></span>
                        </div>



                        <!-- email -->
                        <div class="mb-3">
                            <label for="email" class="form-label"><strong class="write">Email</strong></label>
                            <input type="email" id="email" class="form-control rounded-5 text-center" name="email" value="<?= $email ?>" placeholder="Enter your email">

                            <!-- validator message -->
                            <span class="text-danger text-center"><?= $emailError ?></span>
                        </div>


                        <!-- password -->
                        <div class="mb-3">
                            <label for="password" class="form-label"><strong class="write">Password</strong></label>
                            <input type="password" id="password" class="form-control rounded-5 text-center" name="password" placeholder="Enter your password">
                            <!-- validator message -->
                            <span class="text-danger text-center"><?= $passError ?></span>
                        </div>

                        <!-- phone number -->
                        <div class="mb-3">
                            <label for="phone_number" class="form-label"><strong class="write">Phone</strong></label>
                            <input type="phone_number" id="phone_number" class="form-control rounded-5 text-center" name="phone_number" value="<?= $phoneNum ?>" placeholder="Enter your phone number">

                            <!-- validator message -->
                            <span class="text-danger text-center"><?= $phoneNumError ?></span>

                        </div>

                        <!-- picture profile -->
                        <div class="mb-3">
                            <label for="profile_img" class="form-label"> <strong class="write">Select a photo profile</strong></label>
                            <input type="file" id="profile_img" class="form-control rounded-5" name="profile_img">
                        </div>

                        <div class="mb-3">
                            <input type="submit" class="btn btn-danger bg-gradient bg-opacity-25 rounded-4 border-light border-2 px-4" name="register">
                            <br>
                            <br>
                            <p>Already have an account?</p>
                            <a href="login.php" class="btn btn-warning bg-gradient rounded-4 border-light border-2 px-4">Login</a>


                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>




</body>

</html>