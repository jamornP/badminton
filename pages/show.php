<?php 

session_start(); ?>
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
    // echo "<pre>";
    // print_r($_GET);
    // echo "</pre>";
    ?>
    <div class="container mt-5">
        <div class="card">
            <h5 class="card-header">
                <?php
                if (isset($_GET['date'])) {
                    $bill = $matchObj->getBillByDate("data",$_GET['date'],$_GET['u_id']);
                    $da = datethai($_GET['date']);
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
                            $sum_c += $b['court_cal'];
                            $sum_b += $b['bad_cal'];
                            $sum_s += $b['bi_sum'];
                            echo "
                                <tr>
                                    <td>{$i}</td>
                                    <td>{$b['m_name']}</td>
                                    <td>{$b['court_cal']}</td>
                                    <td>{$b['bad_cal']}({$b['bad_m']})</td>
                                    <td>{$b['bi_sum']}</td>
                                </tr>
                            ";
                        }
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