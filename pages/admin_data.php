<?php 
session_start();
if(isset($_GET['u_id'])){
    $_SESSION['b_u_id'] = $_GET['u_id'];
    echo "  
            <script type='text/javascript'>
                setTimeout(function(){location.href='/badminton/pages'} , 1);
            </script>
        ";    
}else{
    
}

?>