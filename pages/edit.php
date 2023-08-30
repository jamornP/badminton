<?php require $_SERVER['DOCUMENT_ROOT'] . "/badminton/vendor/autoload.php"; ?>
<?php
    use App\Model\Badminton\Matchs;
    $matchObj = new Matchs;
    print_r($_REQUEST);
    if(isset($_POST['editbad'])){
        $p = "manage.php?c_id={$_POST['c_id']}&court={$_POST['court']}";
        $data['b_name']=$_POST['b_name'];
        $data['id']=$_POST['id'];
        $ck = $matchObj->updateBad($data);
        if($ck){
            echo "  
            <script type='text/javascript'>
                setTimeout(function(){location.href='{$p}'} , 1);
            </script>
        ";
        }
    }else{
        $data['id']=$_POST['id'];
        $data['m_id']=$_POST['m_id'];
        $ck = $matchObj->updateMemberById($data);
        if($ck){
            echo "  
            <script type='text/javascript'>
                setTimeout(function(){location.href='/badminton/pages/manage.php?c_id={$_POST['c_id']}&court={$_POST['court']}'} , 1);
            </script>
        ";
        }
    }
    
?>
