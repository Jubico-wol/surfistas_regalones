<?php

require_once 'conf.php';
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

$options = array(
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
); 
$db = 'mysql:host='.DB_HOSTNAME.';dbname='.DB_NAME;
$dbhost = new PDO($db, DB_USERNAME, DB_PASSWORD, $options);

$name = $_POST["name"];
$lastname = $_POST["lastname"];
$state = $_POST["state"];
$id = $_POST["id"];
$email = $_POST["email"];
$phone = $_POST["phone"];
$ip_address = $_SERVER['REMOTE_ADDR'];

$query_users = "SELECT * 
                FROM usuarios U
                WHERE U.correo = :email OR U.identificacion = :id;";
$stmt_users = $dbhost->prepare($query_users);
$stmt_users->bindParam(':email', $email);
$stmt_users->bindParam(':id', $id);

if($stmt_users->execute()){
    if($stmt_users->rowCount() == 0){
        $query = "INSERT INTO usuarios(id, nombre, apellido, telefono, correo, identificacion, id_departamento, fecha_ing, ip_address, estado) 
                VALUES(null, :name, :lastname, :phone, :email, :id, :state, now(), :ip, 1);";

        $stmt = $dbhost->prepare($query);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':lastname', $lastname);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':state', $state);
        $stmt->bindParam(':ip', $ip_address);

        if($stmt->execute()){
            $id_user = $dbhost->lastInsertId();
            $KeyPHP = generateRandomString();
            $ivPHP = generateRandomString();
            $clave = generateRandomString();
            $key = pack("H", $KeyPHP);
            $iv =  pack("H", $ivPHP);
            $ivlen = openssl_cipher_iv_length($cipher = "AES-128-CBC");
            $iv2 = openssl_random_pseudo_bytes($ivlen);
            $ciphertext_raw = openssl_encrypt($clave, $cipher, $clave, $options = OPENSSL_RAW_DATA, $iv2);
            $hmac = hash_hmac('sha256', $ciphertext_raw, $clave, $as_binary=true);
            $ciphertext = base64_encode( $iv2.$hmac.$ciphertext_raw );
            
            $query_log = "INSERT INTO log VALUES(null, :id_usuario, :token, now(), 1);";
            $stmt_log = $dbhost->prepare($query_log);
            $stmt_log->bindParam(':id_usuario', $id_user);
            $stmt_log->bindParam(':token', $ciphertext);
            if($stmt_log->execute()){
                session_start();
                $_SESSION["id_user"] = $id_user;
                $_SESSION["email"] = $email;
                $_SESSION["token"] = $ciphertext;
                $response = array(
                    "status" => 200,
                    "error" => "Sesión iniciada"
                );
            }else{
                $response = array(
                    "status" => 400,
                    "error" => "Error al generar token"
                );
            }
            echo json_encode(array(
                "status" => 200,
                "error" => ""
            ));
        }else{
            echo json_encode(array(
                "status" => 400,
                "error" => "Error al guardar registro ".$dbhost->errorInfo()
            ));
        }
    }else{
        echo json_encode(array(
            "status" => 400,
            "error" => "Usuario ya registrado"
        ));
    }
}else{
    echo json_encode(array(
        "status" => 400,
        "error" => "Error al obtener los datos ".$dbhost->errorInfo()
    ));
}
    
?>