<?php
require_once 'ProductsTable.php';
function dbConnect()
{
    $pdo = new PDO('mysql:host=localhost;dbname=alfa_bank;charset=utf8', 'root', '');
    return $pdo;
}


class UserLogic{
    public static function editProduct(){
        if (key_exists('editProduct', $_GET))
        {
            if (isset($_GET['editProduct']) && !empty($_GET['editProduct']))
            {
                return ProductsTable::getProductInfo($_GET['editProduct']);
            }
        }
    }
    public static function saveProduct() : array
    {
        $errors = array();
        if (key_exists('saveProduct', $_POST))
        {
            if ((isset($_POST['newDescription']) && isset($_POST['newName']) && isset($_POST['newType']) && isset($_POST['newСost']) && isset($_POST['saveProduct']) && isset($_FILES["newImgProduct"]["name"]))
                && (!empty($_POST['newDescription']) && !empty($_POST['newName']) && !empty($_POST['newType']) && !empty($_POST['newСost']) && !empty($_POST['saveProduct']) && !empty($_FILES["newImgProduct"]["name"])))
            {
                ProductsTable::editProduct($_POST['saveProduct'], $_FILES["newImgProduct"]["name"], $_FILES["newImgProduct"]["tmp_name"], $_POST['newName'], $_POST['newDescription'], $_POST['newType'], $_POST['newСost']);
                header("Location: products.php");
            }
            else
            {
                $errors[] = "Ошибка! Все поля должны быть заполнены!";
                header("Location: productEdit.php?editProduct=".$_POST['saveProduct']);
                die();
            }

        }
        return $errors;
    }
    public static function deleteProduct(){
        if (key_exists('deleteProduct', $_GET))
        {
            if (isset($_GET['deleteProduct']))
            {
                ProductsTable::deleteProduct($_GET['deleteProduct']);
                header("Location: index.php");
            }
        }
    }
    public static function addProduct(){
        $errors = array();
        if (key_exists('addProduct', $_POST))
        {
            if (!empty($_POST['name']) && !empty($_POST['description']) && !empty($_POST['type']) && !empty($_POST['cost']) && !empty($_FILES["imgProduct"]["name"]))
            {
                ProductsTable::addProduct($_POST['name'], $_POST['description'], $_POST['type'], $_POST['cost'], $_FILES["imgProduct"]["name"], $_FILES["imgProduct"]["tmp_name"]);
                header("Location: products.php");
            }
            else
            {
                $errors[] = "Ошибка! Все поля должны быть заполнены!";
            }
            return $errors;
        }
    }
}