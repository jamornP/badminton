<?php
/* set the cache limiter to 'private' */
session_cache_limiter('private');
$cache_limiter = session_cache_limiter();

/* set the cache expire to 30 minutes */
session_cache_expire(360);
$cache_expire = session_cache_expire();
session_start();
?>
<?php require $_SERVER['DOCUMENT_ROOT']."/badminton/function/function.php"; ?>
<?php require $_SERVER['DOCUMENT_ROOT']."/badminton/vendor/autoload.php";?>
<?php
use App\Model\Badminton\Users;
$usersObj = new Users;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Badminton</title>
    <?php require $_SERVER['DOCUMENT_ROOT'] . "/badminton/components/link.php"; ?>
</head>

<body>
    <?php //require $_SERVER['DOCUMENT_ROOT'] . "/badminton/components/nav.php"; ?>
    <nav class='navbar navbar-dark bg-primary'>
        <div class='container-fluid'>
            <span class='navbar-brand mb-0 h1'>Badminton</span>
        </div>
    </nav>
    <?php require $_SERVER['DOCUMENT_ROOT'] . "/badminton/components/botton.php"; ?>
    <div class="container font-sriracha">
        <?php 
        if(isset($_GET['err'])){
            echo "
                <div class='alert alert-danger mt-2' role='alert'>
                    <h4> {$_GET['err']}</h4>
                </div>
            ";
        }
        if(isset($_GET['success'])){
            echo "
                <div class='alert alert-success mt-2' role='alert'>
                    <h4> {$_GET['success']}</h4>
                </div>
            ";
        }
        ?>
        <div class="card mt-5">
            <div class="card-body">
                <form action="index.php" method="POST">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Username</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" name="u_username" autofocus required>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <input type="password" class="form-control" id="exampleInputPassword1" name="u_password" required>
                    </div>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <button type="submit" class="btn btn-primary" name="submit">เข้าสู่ระบบ</button>
                        <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                            ลงทะเบียน
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="index.php" method="POST">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">ลงทะเบียน</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">

                            <div class="mb-2">
                                <label for="u_username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" name="u_username" required>
                            </div>
                            <div class="mb-2">
                                <label for="u_password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="u_password" name="u_password" required>
                            </div>
                            <div class="mb-2">
                                <label for="u_name" class="form-label">ชื่อ-สกุล</label>
                                <input type="text" class="form-control" id="u_name" name="u_name" required>
                            </div>
                            <div class="mb-2">
                                <label for="u_tel" class="form-label">เบอร์ติดต่อ</label>
                                <input type="text" class="form-control" id="u_tel" name="u_tel" required>
                            </div>
                            <div class="mb-2">
                                <label for="u_team" class="form-label">ชื่อก้วน</label>
                                <input type="text" class="form-control" id="u_team" name="u_team" required>
                            </div>
                            <div class="mb-2">
                                <label for="line" class="form-label">line token  ไม่มีให้ว่างไว้ครับ <br>วิธีทำ( <a href='https://www.youtube.com/watch?v=16dhTsmvkzg'> https://www.youtube.com/watch?v=16dhTsmvkzg</a>)</label>
                                <input type="text" class="form-control" id="line" name="line">
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" name="register">บันทึก</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php
    if (isset($_POST['submit'])) {
        unset($_POST['submit']);
        
        // print_r($_POST);
        $ck = $usersObj->checkUsers($_POST);
        // echo "<br>".$ck;
        if ($ck) {
           
            echo "  
                <script type='text/javascript'>
                    setTimeout(function(){location.href='/badminton/pages'} , 1);
                </script>
            ";
        }
    }
    if (isset($_POST['register'])) {
        unset($_POST['register']);
        if($_POST['line']==""){
            $_POST['line']="NEBJNOEsOZKaHi0CtH5DxutkPV9HNGinPgxZTEsrY1W";
        }
        // print_r($_POST);
        $ck = $usersObj->addUsers($_POST);
        // $ck = true;
        if ($ck) {
            $success="ลงทะเบียนสำเร็จ กรุณาเข้าสู่ระบบด้วย Username ที่ลงทะเบียนไว้";
            echo "  
                <script type='text/javascript'>
                    setTimeout(function(){location.href='/badminton/index.php?success={$success}'} , 1);
                </script>
            ";
        }else{
            $err = "Username นี้มีอยู่แล้ว กรุณาใช้ Username ใหม่";
            echo "  
                <script type='text/javascript'>
                    setTimeout(function(){location.href='/badminton/index.php?err={$err}'} , 1);
                </script>
        ";
        }
    }
    ?>
    <?php require $_SERVER['DOCUMENT_ROOT'] . "/badminton/components/script.php"; ?>
    <script>
    $('#staticBackdrop').on('shown.bs.modal', function () {
        $('#username').focus()
    });
    
    </script>
</body>

</html>