<?php
class User{
	private $db;
	public function __construct($db){
		$this->db=$db;
	}
	public function authen($usr,$pass)
	{
		//echo $usr." ".$pass;
		$sql = "SELECT * FROM login WHERE uname='$usr' and password='$pass'";
		//Use the PDO connection to create a PDOStatement object
		$statement = $this->db->prepare($sql);
		//tell MySQL to execute the statement
		$statement->execute();
		//retrieve the first row of data from the table
		$user = $statement->fetchObject();
		//print_r(isset($user));
		return is_object($user);
	}
	public function getUid()
	{
		$usr=$_SESSION['usr'];
		$sql = "SELECT * FROM login WHERE uname='$usr'";
		//Use the PDO connection to create a PDOStatement object
		$statement = $this->db->prepare($sql);
		//tell MySQL to execute the statement
		$statement->execute();
		//retrieve the first row of data from the table
		$uid = $statement->fetchObject();
		//print_r(isset($user));
		return $uid->uid;
	}
	public function getBalance()
	{
		$usr=$_SESSION['usr'];
		$sql = "SELECT balance FROM login WHERE uname='$usr' ";
		//Use the PDO connection to create a PDOStatement object
		$statement = $this->db->prepare($sql);
		//tell MySQL to execute the statement
		$statement->execute();
		//retrieve the first row of data from the table
		$uid = $statement->fetchObject();
		//print_r(isset($user));
		return $uid->balance;
	}
	public function getUserData()
	{
		$uid=$_SESSION['uid'];
		$sql = "SELECT * FROM login WHERE uid='$uid' ";
		//Use the PDO connection to create a PDOStatement object
		$statement = $this->db->prepare($sql);
		//tell MySQL to execute the statement
		$statement->execute();
		//retrieve the first row of data from the table
		$user = $statement->fetchObject();
		//print_r(isset($user));
		return json_encode($user);
	}
	public function getRanking()
	{
		$sql = "SELECT * FROM login order by balance desc";
		//Use the PDO connection to create a PDOStatement object
		$statement = $this->db->prepare($sql);
		//tell MySQL to execute the statement
		$statement->execute();
		//retrieve the first row of data from the table
		if(!($statement->rowCount()==0))
			return json_encode($statement->fetchAll());
		else
			return 0;
	}
}
?>