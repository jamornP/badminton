<?php require $_SERVER['DOCUMENT_ROOT'] . "/badminton/vendor/autoload.php"; ?>
<?php

session_start();
use App\Model\Badminton\Matchs;
$matchObj = new Matchs;
    if(isset($_GET['del'])){
        echo "
            <script type='text/javascript'>
                let isExecuted = confirm('คุณแน่ใจว่าต้องการลบข้อมูลรายการนี้ ?');
                if (isExecuted == true) {
                    location.href='del.php?delok=delok&action=member&m_id={$_GET['m_id']}';
                } else {
                    location.href='/badminton/pages/member.php';
                }
                console.log(isExecuted);
            </script>
        ";
    }
    if(isset($_GET['action'])){
        print_r($_GET);
        switch ($_GET['action']){
            case  "court" :
              
  
                $sql = "DELETE FROM tb_court WHERE c_id ={$_GET['c_id']}";
                $ck = $matchObj->delSQL($sql);
                if($ck){
                    echo "  
                    <script type='text/javascript'>
                        setTimeout(function(){location.href='/badminton/pages/court.php?date={$_SESSION['date']}'} , 1);
                    </script>
                ";
                }else{
                    echo "  
                    <script type='text/javascript'>
                        setTimeout(function(){location.href='/badminton/pages/court.php?date={$_SESSION['date']}'} , 1);
                    </script>
                ";
                }
                break;
            case  "member" :
                    $sql = "DELETE FROM tb_member WHERE m_id ={$_GET['m_id']}";
                    $ck = $matchObj->delSQL($sql);
                    if($ck){
                        echo "  
                        <script type='text/javascript'>
                            setTimeout(function(){location.href='/badminton/pages/member.php'} , 1);
                        </script>
                    ";
                    }else{
                        echo "  
                        <script type='text/javascript'>
                            setTimeout(function(){location.href='/badminton/pages/member.php'} , 1);
                        </script>
                    ";
                    }
                
                
                break;
            
        }
    }
?>