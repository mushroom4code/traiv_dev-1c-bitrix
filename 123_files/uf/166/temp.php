<?php
if(isset($_FILES) && $_FILES['inputfile']['error'] == 0){ // Проверяем, загрузил ли пользователь файл
$destiation_dir = dirname(__FILE__) .'/'.$_FILES['inputfile']['name']; // Директория для размещения файла
move_uploaded_file($_FILES['inputfile']['tmp_name'], $destiation_dir ); // Перемещаем файл в желаемую директорию
echo 'File Uploaded'; // Оповещаем пользователя об успешной загрузке файла
}
else{
echo 'No File Uploaded'; // Оповещаем пользователя о том, что файл не был загружен
}
?>
<html>
<head>
<title>Basic File Upload</title>
</head>
<body>
<h1>Basic File Upload</h1>
<form method="post" action="template.php" enctype="multipart/form-data">
<label for="inputfile">Upload File</label>
<input type="file" id="inputfile" name="inputfile"></br>
<input type="submit" value="Click To Upload">
</form>
</body>
</html>