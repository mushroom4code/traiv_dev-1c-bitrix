<?php
if(isset($_FILES) && $_FILES['inputfile']['error'] == 0){ // ���������, �������� �� ������������ ����
$destiation_dir = dirname(__FILE__) .'/'.$_FILES['inputfile']['name']; // ���������� ��� ���������� �����
move_uploaded_file($_FILES['inputfile']['tmp_name'], $destiation_dir ); // ���������� ���� � �������� ����������
echo 'File Uploaded'; // ��������� ������������ �� �������� �������� �����
}
else{
echo 'No File Uploaded'; // ��������� ������������ � ���, ��� ���� �� ��� ��������
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