<?php
session_start();
include '../../database/ConnectDatabase.php';
include '../class/BorrowManager.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $borrowManager = new BorrowManager();
    $expectedReturnDate = $_REQUEST['expectedReturnDate'];
    $idStudent = $_REQUEST['idStudent'];
    $_SESSION['idStudent'] = $idStudent;
    $id = $_REQUEST['id'];
    $_SESSION['idOfUpdate'] = $id;
    $status = $_REQUEST['status'];
    $borrowById = $borrowManager->getAllById($id);
    $differentDate = strtotime($expectedReturnDate) - strtotime($borrowById['borrow_date']);
    $arrayIdStudent = $borrowManager->getIdStudent();
    if ($differentDate > 0 && in_array($idStudent, $arrayIdStudent)) {
        $borrowManager->update($id, $idStudent, $expectedReturnDate, $status);
        unset($_SESSION['idOfUpdate']);
        unset($_SESSION['idStudent']);
        header('Location: ../borrows.php');
    } else {
        if (in_array($idStudent, $arrayIdStudent)) {
            $borrowManager->updateNoExpectedReturnDate($id, $idStudent, $status);
            unset($_SESSION['idOfUpdate']);
            unset($_SESSION['idStudent']);
            header('Location: ../borrows.php');
        } else {
            $_SESSION['differentDate'] = false;
            unset($_SESSION['idStudent']);
            header('Location: ../view/update.php');
        }
    }
}

