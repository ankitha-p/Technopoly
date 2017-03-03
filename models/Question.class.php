<?php 
class Question{
	private $db;
	public function __construct($db){
		$this->db=$db;
	}
	public function getQuestions($lev)
	{
		$sql = "SELECT q.qid,v.costprice,v.prize FROM value v,question q left outer join owner o on q.qid=o.qid WHERE  v.level=q.level and o.qid IS NULL and q.level=".$lev;
		$statement = $this->db->prepare($sql);
		$statement->execute();
		if(!($statement->rowCount()==0))
			return json_encode($statement->fetchAll());
		else
			return 0;
	}
	public function getUserQuestions()
	{
		$uid=$_SESSION['uid'];
		$sql = "SELECT o.qid,q.question,v.costprice,v.prize FROM question q inner join value v on v.level=q.level inner join owner o on o.qid=q.qid where o.status!=1 and o.ownerid=$uid";
		$statement = $this->db->prepare($sql);
		$statement->execute();
		if(!($statement->rowCount()==0))
			return json_encode($statement->fetchAll());
		else
			return 0;
	}
	public function getMarket()
	{
		$sql = "SELECT q.qid,m.saleprice,v.level FROM market m,question q,value v where m.qid=q.qid and v.level=q.level";
		$statement = $this->db->prepare($sql);
		$statement->execute();
		if(!($statement->rowCount()==0))
			return json_encode($statement->fetchAll());
		else
			return 0;
	}
	public function getQuestion($qid)
	{
		$sql = "SELECT * FROM question q,value v,owner o where q.level=v.level and o.qid=q.qid and q.qid='$qid' ";
		$statement = $this->db->prepare($sql);
		$statement->execute();
		$ques = $statement->fetchObject();
		return $ques;
	}
	public function addMarket($qid,$price)
	{
		$status = $this->getQuestion($qid)->status;
		if($status==0)
		{
			if(!empty($qid) && !empty($price)) 
			{    
			
				$q1 = "insert into market values (".$qid.",".$price.")";
				$q2 = "update owner set status=3 where qid=".$qid;
				$statement1 = $this->db->prepare($q1);
				$statement1->execute();
				$statement2 = $this->db->prepare($q2);
				$statement2->execute();
				echo 1;
			}
			else{
				echo 2;
			}
		}
		else 
			echo 3;
	}
	public function buyQuestion($qid,$bal)
	{
		$sql = "select * from owner where qid=".$qid;
		$statement = $this->db->prepare($sql);
		$statement->execute();
		if($statement->rowCount()>0)
			return 3;
		$sql = "SELECT * FROM question q,value v where q.level=v.level and q.qid='$qid' ";
		$statement = $this->db->prepare($sql);
		$statement->execute();
		$ques = $statement->fetchObject();
		$costprice = $ques->costprice;
		if($costprice<= $bal)
		{ 
			$uid = $_SESSION['uid'];
			$sql1 = "insert into owner(qid,ownerid) values(".$qid.",".$uid.")";
			//$sql2 = "update login set balance=balance-".$costprice." where uid=".$uid;
			$statement1 = $this->db->prepare($sql1);
			$statement1->execute();
			$sql1 = "update login set balance=balance-$costprice where uid=$uid";
			$statement1 = $this->db->prepare($sql1);
			$statement1->execute();
			return 1;
		}
		else{
				return 2;
		}
	}
	function buyMarketQuestion($qid,$bal)
	{
		$sql = "select status,ownerid,saleprice from owner inner join market on market.qid=owner.qid where owner.qid=".$qid;
		$statement = $this->db->prepare($sql);
		$statement->execute();
		$market = $statement->fetchObject();
		$status=$market->status;
		$ownerid=$market->ownerid;
		$saleprice=$market->saleprice;
		$uid = $_SESSION['uid'];
		if($status==3)
		{
			if($uid==$ownerid)
			{
				echo 3;
			}
			else
			{
				if($bal<$saleprice)
				{
					echo 2;
				}
				else
				{
					$q1 = "update login set balance=balance+".$saleprice." where uid=".$ownerid;
					$q2 = "update login set balance=balance-".$saleprice." where uid=".$uid;
					$q3 = "update owner set status=4,ownerid=".$uid." where qid=".$qid;
					$q4 = "delete from market where qid=".$qid;
					$statement = $this->db->prepare($q1);$statement->execute();
					$statement = $this->db->prepare($q2);$statement->execute();
					$statement = $this->db->prepare($q3);$statement->execute();
					$statement = $this->db->prepare($q4);$statement->execute();	
					echo 1;				 
				}
			}
		}
		else 
			echo 4;
	}
	public function getOptions($qid)
	{
		$sql = "SELECT * FROM answers WHERE qid=$qid;";
		$statement = $this->db->prepare($sql);
		$statement->execute();
		if(!($statement->rowCount()==0))
			return json_encode($statement->fetchAll());
		else
			return 0;
	}
	public function submitAnswer($qid,$option,$uid)
	{
		$costprice = $this->getQuestion($qid)->costprice;
		$crctAns = $this->getQuestion($qid)->correctAnsId;
		$status = $this->getQuestion($qid)->status;
		$prize = $this->getQuestion($qid)->prize;	
		//echo $prize;	
		if($status == 0)//not submitted
		{
			$sql1= "update owner set status=1 where qid=".$qid;
			$statement1 = $this->db->prepare($sql1);
			$statement1->execute();
			$statement1 = $this->db->prepare($sql1);
			$statement1->execute();
			if($crctAns == $option){
				$sql2= "update login set balance=balance+".$prize." where uid=".$uid;
				$statement2 = $this->db->prepare($sql2);
				$statement2->execute();
				echo "1";
			}
			else{
				echo "2";
			}
		}
		else{
			echo "3";
		}
	}
}
?>