<?php

session_start();

if (isset($_SESSION['adm'])) {
    header("Location:../admin/dashboard.php");
    exit;
}

if (!isset($_SESSION['user']) && !isset($_SESSION['adm'])) {
    header("Location:login/login.php");
    exit;
}





require_once "../components/db_connect.php";


$sql = "SELECT * FROM `animals`";
$result = mysqli_query($connect, $sql);
// echo "<pre>"; 
// var_dump($result);
// echo "</pre>";

$layout = '';

$btnAdopt = "";



if (mysqli_num_rows($result) > 0) {
    $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);



    foreach ($rows as $row) {

        if ($row["status_anim"] == 'adopted') {
            $Adopt = "<p> The pet has already a new home</p>";
        }




        $layout .= " <div class = 'my-3 '> 
    <div class='card my-3 mx-auto text-center rounded-4 bg-danger bg-gradient bg-opacity-25 text-light' style='width: 18rem;'>
  <img src='../img/{$row['image']}' class='card-img-top' id = 'cardPet'alt='image of {$row['name']}'>
  <div class='card-body'>
    <h5 class='card-title display-5'>{$row['name']}</h5>
    <p class='card-text'><strong>Breed :</strong> {$row['breed']}</p>
   <br>
    <a href='details.php?id={$row['animalId']}' class='btn btn-danger-sm  bg-gradient bg-opacity-25 rounded-3 text-warning border-3'>More Details</a>
   <br> 
   <br>
    <form action='adoption.php' method='POST'>
        <input type='hidden' name = 'pet_id' value = '{$row['animalId']}'>
        <button type='submit' name= 'adopt' value = 'Take me Home' class = 'btn btn-danger-sm  bg-gradient bg-opacity-25 rounded-3 border-light border-3 text-warning'><i class='fa-solid fa-paw' style='color: #FFD43B;'></i>Take Me Home <i class='fa-solid fa-paw' style='color: #FFD43B;'></i></button></form>
    <br>

   

  </div>
</div>
    </div>";
    }
} else {
    $layout = "<p class= 'text-center'>No pet found</p>";
}

// query to get user info
$sqlUser =  "SELECT * FROM users where userId = {$_SESSION['user']}";
$resultUser = mysqli_query($connect, $sqlUser);
$row = mysqli_fetch_assoc($resultUser);


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage-Rescue Haven</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="/style.css">

    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
</head>

<body>


    <div class="container-fluid">
        <nav class="navbar bg-body-tertiary rounded-4 mt-3">
            <div class="container-fluid justify-content-start text-light">
                <div></div>
                <img src="../img/logo.png" class="rounded-circle me-3
                " alt="logo Rescue Haven" id="imgLogo">


                <a class="btn btn-sm  me-2" href="home.php">Home</a>
                <a class="btn btn-sm  me-2" href="senior.php">Senior</a>
                <a class="btn btn-sm  me-5 " href="../login/logout.php?logout">Logout</a>

                <!-- imageProfile account + HI nameUser -->

                <img src=" <?= "../img/{$row['profile_img']} " ?>" class="rounded-circle me-2" id="imgProfile">

                <h5 class="text-light me-5"> Hello <?= $row['first_name'] ?></h5>

                <a href="edit_profile.php" class="ml-5 " title="Edit your profile"><i class="fa-solid fa-ellipsis-vertical fa-fade fs-5" style="color: #e37e2b;"></i></a>
            </div>
        </nav>

    </div>

    <div class="container text-center my-5">

        <h1>Welcome at Rescue Haven</h1>

        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 ">
            <?= $layout ?>

        </div>
    </div>

    <div class="footer animate__animated  animate__fadeInUp">
        <div class="social d-flex justify-content-around py-3 text-warning text-opacity-75 bg-gradient">
            <i class="fa-brands fa-facebook"></i>
            <i class="fa-brands fa-square-instagram"></i>
            <i class="fa-brands fa-twitter"></i>

        </div>
        <div class="py-3 text-light text-opacity-50 text-center">All rights reserved Rescue Haven &copy; 2024</div>

    </div>

    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>