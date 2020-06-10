<?php
require_once "DB.php";

print_r($_SERVER['HTTP_ORIGIN']);
$redirect_to =  $_SERVER['HTTP_ORIGIN'] . '/image.php?' . http_build_query(['id' => $_POST['id']]);

//var_dump($redirect_to);

header("Location: $redirect_to");

$db = DB::getInstance();
$sql = "UPDATE `images` SET `color` = ?, `text` = ?, `size` = ? WHERE `id` = UNHEX(?)";
$stmt = $db->prepare($sql);
$stmt->execute([$_POST['color'],$_POST['legend'],$_POST['size'], $_POST['id']]);

