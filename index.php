<html lang="en">
<head>
  <meta charset="utf-8">

  <title>The HTML5 Herald</title>
  <meta name="description" content="The HTML5 Herald">
  <meta name="author" content="SitePoint">

  <link rel="stylesheet" href="css/styles.css?v=1.0">

</head>
<body>
    <h1>Загрузка картинки</h1>

    <form enctype="multipart/form-data" action="fileupload.php" method="POST">
        <input type="hidden" name="MAX_FILE_SIZE" value="300000" />
        Выберите файл: <input name="userfile" type="file" />
        <input type="submit" value="Отправить файл" />
    </form>
</body>