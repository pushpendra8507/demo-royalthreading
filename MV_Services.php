<?php
class MV_Services extends Database
{

	public function __construct()
	{
		parent::__construct();
	}

	public function index($homepage = 0)
	{

		if ($homepage == 0) {
			$stmt = $this->connection->prepare("select * from tbl_services where homepage=? order by id ");
			$stmt->bindParam(1, $homepage);
		} else if ($homepage == 1) {
			$stmt = $this->connection->prepare("select * from tbl_services where homepage=? order by id ");
			$stmt->bindParam(1, $homepage);
		} else if ($homepage == 2) {
			$stmt = $this->connection->prepare("select * from tbl_services order by id ");
		}

		if ($stmt->execute()) {
			return $rtmt = $stmt->fetchAll(PDO::FETCH_ASSOC);
		} else {
			die(print_r($stmt->errorInfo(), true));
		}
	}
	public function store($data = array())
	{

		$stmt = $this->connection->prepare("INSERT INTO `tbl_services`(`title`,`seo_title`,`title_home`,`seo_description`,`seo_keyword`,`seo_h1`,`seo_h2`,`description`,`alt_name`,`detail`,`price`, `status`,`title_name`,second_price,`title_name_2`,`price_3`) VALUES (?,?,?,?,?,?,?,?,?,?, 1,?,?,?,?)");

		$stmt->bindParam(1, $data['title']);
		$stmt->bindParam(2, $data['seo_title']);
		$stmt->bindParam(3, $data['title_home']);
		$stmt->bindParam(4, $data['seo_description']);
		$stmt->bindParam(5, $data['seo_keyword']);
		$stmt->bindParam(6, $data['seo_h1']);
		$stmt->bindParam(7, $data['seo_h2']);
		$stmt->bindParam(8, $data['description']);
		$stmt->bindParam(9, $data['alt_name']);
		$stmt->bindParam(10, $data['detail']);
		$stmt->bindParam(11, $data['price']);
		$stmt->bindParam(12, $data['title_name']);
		$stmt->bindParam(13, $data['second_price']);
		$stmt->bindParam(14, $data['title_name_2']);
		$stmt->bindParam(15, $data['price_3']);


		if ($stmt->execute()) {
			$last_insert_id = $this->connection->lastInsertId();
			return (isset($last_insert_id) && !empty($last_insert_id)) ? $last_insert_id : die(print_r($stmt->errorInfo(), true));
		} else {
			die(print_r($stmt->errorInfo(), true));
		}
	}

	public function update($id, $data = array())
	{

		$stmt = $this->connection->prepare("UPDATE `tbl_services` SET `title`=?,`seo_title`=?,`title_home`=?,`seo_description`=?,`seo_keyword`=?,`seo_h1`=?,`seo_h2`=?,`description`=?,`alt_name`=?,`detail`=?,`price`=?, `title_name`=?, `second_price`=?, `title_name_2`=?,`price_3`=?  where id=?",);

		$stmt->bindParam(1, $data['title']);
		$stmt->bindParam(2, $data['seo_title']);
		$stmt->bindParam(3, $data['title_home']);
		$stmt->bindParam(4, $data['seo_description']);
		$stmt->bindParam(5, $data['seo_keyword']);
		$stmt->bindParam(6, $data['seo_h1']);
		$stmt->bindParam(7, $data['seo_h2']);
		$stmt->bindParam(8, $data['description']);
		$stmt->bindParam(9, $data['alt_name']);
		$stmt->bindParam(10, $data['detail']);
		$stmt->bindParam(11, $data['price']);
		$stmt->bindParam(12, $data['title_name']);
		$stmt->bindParam(13, $data['second_price']);
		$stmt->bindParam(14, $data['title_name_2']);
		$stmt->bindParam(15, $data['price_3']);
		$stmt->bindParam(16, $id);
		if ($stmt->execute()) {
			return $id;
		} else {
			die(print_r($stmt->errorInfo(), true));
		}
	}

	public function delete($id)
	{
		$photoid = $this->get_details($id);
		if (!empty($photoid['photourl'])) {
			unlink('../' . $photoid['photourl']);
		}

		$stmt = $this->connection->prepare("DELETE FROM `tbl_services` WHERE id = ?");
		$stmt->bindParam(1, $id);
		if ($stmt->execute()) {
			return $id;
		} else {
			die(print_r($stmt->errorInfo(), true));
		}
	}

	public function get_details_by_alias($detail)
	{
		$stmt = $this->connection->prepare("SELECT * FROM `tbl_services` WHERE `detail`=?");
		$stmt->bindParam(1, $detail);
		if ($stmt->execute()) {
			return $rtmt = $stmt->fetch(PDO::FETCH_ASSOC);
		} else {
			die(print_r($stmt->errorInfo(), true));
		}
	}

	public function get_details($id)
	{
		$stmt = $this->connection->prepare("select * from tbl_services where id=?");
		$stmt->bindParam(1, $id);
		if ($stmt->execute()) {
			return $rtmt = $stmt->fetch(PDO::FETCH_ASSOC);
		} else {
			die(print_r($stmt->errorInfo(), true));
		}
	}

	public function update_homepage_status($id, $status)
	{
		$stmt = $this->connection->prepare("UPDATE `tbl_services` SET `homepage`=? where id=?");

		$stmt->bindParam(1, $status);
		$stmt->bindParam(2, $id);
		if ($stmt->execute()) {
			return $id;
		} else {
			die(print_r($stmt->errorInfo(), true));
		}
	}
}
