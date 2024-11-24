<?php
session_start();

if (isset($_SESSION['user'])) {
    header("Location: user/home.php");
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
$row = mysqli_fetch_assoc($result);

// var_dump($row);

if ($row['image'] != 'img/defeault_animal.jpg') {
    unlink("img/{$row['image']}");
}

$deleteSql = "DELETE FROM `animals` WHERE animalId = {$id}";
mysqli_query($connect, $deleteSql);
header("Location: dashboard.php");
