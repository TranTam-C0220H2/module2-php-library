<?php
session_start();
if (!isset($_SESSION['login'])) {
    header('Location: ../../index.php');
}

include '../../database/ConnectDatabase.php';
include '../class/StudentManager.php';

$studentManager = new StudentManager();

if (isset($_REQUEST['id'])) {
    $id = $_REQUEST['id'];
    $studentById = $studentManager->getAllById($id);
    $_SESSION['idOfUpdate'] = $id;
    $_SESSION['name'] = $studentById['name'];
    $_SESSION['email'] = $studentById['email'];
    $_SESSION['phone'] = $studentById['phone'];
    $_SESSION['birthDay'] = $studentById['birthday'];
    $_SESSION['address'] = $studentById['address'];
    $_SESSION['imageById'] = $studentById['image'];
    $_SESSION['note'] = $studentById['note'];
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
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh"
          crossorigin="anonymous">

    <title>Update Student</title>
</head>
<body>
<div class="container">
    <h3>Update Student</h3>
    <form action="../action/change.php?id=<?php echo isset($_SESSION['idOfUpdate']) ? $_SESSION['idOfUpdate'] : '' ?>"
          method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label>*Image</label>
            <input type="file" class="form-control" name="image">
            <div class="col-md-9">
                <?php
                if (isset($_SESSION['checkImage']) && isset($_SESSION['imageName']) && isset($_SESSION['imageById']) && $_SESSION['checkImage'] == "Lỗi: Image is empty" && ($_SESSION['checkImage'] != 'Upload file thành công' && ($_SESSION['checkImage'] != 'Lỗi : File đã tồn tại.' || $_SESSION['imageName'] != $_SESSION['imageById']))) {
                    echo $_SESSION['checkImage'];
                    unset($_SESSION['checkImage']);
                    unset($_SESSION['imageName']);
                } else
                ?>
            </div>
        </div>
        <div class="form-group">
            <label>*Name</label>
            <input type="text" class="form-control" name="name"
                   value="<?php echo isset($_SESSION['name']) ? $_SESSION['name'] : '' ?>">
            <div class="col-md-9">
                <?php
                if (isset($_SESSION['name'])) {
                    unset($_SESSION['name']);
                }
                ?>
            </div>
        </div>
        <div class="form-group">
            <label>*Email</label>
            <input type="text" class="form-control" name="email"
                   value="<?php echo isset($_SESSION['email']) ? $_SESSION['email'] : '' ?>">
            <?php
            if (isset($_SESSION['email'])) {
                unset($_SESSION['email']);
            }
            ?>
        </div>
        <div class="form-group">
            <label>*Phone</label>
            <input type="text" class="form-control" name="phone"
                   value="<?php echo isset($_SESSION['phone']) ? $_SESSION['phone'] : '' ?>">
            <?php
            if (isset($_SESSION['phone'])) {
                unset($_SESSION['phone']);
            }
            ?>
        </div>
        <div class="form-group">
            <label>Birth Day</label>
            <input type="date" class="form-control" name="birthDay"
                   value="<?php echo isset($_SESSION['birthDay']) ? $_SESSION['birthDay'] : '' ?>">
            <?php
            if (isset($_SESSION['birthDay'])) {
                unset($_SESSION['birthDay']);
            }
            ?>
        </div>
        <div class="form-group">
            <label>Address</label>
            <input type="text" class="form-control" name="address"
                   value="<?php echo isset($_SESSION['address']) ? $_SESSION['address'] : '' ?>">
            <?php
            if (isset($_SESSION['address'])) {
                unset($_SESSION['address']);
            }
            ?>
        </div>
        <div class="form-group">
            <label>*Status</label>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="status" value="Clean" checked>
                <label class="form-check-label">
                    Clean
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="status" value="Borrow">
                <label class="form-check-label">
                    Borrow
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="status" value="In Debt">
                <label class="form-check-label">
                    In Debt
                </label>
            </div>
        </div>
        <div class="form-group">
            <label>Note</label>
            <input type="text" class="form-control" name="note"
                   value="<?php echo isset($_SESSION['note']) ? $_SESSION['note'] : '' ?>">
            <div class="col-md-9">
                <?php
                if (isset($_SESSION['note'])) {
                    unset($_SESSION['note']);
                }
                ?>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-9 col-sm-offset-3">
                <span class="help-block">*Required fields</span>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
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
