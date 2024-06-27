<?php
$uploadDirectory = '../../assets/uploads/';

$response = [
    'status' => 'error',
    'files' => [],
    'message' => 'No files found.'
];

if (isset($_POST['idMatrix'])) {
    $idMatrix = $_POST['idMatrix'];
    $directory = $uploadDirectory . $idMatrix . '/';

    if (is_dir($directory)) {
        $files = scandir($directory);
        $files = array_diff($files, array('.', '..'));

        if (!empty($files)) {
            $response['status'] = 'success';
            $response['files'] = array_values($files);
            $response['message'] = 'Files found.';
        } else {
            $response['message'] = 'No files in directory.';
        }
    } else {
        $response['message'] = 'Directory does not exist.';
    }
}

header('Content-Type: application/json');
echo json_encode($response);
