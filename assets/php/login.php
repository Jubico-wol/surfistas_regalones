<?php

require_once 'conf.php';

$options = array(
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
); 
$db = 'mysql:host='.DB_HOSTNAME.';dbname='.DB_NAME;
$dbhost = new PDO($db, DB_USERNAME, DB_PASSWORD, $options);

$email = $_POST["email"];
$id = $_POST["id"];
$ip_address = $_SERVER['REMOTE_ADDR'];

$query = "SELECT * FROM usuarios WHERE correo = :email AND identificacion = :id AND estado = 1;";

$stmt = $dbhost->prepare($query);
$stmt->bindParam(':email', $email);
$stmt->bindParam(':id', $id);

if($stmt->execute()){
    if($stmt->rowCount() > 0){
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
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
        
        $query = "INSERT INTO log VALUES(null, :id_usuario, :token, now(), 1);";
        $stmt = $dbhost->prepare($query);
        $stmt->bindParam(':id_usuario', $row["id"]);
        $stmt->bindParam(':token', $ciphertext);
        if($stmt->execute()){
            session_start();
            $_SESSION["id_user"] = $row["id"];
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
    }else{
        $response = array(
            "status" => 400,
            "error" => "Credenciales invalidas"
        );
    }
}else{
    $response = array(
        "status" => 400,
        "error" => $dbhost->errorInfo()
    );
}
echo json_encode($response);

?>