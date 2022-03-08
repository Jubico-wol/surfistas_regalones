<?php
require_once 'conf.php';

$options = array(
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
); 
$db = 'mysql:host='.DB_HOSTNAME.';dbname='.DB_NAME;
$dbhost = new PDO($db, DB_USERNAME, DB_PASSWORD, $options);

if(isset($_POST["id_pais"])){
    $id_pais = $_POST["id_pais"];

    $query = "SELECT id, nombre FROM departamentos WHERE id_pais = :id;";
    $stmt = $dbhost->prepare($query);
    $stmt->bindParam(':id', $id_pais);
    if($stmt->execute()){
        $data = ($id_pais == 6)? "<option value=0>Provincia</option>" : "<option value=0>Departamento</option>";
        $status = 200;
        $msg = "";
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $data .= "<option value=".$row['id'].">".$row['nombre']."</option>";
        }
    }else{
        $status = 400;
        $data = "<option value=0>Sin datos</option>";
        $msg = "";
    }
}else{
    $status = 400;
    $data = "<option value=0>Sin datos</option>";
    $msg = "";
}

echo json_encode(array(
    "status" => $status,
    "data" => $data,
    "msg" => $msg
));
?>