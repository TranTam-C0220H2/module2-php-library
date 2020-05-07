<?php


class BorrowManager
{
    protected $conn;

    public function __construct()
    {
        $this->conn = new ConnectDatabase();
    }

    function prepare($sql)
    {
        $stmt = $this->conn->connect();
        return $stmt->prepare($sql);
    }

    function getAllDatabase()
    {
        $sql = 'SELECT * FROM borrows;';
        $stmt = $this->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    function getIdStudent()
    {
        $sql = 'SELECT students.id FROM students LEFT JOIN borrows ON students.id = borrows.student_id;';
        $stmt = $this->prepare($sql);
        $stmt->execute();
        $arrayStudentId = [];
        while ($row = $stmt->fetch()) {
            array_push($arrayStudentId, $row['id']);
        }
        return $arrayStudentId;
    }

    function add($borrow)
    {
        $returnDate = $borrow->getReturnDate();
        $studentId = $borrow->getStudentId();
        $status = $borrow->getStatus();
        $borrowDate = date('Y-m-d');
        $sql = 'INSERT INTO borrows (borrow_date,return_date,student_id,status) values (?,?,?,?);';
        $stmt = $this->prepare($sql);
        $stmt->bindParam(1, $borrowDate);
        $stmt->bindParam(2, $returnDate);
        $stmt->bindParam(3, $studentId);
        $stmt->bindParam(4, $status);
        $stmt->execute();
    }

    function delete($id)
    {
        $sql = "DELETE FROM borrows WHERE id = '$id';";
        $stmt = $this->prepare($sql);
        $stmt->execute();
    }

    function getAllById($id)
    {
        $sql = "SELECT * FROM borrows WHERE id = '$id';";
        $stmt = $this->prepare($sql);
        $stmt->execute();
        return $stmt->fetch();
    }

    function update($id, $idStudent, $expectedReturnDate, $status)
    {
        $sql = "UPDATE borrows SET student_id = '$idStudent',expected_return_date = '$expectedReturnDate', status = '$status' WHERE id = '$id';";
        $stmt = $this->prepare($sql);
        $stmt->execute();
    }

    function updateNoExpectedReturnDate($id, $idStudent, $status)
    {
        $sql = "UPDATE borrows SET student_id = '$idStudent', status = '$status' WHERE id = '$id';";
        $stmt = $this->prepare($sql);
        $stmt->execute();
    }

    function searchByRow($row, $keyword)
    {
        $sql = 'SELECT * FROM borrows WHERE ' . $row . ' LIKE "%' . $keyword . '%";';
        $stmt = $this->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    function getMaxId() {
        $sql = "SELECT MAX(id) FROM borrows;";
        $stmt = $this->prepare($sql);
        $stmt->execute();
        return $stmt->fetch();
    }
}