<?php
session_start();
include '../../database/ConnectDatabase.php';
include '../class/BorrowManager.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $returnDate = $_REQUEST['returnDate'];
    $_SESSION['returnDate'] = $returnDate;
    $idStudent = $_REQUEST['idStudent'];
    $_SESSION['idStudent'] = $idStudent;
    $status = $_REQUEST['status'];
    $_SESSION['status'] = $status;
    $numberOfBooks = $_REQUEST['numberOfBooks'];
    $_SESSION['numberOfBooks'] = $numberOfBooks;
    $differentDate = strtotime($returnDate) - strtotime(date('Y/m/d'));
    $borrowManager = new BorrowManager();
    $arrayIdStudent = $borrowManager->getIdStudent();

    if ($returnDate != '' && $idStudent != '' && $numberOfBooks != '' && $differentDate > 0 && in_array($idStudent, $arrayIdStudent)) {
        header('Location: ../view/add2.php');
    } else {
        if ($differentDate <= 0) {
            $_SESSION['differentDate'] = false;
        }
        if (!in_array($idStudent, $arrayIdStudent)) {
            unset($_SESSION['idStudent']);
        }
        header('Location: ../view/add.php');
    }

}

