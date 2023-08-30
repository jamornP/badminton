<?php session_start();?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Badminton</title>
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <?php require $_SERVER['DOCUMENT_ROOT'] . "/badminton/components/link.php"; ?>
    <style>
        .sbtn-remove,
        .nbtn-remove {
            display: none;
        }
    </style>


</head>

<body class="font-sriracha">
    <?php require $_SERVER['DOCUMENT_ROOT'] . "/badminton/components/nav.php"; ?>
    <?php require $_SERVER['DOCUMENT_ROOT'] . "/badminton/components/botton.php"; ?>
    <?php
        if(isset($_POST['add'])){
            unset($_POST['add']);
            $_POST['u_id']=$_SESSION['b_u_id'];
            // print_r($_POST);
            $ckadd = $dateObj->addDate($_POST);
            if ($ckadd) {
                echo "  
                    <script type='text/javascript'>
                        setTimeout(function(){location.href='/badminton/pages/index.php'} , 1000);
                    </script>
                ";
            }
        }

    ?>
    <?php if($_SESSION['admin']){?>
        <div class="container mt-5">
            <div class="card">
                <h5 class="card-header">User</h5>
                <div class="card-body">
                    <p class="">ข้อมูลก้วน</p>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">ก้วน</th>
                                <th scope="col">ดำเนินการ</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $dataU = $usersObj->getUsers();
                                // print_r($dataU);
                                $i =0;
                                foreach($dataU as $d){
                                    $i++;
                                    // $dateshow=datethai($d['d_date']);
                                    echo "
                                        <tr>
                                            <th scope='row'>{$i}</th>
                                            <td>{$d['u_team']}</td>
                                            <td><a href='/badminton/pages/admin_data.php?u_id={$d['u_id']}'>ดำเนินการต่อ</a></td>
                                        </tr>
                                    ";
                                }
                            ?>
                            

                        </tbody>
                    </table>
                    <hr>
                    
                
                </div>
            </div>

        </div>
    <?php }?>
    <?php require $_SERVER['DOCUMENT_ROOT'] . "/badminton/components/script.php"; ?>
    <script type="text/javascript">
        $(function() {
            $("#datepicker").datepicker({
                language: 'th-en',
                format: 'yyyy-mm-dd',
                minDate: 0,
                autoclose: true

            });
            $("#datepicker2").datepicker({
                language: 'th-en',
                format: 'yyyy-mm-dd',
                autoclose: true
            });

        });
    </script>
    
</body>

</html>