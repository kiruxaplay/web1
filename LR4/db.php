<?php
global $pdo;
function dbConnect(){
//    session_start();
    $pdo = new PDO('mysql:host=localhost;dbname=university;charset=utf8;', 'root', '');
    return $pdo;
}