<?php
/* set the cache limiter to 'private' */
session_cache_limiter('private');
$cache_limiter = session_cache_limiter();

/* set the cache expire to 30 minutes */
session_cache_expire(360);
$cache_expire = session_cache_expire();
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