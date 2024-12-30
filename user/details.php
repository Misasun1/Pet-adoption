<?php
session_start();
if (isset($_SESSION['adm'])) {
    header("Location: ../admin/dashboard.php");
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

    $available = $row['status_anim'] == "adopted" ? " pet adopted" : " Take me Home";
    $not_avail = $row['status_anim'] == "adopted" ? "disabled" : "";


    $layout = "
    <div class ='text-center d-flex align-items-center my-5 px-5'> 
        <div class='card mx-auto rounded-4 bg-danger bg-opacity-25 bg-gradient text-light' id ='PetDet' style='width: 22rem; height:auto'>
            <img src='../img/{$row['image']}' class='card-img-top' alt='image of {$row['name']}'>
            <div class='card-body'>
                <h5 class='card-title display-3'>{$row['name']}</h5>
                <p class='card-text'><strong>Breed :</strong>{$row['breed']}</p>
                 <p class='card-text'><strong>Age : </strong> {$row['age']} years old</p>
                  <p class='card-text'><strong>Size :</strong> {$row['size']}</p>
                <p class='card-text'><strong>Address :</strong> {$row['address_anim']}</p>
                  <p class='card-text'><strong>Vaccine :</strong> {$row['vaccinated']}</p>
                <p class='card-text'><strong>Description :</strong> <br>  {$row['description']}</p>
                <br>
                <br>
                <hr>
                <div class = 'd-flex justify-content-around text-center'>
               
                <a href='home.php' class='btn btn-warning bg-gradient border-danger rounded-2 border-3 px-4 me-2'>Back to Pets</a>

                <form action='adoption.php' method='POST'>
                    <input type='hidden' name = 'pet_id' value = '{$row['animalId']}'>
                    <button type='submit' name= 'adopt' value = '$available' $not_avail  class = 'btn btn-danger-sm  bg-gradient bg-opacity-50 rounded-3 border-light border-3 rounded-2 text-warning fw-5 px-4'><i class='fa-solid fa-paw' style='color: #FFD43B;'></i>$available  <i class='fa-solid fa-paw' style='color: #FFD43B;'></i></button></form>
                <br>

                 </div>
                
             
            </div>
        </div>
    </div>";
} else {
    echo "No pet availavble for adoption";
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <div class="container mx-auto bg-warning w-75 mt-2 bg-gradient bg-opacity-25 rounded-5" id="contDet">
        <?= $layout ?>

        <br>
        <br>
        <br>
        <br>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>