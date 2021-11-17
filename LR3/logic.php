<?php
require_once 'db.php';
global $pdo;

$sqlALL = "SELECT students.id, students.img_path, students.full_name, students.characteristic, students.year, groups.name as 'group', students.id_group
    FROM `students`
    JOIN `groups` ON students.id_group = groups.id";

$arBindsAll = [];


$sqlGroups = "SELECT groups.id, groups.name from `groups`";
$arBindsGroups = [];
$stmtGroups = $pdo->prepare($sqlGroups);
$resultGroups = $stmtGroups->execute($arBindsGroups);
$resultGroups = $pdo->query($sqlGroups)->fetchAll(PDO::FETCH_ASSOC);


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
function protect()
{
    if (!isset($_SESSION['loggedUser'])){
        header('Location: login.php');
        exit;
    }
}
