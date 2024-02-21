<?php 
/* set the cache limiter to 'private' */
session_cache_limiter('private');
$cache_limiter = session_cache_limiter();

/* set the cache expire to 30 minutes */
session_cache_expire(360);
$cache_expire = session_cache_expire();
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
   
    <div class="container mt-5">
        <div class="card">
            <h5 class="card-header">
            <?php 
            $da = datethai($_GET['bi_date']);
            echo "ก้วน ".$_SESSION['b_u_team'];
            // print_r($_SESSION);
                          
            ?>
            </h5>
            <div class="card-body">
                <?php echo " วันที่ " . $da; ?>
                <table class="table fs-12">
                    <thead>
                        <tr class='text-center'>
                            <th scope="col">เกมส์</th>
                            <th class="text-center">ทีม 1</th>
                            <th scope="col">VS</th>
                            <th scope="col">ทีม 2</th>
                            <th scope="col">ลูกแบดที่</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $matchs = $matchObj->getCourtMatch($_GET['bi_date'],$_SESSION['b_u_id']);
                            if(count($matchs)>0){  
                                // print_r($matchs);
                                $i = 0;
                                foreach($matchs as $match){
                                    $i++;
                                    $dataMembers = $matchObj->getMatchDataById($match['dm_id']);
                                    $dataBad = $matchObj->getBadById($match['b_id']);
                                    // echo "<pre>";
                                    // print_r($dataMembers);
                                    // echo "<br>";
                                    // foreach($dataMembers as $m){
                                    //     print_r($m);
                                    // print_r($dataBad);
                                        echo "
                                            <tr class='text-center'>
                                                <td>{$i}</td>
                                                <td>{$dataMembers[0]['m_name']} + {$dataMembers[1]['m_name']}</td>
                                                <td>VS</td>
                                                <td>{$dataMembers[2]['m_name']} + {$dataMembers[3]['m_name']}</td>
                                                <td>{$dataBad[0]['b_name']}</td>
                                            </tr>
                                        ";
                                    // }
                                }     
                            }      
                        ?>
                    </tbody>
                </table>
                
                

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