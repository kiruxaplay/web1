<?php
require_once 'db.php';
require_once 'logic.php';
global $pdo;

$pdo = new PDO('mysql:host=localhost;dbname=university', 'root', '');
$data = $_POST;
$userdata = [];
if (isset($data['signUpTo'])) {
    $errors = array();

    if (!isset($data['login'])) {
        $errors[] = 'Введите логин!';
    } else {
        if (checkEmail($data['login'])){
            $userdata['login'] = $data['login'];
        }
        else{
            $errors[] = 'Неверный формат почты!';
        }

    }
    if (!isset($data['full_name'])) {
        $errors[] = 'Введите ФИО!';
    } else {
        $userdata['full_name'] = $data['full_name'];
    }

    if (!isset($data['birthday'])) {
        $errors[] = 'Введите дату рождения!';
    } else {
        $userdata['birthday'] = $data['birthday'];
    }

    if (!isset($data['address'])) {
        $errors[] = 'Введите адрес!';
    } else {
        $userdata['address'] = $data['address'];
    }

    if (isset($data['interests'])){
        $userdata['interests'] = $data['interests'];
    }

    if (!isset($data['vk'])) {
        $errors[] = 'Введите ссылку на свой профиль VK!';
    } else {
        $userdata['vk'] = $data['vk'];
    }

    if (!isset($data['gender'])) {
        $errors[] = 'Выберите пол!';
    } else {
        $userdata['gender'] = $data['gender'];
    }

    if (!isset($data['blood_type'])){
        $errors[] = 'Укажите группу крови!';
    }
    else{
        $userdata['blood_type'] = $data['blood_type'];
    }

    if (!isset($data['factor'])){
        $errors[] = 'Укажите резус-фактор!';
    }
    else{
        $userdata['factor'] = $data['factor'];
    }

    if (!isset($data['password'])) {
        $errors[] = 'Введите пароль!';
    }
    else {
        if ($data['password'] == $data['password_confirm']){
            if (checkPassword($data['password'])) {
                $userdata['password'] = $_POST["password"];
                $userdata['password'] = password_hash($userdata['password'], PASSWORD_DEFAULT);
            } else {
                $errors[] = 'Пароль не соответствует правилам!';
            }
        }
        else{
            $errors[] = 'Пароли не совпадают!';
        }

    }
    if(!isset($data['password_confirm'])){
        $errors[] = 'Введите пароль еще раз!';
    }





    if (empty($errors)) {
        $bar = [];
        $sql_test = "SELECT COUNT(*) FROM `USERS` WHERE login = ?";
        $result = $pdo->prepare($sql_test);
        $result->execute([$userdata['login']]);

        $number_of_rows = $result->fetchColumn();
        if ($number_of_rows == 0) {
            $sql = "INSERT INTO `users` (`login`, `password`, `full_name`, `birthday`, `address`, `gender`, `interests`, `vk`, `blood_type`, `factor`)
        VALUES (:login, :password, :full_name, :birthday, :address, :gender, :interests, :vk, :blood_type, :factor)";
            $query = $pdo->prepare($sql);
            $res = $query->execute($userdata);
            header('Location: login.php');
        } else {
            $errors[] = 'Пользователь с таким логином уже существует';
        }
    }
}
