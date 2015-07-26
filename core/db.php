<?php
	class Database {
		private $dbname;
		private $user;
		private $pass;
		private $host;
		private $pdo;

		public function __construct($dbname, $user = 'root', $pass = '', $host = 'localhost') {
			$this->dbname = $dbname;
			$this->user = $user;
			$this->pass = $pass;
			$this->host = $host;
		}

		private function getPDO() {
			if($this->pdo === null) {
				$pdo = new PDO("mysql:dbname=$this->dbname; host=$this->host", $this->user, $this->pass);
				$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$this->pdo = $pdo;
			}
			return $this->pdo;
		}

		public function query($statement) {
			$req = $this->getPDO()->query($statement);
			$data = $req->fetchAll(PDO::FETCH_OBJ);
			return $data;
		}

		public function prepare($statement, $attributes, $insert = 0) {
			$req = $this->getPDO()->prepare($statement);
			$req->execute($attributes);

			if(!$insert) {
				$data = $req->fetchAll(PDO::FETCH_OBJ);
			} else {
				$data = $this->pdo->lastInsertId();
			}
			return $data;
		}
	}

	$db = new Database("");
?>
