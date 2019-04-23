<?php $dirname = "compressed/";

if (!file_exists($dirname)) {
    mkdir("compressed/");
    echo "folder created";
    header("location:/?page=0&folder=" . "compressed/");
}
    $images = glob($dirname . "*");

    function formatSizeUnits($bytes) {
    if ($bytes >= 1073741824) {
        $bytes = number_format($bytes / 1073741824, 2) . ' GB';
    }
    elseif ($bytes >= 1048576){
        $bytes = number_format($bytes / 1048576, 2) . ' MB';
    }
    elseif ($bytes >= 1024) {
        $bytes = number_format($bytes / 1024, 2) . ' KB';
    }
    elseif ($bytes > 1) {
        $bytes = $bytes . ' bytes';
    }
    elseif ($bytes == 1) {
        $bytes = $bytes . ' byte';
    }
    else {
        $bytes = '0 bytes';
    }
    return $bytes;
}
$GLOBALS['limit'] = 4;
@$GLOBALS['page'] = (int)$_GET['page']?:0;
$GLOBALS['skip'] = $GLOBALS['limit'] * $GLOBALS['page'];
if ($handle = opendir('compressed/')) {
        $blacklist = array('.', '..', 'uploads', 'index.php','resize.php','upload.php','delete.php');
            $GLOBALS['skipped']  = -1;
    while (false !== ($file = readdir($handle))) {
        if (!in_array($file, $blacklist)) {
            $GLOBALS['skipped'] ++;
                if ($GLOBALS['skipped']  < $GLOBALS['skip'] || $GLOBALS['skipped']  >= $GLOBALS['skip'] + $GLOBALS['limit']) {
                    continue;
                }
?>
    <link rel="stylesheet" href="css/styles.css">
    <link href="https://fonts.googleapis.com/css?family=ZCOOL+XiaoWei" rel="stylesheet">
        <div class="card" style="width: 18rem; ">
            <img class="card-img-top" src=" <?= "compressed/" . $file ?> " alt="Card image cap">
            <div class="card-body">
                <form onsubmit="form_rename(this,event)" enctype="multipart/form-data" class="form-rename">
                    <input class="myinput" autocomplete="off"  onfocus="this.value = ''" name="rename" type="text"   value="<?php $explode = explode("/","compressed/". $file);
                        echo end($explode)?>"/>
                    <input style="width: 250px"  type = "hidden" class= "hide" name="oldname" autocomplete="off"  value="<?php $explode = explode("/","compressed/". $file);
                        echo end($explode)?>"/>
                    <br>
                    <p style="font-family: 'ZCOOL XiaoWei', serif;" class="card-text"><?php echo $date = date("F d Y H:i:s.", filemtime("compressed/" . $file));
                        $size = filesize("compressed/" . $file);
                        $mimetype = mime_content_type("compressed/" . $file);
                        $filesize = formatSizeUnits($size);?><br><?php
                        echo $filesize ?> </p>
                    <a onclick="remove(this,event)" id = "delete" style="font-family: 'ZCOOL XiaoWei', serif;" href="delete.php?path=<?php echo "compressed/" . $file ?>" class="btn btn-primary">Delete</a>
                    <button type="submit" style=" float:right ; font-family: 'ZCOOL XiaoWei', serif;"  id = "rename" class="btn btn-primary" name="submit">Rename</button>
                </form>
            </div>
        </div>
            <?php
        }
    }
}
$pages = (int)$GLOBALS['skipped'] / $GLOBALS['limit'];
    if ($GLOBALS['skip'] % $GLOBALS['limit']) {
        $pages ++;
    }
    for ($i = 0; $i < $pages; $i++) {
        $class = '';
    if ($GLOBALS['page'] == $i) {
        $class = 'class="active"';
    }
?>
    <ul class = "pagination shadow-sm">
        <li class = "page-item">
            <a class = "page-link" href = "?page=<?= $i ?>" <?= $class ?>><?= $i ?></a>
        </li>
    </ul>
<?php
}
?>
