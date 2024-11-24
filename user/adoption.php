<?php

session_start();

if (isset($_SESSION['adm'])) {
  header("Location:../admin/dashboard.php");
  exit;
}

if (!isset($_SESSION['user']) && !isset($_SESSION['adm'])) {
  header("Location:../login/login.php");
  exit;
}


require_once "../components/db_connect.php";





if (isset($_SESSION["user"]) && !isset($_SESSION["adm"])) {
  $sqlUser = "SELECT * FROM users WHERE userId = {$_SESSION["user"]}";
  $resultUser = mysqli_query($connect, $sqlUser);
  $userID = mysqli_fetch_assoc($resultUser);
} elseif (!isset($_SESSION["user"]) && isset($_SESSION["adm"])) {
  $sqlUser = "SELECT * FROM users WHERE userId = {$_SESSION["adm"]}";
  $resultUser = mysqli_query($connect, $sqlUser);
  $userID = mysqli_fetch_assoc($resultUser);
}



if (isset($_POST['adopt'])) {




  $userID = $_SESSION['user'];
  $petID = $_POST['pet_id'];
  $adopDate = date('Y-m-d');

  // echo "<pre>";
  // var_dump($petID);
  // echo "</pre>";


  $sqlAdop = "INSERT INTO `pet_adoption`(`user_Id`, `pet_id`, `adoption_date`) VALUES ('$userID','$petID','$adopDate')";
  $resultAdop = mysqli_query($connect, $sqlAdop);

  if ($resultAdop) {
    echo "<div class='alert alert-success text-center' role='alert'>
  Congrats! Your pet in on the way home
</div>";
  } else {
    echo "<div class='alert alert-danger text-center' role='alert'>
  Something went wrong, try later or contact us directly
</div>";
  }

  header("refresh: 6; url=home.php");
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Adoption</title>
  <link rel="Stylesheet" href="/style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>

<body>

  <div class="container text-center">

    <img src="../img/thank_you.jpg" class="rounded-5 mt-5" alt="thnak you image" width="400">
  </div>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"> </script>
</body>

</html>