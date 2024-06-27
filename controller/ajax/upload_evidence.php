<?php

require_once "../forms.controller.php";
require_once "../../model/forms.models.php";

// Directorio de carga
$uploadDirectory = '../../assets/uploads/' . $_POST['matrix'] . '/';

// Crear el directorio de carga si no existe
if (!is_dir($uploadDirectory)) {
    mkdir($uploadDirectory, 0755, true);
}

// Inicializar la respuesta por defecto
$response = [
    'status' => 'error',
    'message' => 'No files uploaded',
    'files' => [],
    'uploadId' => null
];

$progress = ($_POST['progress'] <= $_POST['maxProgress']) ? $_POST['progress'] : $_POST['maxProgress'];
$upload = FormsController::ctrAddEvidence($_POST['matrix'], $_POST['description'], $progress);
if ($upload) {
    $response['uploadId'] = $upload; // Asignar el lastId de la evidencia recién agregada
    try {
        if (!empty($_FILES)) {
            foreach ($_FILES as $key => $fileArray) {
                if (is_array($fileArray['name'])) {
                    for ($i = 0; $i < count($fileArray['name']); $i++) {
                        $filePath = $uploadDirectory . basename($fileArray['name'][$i]);
                        if (move_uploaded_file($fileArray['tmp_name'][$i], $filePath)) {
                            // Reducir el tamaño de la imagen si es una imagen soportada
                            if (reduceImageSize($filePath)) {
                                error_log("File uploaded and optimized: " . $filePath); // Registrar en el log
                            } else {
                                error_log("File uploaded but optimization failed: " . $filePath); // Registrar en el log
                            }
                            // Añadir el archivo al array de respuesta
                            $response['files'][] = [
                                'name' => basename($fileArray['name'][$i]),
                                'path' => $filePath
                            ];
                        } else {
                            error_log("Failed to upload: " . $fileArray['name'][$i]); // Registrar error en el log
                        }
                    }
                } else {
                    $filePath = $uploadDirectory . basename($fileArray['name']);
                    if (move_uploaded_file($fileArray['tmp_name'], $filePath)) {
                        // Reducir el tamaño de la imagen si es una imagen soportada
                        if (reduceImageSize($filePath)) {
                            error_log("File uploaded and optimized: " . $filePath); // Registrar en el log
                        } else {
                            error_log("File uploaded but optimization failed: " . $filePath); // Registrar en el log
                        }
                        // Añadir el archivo al array de respuesta
                        $response['files'][] = [
                            'name' => basename($fileArray['name']),
                            'path' => $filePath
                        ];
                    } else {
                        error_log("Failed to upload: " . $fileArray['name']); // Registrar error en el log
                    }
                }
            }

            $response['status'] = 'success';
            $response['message'] = 'Files uploaded successfully';
        }
    } catch (Exception $e) {
        error_log("Exception: " . $e->getMessage()); // Registrar la excepción en el log
        $response['message'] = 'An error occurred: ' . $e->getMessage();
    }
}

header('Content-Type: application/json');
echo json_encode($response);

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
            $result = imagepng($image, $filePath, 9); // 0 (sin compresión) a 9
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