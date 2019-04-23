<?php
if (!isset($_GET['page'])){
    header("location: index.php?page=0");
}
?>
<!doctype html>
<html lang="en">
<head>
    <link rel="icon" type="image/ico" href="/images/favicon.png" />
    <link rel="stylesheet" href="css/style.css">
    <script src=" http://code.jquery.com/jquery-3.3.1.js " integrity=" sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60= "
        crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Upload Image Form</title>
</head>
<body>
    <form id="form" action="upload.php" method="POST" enctype="multipart/form-data">
        <input id="file" type="file" name="file">
        <button type="submit" name="submit">Upload Image</button>
    </form>
    <div class="cont">
<?php include "cont.php"
?>
    </div>
</body>
<script src="js/script.js"></script>
</html>



