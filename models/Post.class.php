<?php 
class Post{
	private $db;
	private $totalPosts;
	public function __construct($db){
		$this->db=$db;
	}
	public function getAllPosts()
	{
		$sql = "SELECT * FROM posts WHERE visible=true ORDER BY created_on DESC";
		$statement = $this->db->prepare($sql);
		$statement->execute();
		return $statement->fetchAll();
	}
	public function addPost($title,$description,$usr)
	{
		$title=strtolower($title);
		$sql = "INSERT INTO posts(title,description,created_by) VALUES('$title','$description','$usr')";
		$statement = $this->db->prepare($sql);
		$statement->execute();
	}
	public function getPost($title)
	{
		$sql = "SELECT * FROM posts WHERE title='$title' AND visible=true;";
		$statement = $this->db->prepare($sql);
		$statement->execute();
		if(!($statement->rowCount()==0))
			return $statement->fetch();
		else
			return 0;
	}
	public function delPost($title)
	{
		$sql = "UPDATE posts set visible=false WHERE title='$title';";
		$statement = $this->db->prepare($sql);
		$statement->execute();
		echo $statement->rowCount();
	}
}
?>