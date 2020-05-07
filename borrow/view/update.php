<?php
session_start();
if (!isset($_SESSION['login'])) {
    header('Location: ../../index.php');
}
include '../../database/ConnectDatabase.php';
include '../class/BorrowManager.php';

$borrowManager = new BorrowManager();

if (isset($_REQUEST['id'])) {
    $id = $_REQUEST['id'];
    $_SESSION['idOfUpdate'] = $id;
    $borrowById = $borrowManager->getAllById($id);
    $_SESSION['idStudent'] = $borrowById['student_id'];
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

    <title>Update Borrow</title>
</head>
<body>
<div class="card">
    <div class="card-header">
        <ul class="nav nav-pills card-header-pills">
            <li class="nav-item">
                <a class="nav-link" href="../../category/categories.php">Categories</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../../book/books.php">Books</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../../student/students.php">Students</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="../borrows.php">Borrows</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../../user/action/logout.php">Logout</a>
            </li>
        </ul>
    </div>
    <div class="card-body">
        <h4>Update Borrow</h4>
        <form action="../action/change.php?id=<?php echo isset($_SESSION['idOfUpdate'])?$_SESSION['idOfUpdate']:'' ?>" method="post">
            <div class="form-group">
                <label>*ID Student</label>
                <input type="number" class="form-control" name="idStudent"
                       value="<?php echo isset($_SESSION['idStudent']) ? $_SESSION['idStudent'] : '' ?>">
                <div class="col-md-9">
                    <?php
                    if (!isset($_SESSION['idStudent'])) {
                        echo 'CategoryID is already exist';
                    } else {
                        unset($_SESSION['idStudent']);
                    }
                    ?>
                </div>
            </div>
            <div class="form-group">
                <label>Expected Return Date</label>
                <input type="date" class="form-control" name="expectedReturnDate">
                <div class="col-md-9">
                    <?php
                    if (isset($_SESSION['differentDate'])) {
                        echo 'Expected Return Date is invalid';
                        unset($_SESSION['differentDate']);
                    }
                    ?>
                </div>
            </div>
            <div class="form-group">
                <label>*Status</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="status" value="Slacking" checked>
                    <label class="form-check-label">
                        Slacking
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="status" value="Done">
                    <label class="form-check-label">
                        Done
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="status" value="Warning">
                    <label class="form-check-label">
                        Warning
                    </label>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-9 col-sm-offset-3">
                    <span class="help-block">*Required fields</span>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Add</button>
        </form>
    </div>
</div>
<?php unset($_SESSION['idOfUpdate']) ?>
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
