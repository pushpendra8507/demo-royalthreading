<?php
class PR_Videos extends Database{

	public function __construct()
	{
		parent::__construct();
	}

	public function video_list()
	{
		$stmt =  $this->connection->prepare("SELECT * FROM `tbl_videos` where `status`=1");
        $stmt ->execute();

        return  $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	

	public function store($data=[])
	{
		$stmt = $this->connection->prepare("INSERT INTO `tbl_videos` (`title`,`youtube_link`,`status`) VALUES(?,?,1)");
		$stmt->bindParam(1, $data['title']);
		$stmt->bindParam(2, $data['youtube_link']);
		if($stmt->execute())
		{
			$last_insert_id = $this->connection->lastInsertId();
			return (isset($last_insert_id) && !empty($last_insert_id))?$last_insert_id:die(print_r($stmt->errorInfo(), true));
		}
		else
		{
			die(print_r($stmt->errorInfo(), true));
		}
	}

	
	

	public function delete($id)
	{
		$stmt = $this->connection->prepare("DELETE FROM `tbl_videos` WHERE `id`=?");
		$stmt->bindParam(1, $id);
		if($stmt->execute())
		{
			return true;
		}
		else
		{
			die(print_r($stmt->errorInfo(), true));
		}
	}

}