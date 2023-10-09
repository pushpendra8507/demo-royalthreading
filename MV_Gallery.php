<?php
class MV_Work extends Database{

	public function __construct()
	{
		parent::__construct();
	}

	public function index($homepage=0){

		if($homepage==0)
		{
			$stmt = $this->connection->prepare("select * from tbl_our_work where homepage=? order by id ");
			$stmt->bindParam(1,$homepage);
		}
		else if($homepage==1){
			$stmt = $this->connection->prepare("select * from tbl_our_work where homepage=? order by id ");
			$stmt->bindParam(1,$homepage);
		}
		else if($homepage==2){
			$stmt = $this->connection->prepare("select * from tbl_our_work order by id ");
		}
		
		if($stmt->execute()){
			return $rtmt = $stmt->fetchAll(PDO::FETCH_ASSOC);
		}
		else{
			die(print_r($stmt->errorInfo(), true));
		}
	}

	public function store($data = array())
	{
		
		$stmt = $this->connection->prepare("INSERT INTO `tbl_our_work`(`alt_name_home`, `status`,`alt_name`,`title`) VALUES (?, 1,?,?)");
		
		$stmt->bindParam(1,$data['alt_name_home']);
		$stmt->bindParam(2,$data['alt_name']);
		$stmt->bindParam(3,$data['title']);
		if($stmt->execute()){
			$last_insert_id = $this->connection->lastInsertId();
			return (isset($last_insert_id) && !empty($last_insert_id))?$last_insert_id:die(print_r($stmt->errorInfo(), true));
		}
		else{
			die(print_r($stmt->errorInfo(), true));
		}
		
	}

	public function update($id, $data = array()){
		
		$stmt = $this->connection->prepare("UPDATE `tbl_our_work` SET `alt_name_home`=?,`alt_name`=?,`title`=?  where id=?");

		$stmt->bindParam(1,$data['alt_name_home']);		
		$stmt->bindParam(2,$data['alt_name']);		
		$stmt->bindParam(3,$data['title']);		
		$stmt->bindParam(4,$id);
		if($stmt->execute()){
			return $id;
		}
		else{
			die(print_r($stmt->errorInfo(), true));
		}
	}

	public function delete($id){
		$photoid = $this->get_details($id);
		if(!empty($photoid['photourl'])){
			unlink('../'.$photoid['photourl']);
		}
		
		$stmt = $this->connection->prepare("DELETE FROM `tbl_our_work` WHERE id = ?");
		$stmt->bindParam(1,$id);
		if($stmt->execute()){
			return $id;
		}
		else{
			die(print_r($stmt->errorInfo(), true));
		}
	}

	

	public function get_details($id){
		$stmt = $this->connection->prepare("select * from tbl_our_work where id=?");
		$stmt->bindParam(1,$id);
		if($stmt->execute()){
			return $rtmt = $stmt->fetch(PDO::FETCH_ASSOC);
		}
		else{
			die(print_r($stmt->errorInfo(), true));
		}
	}

	public function update_homepage_status($id,$status)
	{
		$stmt = $this->connection->prepare("UPDATE `tbl_our_work` SET `homepage`=? where id=?");

		$stmt->bindParam(1,$status);
		$stmt->bindParam(2,$id);
		if($stmt->execute()){
			return $id;
		}
		else{
			die(print_r($stmt->errorInfo(), true));
		}
	}

}