<!DOCTYPE html>
<html lang="ukr">
<head>
    <meta charset="UTF-8" name = "upload_CSV" content="Сторінка для завантаження csv-таблиці бази даних.">
    <title>upload_CSV</title>
</head>
<body>
<form method="post" action="upload_csv_file.php" enctype="multipart/form-data">
    <input type="file" name="file" accept=".csv" required = "required" formenctype="multipart/form-data">
    <input type="submit" value="Відправити файл" >
</form>
</body>
</html>