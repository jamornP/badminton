<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Badminton</title>
    <?php require $_SERVER['DOCUMENT_ROOT']."/badminton/components/link.php";?>
</head>
<body>
    <?php require $_SERVER['DOCUMENT_ROOT']."/badminton/components/nav.php";?>
    <?php require $_SERVER['DOCUMENT_ROOT']."/badminton/components/botton.php";?>
    <div class="container font-sriracha">
        <div class="card mt-5">
            <div class="card-body">
                <form action="index.php" method="POST">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Username</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" name="username" autofocus required>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <input type="password" class="form-control" id="exampleInputPassword1" name="password" required>
                    </div>
                
                    <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                </form>
            </div>
        </div>
    </div>
    <?php
    if(isset($_POST['submit'])){
        $ck = true;
        if($ck){
                $_SESSION['b_teamname']="Dukdik Badminton";
                $_SESSION['b_login']=true;
            echo "  
                <script type='text/javascript'>
                    setTimeout(function(){location.href='/badminton/pages'} , 1);
                </script>
            ";
        }
        
    }
    ?>
    <?php require $_SERVER['DOCUMENT_ROOT']."/badminton/components/script.php";?>
</body>
</html>