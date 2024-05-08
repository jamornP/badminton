
<?php require $_SERVER['DOCUMENT_ROOT'] . "/badminton/function/function.php"; ?>
<?php require $_SERVER['DOCUMENT_ROOT'] . "/badminton/vendor/autoload.php"; ?>
<?php
session_start();
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

if(isset($_GET['del']) && $_GET['del']==0){
    echo "
        <script type='text/javascript'>
            let isExecuted = confirm('คุณแน่ใจว่าต้องการลบข้อมูลรายการนี้ ?');
            if (isExecuted == true) {
                location.href='del_all.php?del=1&date={$_GET['date']}';
            } else {
                location.href='/badminton/pages/index.php';
            }
            console.log(isExecuted);
        </script>
    ";
}
if(isset($_GET['del']) && $_GET['del']==1){
    if(isset($_GET['date'])){
        echo "ระบบกำลังดำเนินการ กรุณารอสักครู่...";
        //echo $_GET['date'];
        //echo "<br>".$_SESSION['b_u_id'];
        $sql = "SELECT * FROM `tb_match` WHERE ma_date = '{$_GET['date']}' AND u_id = {$_SESSION['b_u_id']}";
        $dataMatch = $matchObj->getSQL($sql);
        if(count($dataMatch)>0){
            foreach($dataMatch as $m){
                // //echo "<br> m=>{$m['dm_id']} b=>{$m['b_id']}";
                $sql1 = "DELETE FROM `tb_data_match` WHERE dm_id = '{$m['dm_id']}'";
               // echo "<br>".$sql1;
                $ck = $matchObj->getSQL($sql1);
                $sql2 = "DELETE FROM `tb_bad` WHERE b_id = '{$m['b_id']}'";
               // echo "<br>".$sql2;
                $ck = $matchObj->getSQL($sql2);
            }
            $sql3 = "DELETE FROM `tb_match` WHERE ma_date = '{$_GET['date']}' AND u_id = {$_SESSION['b_u_id']}";
           // echo "<br>".$sql3;
            $ck = $matchObj->getSQL($sql3);
        }
        $sql4 = "DELETE FROM `tb_member` WHERE m_date = '{$_GET['date']}' AND u_id = {$_SESSION['b_u_id']}";
       // echo "<br>".$sql4;
        $ck = $matchObj->getSQL($sql4);
        $sql6 = "SELECT * FROM `tb_bill` WHERE bi_date = '{$_GET['date']}' AND u_id = {$_SESSION['b_u_id']}";
        $dataBill = $matchObj->getSQL($sql6);
        if(count($dataBill)>0){
            foreach($dataBill as $b){
                $sql5 = "DELETE FROM `tb_data_bill` WHERE bi_id = '{$b['bi_id']}'";
               // echo "<br>".$sql5;
                $ck = $matchObj->getSQL($sql5);
            }
            $sql6 = "DELETE FROM `tb_bill` WHERE bi_date = '{$_GET['date']}' AND u_id = {$_SESSION['b_u_id']}";
           // echo "<br>".$sql6;
            $ck = $matchObj->getSQL($sql6);
        }
        $sql7 = "DELETE FROM `tb_date` WHERE d_date = '{$_GET['date']}' AND u_id = {$_SESSION['b_u_id']}";
       // echo "<br>".$sql7;
        $ck = $matchObj->getSQL($sql7);
       echo "  
            <script type='text/javascript'>
                setTimeout(function(){location.href='/badminton/pages/index.php'} , 1000);
            </script>
        ";
    }
}
?>