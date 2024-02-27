
<?php //require $_SERVER['DOCUMENT_ROOT'] . "/badminton/components/auth.php"; ?>
<?php require $_SERVER['DOCUMENT_ROOT'] . "/badminton/function/function.php"; ?>
<?php require $_SERVER['DOCUMENT_ROOT'] . "/badminton/vendor/autoload.php"; ?>
<?php

use App\Model\Badminton\Users;

$usersObj = new Users;

use App\Model\Badminton\Court;

$courtObj = new Court;

use App\Model\Badminton\Member;

$memberObj = new Member;

use App\Model\Badminton\Matchs;

$matchObj = new Matchs;

use App\Model\Badminton\Dates;

$dateObj = new Dates;

if (isset($_SESSION['b_login']) and ($_SESSION['b_login'] == true)) {
    if (isset($_SESSION['date']) AND $_SESSION['date']!="") {
        if($_SESSION['b_line']!=""){
            $token = "Yse";
        }else{
            $token = "No";
        }
        echo "
        <nav class='navbar navbar-dark bg-primary'>
            <div class='container-fluid'>
                <span class='navbar-brand mb-0 h1'>{$_SESSION['b_u_team']} ( token = {$token} )</span>
            </div>
        </nav>
        <ul class='nav justify-content-center'>
        
            <li class='nav-item'>
                <a class='nav-link'  href='/badminton/pages/index.php'>1.home</a>
            </li>
           
            <li class='nav-item'>
                <a class='nav-link' href='/badminton/pages/member.php?date={$_SESSION['date']}'>2.ผู้เล่น</a>
            </li>
            <li class='nav-item'>
                <a class='nav-link' href='/badminton/pages/manage.php'>3.จัดแมท</a>
            </li>
            <li class='nav-item'>
                <a class='nav-link ' href='/badminton/pages/cal.php'>4.คำนวน</a>
            </li>
            ";
            //  <li class='nav-item'>
            // <a class='nav-link ' href='/badminton/pages/court.php?date={$_SESSION['date']}'>2.สนาม</a>
            // </li>
        if(isset($_SESSION['admin']) AND $_SESSION['admin']==true){
            echo "
            <li class='nav-item'>
                <a class='nav-link'  href='/badminton/pages/admin.php'>Admin</a>
            </li>
            ";
        }
        echo "
        </ul>
    ";
    } else {
        echo "
        <nav class='navbar navbar-dark bg-primary'>
            <div class='container-fluid'>
                <span class='navbar-brand mb-0 h1'>{$_SESSION['b_u_team']}</span>
            </div>
        </nav>
        <ul class='nav justify-content-center'>
        ";
        if(isset($_SESSION['admin']) AND $_SESSION['admin']==true){
            echo "
            <li class='nav-item'>
                <a class='nav-link'  href='/badminton/pages/admin.php'>Admin</a>
            </li>
            ";
        }
        echo "
            <li class='nav-item'>
                <a class='nav-link'  href='/badminton/pages/index.php'>1.home</a>
            </li>
            </ul>
            ";
    }
} else {
    echo "
        <nav class='navbar navbar-dark bg-primary'>
            <div class='container-fluid'>
                <span class='navbar-brand mb-0 h1'>Badminton</span>
            </div>
        </nav>
    ";
}
