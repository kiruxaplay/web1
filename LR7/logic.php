<?php
function dbConnect()
{
    $pdo = new PDO('mysql:host=localhost;dbname=university;charset=utf8;', 'root', '');
    return $pdo;
}
class StudentsTable
{
    public static function getStudents(){
        $pdo = dbConnect();
        $sql = "SELECT students.id, students.img_path, students.full_name, students.characteristic, students.year, groups.name as 'group', students.id_group
        FROM `students`
        JOIN `groups` ON students.id_group = groups.id";
        $result = $pdo->query($sql);
        $result = $result->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public static function deleteStudent()
    {
        if (key_exists('deleteStudent', $_GET))
        {
            if (isset($_GET['deleteStudent']))
            {
                $pdo = dbConnect();
                $student['studentId'] = htmlspecialchars($_GET['deleteStudent']);

                $sqlImg = "SELECT `img_path` FROM `students` WHERE `students`.`id` = :studentId";
                $query = $pdo->prepare($sqlImg);
                $query->execute($student);
                $resultImg = $query->fetch(PDO::FETCH_ASSOC);
                $path = "inc/students/" . $resultImg['img_path'];
                unlink($path);

                $sql = "DELETE FROM `students` WHERE `students`.`id` = :studentId";
                $stmt = $pdo->prepare($sql);
                $stmt->execute($student);
                header("Location: index.php");
            }
        }
    }
    public static function getGroups(){
        $pdo = dbConnect();
        $sqlGroups = "SELECT groups.id, groups.name from `groups`";
        $resultGroups = $pdo->query($sqlGroups)->fetchAll(PDO::FETCH_ASSOC);
        return $resultGroups;

    }
    public static function editStudent()
    {
        if (key_exists('editStudent', $_GET))
        {
            if (isset($_GET['editStudent']) && !empty($_GET['editStudent']))
            {
                $studentInfo = [];
                $studentId['studentId'] = htmlspecialchars($_GET['editStudent']);
                $sql = "SELECT students.id, students.full_name, students.id_group, students.characteristic, students.year , groups.name FROM students, groups WHERE groups.id = students.id_group AND students.id = :studentId";
                $pdo = dbConnect();
                $stmt = $pdo->prepare($sql);
                $stmt->execute($studentId);
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                foreach ($result as $key => $value)
                {
                    foreach ($value as $valueKey => $item)
                    {
                        $studentInfo["$valueKey"] = $item;
                    }
                }
                return $studentInfo;
            }
        }

        if (key_exists('saveStudent', $_POST))
        {
            if ((isset($_POST['newCharacteristic']) && isset($_POST['newFull_name']) && isset($_POST['newGroup']) && isset($_POST['newYear']) && isset($_POST['saveStudent']))
                && (!empty($_POST['newCharacteristic']) && !empty($_POST['newFull_name']) && !empty($_POST['newGroup']) && !empty($_POST['newYear']) && !empty($_POST['saveStudent'])))
            {


                $studentDelete['studentId'] = htmlspecialchars($_POST['saveStudent']);
                $pdo = dbConnect();
                $sqlImg = "SELECT `img_path` FROM `students` WHERE `students`.`id` = :studentId";
                $query = $pdo->prepare($sqlImg);
                $query->execute($studentDelete);
                $resultImg = $query->fetch(PDO::FETCH_ASSOC);
                $pathDelete = "inc/students/" . $resultImg['img_path'];
                unlink($pathDelete);

                $path = "inc/students/" . $_FILES["newImgStudent"]["name"];
                move_uploaded_file($_FILES["newImgStudent"]["tmp_name"], $path);
                $newStudentInfo['img'] = $_FILES["newImgStudent"]["name"];
                $newStudentInfo['newFull_name'] = htmlspecialchars($_POST['newFull_name']);
                $newStudentInfo['newCharacteristic'] = htmlspecialchars($_POST['newCharacteristic']);
                $newStudentInfo['newGroup'] = htmlspecialchars($_POST['newGroup']);
                $newStudentInfo['newYear'] = htmlspecialchars($_POST['newYear']);
                $newStudentInfo['studentId'] = htmlspecialchars($_POST['saveStudent']);


                $sql = "UPDATE students SET students.full_name = :newFull_name , students.characteristic = :newCharacteristic , students.id_group = :newGroup, students.year = :newYear, students.img_path = :img WHERE students.id = :studentId";
                $stmt = $pdo->prepare($sql);
                $stmt->execute($newStudentInfo);
                header("Location: students.php");
            }
            else
            {

                echo "Ошибка! Все поля должны быть заполнены!";
                header("Location: studentsEdit.php?editStudent=".$_POST['saveStudent']);
            }
        }
    }
    public static function addStudent()
    {
        if (key_exists('addStudent', $_POST))
        {
            if (!empty($_POST['full_name']) && !empty($_POST['characteristic']) && !empty($_POST['id_group']) && !empty($_POST['year']))
            {
                $path = "inc/students/" . $_FILES["imgStudent"]["name"];
                move_uploaded_file($_FILES["imgStudent"]["tmp_name"], $path);
                $student['img'] = $_FILES["imgStudent"]["name"];
                $student['full_name'] = htmlspecialchars($_POST['full_name']);
                $student['characteristic'] = htmlspecialchars($_POST['characteristic']);
                $student['id_group'] = htmlspecialchars($_POST['id_group']);
                $student['year'] = htmlspecialchars($_POST['year']);
                $sql = "INSERT INTO `students` (`full_name`, `characteristic`, `id_group`, `year`, `img_path`) VALUES ( :full_name, :characteristic, :id_group, :year, :img)";
                $pdo = dbConnect();
                $stmt= $pdo->prepare($sql);
                $stmt->execute($student);
                header("Location: students.php");
            }
            else
            {
                echo "Ошибка! Все поля должны быть заполнены!";
            }

        }
    }

}
