<?php
require_once 'logic.php';
UserLogic::deleteProduct();
require_once 'header.php';
$products = ProductsTable::getProducts();
?>
<div class="container">
    <h1>Список банковских услуг</h1>
    <a type="submit" class="btn btn-primary" href="productAdd.php">Добавить продукт</a>
    <div class="row text-center mt-5">
        <?php if (count($products) > 0): ?>
            <table class="table">
                <thead>
                <tr>
                    <th class="scope">id</th>
                    <th class="scope">Изображение</th>
                    <th class="scope">Название продукта</th>
                    <th class="scope">Тип клиента</th>
                    <th class="scope">Описание</th>
                    <th class="scope">Цена</th>
                    <th colspan="2"></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($products as $item): ?>
                    <td><?= htmlspecialchars($item['id']) ?></td>
                    <th scope="row"><img src="images/products_images/<?= $item['img_path'] ?>" style="max-width: 150px;"></th>
                    <td><?= htmlspecialchars($item['name']) ?></td>
                    <td><?= htmlspecialchars($item['type']) ?></td>
                    <td><?= htmlspecialchars($item['description']) ?></td>
                    <td><?= htmlspecialchars($item['cost']) ?></td>
                    <td>
                        <form action="productEdit.php" method="get">
                            <button type="submit" class="btn btn-primary" name="editProduct" value="<?=$item['id']?>">Редактировать</button>
                        </form>
                    </td>
                    <td>
                        <form action="products.php" method="get">
                            <button type="submit" class="btn btn-danger" name="deleteProduct" value="<?=$item['id']?>">Удалить</button>
                        </form>
                    </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>

    </div>
</div>




<?php include 'footer.php'; ?>
