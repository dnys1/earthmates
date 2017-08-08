<?php
    require_once 'class.upload.php';

    $handle = new Upload($_FILES['file']);
    $handle->allowed = 'image/*';

    if($handle->uploaded) {
        $handle->Process('../../uploads');
        if($handle->processed) {
            echo 'Image uploaded';
        } else {
            echo 'error';
        }
    }	
?>