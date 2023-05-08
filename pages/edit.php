<?php require $_SERVER['DOCUMENT_ROOT'] . "/badminton/vendor/autoload.php"; ?>
<?php
    use App\Model\Badminton\Matchs;
    $matchObj = new Matchs;
    print_r($_REQUEST);
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
    
?>
