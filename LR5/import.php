<?php
require_once 'header.php';
require_once 'ImportExportLogic.php';
import();
?>
<div class="container">
    <form action="import.php" method="post">
        <div class="form-group">
            <label for="url_to_file">Ссылка на файл</label>
            <input type="url" class="form-control" name="url_to_file" id="url_to_file" placeholder="/upload/import.csv" required="" enctype="multipart/form-data">
        </div>
        <button type="submit" name="import" class="btn btn-primary">Загрузить</button>
    </form>
</div>
<?php require_once 'footer.php'?>
