<?php
    session_start();
    if(isset($_SESSION['b_login'])){
        if(!$_SESSION['b_login']){
            echo "  
                <script type='text/javascript'>
                    setTimeout(function(){location.href='/badminton/index.php'} , 1);
                </script>
            ";
            exit;
        }
    }else{
        echo "  
                <script type='text/javascript'>
                    setTimeout(function(){location.href='/badminton/index.php'} , 1);
                </script>
            ";
            exit;
    }
?>