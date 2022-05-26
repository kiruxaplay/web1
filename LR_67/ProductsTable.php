<?php
require_once 'logic.php';

class ProductsTable
{
    public static function getProductInfo($productId): array
    {
        $productInfo = [];
        $sql = "SELECT products.id, products.name, products.id_client_type, products.description, products.cost , client_types.name AS nameGroup FROM products, client_types WHERE client_types.id = products.id_client_type AND products.id = :productId";
        $pdo = dbConnect();
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(":productId", $productId);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result as $key => $value) {
            foreach ($value as $valueKey => $item) {
                $productInfo["$valueKey"] = $item;
            }
        }
        return $productInfo;
    }

    public static function deleteProduct($productId)
    {
        $pdo = dbConnect();

        $sqlImg = "SELECT `img_path` FROM `products` WHERE `products`.`id` = :productId";
        $query = $pdo->prepare($sqlImg);
        $query->bindValue(":productId", $productId);
        $query->execute();
        $resultImg = $query->fetch(PDO::FETCH_ASSOC);
        $path = "images/products_images/" . $resultImg['img_path'];
        unlink($path);

        $sql = "DELETE FROM `products` WHERE `products`.`id` = :productId";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(":productId", $productId);
        $stmt->execute();

    }

    public static function editProduct($productId, $file_name, $file_tmp_name, $newName, $newDescription, $newType, $newCost)
    {
        $pdo = dbConnect();
        $sqlImg = "SELECT `img_path` FROM `products` WHERE `products`.`id` = :productId";
        $query = $pdo->prepare($sqlImg);
        $query->bindValue(":productId", $productId);
        $resultImg = $query->fetch(PDO::FETCH_ASSOC);
        $pathDelete = "images/products_images/" . $resultImg['img_path'];
        unlink($pathDelete);
        $path = "images/products_images/" . $file_name;
        move_uploaded_file($file_tmp_name, $path);


        $sql = "UPDATE products SET products.name = :newName , products.description = :newDescription , products.id_client_type = :newType, products.cost = :newCost, products.img_path = :img WHERE products.id = :productId";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(":productId", $productId);
        $stmt->bindValue(":newName", $newName);
        $stmt->bindValue(":newDescription", $newDescription);
        $stmt->bindValue(":newType", $newType);
        $stmt->bindValue(":newCost", $newCost);
        $stmt->bindValue(":img", $file_name);


        $stmt->execute();

    }

    public static function addProduct($name, $description, $type, $cost, $file_name, $file_tmp_name)
    {

        $path = "images/products_images/" . $file_name;
        move_uploaded_file($file_tmp_name, $path);
        $sql = "INSERT INTO `products` (`name`, `description`, `id_client_type`, `cost`, `img_path`) VALUES ( :name, :description, :type, :cost, :img)";
        $pdo = dbConnect();
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(":name", $name);
        $stmt->bindValue(":description", $description);
        $stmt->bindValue(":type", $type);
        $stmt->bindValue(":cost", $cost);
        $stmt->bindValue(":img", $file_name);
        $stmt->execute();
    }
    public static function getProducts(){
        $pdo = dbConnect();
        $sql = "SELECT products.id, products.img_path, products.name, products.description, products.cost, client_types.name as 'type', products.id_client_type 
        FROM `products` 
        JOIN `client_types` ON products.id_client_type = client_types.id";
        $result = $pdo->query($sql);
        $result = $result->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public static function getTypes(){
        $pdo = dbConnect();
        $sqlType = "SELECT client_types.id, client_types.name from `client_types`";
        $resultType = $pdo->query($sqlType)->fetchAll(PDO::FETCH_ASSOC);
        return $resultType;
    }

}