<?php



class student
{
	private PDO $db;
	public function __construct(PDO $db)
	{
		$this->db=$db;
	}

	// get all students ; in get return all the data but never the password 

	public function getAll():array
	{
		$sql = "SELECT id, name, email, course, created_at
		FROM students
		ORDER BY id DESC";
		$stmt = $this->db->query($sql);
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	// get students by id

	// public function get_id(int $id):?array
	// {
	// 	$sql = "SELECT id
	// 	FROM students
	// 	WHERE id=?";
	// 	$stmt = $this->db->query($sql);
	// 	$stmt = execute([$id]);
	// 	$student =$stmt->fetchAll(PDO::FETCH_ASSOC);
	// 	return $student ?:null;
	// }

	public function get_id(int $id):?array
	{
		$sql = "SELECT id, name, email, course, created_at
				FROM students
				WHERE id = ?";

		$stmt = $this->db->prepare($sql);
		$stmt->execute([$id]);

		$student = $stmt->fetch();

		return $student ?: null;
	}

	// create student (post)

	public function create_student(string $name, string $email, string $course, string $password): int
	{
		$hashed_pass = password_hash($password, PASSWORD_DEFAULT);
		$sql = "INSERT INTO students (name, email, course, password)
				VALUES (?, ?, ?, ?)";
		$stmt = $this->db->prepare($sql);
		$stmt->execute([$name, $email, $course, $hashed_pass]);
		return (int) $this->db->lastInsertId();
	}

	// public function create_student(string $name, string $email, string $coures, string $password):int
	// {
	// 	// hashed password;
	// 	$hashed_pass = password_hash($password , PASSWORD_DEFAULT);
	// 	$sql = "INSERT INTO students 
	// 	(name, email,coures,password)
	// 	values(?,?,?,?)";
	// 	$stmt = $this->db->prepare($sql);
	// 	$stmt->execute([$name, $email, $hashed_pass, $course]);
	// 	return (int) $this->db->lastInsertId();
	// }

	// update student
	// password is optional
	public function update_student(int $id, string $name, string $email, string $coures, ?string $password = null) : bool
	{
		if ($password != null && $password != "")
		{
			$hashed_pass = password_hash($password , PASSWORD_DEFAULT);
			$sql = "UPDATE students 
			SET name = ? , email = ?, course = ? , password = ? 
			WHERE id = ?";
			$stmt = $this->db->prepare($sql);
			$stmt->execute([$name, $email, $course, $hashed_pass, $id]);
			// $stmt->execute([$name, $email, $hashed_pass, $course]);
			// return (int) $this->db->lastInsertId();
		}
		else 
		{
			$sql = "UPDATE students 
			SET name = ? , email = ?, course = ?
			WHERE id = ?";
			$stmt = $this->db->prepare($sql);
			$stmt->execute([$name, $email, $course, $id]);
			// $stmt->execute([$name, $email, $course]);
			// return (int) $this->db->lastInsertId();
		}
		return $stmt->rowCount() > 0;
	}

	// verify password

	public function verify_password(int $id , string $password):bool
	{
		$sql = "SELECT password
		FROM students
		WHERE id = ?";

		$stmt = $this->db->prepare($sql);
		$stmt->execute([$id]);
		$student = $stmt->fetch(PDO::FETCH_ASSOC);
		if (!$student)
		{
			return false;
		}
		else 
		{
			return password_verify($password, $student["password"]);
		}
	}

	// delete student
	public function delete_student(int $id):bool
	{
		$sql = "DELETE FROM students WHERE id = ?";
		$stmt = $this->db->prepare($sql);
		$stmt->execute([$id]);
		return $stmt->rowCount() > 0;
	}



}


?>