<?php
require_once 'header.php';
require_once 'ImportExportLogic.php';
export();
?>
<div class="container">
    <form method="post" enctype="multipart/form-data" action="export.php">
        <div class="form-group">
            <label for="path_to_save"></label>
            <input type="text" class="form-control" id="path_to_save" name="path_to_save"
                value=" <?php
                if (isset($_POST['submit_export'])&&isset($filename)){
                    echo $filename." передан скрипту worker.php по протоколу HTTP методом POST.";
                }
                else echo "JSON файл будет передан внешнему скрипту!"; ?>"
            >
            <?php if (isset($response)) echo $response;?>
        </div>
        <button type="submit" name="submit_export" class="btn btn-info1">Экспорт</button>
    </form>
</div>
<?php require_once 'footer.php'?>

