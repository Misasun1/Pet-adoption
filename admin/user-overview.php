<!-- to connect this page to db connect -->
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

$sql = "SELECT * FROM `users` where status LIKE 'user%'  OR (status LIKE 'adm%') IS NOT TRUE";
$result = mysqli_query($connect, $sql);
$layout = '';

if (mysqli_num_rows($result) > 0) {
    $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
    // var_dump($rows);

    // problem with path image
    foreach ($rows as $row) {
        $layout .= "
    <div class = 'my-3 '> 
    <div class='card my-3 mx-auto text-center rounded-4 bg-danger bg-opacity-25 bg-gradient text-light' style='width: 18rem;'>
  <img src='../img/{$row['profile_img']}' class='card-img-top rounded-circle' id = 'cardDish'alt='image of {$row['first_name']}'>
  <div class='card-body'>
    <h5 class='card-title'>{$row['first_name']}</h5>
    <h5 class='card-title'>{$row['last_name']}</h5>
    <p class='card-text'>{$row['email']}</p>
    <p class='card-text'>{$row['phone_number']}</p>
    <p class='card-text'>{$row['address']}</p>
  
  </div>
</div>
    </div>
    
    
    ";
    }
} else {
    $layout = "<div class ='mx-auto my-5 text-light display-6'>
    <p> No data available</p>
    </div>
    ";
}



?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Overview</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="stylesheet" href="../style.css">
</head>

<body>

    <div class="container rounded-1 bg-gradient text-center ">
        <br>
        <div class="">
            <a href="dashboard.php" class="btn btn-warning bg-opacity-50 bg-gradient rounded-3 border-light border-3 text-light bg-opacity-75 mt-3" id="log">Back to Dashboard</a>

            <br>
            <br>

            <br>
            <br>
            <h1 class="pt-5 sweet animate__animated animate__bounce">Registered Users</h1>
            <br>



            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3">


                <?= $layout ?>

            </div>


        </div>




        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>