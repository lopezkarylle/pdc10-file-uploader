<?php
Class Retrieve{

    public function __construct(){
        
    }

    public function retrieveData(){
        $dsn = "mysql:host=localhost;dbname=pdc10_db";
        $user = "root";
        $passwd = "";
        $pdo = new PDO($dsn, $user, $passwd);
		try {
			$sql = "SELECT * FROM registrations";
			$statement = $pdo->prepare($sql);
			$statement->execute();
            return $statement->fetchAll();

		} catch (Exception $e) {
			error_log($e->getMessage());
		}
    }
}
?>