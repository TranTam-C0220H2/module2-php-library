<?php


class StudentManager
{
    protected $connDB;

    public function __construct()
    {
        $this->connDB = new ConnectDatabase();
    }

    function prepare($sql)
    {
        $stmt = $this->connDB->connect();
        return $stmt->prepare($sql);
    }

    function getAllDatabase()
    {
        $sql = 'SELECT * FROM students;';
        $stmt = $this->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    function add($student)
    {
        $name = $student->getName();
        $birthDay = $student->getBirthDay();
        $address = $student->getAddress();
        $email = $student->getEmail();
        $phone = $student->getPhone();
        $image = $student->getImage();
        $status = $student->getStatus();
        $note = $student->getNote();
        $sql = 'INSERT INTO students (name,birthday,address,email,phone,image,status,note) values (?,?,?,?,?,?,?,?);';
        $stmt = $this->prepare($sql);
        $stmt->bindParam(1, $name);
        $stmt->bindParam(2, $birthDay);
        $stmt->bindParam(3, $address);
        $stmt->bindParam(4, $email);
        $stmt->bindParam(5, $phone);
        $stmt->bindParam(6, $image);
        $stmt->bindParam(7, $status);
        $stmt->bindParam(8, $note);
        $stmt->execute();
    }

    function getImageById($id)
    {
        $sql = "SELECT image FROM students WHERE id = '$id';";
        $stmt = $this->prepare($sql);
        $stmt->execute();
        return $stmt->fetch();
    }

    function delete($id)
    {
        $sql = "DELETE FROM students WHERE id = '$id';";
        $stmt = $this->prepare($sql);
        $stmt->execute();
    }

    function getAllById($id)
    {
        $sql = "SELECT * FROM students WHERE id = '$id';";
        $stmt = $this->prepare($sql);
        $stmt->execute();
        return $stmt->fetch();
    }

    function update($id, $name, $birthDay, $address, $email, $phone, $image, $status, $note)
    {
        $sql = 'UPDATE students SET name = ?,birthday = ?,address = ?,email = ?,phone = ?,image = ?,status = ?,note = ? WHERE id = ?; ';
        $stmt = $this->prepare($sql);
        $stmt->bindParam(1, $name);
        $stmt->bindParam(2, $birthDay);
        $stmt->bindParam(3, $address);
        $stmt->bindParam(4, $email);
        $stmt->bindParam(5, $phone);
        $stmt->bindParam(6, $image);
        $stmt->bindParam(7, $status);
        $stmt->bindParam(8, $note);
        $stmt->bindParam(9, $id);
        $stmt->execute();
    }
    function updateExceptImage($id, $name, $birthDay, $address, $email, $phone, $status, $note)
    {
        $sql = 'UPDATE students SET name = ?,birthday = ?,address = ?,email = ?,phone = ?,status = ?,note = ? WHERE id = ?; ';
        $stmt = $this->prepare($sql);
        $stmt->bindParam(1, $name);
        $stmt->bindParam(2, $birthDay);
        $stmt->bindParam(3, $address);
        $stmt->bindParam(4, $email);
        $stmt->bindParam(5, $phone);
        $stmt->bindParam(6, $status);
        $stmt->bindParam(7, $note);
        $stmt->bindParam(8, $id);
        $stmt->execute();
    }

    function searchByRow($row, $keyword)
    {
        $sql = 'SELECT * FROM students WHERE ' . $row . ' LIKE "%' . $keyword . '%";';
        $stmt = $this->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    function updateStatus($id) {
        $sql = "UPDATE students SET status = 'Borrow' WHERE id = '$id';";
        $stmt = $this->prepare($sql);
        $stmt->execute();
    }
}