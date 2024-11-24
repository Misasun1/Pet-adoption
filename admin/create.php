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


// $sqlSuppliers = "SELECT * FROM suppliers";
// $suppResult = mysqli_query($connection, $sqlSuppliers);
// $suppliersRows = mysqli_fetch_all($suppResult, MYSQLI_ASSOC);

// $options = "";
// foreach ($suppliersRows as $supp) {

//     $options .= " <option value='{$supp['supplierId']}'>{$supp['sup_name']}</option>";
// }


if (isset($_POST['add_pet'])) {


    $name = ($_POST['name']);
    $breed = ($_POST['breed']);
    $age = ($_POST['age']);
    $size = ($_POST['size']);
    $addressPet = ($_POST['address_anim']);
    $vaccine = ($_POST['vaccinated']);
    $descrip = ($_POST['description']);
    $image = imageUpload($_FILES['image'], 'animal');
    $statusPet = ($_POST['status_anim']);



    $sql = "INSERT INTO `animals`(`name`, `breed`, `image`, `address_anim`, `description`, `size`, `age`, `vaccinated`, `status_anim`)  VALUES ( '$name','$breed','$image[0]','$addressPet','$descrip','$size','$age','$vaccine', '$statusPet')";


    $result = mysqli_query($connect, $sql);





    if ($result) {

        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'><p class = 'text-center'>
  <strong>$image[1]!</strong> A new pet has been added. </p>
  <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
</div>";
    } else {
        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'><p class = 'text-center'>
 <p> Something went wrong. Try again later.</p>
  <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
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
    <h1 class="text-center display-3 my-3"> Add New Record</h1>
    <div class="container mt-5">




        <form method="POST" enctype="multipart/form-data" class="rounded-4  bg-gradient text-light py-4 px-5">
            <!-- name -->
            <div class="mb-3 text-center">
                <label for="name" class="form-label "><strong class="write">Name</strong></label>
                <input type="text" id="name" name="name" class="form-control text-center rounded-5" placeholder="Insert name Dish" required>
            </div>
            <!-- breed -->
            <div class="mb-3 text-center">
                <label for="breed" class="form-label  "><strong class="write">Breed</strong></label>
                <input type="text" id="breed" name="breed" class="form-control text-center rounded-5"
                    placeholder="Enter pet breed"
                    required>

                <!-- <div class="mb-3 text-center">
                    <label for="supplier" class="form-label  "><strong class="write">Choose Supplier</strong></label>
                    <select id="supplier" name="supplier" class="form-select text-center rounded-5">
                        <option value="null">Select one of the options</option>
                        <?= $options ?>
                    </select>
                </div> -->
                <!-- age -->
                <div class="mb-3 text-center">
                    <label for="age" class="form-label  "><strong class="write">Age</strong></label>
                    <input type="text" id="age" name="age" class="form-control text-center rounded-5"
                        placeholder="Enter pet age"
                        required>
                </div>

                <!-- size -->
                <div class="mb-3 text-center">
                    <label for="size" class="form-label  "><strong class="write">Size</strong></label>
                    <input type="text" id="size" name="size" class="form-control text-center rounded-5"
                        placeholder="Enter pet size"
                        required>
                </div>

                <!-- address -->
                <div class="mb-3 text-center">
                    <label for="address" class="form-label  "><strong class="write">Address</strong></label>
                    <input type="text" id="address" name="address_anim" class="form-control text-center rounded-5"
                        placeholder="Enter pet address"
                        required>
                </div>

                <!-- vaccination -->

                <!-- maybe create an option -->
                <div class="mb-3 text-center">
                    <label for="vaccinated" class="form-label  "><strong class="write">Vaccination</strong></label>
                    <input type="text" id="vaccinated" name="vaccinated" class="form-control text-center rounded-5"
                        placeholder="Enter if pet has been vaccinated"
                        required>
                </div>

                <!-- description -->
                <div class="mb-3 text-center">
                    <label for="descrip" class="form-label  "><strong class="write">Description</strong></label>

                    <textarea name="description" id="description" placeholder="Provide a short description" class="form-control text-center rounded-5"
                        required></textarea>
                </div>


                <!-- status -->
                <div class="mb-3 text-center">
                    <label for="status_anim" class="form-label  "><strong class="write">Status</strong></label>
                    <input type="text" id="status_anim" name="status_anim" class="form-control text-center rounded-5"
                        placeholder="Enter status (ex: adopted,..)"
                        required>
                </div>




                <!-- image -->
                <div class="mb-3 text-center">
                    <label for="image" class="form-label "><strong class="write">Upload an image</strong> </label>
                    <input type="file" id="image" name="image" class="form-control rounded-5">
                    <br>
                    <br>


                    <div class="">
                        <input type="submit" class="btn btn-dark bg-gradient rounded-4 border-light border-2 px-4" name="add_pet" value="Submit">
                        <br>
                        <a href="dashboard.php" class="btn btn-warning bg-gradient my-5 rounded-5 border-light border-2">Back to Menu</a>
                    </div>

        </form>


    </div>


    </div>





</body>

</html>