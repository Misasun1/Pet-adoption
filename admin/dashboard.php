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

$sql = "SELECT * FROM `users` WHERE userId = {$_SESSION['adm']}";
$result = mysqli_query($connect, $sql);
$row = mysqli_fetch_assoc($result);


$sql1 = "SELECT * FROM `animals` ";

$result1 = mysqli_query($connect, $sql1);
$layout = '';

if (mysqli_num_rows($result1) > 0) {
    $rows = mysqli_fetch_all($result1, MYSQLI_ASSOC);


    foreach ($rows as $anim) {

        $layout .= "
       
    <div class = 'my-3 '> 
   <div class='card my-3 mx-auto text-center rounded-4 bg-danger bg-gradient bg-opacity-25 text-light' style='width: 18rem;'>
  <img src='../img/{$anim['image']}' class='card-img-top' id = 'cardPet'alt='image of {$anim['name']}'>
  <div class='card-body'>
    <h5 class='card-title display-5'>{$anim['name']}</h5>
    <p class='card-text'>Breed : {$anim['breed']}</p>


    <a href='detailsAdm.php?id={$anim['animalId']}' class='btn btn-danger-sm  bg-gradient bg-opacity-25 rounded-3 border-light border-3'>More</a>
   <br>
   <br>
    <a href='update.php?id={$anim['animalId']}' class='btn btn-warning bg-gradient bg-opacity-25  border-light border-3 me-2 px-4'>Edit</a>

        <a href='delete.php?id={$anim['animalId']}' class='btn btn-danger  bg-gradient bg-opacity-10 rounded-3 text-warning border-3'>Delete</a>

  </div>
</div>
</div>
    
    
    ";
    }
} else {
    $layout = 'No data available';
}



?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin-Rescue Haven</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="/style.css">
</head>

<body>

    <div class="container-fluid  text-center ">


        <nav class="navbar bg-body-tertiary rounded-4 mt-3 d-flex justify-content-around">
            <div class="container-fluid ">
                <img src="../img/logo.png" class="rounded-circle me-3 
                " alt="logo Rescue Haven" id="imgLogo">


                <a class="btn btn-sm  me-2" href="dashboard.php">Home</a>
                <a class="btn btn-sm  me-2" href="create.php">Add a new Pet</a>
                <a class="btn btn-sm my-3 me-2" href="adoption-overview.php">Adoption overview</a>
                <a class="btn btn-sm  me-2" href="user-overview.php">Users overview</a>
                <a class="btn btn-sm  me-5 " href="../login/logout.php?logout">Logout</a>

                <!-- imageProfile account + HI nameAdm-->

                <img src=" <?= "../img/{$row['profile_img']} " ?>" class="rounded-circle me-2 my-3" id="imgProfile">
                <h5 class="text-warning me-5"> Hello <?= $row['first_name'] ?></h5>

                <a href="edit_profile_adm.php" class="ml-5 " title="Edit your profile"><i class="fa-solid fa-ellipsis-vertical fa-fade fs-5" style="color: #e37e2b;"></i></a>
            </div>
        </nav>



        <h1 class="pt-5">RESCUE HAVEN</h1>

        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 ">
            <?= $layout ?>

        </div>

    </div>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>