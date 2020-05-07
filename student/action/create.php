<?php
session_start();
include '../../database/ConnectDatabase.php';
include '../class/Student.php';
include '../class/StudentManager.php';
include '../../function/function.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $image = $_FILES['image'];
    $imageName = $image['name'];
    $_SESSION['imageName'] = $imageName;
    $name = $_REQUEST['name'];
    $_SESSION['name'] = $name;
    $email = $_REQUEST['email'];
    $_SESSION['email'] = $email;
    $phone = $_REQUEST['phone'];
    $_SESSION['phone'] = $phone;
    $birthDay = $_REQUEST['birthDay'];
    $_SESSION['birthDay'] = $birthDay;
    $address = $_REQUEST['address'];
    $_SESSION['address'] = $address;
    $status = $_REQUEST['status'];
    $note = $_REQUEST['note'];
    $_SESSION['note'] = $note;
    $studentManager = new StudentManager();
    if ($name != '' && $email != '' && $phone != '') {
        $_SESSION['checkImage'] = checkUploadImage($image, '../image/');
        if ($_SESSION['checkImage'] == 'Upload file thành công') {
            $student = new Student($imageName, $name, $email, $phone, $birthDay, $address, $status, $note);
            $studentManager->add($student);
            unset($_SESSION['name']);
            unset($_SESSION['email']);
            unset($_SESSION['phone']);
            unset($_SESSION['birthDay']);
            unset($_SESSION['address']);
            unset($_SESSION['note']);
            unset($_SESSION['imageName']);
            unset($_SESSION['checkImage']);
            header('Location: ../students.php');
        } else {
            header('Location: ../view/add.php');
        }
    }
}
