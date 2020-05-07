<?php


class DetailBorrowManager
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

    function getAllDataBook()
    {
        $sql = "SELECT * FROM books LEFT JOIN book_borrow ON books.id = book_borrow.book_id;";
        $stmt = $this->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    function add($detailBorrow)
    {
        $bookId = $detailBorrow->getBookId();
        $borrowId = $detailBorrow->getBorrowId();
        $sql = "INSERT INTO book_borrow (book_id, borrow_id) VALUES (:bookId, :borrowId);";
        $stmt = $this->prepare($sql);
        $stmt->bindParam(':bookId', $bookId);
        $stmt->bindParam(':borrowId', $borrowId);
        $stmt->execute();
    }

    function getDetailBorrow($idBorrow)
    {
        $sql = "SELECT students.id AS idStudent, students.name AS nameStudent, students.email AS emailStudent, students.phone AS phoneStudent,
                borrows.id AS idBorrow, borrows.borrow_date AS borrowDate, borrows.return_date AS returnDate, 
                books.id AS idBook, books.image AS imageBook, books.name AS nameBook, books.author AS authorBook, books.price AS priceBook,
                categories.name AS nameCategory
                FROM students
                JOIN borrows
                ON students.id = borrows.student_id
                JOIN book_borrow
                ON borrows.id = book_borrow.borrow_id
                JOIN books
                ON book_borrow.book_id = books.id
                JOIN categories
                ON categories.id = books.category_id
                WHERE borrows.id = '$idBorrow';";
        $stmt = $this->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}