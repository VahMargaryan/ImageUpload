<?php
if (isset($_FILES['file'])) {
    $file = $_FILES['file'];

    $fileName = $_FILES['file']['name'];
    $fileTmpName = $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['size'];
    $fileType = $_FILES['file']['type'];
    $fileError = $_FILES['file']['error'];

    $fileExt = explode('.', $fileName);
    $fileActExt = strtolower(end($fileExt));

    $allow = array('jpg', 'jpeg', 'png', 'pdf');

    if ( in_array( $fileActExt, $allow ) )
        {
            if ( $fileError === 0 )
            {
                if ( $fileSize < 10000000000000 )
                {
                    $fileNameNew = uniqid("", true) . "." . $fileActExt;
                    $fileDest = "upload/" . $fileNameNew;
                    $imageProcess = 0;
                        if ( is_array($_FILES ) )
                        {
                            include_once "resize.php";
                            $sourceProperties = getimagesize($fileTmpName);
                            $resizeFileName = time();
                            $uploadPath = "upload/";
                            $fileExt = pathinfo ( $_FILES['file']['name'] , PATHINFO_EXTENSION );
                            move_uploaded_file ( $fileTmpName, "upload/" . $fileNameNew  );
                            $imageProcess = 1;
                            $target_file = "upload/$fileNameNew";
                            $resized_file = "compressed/$fileNameNew";
                            $wmax = 200;
                            $hmax = 200;
                            ak_img_resize( $target_file , $resized_file , $wmax , $hmax , $fileExt );
                            include "cont.php";
                }
            else
                {
                    echo " Your File Is Too Big ";
                }
    }
    else
    {
        echo " There Was An Error Uploading File ";
    }
}
else
    {
        echo " This Type is Unvaible ";
    }
}}
