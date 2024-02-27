<?php 

session_start();?>
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


// echo "<pre>";
// print_r($_POST);

// 
    foreach($_POST['db_id'] as $id){
        $data['db_id']=$id;
        $data['ck']=0;
        $ck = $matchObj->updateDataBillById($data);
    }
    foreach($_POST['ck'] as $ck){
        $data['db_id'] = $ck;
        $data['ck'] = 1;
        $ck = $matchObj->updateDataBillById($data);
        if($ck){
            echo "  
                <script type='text/javascript'>
                    setTimeout(function(){location.href='/badminton/pages/cal.php'} , 0);
                </script>
            ";
        }
    }
// echo "<pre>";
// print_r($data);
?>
