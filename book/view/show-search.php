<?php
session_start();
if (!isset($_SESSION['login'])) {
    header('Location: ../../index.php');
}
include '../../database/ConnectDatabase.php';
include '../class/BookManager.php';

$bookManager = new BookManager();
$arraySearch = [];
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_REQUEST['id'])) {
        $keyword = $_REQUEST['id'];
        $arraySearch = $bookManager->searchByRow('id', $keyword);
    } else {
        $keyword = $_REQUEST['keyword'];
        $choose = $_REQUEST['choose'];
        if ($choose == 'ID') {
            $arraySearch = $bookManager->searchByRow('books.id', $keyword);
        } elseif ($choose == 'Name') {
            $arraySearch = $bookManager->searchByRow('books.name', $keyword);
        } elseif ($choose == 'Author') {
            $arraySearch = $bookManager->searchByRow('author', $keyword);
        } elseif ($choose == 'Price') {
            $arraySearch = $bookManager->searchByRow('price', $keyword);
        } elseif ($choose == 'Category') {
            $arraySearch = $bookManager->searchByRow('categories.name', $keyword);
        } elseif ($choose == 'Status') {
            $arraySearch = $bookManager->searchByRow('status', $keyword);
        }
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Library Manager</title>
</head>
<body>
<div class="card">
    <div class="card-header">
        <ul class="nav nav-pills card-header-pills">
            <li class="nav-item">
                <a class="nav-link" href="../../category/categories.php">Categories</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="../books.php">Books</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../../student/students.php">Students</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../../borrow/borrows.php">Borrows</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../../user/action/logout.php">Logout</a>
            </li>
        </ul>
    </div>
    <div class="card-body">
        <h4>Book List Search</h4>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Image</th>
                <th scope="col">Name</th>
                <th scope="col">Author</th>
                <th scope="col">Price</th>
                <th scope="col">Category</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($arraySearch as $item): ?>
                <tr>
                    <th scope="row"><?php echo $item['id'] ?></th>
                    <td><img height="140" width="100" src="../image/<?php echo $item['image'] ?>"</td>
                    <td><?php echo $item['name'] ?></td>
                    <td><?php echo $item['author'] ?></td>
                    <td><?php echo $item['price'] ?></td>
                    <td><?php echo $item['nameCategory'] ?></td>
                    <td><?php echo $item['status'] ?></td>
                    <td><a href="update.php?id=<?php echo $item['id'] ?>">Update</a>|<a
                                onclick="return confirm('Delete?')"
                                href="../action/delete.php?id=<?php echo $item['id'] ?>">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        <h6><?php echo count($arraySearch) == 0 ? '*No result search' : '*' . count($arraySearch) . ' result is found' ?></h6>
    </div>
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
</body>
</html>