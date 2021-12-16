<?php
require_once 'logic.php';
StudentsTable::deleteStudent();
require_once 'header.php';
$students = StudentsTable::getStudents();
?>
<div class="container">
    <h1>Таблица студентов</h1>
    <a type="submit" class="btn btn-primary" href="studentsAdd.php">Добавить студента</a>
    <div class="row text-center mt-5">
        <?php if (count($students) > 0): ?>
            <table class="table">
                <thead>
                <tr>
                    <th class="scope">id</th>
                    <th class="scope">Изображение</th>
                    <th class="scope">ФИО</th>
                    <th class="scope">Учебная группа</th>
                    <th class="scope">Характеристика</th>
                    <th class="scope">Год поступления</th>
                    <th colspan="2"></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($students as $item): ?>
                    <td><?= htmlspecialchars($item['id']) ?></td>
                    <th scope="row"><img src="inc/students/<?= $item['img_path'] ?>" style="max-width: 150px;"></th>
                    <td><?= htmlspecialchars($item['full_name']) ?></td>
                    <td><?= htmlspecialchars($item['group']) ?></td>
                    <td><?= htmlspecialchars($item['characteristic']) ?></td>
                    <td><?= htmlspecialchars($item['year']) ?></td>
                    <td>
                        <form action="studentsEdit.php" method="get">
                            <button type="submit" class="btn btn-primary" name="editStudent" value="<?=$item['id']?>">Редактировать</button>
                        </form>
                    </td>
                    <td>
                        <form action="students.php" method="get">
                            <button type="submit" class="btn btn-danger" name="deleteStudent" value="<?=$item['id']?>">Удалить</button>
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
