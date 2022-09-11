<?php

include "file.php";

$dsn = "mysql:host=localhost;dbname=pdc10_db";
$user = "root";
$passwd = "";

$pdo = new PDO($dsn, $user, $passwd);

$result = File::handleUpload($_FILES['fileSelect']);
if ($result == "error"){
	header('Location: index.php?error=' . "error file type");
}

else{
	if ($result !== FALSE) {
		try{
			//Save registration data
			$encrypted_pass = md5($_POST['password']);
			$register = new File($_POST['compname'], $_POST['email'], $password = $encrypted_pass, $result['save_path']);
			$result = $register->save();
			header('Location: index.php?success=1');
		}
		catch(Exception $e) {
			error_log(e->getMessage());
		}

	} else {

		header('Location: index.php?error=' . $e->getMessage());

	}
}
?>