<?php
session_start();
if (!isset($_SESSION['login'])) {
    header('Location: ../index.php');
}

include '../database/ConnectDatabase.php';
include 'class/BorrowManager.php';

$borrowManager = new BorrowManager();
$arrayBorrow = $borrowManager->getAllDatabase();
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

    <title>Borrow Manager</title>
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
                <a class="nav-link active" href="">Borrows</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../user/action/logout.php">Logout</a>
            </li>
        </ul>
    </div>
    <div class="card-body">
        <form action="view/show-search.php" method="get" class="card card-sm">
            <div class="card-body row no-gutters align-items-center">
                <div class="col-auto">
                    <select id="inputState" name="choose" class="form-control form-control-lg form-control-borderless">
                        <option selected>Choose...</option>
                        <option>ID</option>
                        <option>ID Student</option>
                        <option>Borrow Date</option>
                        <option>Return Date</option>
                        <option>Expected Return Date</option>
                        <option>Status</option>
                    </select>
                </div>
                <!--end of col-->
                <div class="col">
                    <input class="form-control form-control-lg form-control-borderless" type="search"
                           placeholder="Search by choose" name="keyword">
                </div>
                <!--end of col-->
                <div class="col-auto">
                    <button class="btn btn-lg btn-success" type="submit">Search</button>
                </div>
                <!--end of col-->
            </div>
        </form>
    </div>
    <div class="card-body"><a href="view/add.php">Add new borrow</a></div>
    <div class="card-body">
        <h5 class="card-title">Borrows List</h5>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">ID Student</th>
                <th scope="col">Borrow Date</th>
                <th scope="col">Return Date</th>
                <th scope="col">Expected Return Date</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($arrayBorrow as $item): ?>
                <tr>
                    <th scope="row"><a
                                href="../detail-borrow/detail-borrow.php?id=<?php echo $item['id'] ?>"><?php echo $item['id'] ?></a>
                    </th>
                    <td><?php echo $item['student_id'] ?></td>
                    <td><?php echo $item['borrow_date'] ?></td>
                    <td><?php echo $item['return_date'] ?></td>
                    <td><?php echo $item['expected_return_date'] ?></td>
                    <td class="<?php echo $item['status'] == 'Slacking' ? 'text-warning' : ($item['status'] == 'Warning' ? 'text-danger' : 'text-success') ?>"><?php echo $item['status'] ?></td>
                    <td><a href="view/update.php?id=<?php echo $item['id'] ?>">Update</a>|<a
                                onclick="return confirm('Delete?')"
                                href="action/delete.php?id=<?php echo $item['id'] ?>">Delete</a>
                    </td>
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