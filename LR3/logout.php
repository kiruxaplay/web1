<?php
require_once 'db.php';
unset($_SESSION['loggedUser']);
header('Location: login.php');
exit;
