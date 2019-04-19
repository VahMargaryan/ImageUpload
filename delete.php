<?php
if (($_POST['path'])) {
        $path = $_POST['path'];
        unlink($path);
        include "cont.php";
    }
?>