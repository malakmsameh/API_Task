
<?php
class Db {
	private $db;

	public function __construct() {
		$this->db = new PDO(
			"mysql:host=localhost;dbname=students_api;charset=utf8mb4",
			"root",
			"",
			[PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]
		);
	}

	public function run_query(string $sql, array $param = []) {
		$stmt = $this->db->prepare($sql);
		$stmt->execute($param);
		return $stmt;
	}

	public function beginTransaction()
	{
		return $this->db->beginTransaction();
	}

	public function commit()
	{
		return $this->db->commit();
	}

	public function rollBack()
	{
		if ($this->db->inTransaction())
		{
			return $this->db->rollBack();
		}
		return false;
	}
	// getter
	public function pdo(): PDO
	{
		return $this->db;
	}
}

// class Database 
// {
// 	private string $host = "localhost";
// 	private string $dbname = "students_api";
// 	private string $username = "root";
// 	private string $password = "";
// 	private ?PDO->$connection === NULL 
// 	{
// 		//  (string $host , string $dbname)
// 		public function connect(): PDO 
// 		{
// 			if (this->connection == NULL)
// 				try 
// 			{
// 				$dsn = "mysql:host={}";
// 			}
// 		}
// 	}
// }

?>

