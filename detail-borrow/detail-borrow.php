<?php
session_start();
if (!isset($_SESSION['login'])) {
    header('Location: ../index.php');
}
if (isset($_REQUEST['id'])) {
    include '../database/ConnectDatabase.php';
    include 'class/DetailBorrowManager.php';
    $detailBorrowManager = new DetailBorrowManager();
    $arrayDetailBorrowManager = $detailBorrowManager->getDetailBorrow($_REQUEST['id']);
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>Library Manager</title>
</head>
<body>
<div class="card">
    <div class="card-header">
        <ul class="nav nav-pills card-header-pills">
            <li class="nav-item">
                <a class="nav-link" href="../category/categories.php">Categories</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../book/books.php">Books</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../student/students.php">Students</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="../borrow/borrows.php">Borrows</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../user/action/logout.php">Logout</a>
            </li>
        </ul>
    </div>
    <div class="card-body row no-gutters align-items-center">
        <?php foreach ($arrayDetailBorrowManager as $item): ?>
            <div class="col">
                <h5 class="card-title">Borrow Information</h5>
                <p>ID: <?php echo $item['idBorrow'] ?></p>
                <p>Borrow Date: <?php echo $item['borrowDate'] ?></p>
                <p>Return Date: <?php echo $item['returnDate'] ?></p>
                <p>&nbsp;</p>
            </div>
            <div class="col">
                <h5 class="card-title">Student Information</h5>
                <p>ID: <?php echo $item['idStudent'] ?></p>
                <p>Name: <?php echo $item['nameStudent'] ?></p>
                <p>Email: <?php echo $item['emailStudent'] ?></p>
                <p>Phone: <?php echo $item['phoneStudent'] ?></p>
            </div>
            <?php break ?>
        <?php endforeach; ?>
    </div>
    <div class="card-body">
        <h5 class="card-title">Borrow Book List</h5>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Image</th>
                <th scope="col">Name</th>
                <th scope="col">Author</th>
                <th scope="col">Price</th>
                <th scope="col">Category</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($arrayDetailBorrowManager as $item): ?>
                <tr>
                    <th scope="row"><?php echo $item['idBook'] ?></th>
                    <td><img height="140" width="100" src="../book/image/<?php echo $item['imageBook'] ?>"</td>
                    <td><?php echo $item['nameBook'] ?></td>
                    <td><?php echo $item['authorBook'] ?></td>
                    <td><?php echo $item['priceBook'] ?></td>
                    <td><?php echo $item['nameCategory'] ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
            integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
            integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
            crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
            integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
            crossorigin="anonymous"></script>
</div>
</body>
</html>