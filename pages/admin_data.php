<?php 
/* set the cache limiter to 'private' */
session_cache_limiter('private');
$cache_limiter = session_cache_limiter();

/* set the cache expire to 30 minutes */
session_cache_expire(360);
$cache_expire = session_cache_expire();
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