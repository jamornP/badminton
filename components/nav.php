<?php
session_start();
?>
<?php require $_SERVER['DOCUMENT_ROOT']."/badminton/components/auth.php"; ?>
<?php require $_SERVER['DOCUMENT_ROOT']."/badminton/function/function.php"; ?>
<?php require $_SERVER['DOCUMENT_ROOT']."/badminton/vendor/autoload.php";?>
<?php
use App\Model\Badminton\Users;
$usersObj = new Users;
use App\Model\Badminton\Court;
$courtObj = new Court;
use App\Model\Badminton\Member;
$memberObj = new Member;
use App\Model\Badminton\Matchs;
$matchObj = new Matchs;
$_SESSION['date']=date("Y-m-d");

if(isset($_SESSION['b_login']) AND ($_SESSION['b_login']== true)){
    echo "
        <nav class='navbar navbar-dark bg-primary'>
            <div class='container-fluid'>
                <span class='navbar-brand mb-0 h1'>{$_SESSION['b_u_team']}</span>
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
                <a class='nav-link' href='/badminton/pages/member.php'>ผู้เล่น</a>
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
