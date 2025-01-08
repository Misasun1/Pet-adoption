<?php

session_start();
if (isset($_SESSION['user'])) {
    header("Location:../user/home.php"); //correct path
    exit;
}

if (isset($_SESSION['adm'])) {
    header("Location: ../admin/dashboard.php");
    exit;
}


require_once "../components/db_connect.php";


$error = false;
$email = "";
$emailError = $passError = "";


if (isset($_POST['log_in'])) {

    $email = cleanData($_POST['email']);
    $pass = cleanData($_POST['password']);


    if (empty($email)) {
        $error = true;
        $emailError = 'Please enter your email';
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = true;
        $emailError = "Please enter a valid email";
    }


    if (empty($pass)) {
        $error = true;
        $passError = "Please provide your password";
    }


    if (!$error) {
        $pass = hash('sha256', $pass);
        $queryEmail = "SELECT * FROM `users` WHERE `email` = '$email'";
        $result = mysqli_query($connect, $queryEmail);



        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);


            if ($row['status'] == 'adm') {
                $_SESSION['adm'] = $row['userId'];
                header('Location: ../admin/dashboard.php');
            } else {

                $_SESSION['user'] = $row['userId'];

                header('Location: ../user/home.php');
            }
        } else {
            echo  "<div class='alert alert-danger text-center' role='alert'>
            <p>Invalid credentials</p>
       </div>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../style.css">
</head>

<body>

    <div class="container text-center py-5">
        <!-- test svg -->

        <div class="svg-img1">

            <iframe class="cat" src="https://lottie.host/embed/d22068b3-bd9e-41d0-a7ac-514fd82bb503/CyMxd8mYjA.lottie" style="width: 250px; height: 250px;"></iframe>


        </div>
        <!-- end -->
        <div class="row">
            <div class="col col-md-6 mx-auto">
                <h1 class="my-4 display-1" id="login-title">Login</h1>
                <div class="style">
                    <form method="POST" enctype="multipart/form-data" class="rounded-4  bg-gradient text-light py-4 px-5">

                        <div class="mb-3">
                            <label for="email" class="form-label"><strong class="">Email</strong></label>
                            <input type="email" id="email" class="form-control rounded-5" name="email" value="<?= $email ?>">
                            <span class="text-danger text-center"><?= $emailError ?></span>

                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label"><strong class="">Password</strong></label>
                            <input type="password" id="password" class="form-control rounded-5" name="password">
                            <span class="text-danger text-center"><?= $passError ?></span>

                        </div>

                        <div class="mb-3">
                            <input type="submit" class="btn btn bg-gradient rounded-4 border-light border-2 px-4" name="log_in" id="submitBtn">
                            <br>
                            <br>
                            <p><strong>OR</strong></p>

                            <br>
                            <p>Don't have an account?</p>
                            <a href="register.php" class="btn btn- bg-gradient rounded-4 border-light border-2 px-4">Register now</a>






                        </div>
                    </form>
                </div>
            </div>
        </div>


        <iframe class="dog" src="https://lottie.host/embed/a6db9d88-8450-4505-a82b-a4b38e0dadc8/aCDpVkl6EU.lottie" style="width: 250px; height: 250px;"></iframe>

    </div>





</body>

</html>