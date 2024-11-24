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

$id = $_GET['id'];



$sql = "SELECT * FROM `animals` WHERE animalId = {$id}";
$result = mysqli_query($connect, $sql);
$layout = '';






if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);



    $layout = "
    <div class ='text-center d-flex align-items-center my-5 px-5'> 
        <div class='card mx-auto rounded-4 bg-danger bg-opacity-25 bg-gradient text-light' style='width: 22rem; height:auto'>
            <img src='../img/{$row['image']}' class='card-img-top' alt='image of {$row['name']}'>
            <div class='card-body'>
                <h5 class='card-title display-3'>{$row['name']}</h5>
                <p class='card-text'><strong>Breed : </strong>{$row['breed']}</p>
                 <p class='card-text'> <strong>Age :</strong> {$row['age']} years old</p>
                  <p class='card-text'><strong>Size : </strong>{$row['size']}</p>
                <p class='card-text'><strong>Address :</strong> {$row['address_anim']}</p>
                  <p class='card-text'><strong>Vaccine :</strong> {$row['vaccinated']}</p>
                <p class='card-text'><strong>Description :<br></strong> {$row['description']}</p>
                <br>
                <br>
                <hr>
                <div class = 'd-flex justify-content-around ml-5 text-center'>
                <a href='adoption.php?id={$row['animalId']}' class='btn btn- bg-gradient border-danger rounded-5 border-3 px-5'>Take me Home</a>
                <br>
                <a href='dashboard.php' class='btn btn-warning bg-gradient border-danger rounded-5 border-3 px-5'>Back to list</a>
                 </div>
                
             
            </div>
        </div>
    </div>";
} else {
    echo "Dish n°{$id} not found.";
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About...</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="/style.css">
</head>

<body>
    <div class="container mx-auto bg-warning bg-gradient bg-opacity-25 rounded-5" id="contDet">
        <?= $layout ?>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>