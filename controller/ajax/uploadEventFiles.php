<?php
require_once "../forms.controller.php";
require_once "../../model/forms.models.php";

if (isset($_POST['eventId'])) {
    $eventId = $_POST['eventId'];
    $idTeam = $_POST['idTeam'];
    $fileType = '';

    if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['file']['tmp_name'];
        $fileName = $_FILES['file']['name'];
        $fileSize = $_FILES['file']['size'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));

        $allowedfileExtensions = array('jpg', 'jpeg', 'gif', 'png', 'pdf', 'doc', 'docx', 'ppt', 'pptx', 'xls', 'xlsx', 'txt');
        if (in_array($fileExtension, $allowedfileExtensions)) {
            $uploadFileDir = '../../assets/uploads/events/';
            $dest_path = $uploadFileDir . $fileName;
            if (move_uploaded_file($fileTmpPath, $dest_path)) {
                if (in_array($fileExtension, array('jpg', 'jpeg', 'gif', 'png'))) {
                    reduceImageSize($dest_path);
                    $fileType = 'image';
                } else {
                    $fileType = 'document';
                }
                $response = FormsController::ctrUploadEventFiles($eventId, $fileName, $fileType, $idTeam);
                echo json_encode($response);
            } else {
                echo json_encode('Error al mover el archivo al directorio de subida.');
            }
        } else {
            echo json_encode('Tipo de archivo no permitido. Tipos permitidos: ' . implode(',', $allowedfileExtensions));
        }
    } elseif (!empty($_POST['videoLink'])) {
        $videoLink = $_POST['videoLink'];
        $fileType = 'video';
        $response = FormsController::ctrUploadEventFiles($eventId, $videoLink, $fileType, $idTeam);
        echo json_encode($response);
    } else {
        echo json_encode('No se ha subido ningún archivo o el tipo de archivo es inválido.');
    }
}

// Función para reducir el tamaño de la imagen
function reduceImageSize($filePath)
{
    $info = getimagesize($filePath);
    if ($info === false) {
        error_log("Failed to get image size: " . $filePath);
        return false;
    }

    switch ($info['mime']) {
        case 'image/jpeg':
            $image = imagecreatefromjpeg($filePath);
            if ($image === false) {
                error_log("Failed to create image from JPEG: " . $filePath);
                return false;
            }
            $result = imagejpeg($image, $filePath, 45);
            break;

        case 'image/png':
            $image = imagecreatefrompng($filePath);
            if ($image === false) {
                error_log("Failed to create image from PNG: " . $filePath);
                return false;
            }
            $bg = imagecreatetruecolor(imagesx($image), imagesy($image));
            imagealphablending($bg, false);
            imagesavealpha($bg, true);
            $transparent = imagecolorallocatealpha($bg, 0, 0, 0, 127);
            imagefilledrectangle($bg, 0, 0, imagesx($image), imagesy($image), $transparent);
            imagecopy($bg, $image, 0, 0, 0, 0, imagesx($image), imagesy($image));
            $result = imagepng($bg, $filePath, 9); // 0 (sin compresión) a 9 (máxima compresión)
            imagedestroy($bg);
            break;

        case 'image/gif':
            $image = imagecreatefromgif($filePath);
            if ($image === false) {
                error_log("Failed to create image from GIF: " . $filePath);
                return false;
            }
            $result = imagegif($image, $filePath);
            break;

        default:
            error_log("Unsupported image type: " . $info['mime']);
            return false;
    }

    imagedestroy($image);
    return $result;
}
