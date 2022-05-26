<?php
require_once 'logic.php';

$types = ProductsTable::getTypes();
$product = UserLogic::editProduct();
$errors = UserLogic::saveProduct();
require_once 'header.php';
?>

<div class="container">
    <a type="submit" class="btn btn-primary" href="products.php">Назад</a>
    <?php
    if (!empty($errors))
    {
        echo "<div class='errordiv'>";
        echo "<ul>";
        foreach ($errors as $err) {
            echo "<li>".$err."</li>"; //or whatever format you want!
        }
        echo "</ul></div>";
    }
    ?>
    <form method="post" enctype="multipart/form-data" action="productEdit.php">
        <div class="row mb-3">
            <div class="col">
                <span>Описание</span>
                <textarea class="form-control" placeholder="Введите описание продукта" name="newDescription"><?php echo isset($product['description']) ? $product['description'] : ''; ?></textarea>
            </div>
        </div>
        <div class="row row-cols-lg-auto g-3 align-items-center">
            <div class="col">
                <div class="input-group">
                    <input type="file" class="form-control" name="newImgProduct" title="Фото">
                </div>
            </div>

            <div class="col">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Название продукта" name="newName" maxlength="60" title="Название продукта" value="<?=$product['name']?>">
                </div>
            </div>

            <div class="col">
                <div class="input-group">
                    <select class="form-select" name="newType" title="Тип клиента">
                        <option selected value="<?=$product['id_client_type']?>"><?=$product['nameGroup']?></option>
                        <?php foreach ($types as $item):?>
                            <?php if ($item['id'] === $product['id_client_type']):?>
                                <?php continue;?>
                            <?php else:?>
                                <option value="<?=$item['id']?>"><?=$item['name']?></option>
                            <?php endif;?>
                        <?php endforeach;?>
                    </select>
                </div>
            </div>

            <div class="col">
                <div class="input-group">
                    <input type="number" class="form-control" placeholder="Цена" name="newСost" maxlength="60" title="Цена" value="<?=$product['cost']?>">
                </div>
            </div>
            <div class="col">
                <div class="input-group">
                    <button class="btn btn-primary" value="<?=$_GET['editProduct']?>" type="submit" name="saveProduct">Отправить</button>
                </div>
            </div>

        </div>






    </form>
</div>



<?php include 'footer.php'; ?>
