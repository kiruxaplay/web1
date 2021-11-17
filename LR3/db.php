<?php
global $pdo;
$pdo = new PDO('mysql:host=localhost;dbname=university', 'root', '');
session_start();