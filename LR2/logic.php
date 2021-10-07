<?php

$pdo = new PDO('mysql:host=localhost;dbname=university', 'root', '');

$sqlALL = "SELECT students.id, students.img_path, students.full_name, students.characteristic, students.year, groups.name as 'group', students.id_group
    FROM `students`
    JOIN `groups` ON students.id_group = groups.id";

$arBindsAll = [];
$stmtAll = $pdo->prepare($sqlALL);
$resultAll = $stmtAll->execute($arBindsAll);
$resultAll = $pdo->query($sqlALL)->fetchAll(PDO::FETCH_ASSOC);

$sqlGroups = "SELECT groups.id, groups.name from `groups`";
$arBindsGroups = [];
$stmtGroups = $pdo->prepare($sqlGroups);
$resultGroups = $stmtGroups->execute($arBindsGroups);
$resultGroups = $pdo->query($sqlGroups)->fetchAll(PDO::FETCH_ASSOC);


if (!key_exists('clearFilter', $_GET)) {
    if (count($_GET) > 0) {
        $first = true;
        $sqlALL .= " WHERE";
        if (isset($_GET['group']) && ($company = $_GET['group'])) {
            if (!$first) $sqlALL .= " AND";
            $sqlALL .= " students.id_group = $company";
            $arBindsAll['group'] = htmlspecialchars($_GET['group']);
            $first = false;
        }
        if (isset($_GET['year']) && ($year = $_GET['year'])) {
            if (!$first) $sqlALL .= " AND";
            $sqlALL .= " students.year = $year";
            $arBindsAll['year'] = htmlspecialchars($_GET['year']);
            $first = false;
        }

        if (isset($_GET['characteristic']) && ($characteristic = $_GET['characteristic'])) {
            if (!$first) $sqlALL .= " AND";
            $sqlALL .= " students.characteristic LIKE '%$characteristic%'";
            $arBindsAll['characteristic'] = htmlspecialchars($_GET['characteristic']);
            $first = false;
        }
        if (isset($_GET['full_name']) && ($full_name = $_GET['full_name'])) {
            if (!$first) $sqlALL .= " AND";
            $sqlALL .= " students.full_name LIKE '%$full_name%'";
            $arBindsAll['full_name'] = htmlspecialchars($_GET['full_name']);
            $first = false;
        }
        $stmtAll = $pdo->prepare($sqlALL);
        $resultAll = $pdo->query($sqlALL)->fetchAll(PDO::FETCH_ASSOC);
    }


}