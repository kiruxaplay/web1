<?php
require_once 'db.php';
function export(){
    if (isset($_POST['submit_export'])){
        $pdo = dbConnect();
        $sql_export = "SELECT * FROM students";
        $data_export = $pdo->prepare($sql_export);
        $filename="students_exported.json";
        $json_export=array();
        while ($row=$data_export->fetch_array(MYSQLI_ASSOC))
            $json_export[]=$row;
        if (!file_exists($filename))
            file_put_contents($filename,json_encode($json_export,JSON_UNESCAPED_UNICODE));
        $uploadDir=$_SERVER['DOCUMENT_ROOT'].'/LR5/';
        $exportUrl='http://localhost/LR5/worker.php';
        $postFields=['file'=>new \CURLFile($uploadDir.$filename,'application/json')];
        if ('POST'==$_SERVER['REQUEST_METHOD']){
            $request=curl_init();
            curl_setopt($request, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($request,CURLOPT_URL,$exportUrl);
            curl_setopt($request, CURLOPT_POST, 1);
            curl_setopt($request, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($request, CURLOPT_POSTFIELDS, $postFields);
            $response=curl_exec($request);
        }
    }
}
function import(){
    if (isset($_POST['import'])){
        $dirpath=$_SERVER['DOCUMENT_ROOT'];
        if (isset($_POST['url_to_file'])){
            $path=explode('/', $_POST['url_to_file']);
            $filename=basename($path);
            $filepath=$dirpath.'/'.$path[count($path)-1];
            $handle=fopen($filepath,"r");
            $content=fread($handle,filesize($filepath));
            fclose($handle);
            $content=json_decode($content,true);
            $count=1;
            foreach ($content["data"] as $item) {
                $pdo = dbConnect();
                $sql_import = "INSERT INTO students_imported (img_path, full_name, id_group, characteristic, year) 
				        VALUES (:img_path, :full_name, :id_group, :characteristic, :year)";
                $stmt = $pdo->prepare($sql_import);
                $stmt->bindValue(":img_path", $item['img_path']);
                $stmt->bindValue(":full_name", $item['full_name']);
                $stmt->bindValue(":id_group", $item['id_group']);
                $stmt->bindValue(":characteristic", $item['characteristic']);
                $stmt->bindValue(":year", $item['year']);
                $stmt->execute();
                $count++;
                }
                $import_message="Файл с данными получен из ".$filename." и обработан. Создана таблица funerals_imported, количество записей в ней: ".($count-1).PHP_EOL;
        } else
            $import_message="Данный файл не является файлом JSON!";
    }
}