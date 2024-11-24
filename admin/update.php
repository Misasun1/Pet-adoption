<?php
session_start();


if (isset($_SESSION['user'])) {
    header("Location: ../user/home.php");
    exit;
}

if (!isset($_SESSION['user']) && !isset($_SESSION['adm'])) {
    header("Location: ../login/login.php");
    exit;
}

require_once "../components/db_connect.php";
require_once "../components/file_upload.php";

$id = $_GET['id'];
$sql = "SELECT * FROM `animals` WHERE animalId = {$id}";
$result = mysqli_query($connect, $sql);
$row = mysqli_fetch_assoc($result);

if (isset($_POST['update'])) {


    $name = ($_POST['name']);
    $breed = ($_POST['breed']);
    $age = ($_POST['age']);
    $size = ($_POST['size']);
    $addressPet = ($_POST['address_anim']);
    $vaccine = ($_POST['vaccinated']);
    $descrip = ($_POST['description']);
    $image = imageUpload($_FILES['image'], 'animal');
    $statusPet = ($_POST['status_anim']);


    if ($_FILES['image']['error'] == 4) {

        $updateQuery = "UPDATE `animals` SET `name`='$name',`breed`='$breed',`age`='$age', `size`='$size',`address_anim`='$addressPet',`vaccinated`='$vaccine',`description`='$descrip', `status_anim`='$statusPet' WHERE animalId = $id";
    } else {
        if ($row['image'] != 'img/defeault_animal.jpg') {

            unlink("img/{$row['image']}");
        }
        $updateQuery = "UPDATE `dish` SET `image`='$image[0]',`name`='$name',`breed`='$breed',`age`='$age', `size`='$size',`address_anim`='$addressPet',`vaccinated`='$vaccine',`description`='$descrip', `status_anim`='$statusPet' WHERE animalId = $id";
    }
    $result = mysqli_query($connect, $updateQuery);
    if ($result) {
        echo "<div class='alert alert-success' role='alert'>
                The record has been updated successfully!
            </div>";
    } else {
        "<div class='alert alert-danger' role='alert'>
                Something went wrong, try again later!
            </div>";
    }
    header("refresh: 3; url=dashboard.php");
}


?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload new dishes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="/style.css">
</head>

<body>
    <h1 class="text-center display-2 my-3"> Edit info about <?= $row['name'] ?></h1>
    <div class="container mt-5">




        <form method="POST" enctype="multipart/form-data" class="rounded-4  bg-gradient text-light py-4 px-5">
            <!-- name -->
            <div class="mb-3 text-center">
                <label for="name" class="form-label "><strong class="write">Name</strong></label>
                <input type="text" id="name" value="<?= $row['name'] ?>" name="name" class="form-control text-center rounded-5" required>
            </div>
            <!-- breed -->
            <div class="mb-3 text-center">
                <label for="breed" class="form-label  "><strong class="write">Breed</strong></label>
                <input type="text" id="breed" value="<?= $row['breed'] ?>" name="breed" class="form-control text-center rounded-5"

                    required>


                <div class="mb-3 text-center">
                    <label for="age" class="form-label  "><strong class="write">Age</strong></label>
                    <input type="text" id="age" value="<?= $row['age'] ?>" name="age" class="form-control text-center rounded-5"

                        required>
                </div>

                <!-- size -->
                <div class="mb-3 text-center">
                    <label for="size" class="form-label  "><strong class="write">Size</strong></label>
                    <input type="text" id="size" value="<?= $row['size'] ?>" name="size" class="form-control text-center rounded-5"

                        required>
                </div>

                <!-- address -->
                <div class="mb-3 text-center">
                    <label for="address" class="form-label  "><strong class="write">Address</strong></label>
                    <input type="text" id="address" value="<?= $row['address_anim'] ?>" name="address_anim" class="form-control text-center rounded-5"

                        required>
                </div>

                <!-- vaccination -->

                <!-- maybe create an option -->
                <div class="mb-3 text-center">
                    <label for="vaccinated" class="form-label  "><strong class="write">Vaccination</strong></label>
                    <input type="text" id="vaccinated" value="<?= $row['vaccinated'] ?>" name="vaccinated" class="form-control text-center rounded-5"

                        required>
                </div>

                <!-- description -->
                <div class="mb-3 text-center">
                    <label for="descrip" class="form-label  "><strong class="write">Description</strong></label>


                    <!-- i have tried with textarea but does not display the info -->
                    <input name="description" id="description" value="<?= $row['description'] ?>" class="form-control text-center rounded-5"
                        required>
                </div>


                <!-- status -->
                <div class="mb-3 text-center">
                    <label for="status_anim" class="form-label  "><strong class="write">Status</strong></label>
                    <input type="text" id="status_anim" value="<?= $row['status_anim'] ?>" name="status_anim" class="form-control text-center rounded-5"

                        required>
                </div>




                <!-- image -->
                <div class="mb-3 text-center">
                    <label for="image" class="form-label "><strong class="write">Upload an image</strong> </label>
                    <input type="file" id="image" value="<?= $row['image'] ?>" name="image" class="form-control rounded-5">
                    <br>
                    <br>


                    <div class="">
                        <input type="submit" class="btn btn-dark bg-gradient border-light border-2 px-4" name="update" value="Submit">
                        <br>
                        <a href="dashboard.php" class="btn btn-warning bg-gradient my-5 border-light border-2">Back</a>
                    </div>

        </form>


    </div>


    </div>





</body>

</html>