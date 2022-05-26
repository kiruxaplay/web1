<?php
require_once 'logic.php';
$types = ProductsTable::getTypes();
$errors = UserLogic::addProduct();

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
    <form method="post" enctype="multipart/form-data" action="productAdd.php">
        <div class="row mb-3">
            <div class="col">
                <span>Описание</span>
                <textarea class="form-control" placeholder="Введите описание продукта" name="description"></textarea>
            </div>
        </div>
        <div class="row row-cols-lg-auto g-3 align-items-center">
            <div class="col">
                <div class="input-group">
                    <input type="file" class="form-control" name="imgProduct" title="Фото">
                </div>
            </div>

            <div class="col">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Название продукта" name="name" maxlength="60" title="Название продукта" value="">
                </div>
            </div>

            <div class="col">
                <div class="input-group">
                    <select class="form-select" name="type" title="Тип клиента">
                        <option selected value="">Выберите тип клиента</option>
                        <?php foreach ($types as $item):?>
                            <option value="<?=$item['id']?>"><?=$item['name']?></option>
                        <?php endforeach;?>
                    </select>
                </div>
            </div>

            <div class="col">
                <div class="input-group">
                    <input type="number" class="form-control" placeholder="Стоимость" name="cost" maxlength="60" title="Стоимость" value="">
                </div>
            </div>
            <div class="col">
                <div class="input-group">
                    <button class="btn btn-primary" type="submit" name="addProduct">Добавить студента</button>
                </div>
            </div>

        </div>






    </form>
</div>



<?php include 'footer.php'; ?>
