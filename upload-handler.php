<?php

include "File.php";

$dsn = "mysql:host=localhost;dbname=my_files";
$user = "root";
$passwd = "secret123";

$pdo = new PDO($dsn, $user, $passwd);

$result = File::handleUpload($_FILES['input_file']);

if ($result !== FALSE) {

	// Save the uploaded file to DB. File name as the label
	$fileObj = new File($_FILES['input_file']['name'], $result['path'], $result['type']);
	$result = $fileObj->save();

	header('Location: index.php?success=1');

} else {

	header('Location: index.php?error=' . $e->getMessage());

}