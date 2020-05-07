<?php
session_start();
include '../../database/ConnectDatabase.php';
include '../class/RegistrationManager.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_REQUEST['username'];
    $phoneNumber = $_REQUEST['phoneNumber'];

    $registrationManager = new RegistrationManager();
    $arrayRetrievalInfo = $registrationManager->getRetrievalInfo();
    foreach ($arrayRetrievalInfo as $item) {
        if ($item['email'] == $username && $item['phone'] == $phoneNumber) {
            $_SESSION['username'] = $username;
        }
    }
    if (isset($_SESSION['username'])) {
        header("Location: ../view/password-retrieval.php");
    } else {
        header('Location: ../view/forgot-password.php');
    }
} else {
    header('Location: ../../index.php');
}