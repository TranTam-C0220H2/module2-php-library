<?php
session_start();
include '../../database/ConnectDatabase.php';
include '../class/RegistrationManager.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['username'])) {
    $registrationManager = new RegistrationManager();
    $password = $_REQUEST['password'];
    $confirmPassword = $_REQUEST['confirmPassword'];
    $checkPassword = $registrationManager->checkPassword($password);
    if ($checkPassword) {
        if ($password == $confirmPassword) {
            $registrationManager->updatePasswordByEmail($_SESSION['username'], $password);
            $_SESSION['login'] = true;
            unset($_SESSION['username']);
            header('Location: ../home.php');
        } else {
            $_SESSION['checkConfirmPassword'] = false;
            header('Location: ../view/password-retrieval.php');
        }
    } else {
        $_SESSION['checkPassword'] = false;
        header('Location: ../view/password-retrieval.php');
    }
} else {
    header('Location: ../../index.php');
}
