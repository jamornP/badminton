<?php require $_SERVER['DOCUMENT_ROOT'] . "/badminton/vendor/autoload.php"; ?>
<?php
/* set the cache limiter to 'private' */
session_cache_limiter('private');
$cache_limiter = session_cache_limiter();

/* set the cache expire to 30 minutes */
session_cache_expire(360);
$cache_expire = session_cache_expire();
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
            if($_POST['b_name']!="-"){
                $ckB = $matchObj->addBad($dataB);
            }else{
                $ckB = true;
            }
            if($ckB){
            echo "  
                <script type='text/javascript'>
                    setTimeout(function(){location.href='/badminton/pages/manage.php'} , 1);
                </script>
            ";
            }
        
        }
    

?>