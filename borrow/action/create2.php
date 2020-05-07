<?php
session_start();
include '../../function/function.php';
include '../../database/ConnectDatabase.php';
include '../class/Borrow.php';
include '../class/BorrowManager.php';
include '../../book/class/BookManager.php';
include '../../student/class/StudentManager.php';
include '../../detail-borrow/class/DetailBorrow.php';
include '../../detail-borrow/class/DetailBorrowManager.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $_SESSION['numberOfBooks'] = $_REQUEST['numberOfBooks'];
    $borrowManager = new BorrowManager();
    $bookManager = new BookManager();
    $studentManager = new StudentManager();
    $checkEmptyBook = 0;
    $_SESSION['arrayBookId'] = [];
    for ($i = 1; $i <= $_SESSION['numberOfBooks']; $i++) {
        $_SESSION["bookId" . $i] = $_REQUEST["bookId" . $i];
        $arrayDataBookById = $bookManager->getAllById($_SESSION["bookId" . $i]);
        if ($arrayDataBookById['status'] != 'Exist') {
            unset($_SESSION["bookId" . $i]);
            $checkEmptyBook += 1;
            break;
        }
        array_push($_SESSION['arrayBookId'], $_SESSION["bookId" . $i]);
    }
    if ($checkEmptyBook == 0 && checkCoincideInArray($_SESSION['arrayBookId'])) {
        $borrow = new Borrow($_SESSION['returnDate'], $_SESSION['idStudent'], $_SESSION['status']);
        $borrowManager->add($borrow);
        $bookManager->updateStatusById($_SESSION['arrayBookId']);
        $studentManager->updateStatus($_SESSION['idStudent']);
        unset($_SESSION['returnDate']);
        unset($_SESSION['idStudent']);
        unset($_SESSION['status']);
        unset($_SESSION['numberOfBooks']);
        $newIdBorrow = $borrowManager->getMaxId()["MAX(id)"];
        $detailBorrowManager = new DetailBorrowManager();
        for ($i = 1; $i <= count($_SESSION['arrayBookId']); $i++) {
            $detailBorrow = new DetailBorrow($_SESSION["bookId" . $i], $newIdBorrow);
            $detailBorrowManager->add($detailBorrow);
            unset($_SESSION["bookId" . $i]);
        }
        unset($_SESSION['arrayBookId']);
        header('Location: ../borrows.php');
    } else {
        unset($_SESSION['arrayBookId']);
        header('Location: ../view/add2.php');
    }
}