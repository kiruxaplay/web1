<?php
require_once 'logic.php';
protect();
?>
<?php include 'header.php'; ?>

    <div class="row">
        <form action="students.php" method="get">
            <label>Фильтрация результата поиска</label>
            <div class="mb-3 mt-3">
                <label>По году поступления:</label>
                <input type="number" name="year" placeholder="Год" value="<?php echo isset($arBindsAll['year']) ? $arBindsAll['year'] : ''; ?>" class="form-control">
            </div>
            <div class="mb-3">
                <label>Фильтрация по учебной группе:</label>
                <select name="group" class="form-control">
                    <option value="">Выберите учебную группу</option>
                    <?php if (count($resultGroups) > 0): ?>
                        <?php foreach ($resultGroups as $item): ?>
                            <option value="<?= $item['id'] ?>" <?php echo (isset($arBindsAll['group']) && $arBindsAll['group'] === $item['id'])? "selected" : ''; ?>> <?= htmlspecialchars($item['name']) ?> </option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>
            </div>
            <div class="mb-3">
                <label>Фильтрация по характеристике:</label>
                <textarea class="form-control" placeholder="Введите характеристику студента" name="characteristic"><?php echo isset($arBindsAll['characteristic']) ? $arBindsAll['characteristic'] : ''; ?></textarea>
            </div>
            <div class="mb-3">
                <label>Фильтрация по ФИО:</label>
                <input type="text" name="full_name" placeholder="Введите ФИО" value="<?php echo isset($arBindsAll['full_name']) ? htmlspecialchars($arBindsAll['full_name']) : ''; ?>" class="form-control">
            </div>
            <input type="submit" value="Применить фильтр" class="btn btn-primary">
            <input type="submit" name="clearFilter" value="Очистить фильтр" class="btn btn-danger">
        </form>
    </div>
    <div class="row text-center mt-5">
        <?php if (count($resultAll) > 0): ?>
            <table class="table">
                <thead>
                <tr>
                    <th class="scope">Изображение</th>
                    <th class="scope">ФИО</th>
                    <th class="scope">Учебная группа</th>
                    <th class="scope">Характеристика</th>
                    <th class="scope">Год поступления</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($resultAll as $item): ?>
                        <th scope="row"><img src="inc/students/<?= $item['img_path'] ?>" style="max-width: 150px;"></th>
                        <td><?= htmlspecialchars($item['full_name']) ?></td>
                        <td><?= htmlspecialchars($item['group']) ?></td>
                        <td><?= htmlspecialchars($item['characteristic']) ?></td>
                        <td><?= htmlspecialchars($item['year']) ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>

    </div>




<?php include 'footer.php'; ?>
