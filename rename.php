<?php
    if ( isset($_POST['oldname']))
    {
        $rename = $_POST['newname'];
        $oldname = $_POST['oldname'];
        $remove[]= " ";
        $remove[]= "$";
        $remove[] = "%";
        $remove[] = '/';
        $remove[] = "|";
        $remove[] = "\\";
        $remove[] = '*';
        $remove[] = '<';
        $remove[] = '>';
        $sanitize = str_replace($remove, "", $rename);
    if ($sanitize === "" || $oldname === "" || empty($oldname) || empty($sanitize))
        {
            echo " Empty Fields";
        }
    else
        {
            $explode = explode(".", $oldname);
            $ext = end($explode);
            $dir = "compressed/";
            rename($dir . $oldname ,  $dir . $sanitize . "." . $ext);
            echo $sanitize . "." . $ext;
        }
    }


