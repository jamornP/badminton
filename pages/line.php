<?php
ini_set('session.gc_maxlifetime', 86400);
session_start();?>
<?php require $_SERVER['DOCUMENT_ROOT'] . "/badminton/function/function.php"; ?>
<?php
if(isset($_POST['line'])){
    echo $_POST['dataLine'];
    SentLineBasic($_SESSION['b_line'],$_POST['dataLine']);
    echo "  
        <script type='text/javascript'>
            setTimeout(function(){location.href='/badminton/pages/index.php'} , 1);
        </script>
    ";
}
   
?>