<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Badminton</title>
    <?php require $_SERVER['DOCUMENT_ROOT']."/badminton/components/link.php";?>
</head>
<body class="font-sriracha">
    <?php require $_SERVER['DOCUMENT_ROOT']."/badminton/components/nav.php";?>
    <?php require $_SERVER['DOCUMENT_ROOT']."/badminton/components/auth.php";?>
    <?php require $_SERVER['DOCUMENT_ROOT']."/badminton/components/botton.php";?>
    <?php require $_SERVER['DOCUMENT_ROOT']."/badminton/function/function.php";?>
    <div class="container mt-5">
        <div class="card">
            <h5 class="card-header">Featured</h5>
            <div class="card-body">
                <h5 class="card-title">Special title treatment</h5>
                <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                <a href="#" class="btn btn-primary">Go somewhere</a>
            </div>
        </div>
    </div>
    
    <?php require $_SERVER['DOCUMENT_ROOT']."/badminton/components/script.php";?>
</body>
</html>