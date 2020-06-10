<html lang="en">
<head>
  <meta charset="utf-8">

  <title>The HTML5 Herald</title>
  <meta name="description" content="The HTML5 Herald">
  <meta name="author" content="SitePoint">

  <link rel="stylesheet" href="css/styles.css?v=1.0">

</head>
<body>

<?php
require_once "DB.php";
require_once "Conf.php";

$uploaddir = './uploads/';
$path_parts = pathinfo(basename($_FILES['userfile']['name']));
$uploadfile = Conf::UPLOAD_DIR . uniqid() . "." . $path_parts['extension'];

move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile);
$type = empty($_FILES['userfile']['type']) ? "" : $_FILES['userfile']['type'];

echo "<h1>Введите текст и цвет надписи</h1>";
echo "<img src='$uploadfile' alt='IMAGE' height='50px' >";

$db = DB::getInstance();
//prepare UUID
$sql = "SELECT HEX(UUID_TO_BIN(UUID(),1))";
$row = $db->query($sql);
$id = $row->fetchColumn();

$sql = "INSERT INTO `images` (`id`,`name`,`type`) "
    . "VALUES (UNHEX(?),?,?)";
$stmt= $db->prepare($sql);
$stmt->execute([$id, $uploadfile, $type]);

echo <<<EOT
    <form 
        method="POST" action="picker.php">
        <input type="hidden" name="image_url" value="$uploadfile">
        <input type="hidden" name="id" value="$id">
        <br>
        <label>Текст: 
            <input type="text" name="legend" placeholder="Введите текст" />
        </label>
        <br>
        <br>
        <label>Выберите цвет шрифтф:
            <input type="number" name="size" value="20"/>
        </label>
        <br>
        <br>
        <label>Выберите цвет:
            <input type="color" name="color" value="#f6b73c"/>
        </label>
        <hr>
        <button type="submit">OK</button>
    </form>
</body>
EOT;
?>

