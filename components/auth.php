<?php
    if($_SESSION['b_login']){

    }else{
        echo "  
            <script type='text/javascript'>
                setTimeout(function(){location.href='/badminton'} , 1000);
            </script>
        ";
    }
?>