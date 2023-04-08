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
    <div class="container mt-5">
        <div class="card">
            <h5 class="card-header">ขั้นตอนที่ 1</h5>
            <div class="card-body">
            <h5 class="card-header">ข้อมูลวันที่</h5>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">วันที่</th>
                            <th scope="col">ดำเนินการ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $dataD = $dateObj->getDateByUser($_SESSION['b_u_id']);
                            // print_r($dataD);
                            $i =0;
                            foreach($dataD as $d){
                                $i++;
                                $dateshow=datethai($d['d_date']);
                                echo "
                                    <tr>
                                        <th scope='row'>{$i}</th>
                                        <td>{$dateshow}</td>
                                        <td><a href='/badminton/pages/court.php?date={$d['d_date']}'>ดำเนินการต่อ</a></td>
                                    </tr>
                                ";
                            }
                        ?>
                        

                    </tbody>
                </table>
                <hr>
                <form action="" method="POST">
                    <div class="d-flex mb-2">
                        <div class="">
                        <input type="text" id="datepicker" class="form-control" name="d_date" required autocomplete="off" value="">
                        </div>
                        <button type="submit" class="btn btn-success mx-2 text-white" name="add">เพิ่ม</button>
                    </div>
                </form>
            
        </div>

    </div>

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