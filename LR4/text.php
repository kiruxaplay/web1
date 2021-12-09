<?php
require_once 'textLogic.php';

?>

<?php include 'header.php' ?>
    <div class="container">
        <div class="row my-5">
            <div class="col-md-8">
                <form name="doText" method="post">
                    <div class="mb-3">
                        <label for="textInput" class="form-label">Введите текст</label>
                        <input type="text" class="form-control" id="textInput" aria-describedby="emailHelp" name="text"
                               value= <?php echo htmlspecialchars($inputText); ?>>
                    </div>
                    <button type="submit" class="btn btn-primary" name="doText">Отправить</button>
                </form>

            </div>
        </div>
        <div class="my-5">
            <?php foreach ($text5 as $key => $value)
            {
                echo($value);
                echo "<br>";
                echo "<br>";
            } ?>
            <?php foreach ($text10 as $key => $value)
            {
                echo($value);
                echo "<br>";
                echo "<br>";
            } ?>
            <?php foreach ($text15 as $key => $value)
            {
                echo($value);
                echo "<br>";
                echo "<br>";
            } ?>
            <?php foreach ($text20 as $key => $value)
            {
                echo($value);
                echo "<br>";
                echo "<br>";
            } ?>
        </div>
    </div>
<?php include 'footer.php' ?>