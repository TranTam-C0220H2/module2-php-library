<?php
if (isset($_REQUEST['id'])) {
include '../../database/ConnectDatabase.php';
include '../class/StudentManager.php';
$studentManager = new StudentManager();
$id = $_REQUEST['id'];
$imagePath = $studentManager->getImageById($id);
unlink('../image/'.$imagePath['image']);
$studentManager->delete($id);
header('Location: ../students.php');
} else {
    header('Location: ../../index.php');
}