<?php require $_SERVER['DOCUMENT_ROOT'] . "/badminton/vendor/autoload.php"; ?>
<?php
session_start();
use App\Model\Badminton\Matchs;
$matchObj = new Matchs;
    
        if(isset($_POST['add_bad'])){
            print_r($_POST);
            $num = $matchObj->countBad($_POST['b_id']);
            $dataB['b_id']=$_POST['b_id'];
            $dataB['b_num']=$num;
            $dataB['b_name']=$_POST['b_name'];
            echo "<br>";
            print_r($dataB);
            $ckB = $matchObj->addBad($dataB);
            if($ckB){
            echo "  
                <script type='text/javascript'>
                    setTimeout(function(){location.href='/badminton/pages/manage.php?c_id={$_POST['c_id']}&court={$_POST['court']}'} , 1);
                </script>
            ";
            }
        }
    

?>