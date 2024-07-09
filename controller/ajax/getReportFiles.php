<?php
require_once "../forms.controller.php";
require_once "../../model/forms.models.php";

    $reports = FormsController::ctrGetReports($_POST['Project']);
    $files = [];
    foreach ($reports as $report) {
        $reportFiles = json_decode($report['files'], true);
        if ($reportFiles) {
            foreach ($reportFiles as $file) {
                $files[] = [
                    'name' => $file['name'],
                    'path' => $file['path'],
                    'type' => in_array(pathinfo($file['name'], PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif']) ? 'image' : 'document'
                ];
            }
        }
        if (!empty($report['videos'])) {
            $videos = explode(',', $report['videos']);
            foreach ($videos as $video) {
                $files[] = [
                    'name' => $video,
                    'path' => $video,
                    'type' => 'video'
                ];
            }
        }
    }
    echo json_encode($files);
    
