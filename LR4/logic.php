<?php
require_once 'db.php';
session_start();

global $arBindsAll;
global $data;
global $errors;



function protect()
{
    if (!isset($_SESSION['loggedUser'])){
        header('Location: login.php');
        exit;
    }
}

function filter_groups(){
    $pdo = dbConnect();
    $sqlGroups = "SELECT groups.id, groups.name from `groups`";
    $arBindsGroups = [];
    $stmtGroups = $pdo->prepare($sqlGroups);
    $resultGroups = $stmtGroups->execute($arBindsGroups);
    $resultGroups = $pdo->query($sqlGroups)->fetchAll(PDO::FETCH_ASSOC);
    return $resultGroups;

}
function filter(){
    global $arBindsAll;
    $arBindsAll = [];
    $pdo = dbConnect();
    $sqlALL = "SELECT students.id, students.img_path, students.full_name, students.characteristic, students.year, groups.name as 'group', students.id_group
    FROM `students`
    JOIN `groups` ON students.id_group = groups.id";



    if (!key_exists('clearFilter', $_GET)) {
        if (count($_GET) > 0) {
            $first = true;
            $sqlALL .= " WHERE";
            if (isset($_GET['group']) && ($group = $_GET['group'])) {
                if (!$first) $sqlALL .= " AND";
                $sqlALL .= " students.id_group = :group";
                $arBindsAll['group'] = $_GET['group'];
                $first = false;
            }
            if (isset($_GET['year']) && ($year = $_GET['year'])) {
                if (!$first) $sqlALL .= " AND";
                $sqlALL .= " students.year = :year";
                $arBindsAll['year'] = $_GET['year'];
                $first = false;
            }

            if (isset($_GET['characteristic']) && ($characteristic = $_GET['characteristic'])) {
                if (!$first) $sqlALL .= " AND";
                $sqlALL .= " students.characteristic LIKE CONCAT('%',:characteristic,'%')";
                $arBindsAll['characteristic'] = $_GET['characteristic'];
                $first = false;
            }
            if (isset($_GET['full_name']) && ($full_name = $_GET['full_name'])) {
                if (!$first) $sqlALL .= " AND";
                $sqlALL .= " students.full_name LIKE CONCAT('%',:full_name,'%')";
                $arBindsAll['full_name'] = $_GET['full_name'];
                $first = false;
            }
        }
    }

    $stmtAll = $pdo->prepare($sqlALL);
    $stmtAll->execute($arBindsAll);
    $resultAll = $stmtAll->fetchAll(PDO::FETCH_ASSOC);
    return $resultAll;

}
function checkPassword($pwd)
{
    $errors = array();

    if (strlen($pwd) < 6) {
        $errors[] = "Password too short!";
    }

    if (!preg_match("#[0-9]+#", $pwd)) {
        $errors[] = "Password must include at least one number!";
    }

    if (!preg_match("#[a-zA-Z]+#", $pwd)) {
        $errors[] = "Password must include at least one letter!";
    }
    if (empty($errors)) {
        return true;
    }

}
function checkEmail($email)
{
    $errors = array();

    if (!preg_match("/^(?:[a-z0-9]+(?:[-_.]?[a-z0-9]+)?@[a-z0-9_.-]+(?:\.?[a-z0-9]+)?\.[a-z]{2,5})$/i", $email)) {
        $errors[] = "Bad email!";
    }
    if (empty($errors)) {
        return true;
    }
}

function signup(){
    $pdo = dbConnect();
    global $data;
    global $errors;
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
}
function signin(){
    $pdo = dbConnect();
    global $data;
    global $errors;
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
}




