<?php

session_start();
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
if(isset($_SESSION["id_user"]) && isset($_SESSION["token"])){
    require_once 'conf.php';
    
    $options = array(
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
    ); 
    $db = 'mysql:host='.DB_HOSTNAME.';dbname='.DB_NAME;
    $dbhost = new PDO($db, DB_USERNAME, DB_PASSWORD, $options);
    $query = "SELECT token FROM log WHERE id_usuario = :id AND token = :token;";
    $stmt = $dbhost->prepare($query);
    $stmt->bindParam(':id', $_SESSION["id_user"]);
    $stmt->bindParam(':token', $_SESSION["token"]);
    $ip_address = $_SERVER['REMOTE_ADDR'];
    if($stmt->execute()){
        if($stmt->rowCount() > 0){
            if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_FILES["fileToUpload"]["type"])){
                $errors = array();
                $messages = array();
                $carpeta = "../archivos/";
                $target_file = $carpeta . basename($_FILES["fileToUpload"]["name"]);
                $uploadOk = true;
                $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
                if(isset($_POST["submit"])) {
                    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
                    if($check !== false) {
                        $errors[]= "El archivo es una imagen - " . $check["mime"] . ".";
                    } else {
                        $response = array(
                            "status" => 400,
                            "msg" => "El archivo no es una imagen."
                        );
                        echo json_encode($response);
                        return;   
                    }
                }
                
                // if ($_FILES["fileToUpload"]["size"] > 8388608) {
                //     $errors[]= "Lo sentimos, el archivo es demasiado grande. Tamaño máximo admitido: 2 MB";
                //     $uploadOk = 0;
                // }
                if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
                    $uploadOk = false;
                    $response = array(
                        "status" => 400,
                        "msg" => "Lo sentimos, sólo archivos JPG, JPEG, PNG son permitidos."
                    );
                    echo json_encode($response);
                    return;
                }
                if ($uploadOk) {
                    $factura = $_POST["invoice"];
                    $id_foto = time();
                    $url_foto = "../archivos/".$id_foto.".".$imageFileType;
                    $name = $carpeta.$id_foto.".".$imageFileType;
                    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $name)) {
                        $file_name = $id_foto.".".$imageFileType;
                        $query = "INSERT INTO archivos VALUES(null, :id, :no, :file, now(), :ip, 1)";
                        $stmt = $dbhost->prepare($query);
                        $stmt->bindParam(':id', $_SESSION["id_user"]);
                        $stmt->bindParam(':no', $factura);
                        $stmt->bindParam(':file', $file_name);
                        $stmt->bindParam(':ip', $ip_address);
                        if($stmt->execute()){ 
                            $mail = new PHPMailer(true);
                            $mail->Host = 'smtp.gmail.com';
                            $mail->isSMTP();
                            $mail->CharSet = "UTF-8";
                            $mail->Port = 587;
                            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                            $mail->SMTPAuth   = true;
                            $mail->Username = "support@wolvisor.com";
                            $mail->Password = "ikczzbqbjxlhmpau";
                            $mail->setFrom('support@wolvisor.com', 'SNACKS YUMMIES');
                            $mail->addAddress($_SESSION["email"]);
                            $mail->isHTML(true);
                            $mail->Subject = 'Ya estas participando en Los Duendes Regalones';
                            $mail->Body  = "<div>
                                                <img src='https://snacksyummies.com/Navidad/assets/img/email-invoice.jpg'>
                                                <h3>No responder a este correo, si tienes un problema con tu formulario, contáctanos vía inbox <a href='https://www.facebook.com/SnacksYummies'>aquí</a></h3>
                                            </div>";

                            try {
                                $mail->send();
                                $response = array(
                                    "status" => 200,
                                    "msg" => "El Archivo ha sido subido correctamente."
                                );
                            } catch (Exception $e) {
                                $response = array(
                                    "status" => 400,
                                    "msg" => "Message could not be sent. Mailer Error: {$mail->ErrorInfo}"
                                );
                            }                            
                        }else{
                            $response = array(
                                "status" => 400,
                                "msg" => "Lo sentimos, hubo un error subiendo el archivo."
                            );
                        }
                    } else {
                        $response = array(
                            "status" => 400,
                            "msg" => "Lo sentimos, hubo un error subiendo el archivo."
                        );
                    }
                } else {
                    $response = array(
                        "status" => 400,
                        "msg" => "Lo sentimos, tu archivo no fue subido."
                    );
                }
            }
        }else{
            $response = array(
                "status" => 400,
                "msg" => "Token inválido"
            );
        }
    }else{
        $response = array(
            "status" => 400,
            "msg" => "Error al obtener token"
        );
    }
}else{
    $response = array(
        "status" => 400,
        "msg" => "Sesión terminada"
    );
}

echo json_encode($response);


?>
