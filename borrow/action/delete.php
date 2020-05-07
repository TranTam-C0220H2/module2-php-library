<?php
include '../../database/ConnectDatabase.php';
include '../class/BorrowManager.php';
$borrowManager = new BorrowManager();
$id = $_REQUEST['id'];
$borrowManager->delete($id);
header('Location: ../borrows.php');