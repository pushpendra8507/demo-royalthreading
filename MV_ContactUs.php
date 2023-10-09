<?php
class MV_ContactUs extends Database
{
  public function __construct()
  {
    parent::__construct();
  }

  public function index()
  {
    $stmt = $this->connection->prepare("select * from tbl_contactus where activatedstatus = 1");
    if ($stmt->execute()) {
      return $rtmt = $stmt->fetch(PDO::FETCH_ASSOC);
    } else {
      die(print_r($stmt->errorInfo(), true));
    }
  }

  public function update($data = array())
  {

    $stmt = $this->connection->prepare("UPDATE `tbl_contactus` SET `address`=?,`email`=?,`phone`=?,`phone_2`=?,`facebook`=?,`yelp`=?,`business_hours`=?,`updated_at`=now() where id=1");
    $stmt->bindParam(1, $data['address']);
    $stmt->bindParam(2, $data['email']);
    $stmt->bindParam(3, $data['phone']);
    $stmt->bindParam(4, $data['phone_2']);
    $stmt->bindParam(5, $data['facebook']);
    $stmt->bindParam(6, $data['yelp']);
    $stmt->bindParam(7, $data['business_hours']);
    if ($stmt->execute()) {
      return 1;
    } else {
      die(print_r($stmt->errorInfo(), true));
    }
  }
}
