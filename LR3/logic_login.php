<?php
require_once 'db.php';

global $pdo;
$data = $_POST;
$userdata = [];
if (isset($data['loginTo'])) {

    $errors = array();
    if (!isset($data['login'])) {
        $errors[] = 'Введите логин!';
    } else {
        $userdata['login'] = $data['login'];
    }

    if (!isset($data['password'])) {
        $errors[] = 'Введите пароль!';
    } else {
        $userdata['password'] = $data['password'];
    }

    if (empty($errors)) {
        $sql_count = "SELECT * FROM `USERS` WHERE `login` = ?";
        $query = $pdo->prepare($sql_count);
        $query->execute([$userdata['login']]);
        $query_array = $query->fetch(PDO::FETCH_ASSOC);
        if (!empty($query_array)) {
            if (password_verify($userdata['password'], $query_array['password'])) {
                session_start();
                $_SESSION['loggedUser'] = $userdata['login'];
                header('Location: index.php');
                exit;
            }
            else{
                $errors[] = 'Неверный пароль!';
            }
        }
        else{
            $errors[] = 'Такого логина не существует!';
        }
    }

}
