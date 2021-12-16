<?php
require_once 'logic.php';
$groups = StudentsTable::getGroups();
$student = StudentsTable::editStudent();
require_once 'header.php';
?>

<div class="container">
    <a type="submit" class="btn btn-primary" href="students.php">Назад</a>
    <form method="post" enctype="multipart/form-data" action="studentsEdit.php">
        <div class="row mb-3">
            <div class="col">
                <span>Характеристика</span>
                <textarea class="form-control" placeholder="Введите характеристику студента" name="newCharacteristic"><?php echo isset($student['characteristic']) ? $student['characteristic'] : ''; ?></textarea>
            </div>
        </div>
        <div class="row row-cols-lg-auto g-3 align-items-center">
            <div class="col">
                <div class="input-group">
                    <input type="file" class="form-control" name="newImgStudent" title="Фото">
                </div>
            </div>

            <div class="col">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="ФИО студента" name="newFull_name" maxlength="60" title="Имя студента" value="<?=$student['full_name']?>">
                </div>
            </div>

            <div class="col">
                <div class="input-group">
                    <select class="form-select" name="newGroup" title="Группа">
                        <option selected value="<?=$student['id_group']?>"><?=$student['name']?></option>
                        <?php foreach ($groups as $item):?>
                            <?php if ($item['id'] === $student['groupId']):?>
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
                    <input type="number" class="form-control" placeholder="Год поступления" name="newYear" maxlength="60" title="Год поступления" value="<?=$student['year']?>">
                </div>
            </div>
            <div class="col">
                <div class="input-group">
                    <button class="btn btn-primary" value="<?=$_GET['editStudent']?>" type="submit" name="saveStudent">Отправить</button>
                </div>
            </div>

        </div>






    </form>
</div>



<?php include 'footer.php'; ?>
