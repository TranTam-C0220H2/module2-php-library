<?php
session_start();
include '../../database/ConnectDatabase.php';
include '../class/RegistrationManager.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_REQUEST['username'];
    $password = $_REQUEST['password'];

    $login = new RegistrationManager();
    $arrayLoginInfo = $login->getLoginInfo();
    foreach ($arrayLoginInfo as $item) {
        if ($item['email'] == $username && $item['password'] == $password){
            $_SESSION['login'] = true;
        }
    }
    if (isset($_SESSION['login'])) {
        header('Location: ../home.php');
    } else {
        header('Location: ../../index.php');
    }
} else {
    header('Location: ../../index.php');
}