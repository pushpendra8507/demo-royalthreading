<?php
class MV_Welcome extends Database
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $stmt =  $this->connection->prepare("SELECT * FROM `tbl_welcome` where `id`=1");
        $stmt->execute();

        return  $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($data)
    {
        $description_1 = isset($data['description_1']) ? $data['description_1'] : '';
        $description_2 = isset($data['description_2']) ? $data['description_2'] : '';


        $stmt = $this->connection->prepare("UPDATE `tbl_welcome` SET `description_1`=?,`description_2`=? WHERE `id`=1");
        $stmt->bindParam(1, $description_1);
        $stmt->bindParam(2, $description_2);
        return ($stmt->execute()) ? 1 : 0;
    }
}
