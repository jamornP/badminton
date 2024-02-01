<?php 
ini_set('session.gc_maxlifetime', 86400);
session_start(); ?>
<?php require $_SERVER['DOCUMENT_ROOT'] . "/badminton/function/function.php"; ?>
<?php require $_SERVER['DOCUMENT_ROOT'] . "/badminton/vendor/autoload.php"; ?>
<?php

use App\Model\Badminton\Users;

$usersObj = new Users;

use App\Model\Badminton\Court;

$courtObj = new Court;

use App\Model\Badminton\Member;

$memberObj = new Member;

use App\Model\Badminton\Matchs;

$matchObj = new Matchs;

use App\Model\Badminton\Dates;

$dateObj = new Dates;
?>
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
    <?php //require $_SERVER['DOCUMENT_ROOT'] . "/badminton/components/nav.php"; ?>
    <?php //require $_SERVER['DOCUMENT_ROOT'] . "/badminton/components/botton.php"; ?>
    <?php
    // echo "<pre>";
    // print_r($_GET);
    // echo "</pre>";
    ?>
    <div class="container mt-5">
        <div class="card">
            <h5 class="card-header">
                <?php
                if (isset($_GET['bi_id'])) {
                    $bill = $matchObj->getBillById("data",$_GET['bi_id']);
                    $da = datethai($bill['bi_date']);
                    echo "บิลวันที่ " . $da;
                }
                ?>
            </h5>
            <div class="card-body">
                <p class="">ข้อมูลบิล</p>
                <?php
                     echo "
                     <P>ค่าสนาม {$bill['bi_court']} บาท เล่นไป {$bill['bi_game']} เกมส์</P>
                     <P>ค่าลูกละ {$bill['bad_one']} บาท ใช้ไป {$bill['bad_count']} ลูก เป็นเงิน {$bill['bad_sum']} บาท</P>
                     ";
                     echo "
                     <a href='show_member.php?bi_date={$bill['bi_date']}' class='btn btn-success'>แสดงผู้เล่นแต่ละเกมส์</a>
                     ";
                ?>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">ชื่อ</th>
                            <th scope="col">ค่าสนาม</th>
                            <th scope="col">ค่าลูก</th>
                            <th scope="col">รวม</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        $data = $matchObj->getDataBillById($bill['bi_id']);
                        $i=0;
                        $sum_c = 0;
                        $sum_b = 0;
                        $sum_s = 0;
                        foreach($data as $b){
                            $i++;
                            $sum_c += ceil($b['court_cal']);
                            $sum_b += $b['bad_cal'];
                            $sum_s += ceil($b['bi_sum']);
                            $ccc = ceil($b['court_cal']);
                            $sss = ceil($b['bi_sum']);
                            echo "
                                <tr>
                                    <td>{$i}</td>
                                    <td>{$b['m_name']}</td>
                                    <td>{$ccc}</td>
                                    <td>{$b['bad_cal']}({$b['bad_m']})</td>
                                    <td>{$sss}</td>
                                </tr>
                            ";
                        }
                        // $sum_t = ceil($sum_s);
                        echo "
                            <tr>
                                <th></th>
                                <th>รวม</th>
                                <th>{$sum_c}</th>
                                <th>{$sum_b}</th>
                                <th>{$sum_s}</th>
                            </tr>
                        ";
                    ?>
                    </tbody>
                </table>
                <hr>

            </div>
        </div>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
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