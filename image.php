<?php
require_once "DB.php";

function imagecreatefromfile( $filename ) {
    if (!file_exists($filename)) {
        throw new InvalidArgumentException('File "'.$filename.'" not found.');
    }
    switch ( strtolower( pathinfo( $filename, PATHINFO_EXTENSION ))) {
        case 'jpeg':
        case 'jpg':
            return imagecreatefromjpeg($filename);
        break;

        case 'png':
            return imagecreatefrompng($filename);
        break;

        case 'gif':
            return imagecreatefromgif($filename);
        break;

        default:
            throw new InvalidArgumentException('File "'.$filename.'" is not valid jpg, png or gif image.');
        break;
    }
}

header("Content-Type: image/jpeg");
$id = htmlspecialchars($_GET["id"]);

$db = DB::getInstance();
$sql = "SELECT `name`,`type`,`text`,`color`,`size` FROM `images` WHERE `id` = UNHEX(?)";
$stmt= $db->prepare($sql);
$stmt->execute([$id]);
$row = $stmt->fetch(PDO::FETCH_ASSOC);
//Get RGB Color
list($r, $g, $b) = sscanf($row['color'], "#%02x%02x%02x");
$fontSize = $row['size'];
$imgPath = $row['name'];
$image = imagecreatefromfile($imgPath);
$color = imagecolorallocate($image, $r, $g, $b);
$string = $row['text'];
$font = '/usr/share/fonts/gnu-free/FreeSans.ttf';
$x = 115;
$y = 185;
imagettftext($image, $fontSize, 0, $x, $y, $color, $font, $string);
imagejpeg($image);
