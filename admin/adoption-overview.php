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


$sqlAdopt = "SELECT * FROM `pet_adoption` LEFT JOIN animals on pet_adoption.pet_id = animals.animalId RIGHT JOIN users ON pet_adoption.user_Id = users.userId where status LIKE 'user%'  OR (status LIKE 'adm%') IS NOT TRUE";
$resultAdopt = mysqli_query($connect, $sqlAdopt);
$layout = '';

if (mysqli_num_rows($resultAdopt) > 0) {
    $rows = mysqli_fetch_all($resultAdopt, MYSQLI_ASSOC);


    foreach ($rows as $row) {
        $layout .= "
         <div> 
         
            <tbody>
                <tr>
                    <th scope='row'>{$row['pet_id']}</th>
                    <td>{$row['name']}</td>
                    <td>{$row['age']}</td>
                    <td>{$row['breed']}</td>
                    <td>{$row['address_anim']}</td>
                    <td>{$row['first_name']}</td>
                    <td>{$row['last_name']}</td>
                    <td>{$row['email']}</td>
                    <td>{$row['phone_number']}</td>
                    <td>{$row['address']}</td>
                </tr>

            </tbody>

        
        </div>";
    }
}


// <td>{$row['']}</td>

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adoption Overview</title>
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../style.css">
</head>

<body>

    <div class="container text-center mx-auto" id="tableCont">
        <a href="dashboard.php" class="btn btn-warning  bg-gradient rounded-3 border-light border-3 text-light bg-opacity-25 mt-3" id="log">Back to Dashboard</a>

        <br>
        <br>
        <h1>Adoption Overview</h1>

        <table class='table table-danger bg-opacity-50 bg-gradient border-light border-3  w-25 rounded-4 mx-auto cols-6' id="table">
            <thead>
                <tr>
                    <th scope='col'>Pet Id</th>
                    <th scope='col'>Pet Name</th>
                    <th scope='col'>Pet Age</th>
                    <th scope='col'>Breed</th>
                    <th scope='col'>Temp. Address Pet</th>
                    <th scope='col'>First Name</th>
                    <th scope='col'>Last Name</th>
                    <th scope='col'>Email User</th>
                    <th scope='col'>Phone Number User</th>
                    <th scope='col'>Address User</th>
                </tr>
            </thead>
            <?= $layout ?>
        </table>




    </div>



</body>

</html>