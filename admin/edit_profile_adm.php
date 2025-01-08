<?php
session_start();
if (!isset($_SESSION['user']) && !isset($_SESSION['adm'])) {
    header("Location: ../login/login.php");
    exit;
}

require_once '../components/db_connect.php';
require_once '../components/file_upload.php';

if (isset($_SESSION['adm'])) {
    $id = $_SESSION['adm'];
    $redirectTo = '../admin/dashboard.php';
} else {
    $id = $_SESSION['user'];
    $redirectTo = '../user/home.php';
}

$sql = "SELECT * FROM users where userId = {$id}";
$result = mysqli_query($connect, $sql);
$row = mysqli_fetch_assoc($result);

if (isset($_POST['update-profile'])) {
    $first_name = cleanData($_POST['first_name']);
    $last_name = cleanData($_POST['last_name']);
    $address = cleanData($_POST['address']);
    $email = cleanData($_POST['email']);
    $phoneNum = cleanData($_POST['phone_number']);
    $pass = cleanData($_POST['password']);
    $image = imageUpload($_FILES['profile_img']);

    if ($_FILES['profile_img']['error'] == 4) { // If the user didn t select a picture
        $updateSql = "UPDATE `users` SET `first_name`='$first_name',`last_name`='$last_name',`address`='$address',`phone_number`='$phoneNum',`email`='$email' WHERE id = {$id}";
    } else {
        if ($row['profile_img'] != 'user.jpg') {
            unlink("img/{$row['image']}");
        }
        $updateSql = "UPDATE `users` SET `first_name`='$first_name',`last_name`='$last_name',`address`='$address',`phone_number`='$phoneNum',`email`='$email', `image`='$image[0]' WHERE id = {$id}";
    }
    $result = mysqli_query($connect, $updateSql);
    if ($result) {
        header("Location: $redirectTo");
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../style.css">
</head>

<body>
    <div class="container text-center">
        <div class="row">
            <div class="col col-md-6 mx-auto">
                <h1 class="my-4 display-4">EDIT PROFILE</h1>
                <form method="POST" enctype="multipart/form-data" class="rounded-4 bg-gradient text-light py-4 px-5">
                    <!-- first name -->
                    <div class="mb-3">
                        <label for="first_name" class="form-label">First Name</label>
                        <input type="text" id="first_name" class="form-control rounded-4" name="first_name" value="<?= $row['first_name'] ?>">
                    </div>
                    <!-- last name -->
                    <div class="mb-3">
                        <label for="last_name" class="form-label">Last Name</label>
                        <input type="text" id="last_name" class="form-control rounded-4" name="last_name" value="<?= $row['last_name'] ?>">
                    </div>
                    <!-- address -->
                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" id="address" class="form-control rounded-4" name="address" value="<?= $row['address'] ?>">
                    </div>
                    <!-- email -->
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" id="email" class="form-control rounded-4" name="email" value="<?= $row['email'] ?>">

                    </div>
                    <!-- phone num -->

                    <div class="mb-3">
                        <label for="phone_number" class="form-label">Phone Number</label>
                        <input type="text" id="phone_number" class="form-control rounded-4" name="phone_number" value="<?= $row['phone_number'] ?>">

                    </div>
                    <!-- pass -->

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" id="password" class="form-control rounded-4" name="password" value="<?= $row['password'] ?>">

                    </div>


                    <!-- image profile -->
                    <div class="mb-3">
                        <label for="image" class="form-label">Image</label>
                        <input type="file" id="image" class="form-control rounded-4" name="iamge">
                    </div>
                    <div class="mb-3 my-5">
                        <input type="submit" class="btn btn-danger me-2" name="update-profile" id="submitBtn">
                        <a href="<?= $redirectTo ?>" class="btn btn-warning bg-opacity-25">Back</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>