<?php session_start();?>
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


if(isset($_GET['del'])){
    $p = "manage.php";
    echo "
        <script type='text/javascript'>
            let isExecuted = confirm('คุณแน่ใจว่าต้องการลบข้อมูลรายการนี้ ?');
            if (isExecuted == true) {
                location.href='delmatch.php?delok=delok&b_id={$_GET['b_id']}&dm_id={$_GET['dm_id']}&ma_id={$_GET['ma_id']}';
            } else {
                location.href='{$p}';
            }
            console.log(isExecuted);
        </script>
    ";
    
}
if($_GET['delok']=='delok'){
    // print_r($_GET);
    $ckbad = $matchObj->delBad($_GET['b_id']);
    if($ckbad){
        $ckData = $matchObj->delDataMatch($_GET['dm_id']);
        if($ckData){
            $ckMatch = $matchObj->delMatch($_GET['ma_id']);
            if($ckMatch){
                // $p = "manage.php?c_id={$_GET['c_id']}&court={$_GET['court']}";
                echo "  
                    <script type='text/javascript'>
                        setTimeout(function(){location.href='manage.php'} , 1);
                    </script>
                ";
            }
        }
    }
}

?>