<?php
include '../../database/ConnectDatabase.php';
include '../class/DetailBorrowManager.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $bookId = $_REQUEST['bookId'];
    $detailBorrowManager = new DetailBorrowManager();
    $arrayBooks = $detailBorrowManager->getAllDataBook();
    $arrayIdExistBook = [];
    foreach ($arrayBooks as $item) {
        if ($item['status']=='Exist') {
            array_push($arrayIdExistBook,$item['id']);
        }
    }
    if (in_array($bookId,$arrayIdExistBook)) {

    }
}