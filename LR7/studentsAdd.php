<?php
require_once 'logic.php';
$groups = StudentsTable::getGroups();
StudentsTable::addStudent();

require_once 'header.php';
?>

<div class="container">
    <a type="submit" class="btn btn-primary" href="students.php">Назад</a>
    <form method="post" enctype="multipart/form-data" action="studentsAdd.php">
        <div class="row mb-3">
            <div class="col">
                <span>Характеристика</span>
                <textarea class="form-control" placeholder="Введите характеристику студента" name="characteristic"></textarea>
            </div>
        </div>
        <div class="row row-cols-lg-auto g-3 align-items-center">
            <div class="col">
                <div class="input-group">
                    <input type="file" class="form-control" name="imgStudent" title="Фото">
                </div>
            </div>

            <div class="col">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="ФИО студента" name="full_name" maxlength="60" title="Имя студента" value="">
                </div>
            </div>

            <div class="col">
                <div class="input-group">
                    <select class="form-select" name="id_group" title="Группа">
                        <option selected value="">Выберите группу</option>
                        <?php foreach ($groups as $item):?>
                            <option value="<?=$item['id']?>"><?=$item['name']?></option>
                        <?php endforeach;?>
                    </select>
                </div>
            </div>

            <div class="col">
                <div class="input-group">
                    <input type="number" class="form-control" placeholder="Год поступления" name="year" maxlength="60" title="Год поступления" value="<?=$student['year']?>">
                </div>
            </div>
            <div class="col">
                <div class="input-group">
                    <button class="btn btn-primary" type="submit" name="addStudent">Добавить студента</button>
                </div>
            </div>

        </div>






    </form>
</div>



<?php include 'footer.php'; ?>
