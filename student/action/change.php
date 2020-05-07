<?php
session_start();
include '../../database/ConnectDatabase.php';
include '../class/StudentManager.php';
include '../../function/function.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_REQUEST['id'];
    $_SESSION['idOfUpdate'] = $id;
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
        if ($_SESSION['checkImage'] == 'Lỗi : File đã tồn tại.' && $_SESSION['imageName'] == $_SESSION['imageById']) {
            update($studentManager, $id, $name, $birthDay, $address, $email, $phone, $imageName, $status, $note);
        } elseif ($_SESSION['checkImage'] == 'Upload file thành công') {
            unlink('../image/' . $_SESSION['imageById']);
            update($studentManager, $id, $name, $birthDay, $address, $email, $phone, $imageName, $status, $note);
        } elseif ($_SESSION['checkImage'] == "Lỗi: Image is empty") {
            $studentManager->updateExceptImage($id, $name, $birthDay, $address, $email, $phone, $status, $note);
            unset($_SESSION['name']);
            unset($_SESSION['email']);
            unset($_SESSION['phone']);
            unset($_SESSION['birthDay']);
            unset($_SESSION['address']);
            unset($_SESSION['note']);
            unset($_SESSION['imageName']);
            unset($_SESSION['checkImage']);
            unset($_SESSION['idOfUpdate']);
            header('Location: ../students.php');
        } else {
            header('Location: ../view/update.php');
        }
    } else {
        header('Location: ../view/update.php');
    }
}
function update($studentManager, $id, $name, $birthDay, $address, $email, $phone, $image, $status, $note)
{
    $studentManager->update($id, $name, $birthDay, $address, $email, $phone, $image, $status, $note);
    unset($_SESSION['name']);
    unset($_SESSION['email']);
    unset($_SESSION['phone']);
    unset($_SESSION['birthDay']);
    unset($_SESSION['address']);
    unset($_SESSION['note']);
    unset($_SESSION['imageName']);
    unset($_SESSION['checkImage']);
    unset($_SESSION['idOfUpdate']);
    header('Location: ../students.php');
}

