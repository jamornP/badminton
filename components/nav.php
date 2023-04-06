<?php
session_start();
if(isset($_SESSION['b_login']) AND ($_SESSION['b_login']== true)){
    echo "
        <nav class='navbar navbar-dark bg-primary'>
            <div class='container-fluid'>
                <span class='navbar-brand mb-0 h1'>{$_SESSION['b_teamname']}</span>
            </div>
        </nav>
        <ul class='nav justify-content-center'>
            <li class='nav-item'>
                <a class='nav-link'  href='/badminton/pages/index.php'>home</a>
            </li>
            <li class='nav-item'>
                <a class='nav-link '  href='/badminton/pages/court.php'>สนาม</a>
            </li>
            <li class='nav-item'>
                <a class='nav-link' href='/badminton/pages/name.php'>ผู้เล่น</a>
            </li>
            <li class='nav-item'>
                <a class='nav-link' href='/badminton/pages/match.php'>แข่งขัน</a>
            </li>
            <li class='nav-item'>
                <a class='nav-link ' href='#'>คำนวน</a>
            </li>
        </ul>
    ";
}else{
    echo "
        <nav class='navbar navbar-dark bg-primary'>
            <div class='container-fluid'>
                <span class='navbar-brand mb-0 h1'>Badminton</span>
            </div>
        </nav>
    ";
}
