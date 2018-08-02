<?php
	function createTablesDatabase($pdo) {
		$sql = "CREATE TABLE IF NOT EXISTS luminosidade (" .
								"id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY," .
								"luminosidade FLOAT NOT NULL," .
								"tempo TIMESTAMP NOT NULL" .
						");" .

						"CREATE TABLE IF NOT EXISTS umidade (" .
								"id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY," .
								"umidade FLOAT NOT NULL," .
								"tempo TIMESTAMP NOT NULL" .
						");" .

						"CREATE TABLE IF NOT EXISTS temperatura (" .
								"id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY," .
								"temperatura FLOAT NOT NULL," .
								"tempo TIMESTAMP NOT NULL" .
						");";

		$pdo->prepare($sql)->execute();
	}
?>