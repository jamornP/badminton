<?php
ini_set('session.gc_maxlifetime', 86400);
session_start();

$_SESSION=[];

header("location:/badminton");

?>