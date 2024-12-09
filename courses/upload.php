<?php
$uploaddir = '/home/levelhst/innovations.kh.ua/www/math/uploads/';
$uploadfile = $uploaddir . basename($_FILES['userfile']['name']);

echo '<pre>';
if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
    echo "Файл коректний і успішно завантажений.\n";
} else {
    echo "Можлива атака за допомогою файлового завантаження!\n";
}

echo 'Деяка налагоджувальна інформація:';
print_r($_FILES);

print "</pre>";

?>